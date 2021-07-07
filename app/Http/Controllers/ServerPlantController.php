<?php


namespace App\Http\Controllers;

use App\Http\Helpers\ImageUrlHandle;
use App\Http\Models\ImageForPost;
use App\Http\Models\ServerPlant;
use App\Http\Models\ServerPlantUserEdit;
use App\Http\Services\ServerPlantService;
use App\Http\Validators\PostValidator;
use App\Utilities\S3Helper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ServerPlantController extends Controller
{
    private $serverPlantService;

    public function __construct(
        ServerPlantService $serverPlantService
    )
    {
        $this->serverPlantService = $serverPlantService;
    }

    // SEEDER
    public function seeder()
    {
        for ($i = 1; $i < 13; $i++) {
            $serverPlant = new ServerPlant();
            $serverPlant->common_name = Str::random(10);
            $serverPlant->scientific_name = Str::random(10);
            $serverPlant->image_url = '/storage/image_for_server_plant/' . $i . '.png';
            $serverPlant->pet_friendly = (bool)random_int(0, 1);
            $serverPlant->difficulty = random_int(0, 5);
            $serverPlant->water_level = random_int(0, 5);
            $serverPlant->information = Str::random(100);
            $serverPlant->sunlight = Str::random(100);
            $serverPlant->feed_information = Str::random(100);
            $serverPlant->common_issue = Str::random(100);
            $serverPlant->min_temperature = rand(20, 22);
            $serverPlant->max_temperature = rand(29, 33);
            $serverPlant->min_ph = rand(50, 60) / 10;
            $serverPlant->max_ph = rand(60, 70) / 10;
            $serverPlant->save();
        }
    }

    //TRANG LIST PLANT
    public function listPlant(Request $request) {
        $keyword = $request->get('keyword');
        $list = $this->serverPlantService->getPlantListByChunkForWeb(0, 100, $keyword);
        return view('/admin_pages/server_plant/list_plant')->with('list', $list);
    }

    //TRANG LIST PLANT ĐÓNG GÓP
    public function listPlantContributePage() {
        $list = $this->serverPlantService->getPlantListContributeByChunk(0, 100, '');
        return view('/admin_pages/server_plant/list_plant_contribute',[
            'list' => $list,
        ]);
    }

    //TRANG LIST PLANT CHỈNH SỬA
    public function listPlantEditPage() {
        $list = $this->serverPlantService->getPlantEditListByChunkForWeb(0, 100, '');

        return view('/admin_pages/server_plant/list_plant_edit',[
            'list' => $list,
        ]);
    }

    //TRANG ADD PLANT
    public function addPlantPage() {
        return view('/admin_pages/server_plant/add_plant',[]);
    }

    //TRANG CHI TIẾT PLANT
    public function detailPage($id)
    {
        $plant = $this->serverPlantService->getPlantDetail($id);
        return view('/admin_pages/server_plant/detail')->with('plant', $plant);
    }

    //TRANG CHI TIẾT PLANT CONTRIBUTE
    public function detailContributePage($id)
    {
        $plant = $this->serverPlantService->getPlantDetail($id);
        return view('/admin_pages/server_plant/detail_contribute')->with('plant', $plant);
    }

    //TRANG CHI TIẾT PLANT EDIT
    public function detailEditPage(Request $request)
    {
        $serverPlantUserEditId = $request->server_plant_user_edit_id;
        $serverPlantId = $request->server_plant_id;

        $serverPlant = ServerPlant::find($serverPlantId);
        if ($serverPlant != null) {
            $serverPlant->temperature_range = [$serverPlant->min_temperature, $serverPlant->max_temperature];
            $serverPlant->ph_range = [$serverPlant->min_ph, $serverPlant->max_ph];
            $serverPlant->image_url = ImageUrlHandle::getDynamicImageUrl($serverPlant->image_url);
            $serverPlant->makeHidden(['min_temperature', 'max_temperature', 'min_ph', 'max_ph']);
            $serverPlant->pet_friendly == 1 ? $serverPlant->pet_friendly = true : $serverPlant->pet_friendly = false;
        }

        $userEditPlant = ServerPlantUserEdit::find($serverPlantUserEditId);
        if ($userEditPlant != null) {
            $userEditPlant->temperature_range = [$userEditPlant->min_temperature, $userEditPlant->max_temperature];
            $userEditPlant->ph_range = [$userEditPlant->min_ph, $userEditPlant->max_ph];
            $userEditPlant->image_url = ImageUrlHandle::getDynamicImageUrl($userEditPlant->image_url);
            $userEditPlant->makeHidden(['min_temperature', 'max_temperature', 'min_ph', 'max_ph']);
            $userEditPlant->pet_friendly == 1 ? $userEditPlant->pet_friendly = true : $userEditPlant->pet_friendly = false;
        }
        return view('/admin_pages/server_plant/detail_edit')->with(array('server_plant'=> $serverPlant, 'user_edit_plant'=> $userEditPlant));

    }

    //ADMIN ADD PLANT
    public function addPlant(Request $request){
        $input = $request->except(['_token']);
        // validate
        $rules = [
            'scientific_name' => 'required',
            'common_name' => 'required',
            'max_temperature' => 'gt:min_temperature',
            'min_temperature' => 'lt:max_temperature',
            'max_ph' => 'gt:min_ph',
            'min_ph' => 'lt:max_ph'
        ];
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails())
            return redirect()
                ->intended('/admin/server_plant/add_plant')
                ->withInput()
                ->withErrors($validator->errors());
        // upload the image to local storage
        //$input['image_url'] = $this->imageForPostHandleToStorage($request->image);
        $request->image != null ? $input['image_url'] = $this->imageForPostHandleToS3($request->image) : $input['image_url'] = '';
        //add accepted
        $input['accepted'] = "1";
        //insert new record
        $id = $this->serverPlantService->create($input);
        return redirect('/admin/server_plant/detail/' . $id)->with(['saved' => true]);
    }

    //UPDATE CHI TIẾT PLANT
    public function adminUpdate(Request $request){
        $input = $request->except(['_token', 'image']);
        if($request->image != null){
//            // delete old image
//            Storage::disk('s3')->delete('s3_folder_path/'. $imageName);
            // upload the image to s3
            $input['image_url'] = $this->imageForPostHandleToS3($request->image);
        }
        $this->serverPlantService->update($input);
        return redirect('/admin/server_plant/detail/' . $input['id'])->with(['saved' => true]);
    }

    //ADMIN UPDATE CHI TIẾT PLANT CHO TRANG NGƯỜI DÙNG EDIT
    public function adminUpdateForUserEdit(Request $request){
        $input = $request->except(['_token', 'server_plant_user_edit_id', 'server_plant_id']);
        $server_plant_user_edit_id = $request->server_plant_user_edit_id;
        $server_plant_id = $request->server_plant_id;

        $this->serverPlantService->update($input);
        return redirect('/admin/server_plant/detail_edit?server_plant_user_edit_id='. $server_plant_user_edit_id .'&server_plant_id=' . $server_plant_id)->with(['saved' => true]);
    }

    //CHẤP NHẬN PLANT ĐÓNG GÓP VÀO DB CHÍNH THỨC
    public function acceptContribute($id){
        ServerPlant::where('id', '=', $id)
            ->update(['accepted' => 1]);
        return redirect('/admin/server_plant/detail/' . $id)->with(['saved' => true]);
    }

    // LẤY DS THÔNG TIN CÂY CẢNH THEO CỤM
    public function getPlantListByChunk(Request $request)
    {
        $skip = $request->get('skip');
        $take = $request->get('take');
        $keyword = $request->get('keyword');
        $plants = $this->serverPlantService->getPlantListByChunk($skip, $take, $keyword);

        return Response::json([
            'plants' => $plants,
        ], 200);
    }

    // LẤY CHI TIẾT THÔNG TIN CÂY CẢNH
    public function getPlantDetail(Request $request)
    {
        return Response::json([
            'plant' => $this->serverPlantService->getPlantDetail($request->get('id')),
        ], 200,
            ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
            JSON_UNESCAPED_UNICODE);

    }

    // LẤY CHI TIẾT THÔNG TIN CÂY CẢNH DÀNH CHO USER EDIT
    public function getPlantDetailForUserEdit(Request $request)
    {
        //KIỂM TRA XEM USER ĐÃ YÊU CẦU EDIT CHƯA
        $hasRequestEdit = ServerPlantUserEdit::select('*')
            ->where('user_id', '=', $request->user_id)
            ->where('server_plant_id', '=', $request->server_plant_id)
            ->get();
        //USER ĐÃ YÊU CẦU EDIT
        if($hasRequestEdit->isEmpty() == false)
        {
            $hasRequestEdit[0]->pet_friendly == 1 ? $hasRequestEdit[0]->pet_friendly = true : $hasRequestEdit[0]->pet_friendly = false;
            $hasRequestEdit[0]->has_viewed == 1 ? $hasRequestEdit[0]->has_viewed = true : $hasRequestEdit[0]->has_viewed = false;
            $hasRequestEdit[0]->temperature_range = [$hasRequestEdit[0]->min_temperature, $hasRequestEdit[0]->max_temperature];
            $hasRequestEdit[0]->ph_range = [$hasRequestEdit[0]->min_ph, $hasRequestEdit[0]->max_ph];
            $hasRequestEdit[0]->image_url = ImageUrlHandle::getDynamicImageUrl($hasRequestEdit[0]->image_url);
            return Response::json([
                'has_request_edit' => true,
                'plant' => $hasRequestEdit[0],
            ], 200);
        }
        //USER CHƯA YÊU CẦU EDIT
        return Response::json([
            'has_request_edit' => false,
            'plant' => $this->serverPlantService->getPlantDetail($request->get('server_plant_id')),
        ], 200);
    }

    // ADMIN DUYỆT EDIT PLANT CỦA USER
    public function hasViewed(Request $request) {
        // ID CỦA USER
        $userId = $request->user_id;
        // ID SERVER PLANT
        $server_plant_id = $request->server_plant_id;
        // ID RECORD EDIT CỦA USER
        $server_plant_user_edit_id = $request->server_plant_user_edit_id;
        ServerPlantUserEdit::where('server_plant_id', '=', $server_plant_id)
            ->where('user_id', '=', $userId)
            ->update(['has_viewed' => 1]);
        return redirect('/admin/server_plant/detail_edit?server_plant_user_edit_id='. $server_plant_user_edit_id .'&server_plant_id=' . $server_plant_id)->with(['saved' => true]);
    }

    // USER UPLOAD CÂY CẢNH MỚI
    public function uploadPlant(Request $request){
        $input = $request->except('files');
        DB::beginTransaction();
        // validate the image
        $validator = PostValidator::validateImage($request);
        if ($validator->fails()) {
            DB::rollBack();
            return Response::json([
                'error' => $validator->getMessageBag()->toArray(),
            ], 400);
        }
        //image handle
        if($request->file('files') != null)
            foreach ($request->file('files') as $file) {
            //image handle ==============================
            // change new name
            $fileName = (string)Str::uuid() . $file->getClientOriginalName();
            // upload the image to local storage
//            Storage::disk('public')->putFileAs('image_for_server_plant/', $file, $fileName);
//            $input['image_url'] = '/storage/image_for_server_plant/'.$fileName;
            $input['image_url'] = $this->imageForPostHandleToS3($file);
        }
        //insert new record
        $id = $this->serverPlantService->create($input);
        DB::commit();
        return Response::json([
            'message' => 'Plant submit successfully',
            'status' => true,
            'id' => $id,
        ], 200);
    }

    public
    function imageForPostHandleToS3($file)
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

    public function imageForPostHandleToStorage($file) {
        $fileName = (string)Str::uuid() . $file->getClientOriginalName();
        // upload the image to local storage
        Storage::disk('public')->putFileAs('image_for_server_plant/', $file, $fileName);
        return $input['image_url'] = '/storage/image_for_server_plant/'.$fileName;
    }

    // ADMIN XÓA CÂY
    public function delete(Request $request) {
        ServerPlant::find($request->id)->delete();
        return redirect('/admin/server_plant/list_plant');
    }
}
