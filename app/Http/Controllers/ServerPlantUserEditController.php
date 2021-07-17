<?php


namespace App\Http\Controllers;

use App\Http\Models\ServerPlantUserEdit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class ServerPlantUserEditController extends Controller
{
    // UPLOAD EDIT CÂY CẢNH
    public function uploadPlant(Request $request){
        $input = $request->all();
        //KIỂM TRA XEM USER ĐÃ YÊU CẦU EDIT TRƯỚC ĐÓ CHƯA
        $hasRequestEdit = ServerPlantUserEdit::select('*')
            ->where('user_id', '=', $request->user_id)
            ->where('server_plant_id', '=', $request->server_plant_id)->first();
        //NẾU CÓ, UPDATE
        if($hasRequestEdit != null)
        {
            $hasRequestEdit->update($input);
            return Response::json([
                'message' => 'Plant edit successfully',
                'status' => true,
            ], 200);
        }
        //NẾU KHÔNG
        DB::beginTransaction();
        //insert new record
        $id = ServerPlantUserEdit::create($input)->id;;
        DB::commit();
        return Response::json([
            'message' => 'Plant edit successfully',
            'status' => true,
            'id' => $id,
        ], 200);
    }
}
