<?php


namespace App\Http\Validators;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostValidator
{
    public static function validateSubmitPost(Request $request){

        $customMessages = [

        ];

        $rules = [
            'title' => 'required|min:2',
            'content' => 'max:3000',
            'user_id' => 'required',
        ];
        return Validator::make($request->all(), $rules, $customMessages);
    }

    public static function validateImage(Request $request){

        $customMessages = [
            'required' => 'Please upload an image',
            'mimes' => 'Chỉ được phép gửi định dạng jpg,jpeg,png,bmp,jpg,gif',
            'max' => 'Độ lớn tối đa cho 1 hình là 100KB',
        ];

        $rules = [
            'images_for_post.*' => 'required|mimes:jpg,jpeg,png,bmp,jpg,gif|max:100'
        ];

        return Validator::make($request->all(), $rules, $customMessages);
    }
}
