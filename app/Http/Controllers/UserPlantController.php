<?php


namespace App\Http\Controllers;

use App\Http\Models\ImageForPost;
use App\Http\Models\ImageForUserPlant;
use App\Http\Models\UserPlant;
use App\Http\Services\ImageForUserService;
use App\Http\Services\PlantExchangeService;
use App\Http\Validators\ImageValidator;
use App\Http\Validators\PostValidator;
use App\Utilities\S3Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UserPlantController extends Controller
{
    private $plantExchangeService;
    private $imageForUserService;

    public function __construct(
        PlantExchangeService $plantExchangeService,
        ImageForUserService $imageForUserService
    )
    {
        $this->plantExchangeService = $plantExchangeService;
        $this->imageForUserService = $imageForUserService;
    }

    // SUBMIT CÂY
    public function submitPlant(Request $request) {
        DB::beginTransaction();

        // validate the image
        $validator = ImageValidator::validateImageForUserPlant($request);
        // if validate fail
        if ($validator->fails()) {
            DB::rollBack();
            return Response::json([
                'error' => $validator->getMessageBag()->toArray(),
            ], 400);
        }

        $userPlant = new UserPlant();
        //fields handle
        $userPlant->user_id = $request->get('user_id');
        $userPlant->common_name = $request->get('common_name');
        $userPlant->scientific_name = $request->get('scientific_name') ? $request->get('scientific_name') : '';
        $userPlant->description = $request->get('description');
        $userPlant->save();
        // image for user plant handle + handle multiple images
        $uploadIsErrorFlag = false;
        if ($files = $request->file('files')) {
            // loop through image array
            foreach ($files as $file) {
                //$result = $this->imageForUserPlantHandleToStorage($userPlant, $file);
                $result = $this->imageForPostHandleToS3($userPlant, $file);
                // if upload file to s3 successful
                if ($result == true) {
                    $uploadIsErrorFlag = true;
                } // if fail, break the loop
                else {
                    $uploadIsErrorFlag = false;
                    break;
                }
            }
            // if there is no error happens, then return successful
            if ($uploadIsErrorFlag == true) {
                $userPlant->update();
                DB::commit();
                return Response::json([
                    'message' => 'User plant submit with image successfully',
                    'user_plant_id' => $userPlant->id,
                    'status' => true,
                ], 200);
            } // if there is error, return fail
            else {
                DB::rollBack();
                return Response::json([
                    'message' => 'Image upload failed',
                    'status' => false,
                ], 400);
            }
        }
        return null;
    }

    // LẤY CHI TIẾT CÂY CẢNH THEO ID
    public
    function getUserPlantById(Request $request)
    {
        $id = $request->get('id');

        $userPlant = UserPlant::find($id);

        //NẾU KHÔNG TÌM ĐC CÂY
        if ($userPlant == null) {
            return Response::json([
                'message' => 'no plant is found',
            ], 400);
        }

        $imageForUserPlant = $userPlant->imagesForUserPlant;

        // handle images for post dynamic url
        foreach ($imageForUserPlant as $image) {
            $image->dynamic_url = asset($image->url);
        }
        $user = $userPlant->user;

        // COMMENTS NUMBER
        // $commentsNumber = $this->commentService->getNumberOfComments($post->id);
        // avatar for user of the post
        $avatar_url = $this->imageForUserService->getAvatarUrl($user->id);
        if ($avatar_url != '' && $avatar_url != null)
            $userPlant->user->avatar_url = asset($avatar_url->url);
        else $userPlant->user->avatar_url = '';

        // CHECK LIKED POST OR NOT
//        $userId = $userPlant->user->id;
//        $postId = $userPlant->id;
       // $imageForUserPlant->is_liked = $this->postService->checkLikedPost($userId, $postId);

        return Response::json([
            //'post2' => $postTest,
            'user_plant' => $userPlant,
            'images_for_user_plant' => $imageForUserPlant,
            'user' => $user,
            //'comments_number' => $commentsNumber,
        ], 200);

    }

    // LẤY DS CÂY CẢNH CỦA 1 USER DÙNG ĐỂ TRAO ĐỔI
    public
    function getAllUserPlants(Request $request)
    {
        $skip = $request->get('skip');
        $take = $request->get('take');
        $keyword = $request->get('keyword');

        $userPlants = UserPlant::select('id', 'user_id', 'common_name', 'scientific_name', 'created_at',
            'description', DB::raw('SUBSTRING(description, 1, 70) AS short_content'))
            ->where('user_id', '=', $request->get('user_id'))
            ->where(function ($query) use ($keyword) {
                $query->where('common_name', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('scientific_name', 'LIKE', '%' . $keyword . '%');
            })
            ->orderBy('created_at', 'DESC')
            ->skip($skip)
            ->take($take)
            ->get();

        foreach ($userPlants as $userPlant) {
            // get first image for user plant
            $first_image_for_user_plant = DB::table('image_for_user_plant')
                ->where('user_plant_id', '=', $userPlant->id)
                ->first();

            if ($first_image_for_user_plant != null)
                $userPlant->image_url = asset($first_image_for_user_plant->url);
            else $userPlant->image_url = '';

            // get comments number
            //$commentsNumber = $this->commentService->getNumberOfComments($post->id);

            //$post->comments_number = $commentsNumber;
        }

        foreach ($userPlants as $userPlant) {
            $userPlant->short_content .= '...';
        };
        return Response::json([
            'user_plants' => $userPlants,
        ], 200);
    }

    // YÊU CẦU TRAO ĐỔI CÂY CẢNH
    public function requestExchange(Request $request) {
        $postId = $request->get('post_id');
        $userPlantId = $request->get('user_plant_id');
        // check if exist
        $isExist =  DB::table('plant_pending_exchange')
            ->where('post_id', '=', $postId)
            ->where('user_plant_pending_id', '=', $userPlantId)
            ->get();
        if($isExist->isEmpty())
        {
            // if not exist, insert
            $result = DB::table('plant_pending_exchange')
                ->insert(
                    [
                        'post_id' => $postId,
                        'user_plant_pending_id' => $userPlantId,
                    ]
                );
            return Response::json([
                'result' => $result,
            ], 200);
        }
        return Response::json([
            'status' => 'already inserted',
        ], 200);
    }

    public
    function imageForUserPlantHandleToStorage($userPlant, $file)
    {
        // change new name
        $fileName = (string)Str::uuid() . $file->getClientOriginalName();
        // upload the image to local storage
        $this->uploadImageToStorage($file, $fileName);
        // create new image for post object and associate it with post object
        $imageForUserPlant = new ImageForUserPlant();
        $imageLink = '/storage/image_for_user_plant/' . $fileName;
        $imageForUserPlant->url = $imageLink;
        $imageForUserPlant->userPlant()->associate($userPlant);
        $imageForUserPlant->save();
        return true;
    }

    public
    function imageForPostHandleToS3($userPlant, $file)
    {
        $fileName = (string)Str::uuid() . $file->getClientOriginalName();
        // if upload succeeded
        if (S3Helper::S3UploadFile($file, $fileName) == true) {
            $imageForPlant = new ImageForUserPlant();
            $imageLink = 'https://caycanhapi.s3.ap-southeast-1.amazonaws.com/' . $fileName;
            $imageForPlant->url = $imageLink;
            $imageForPlant->userPlant()->associate($userPlant);
            $imageForPlant->save();
            return true;
        } // if upload failed
        else {
            return false;
        }
    }

    public
    function uploadImageToStorage($file, $fileName)
    {
        Storage::disk('public')->putFileAs('image_for_user_plant/', $file, $fileName);
    }
}
