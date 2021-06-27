<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\FilePathInterface;
use App\Http\Models\EmailActivate;

use App\Http\Models\ImageForPost;
use App\Http\Models\ImageForUser;
use App\Http\Repositories\EmailActiveRepository;
use App\Http\Services\ImageForUserService;
use App\Http\Services\UserService;
use App\Http\Traits\FileUploadTrait;
use App\Http\Validators\ImageValidator;
use App\Http\Validators\UserValidator;
use App\User;
use App\Utilities\S3Helper;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserController extends Controller implements FilePathInterface
{
    private $userService;
    private $imageForUserService;

    use FileUploadTrait;

    public function __construct(
        UserService $userService,
        ImageForUserService $imageForUserService
    )
    {
        $this->userService = $userService;
        $this->imageForUserService = $imageForUserService;
    }

    // tạo nhanh user
    public function createUserInstant(Request $request)
    {
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);

        return response()->json(
            [
                'user' => User::create($input)
            ],
            200,
            ['Content-type' => 'application/json;charset=utf-8'],
            JSON_UNESCAPED_UNICODE);
    }

    public function appLogin(Request $request)
    {
        $validate_admin = DB::table('user')
            ->select('email', 'password')
            ->where('email', $request['email'])
            ->first();

        if ($validate_admin && Hash::check($request['password'], $validate_admin->password)) {
            // here you know data is valid
            return Response::json([
                'status' => 'ok'
            ], 200);
        } else {
            return Response::json([
                'status' => 'not ok'
            ], 500);
        }
    }

    public function checkLogin($user)
    {
        $password = request('password');
        if ($user != null)
            return Hash::check($password, $user->password);
        else return false;
    }

    public function login(Request $request)
    {
        $rules = [
            'email' => 'required',
            'password' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);

        $email = request('email');
        $user1 = User::withTrashed()
            //->select('id', 'email', 'password', 'deleted_at', 'name', 'username')
            ->select()
            ->where('email', 'LIKE', $email)
            ->first();

        if (Auth::attempt(
            [
                'email' => request('email'),
                'password' => request('password')
            ]
            )
        ) // if ($this->checkLogin($user))
        {
            $user = Auth::user();
            if ($user->deleted_at == null) {
                $success['token'] = $user->createToken('appToken')->accessToken;
                //After successful authentication, return json parameters
                return response()->json([
                    'success' => true,
                    'token' => $success,
                    'user' => $user
                ]);
            } else {
                return response()->json(
                    [
                        'success' => false,
                        'message' => 'Tài khoản bị khóa',
                    ],
                    401,
                    ['Content-type' => 'application/json;charset=utf-8'],
                    JSON_UNESCAPED_UNICODE);
            }
        } else {
            //if authentication is unsuccessful
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Sai email hoặc mật khẩu',
                ],
                401,
                ['Content-type' => 'application/json;charset=utf-8'],
                JSON_UNESCAPED_UNICODE);
        }
    }

    // register new account
    public function register(Request $request)
    {
        // validate if email is unique
        $validator = UserValidator::validateRegister($request);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors(),
            ], 401);
        }
        // table email_activate có email vừa nhập?
        $emailActivate = EmailActiveRepository::getByEmail($request->get('email'));
        if ($emailActivate != null) {
            EmailActiveRepository::deleteByEmail($request->get('email'));
        }
        //tạo mới EmailActivate bao gồm email và activation token
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        // create a 4 digits code to email the user
        $input['activation_token'] = rand(pow(10, 4 - 1), pow(10, 4) - 1);
        $newEmailActivate = EmailActivate::create($input);

        //send email to verify
        MailController::sendVerificationEmail($newEmailActivate->activation_token, $newEmailActivate->email);
        //$success['token'] = $user->createToken('appToken')->accessToken;
        return response()->json(
            [
                'success' => true,
                'message' => 'Xin kiểm tra email để lấy mã xác nhận',
                'user' => $newEmailActivate
            ],
            200,
            ['Content-type' => 'application/json;charset=utf-8'],
            JSON_UNESCAPED_UNICODE);
    }

    public function activateAccount(Request $request)
    {
        //lấy record trong table email_active theo email
        $emailActivate = EmailActiveRepository::getByEmail($request->get('email'));
        // activation token trong record = activation token trong request?
        if ($emailActivate->activation_token == $request->get('activation_token')) {
            // tạo mới user theo record trong email_active
            $user = new User();
            $user->username = $emailActivate->username;
            $user->email = $emailActivate->email;
            $user->password = $emailActivate->password;
            $user->name = $emailActivate->name;
            $success['token'] = $user->createToken('appToken')->accessToken;
            $user->save();
            // xóa record trong table email_active
            EmailActiveRepository::deleteByEmail($request->get('email'));
            // trả về token cho app
            return response()->json([
                'success' => true,
                'token' => $success,
                'user' => $user
            ]);
        } else {
            return response()->json([
                'message' => 'wrong activation token',
            ]);
        }
    }

    public function logout(Request $res)
    {
        if (Auth::user()) {
            $user = Auth::user()->token();
            $user->revoke();

            return response()->json([
                'success' => true,
                'message' => 'Logout successfully'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Unable to Logout'
            ]);
        }
    }

    public function changePassword(Request $request)
    {
        // validate new password
        $validator = UserValidator::validateChangePassword($request);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors(),
            ], 401);
        }
        //tạo mới password
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        //lấy record trong table user theo email và update password mới
        DB::table('user')
            ->where('email', 'LIKE', $input['email'])
            ->update(['password' => $input['password']]);

        return response()->json([
            'success' => true,
        ], 200);
    }

    public function getData()
    {
        return Response::json([
            'data' => '1'
        ], 200);
    }

    public function getUserInfoById(Request $request)
    {
        $user = DB::table('user')
            ->select('username', 'email', 'name', 'bio', 'id', 'role_id')
            ->where('id', '=', $request->get('id'))
            ->get();

        $avatarLink = DB::table('image_for_user')
            ->select('url')
            ->where('user_id', '=', $request->get('id'))
            ->first();

        $followers = DB::table('user_follow_user')
            ->select('follower_user_id')
            ->where('user_id', '=', $request->get('id'))
            ->get();
        $numberOfFollowers = count($followers);

        $following = DB::table('user_follow_user')
            ->select('user_id')
            ->where('follower_user_id', '=', $request->get('id'))
            ->get();
        $numberOfFollowing = count($following);

        if ($avatarLink != null)
            $avatarTemp = $avatarLink;
        else $avatarTemp = '';

        return response()->json(
            [
                'user' => $user,
                'avatar_link' => $avatarTemp != null ? asset($avatarTemp->url) : '',
                'number_of_followers' => $numberOfFollowers,
                'number_of_following' => $numberOfFollowing,
            ],
            200,
            ['Content-type' => 'application/json;charset=utf-8'],
            JSON_UNESCAPED_UNICODE);
    }

    public function checkFollow(Request $request)
    {
        $currentUserId = $request->get('current_user_id');
        $userId = $request->get('user_id');

        $result = DB::table('user_follow_user')
            ->select('user_id', 'follower_user_id')
            ->where('user_id', '=', $userId)
            ->where('follower_user_id', '=', $currentUserId)
            ->get();
        if ($result->isEmpty()) {
            return Response::json([
                'result' => false,
            ], 200);
        } else {
            return Response::json([
                'result' => true,
            ], 200);
        }
    }

    public function followUser(Request $request)
    {
        $currentUserId = $request->get('current_user_id');
        $userId = $request->get('user_id');

        $result = DB::table('user_follow_user')
            ->select('user_id', 'follower_user_id')
            ->where('user_id', '=', $userId)
            ->where('follower_user_id', '=', $currentUserId)
            ->get();

        // Nếu chưa follow, sẽ follow
        if ($result->isEmpty()) {
            // UPDATE TABLE TRUNG GIAN
            DB::table('user_follow_user')->insert([
                'follower_user_id' => $currentUserId,
                'user_id' => $userId,
            ]);

            return Response::json([
                //'result' => 'liked',
                'follow' => true,

            ], 200);
        } // Nếu đã follow, sẽ unfollow
        else {
            // UPDATE TABLE TRUNG GIAN
            DB::table('user_follow_user')
                ->select('follower_user_id', 'user_id')
                ->where('user_id', '=', $userId)
                ->where('follower_user_id', '=', $currentUserId)
                ->delete();

            return Response::json([
                //'result' => 'unliked',
                'follow' => false,

            ], 200);
        }
    }

    public function uploadAvatar(Request $request)
    {
        DB::beginTransaction();
        // get user
        $user = User::find($request->get('user_id'));
        // validate the image
        $validator = ImageValidator::validateImage($request);

        if ($validator->fails()) {
            DB::rollBack();
            return Response::json([
                'error' => $validator->getMessageBag()->toArray(),
            ], 400);
        }

        // get old avatar link
        $avatarLink = DB::table('image_for_user')
            ->select('url')
            ->where('user_id', '=', $request->get('user_id'))
            ->first();

        // check if user already has an avatar
        // if user already has avatar
        if ($avatarLink != '') {
            //get old avatar name
            preg_match('/[^\/]*$/', $avatarLink->url, $matches);
            $oldAvatar = $matches[0];
            //insert new avatar
            if ($files = $request->file('files')) {
                // loop through image array
                foreach ($files as $file) {
//                    $this->imageForUserHandleToStorage(
//                        $request->get('user_id'),
//                        $file,
//                        UserController::IMAGE_FOR_USER_DB_URL,
//                        UserController::IMAGE_FOR_USER_PATH_TO_PUT_FILE
//                    );
                    $this->imageForUserHandleToS3($user, $file);
                }
            }
            //delete old avatar
            Storage::disk('public')->delete('image_for_user/' . $oldAvatar);
            DB::table('image_for_user')
                ->where('url', 'LIKE', $avatarLink->url)
                ->delete();

        } // if user doesn't have avatar
        else {
            if ($files = $request->file('files')) {
                // loop through image array
                foreach ($files as $file) {
//                    $this->imageForUserHandleToStorage(
//                        $request->get('user_id'),
//                        $file,
//                        UserController::IMAGE_FOR_USER_DB_URL,
//                        UserController::IMAGE_FOR_USER_PATH_TO_PUT_FILE
//                    );
                    $this->imageForUserHandleToS3($user, $file);
                }
            }
        }
        DB::commit();
        return response()->json(
            [
                'status' => 'ok'
            ],
            200
        );
    }

    public
    function imageForUserHandleToS3($user, $file)
    {
        $fileName = (string)Str::uuid() . $file->getClientOriginalName();

        // if upload succeeded
        if (S3Helper::S3UploadFile($file, $fileName) == true) {
            $imageForUser = new ImageForUser();
            $imageLink = 'https://caycanhapi.s3.ap-southeast-1.amazonaws.com/' . $fileName;
            $imageForUser->url = $imageLink;
            $imageForUser->user()->associate($user);
            $imageForUser->save();
            return true;
        } // if upload failed
        else {
            return false;
        }
    }

    public function updateInfo(Request $request)
    {
        $userId = $request->get('user_id');

        // validate
        $validator = UserValidator::validateUserInfo($request);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors(),
            ], 401);
        }

        $user = User::find($userId);
        $user->update($request->all());

        return response()->json([
            'success' => true,
        ], 200);
    }

    public function searchUser(Request $request)
    {
        // SEARCH USER BY KEYWORD
        $users = $this->userService->searchUser(
            $request->get('keyword'),
            $request->get('skip'),
            $request->get('take'),
            $request->get('role_id_array')
        );
        // AVATAR HANDLE
        foreach ($users as $user) {
            $avatar_url = $this->imageForUserService->getAvatarUrl($user->id);
            if ($avatar_url != '' && $avatar_url != null)
                $user->avatar_url = asset($avatar_url->url);
            else $user->avatar_url = '';
        }

        return Response::json([
            'users' => $users,
        ], 200);
    }

    public function getAvatarUrl(Request $request)
    {
        //get avatar link
        $avatarLink = $this->imageForUserService->getAvatarUrl($request->get('id'));
        //check null
        if ($avatarLink == null)
            $avatarLink = '';

        //return result
        return response()->json(
            [
                'avatar_link' => $avatarLink != '' ? asset($avatarLink->url) : '',
            ],
            200,
            ['Content-type' => 'application/json;charset=utf-8'],
            JSON_UNESCAPED_UNICODE);
    }

    public function getUserInfoForComment(Request $request)
    {
        return $this->userService->getUserInfoForComment($request->get('id'));
    }

    // DATA FOR CLIENT TO REQUEST EXPERT ROLE
    public function dataForClientToRequestExpertRole()
    {
        return array("experience_in" => "", "bio" => "");
    }

    // GET USERNAME
    public function getUserName(Request $request)
    {
        $userId = $request->get('user_id');
        return Response::json([
            'username' => User::select('username')->where('id', $userId)->get()[0]['username'],
        ], 200);
    }
}
