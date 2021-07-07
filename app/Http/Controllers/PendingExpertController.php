<?php


namespace App\Http\Controllers;

use App\Http\Models\ImageForPendingExpert;
use App\Http\Models\ImageForPost;
use App\Http\Models\PendingExpert;
use App\Http\Services\ImageForPendingExpertService;
use App\Http\Services\PendingExpertService;
use App\Http\Services\UserService;
use App\Http\Validators\PostValidator;
use App\User;
use App\Utilities\S3Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PendingExpertController extends Controller
{
    private $pendingExpertService;
    private $userService;
    private $imageForPendingExpertService;

    public function __construct(
        PendingExpertService $pendingExpertService,
        UserService $userService,
        ImageForPendingExpertService $imageForPendingExpertService
    )
    {
        $this->pendingExpertService = $pendingExpertService;
        $this->userService = $userService;
        $this->imageForPendingExpertService = $imageForPendingExpertService;
    }

    // HANDLE REQUEST EXPERT
    public function handleRequestExpert(Request $request)
    {
        $pendingExpert = $this->pendingExpertService->find($request->get('user_id'));

        // NẾU USER CHƯA REQUEST LÀM EXPERT
        if ($pendingExpert == null)
            return $this->requestExpert($request);
        else {
            return Response::json([
                'already_requested' => true,
            ], 200);
        }
    }

    // REQUEST EXPERT
    public function requestExpert(Request $request)
    {
        //validate img
        $validator = PostValidator::validateImage($request);
        if ($validator->fails()) {
            DB::rollBack();
            return Response::json([
                'error' => $validator->getMessageBag()->toArray(),
            ], 400);
        }
        $input = $request->except('files');
        $pendingExpert = PendingExpert::create($input);
        //image handle
        if ($request->file('files') != null)
            foreach ($request->file('files') as $file) {
                //image handle ==============================
                // change new name
                $fileName = (string)Str::uuid() . $file->getClientOriginalName();
                // upload the image to local storage
                //Storage::disk('public')->putFileAs('image_for_pending_expert/', $file, $fileName);
                // save url to db
                //$imageInput['url'] = '/storage/image_for_pending_expert/' . $fileName;
                $imageInput['url'] = $this->imageForPendingExpertHandleToS3($file);
                $imageInput['pending_expert_id'] = $pendingExpert->id;
                ImageForPendingExpert::create($imageInput);
            }
        return Response::json([
            'message' => 'Request successfully',
            'status' => true,
            'request_id' => $pendingExpert->id,
        ], 200);
    }

    public
    function imageForPendingExpertHandleToS3($file)
    {
        $fileName = (string)Str::uuid() . $file->getClientOriginalName();

        // if upload succeeded
        if (S3Helper::S3UploadFile($file, $fileName) == true) {
            $imageLink = 'https://caycanhapi.s3.ap-southeast-1.amazonaws.com/' . $fileName;
            return $imageLink;
        } // if upload failed
        else {
            return false;
        }
    }

    // GET DETAIL BY ID
    public function getDetail(Request $request)
    {
        $requestExpert = PendingExpert::find($request->get('id'));
        //image
        foreach ($requestExpert->imagesForPendingExpert as $image) {
            $image->dynamic_url = asset($image->url);
        }
        if ($request != null) {
            return Response::json([
                'request_expert' => $requestExpert,
            ], 200);
        } else {
            return Response::json([
                'request_expert' => null,
            ], 500);
        }
    }

    // KIỂM TRA TRẠNG THÁI (CHƯA LÀ EXPERT / PENDING EXPERT / ĐÃ LÀ EXPERT)
    // 0, 1, 2
    public function checkStatus(Request $request)
    {
        //1.CHECK ĐÃ LÀ EXPERT
        $roleId = $this->userService->getRoleId($request->get('user_id'));
        if ($roleId == 2) {
            return Response::json([
                'status' => 2,
                'message' => 'is expert',
            ], 200);
        }
        //2.CHECK ĐANG PENDING
        if ($this->pendingExpertService->find($request->get('user_id'))) {
            return Response::json([
                'status' => 1,
                'message' => 'pending',
                'pending_info' => $this->pendingExpertService->find($request->get('user_id'))
            ], 200);
        }
        //3.CHECK CHƯA LÀ EXPERT
        return Response::json([
            'status' => 0,
            'message' => 'not expert',
        ], 200);
    }

    // USER EDIT REQUEST
    public function editRequest(Request $request)
    {
        PendingExpert::where('id', $request->get('id'))->update([
            'bio'=> $request->get('bio'),
            'experience_in'=> $request->get('experience_in')
        ]);
        return Response::json([
        ], 200);
    }

    // PENDING LIST PAGE
    public function pendingExpertPage()
    {
        $pendings = PendingExpert::paginate(10);
        foreach ($pendings as $pending) {

            $pending->username = 'a';
        }
        return view('/admin_pages/pending_expert/list_pending', compact('pendings'));
    }

    // PENDING EXPERT DETAIL PAGE
    public function pendingExpertDetailPage($id)
    {
        $pendingExpert = PendingExpert::find($id);
        $pendingExpert->imagesForPendingExpert;
        foreach ($pendingExpert->imagesForPendingExpert as $image) {
            $image['dynamic_url'] = asset($image['url']);
        }
        return view('/admin_pages/pending_expert/detail_pending', [
            'pendingExpert' => $pendingExpert,
        ]);
    }

    // EXPERT DETAIL PAGE
    public function expertDetailPage($id)
    {
        return view('/admin_pages/pending_expert/detail_expert', [
            'user' => User::find($id),
        ]);
    }

    // GRANT EXPERT ROLE FOR USER
    public function grantExpert(Request $request)
    {
        $input = $request->except('_token');
        //1.đổi role id cho user
        $this->userService->changeRoleId($input['user_id'], 2);
        //2.xóa file hình trong image for pending expert
        $images = $this->imageForPendingExpertService->getImagesFromPendingExpertId($input['id']);
        foreach ($images as $image)
        {
            preg_match('/([^\/]+)$/', $image->url, $matches);
            Storage::disk('public')->delete('image_for_pending_expert/' . $matches[0]);
        }
        //3.xóa record image for pending expert
        $this->imageForPendingExpertService->deleteByPendingExpertId($input['id']);
        //4.xóa record pending expert
        $this->pendingExpertService->delete($input['id']);
        //5.redirect trang list
        return redirect('/admin/expert_pending/list_pending');
    }

    // LIST EXPERT PAGE
    public function listExpertPage(){
        $users = User::select('id', 'username', 'name', 'email')
            ->where('role_id', '=', 2)
            ->paginate(10);
        return view('/admin_pages/pending_expert/list_expert', [
            'users' => $users,
        ]);
    }

    // DELETE EXPERT
    public function deleteExpert(Request $request) {
        $this->userService->changeRoleId($request->id, 1);
        return redirect('/admin/expert_pending/list_expert')->with([
            'deleted' => true,
        ]);
    }
}
