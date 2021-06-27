<?php


namespace App\Http\Validators;


 use Illuminate\Http\Request;
 use Illuminate\Support\Facades\Validator;

class UserValidator
{
    public static function validateUserInfo(Request $request){

        $rules = [
            'username' => 'min:4|max:40',
            'name' => 'min:4|max:100',
            'bio' => 'max:1500',
        ];
        return Validator::make($request->all(), $rules);
    }


    public static function validateRegister(Request $request){

        $customMessages = [
            'email.unique' => 'Email đã được đăng ký',
            'required' => 'Không được bỏ trống',
            'min' => ':attribute phải lớn hơn :min kí tự',
            'password.confirmed' => 'Xác nhận mật khẩu không trùng',
        ];

        $rules = [
            'username' => 'required|min:4',
            'name' => 'required|min:4',
            'email' => 'required|email|unique:user',
            'password' => 'required|min:4|confirmed',
            'password_confirmation' => 'required|min:4',
        ];
        return Validator::make($request->all(), $rules, $customMessages);
    }

    public static function validateChangePassword(Request $request){

        $customMessages = [
            'required' => 'Không được bỏ trống',
            'min' => ':attribute phải lớn hơn :min kí tự',
            'password.confirmed' => 'Xác nhận mật khẩu không trùng',
        ];

        $rules = [
            'password' => 'required|min:4|confirmed',
            'password_confirmation' => 'required|min:4',
        ];
        return Validator::make($request->all(), $rules, $customMessages);
    }

    public static function validateLogin(Request $request){

        $customMessages = [
            'email.unique' => 'Email đã được đăng ký',
            'required' => 'Không được bỏ trống',
            'min' => ':attribute phải lớn hơn :min kí tự',
            'password.confirmed' => 'Xác nhận mật khẩu không trùng',
        ];

        $rules = [
            'username' => 'required|min:4',
            'name' => 'required|min:4',
            'email' => 'required|email|unique:user',
            'password' => 'required|min:4|confirmed',
            'password_confirmation' => 'required|min:4',
        ];
        return Validator::make($request->all(), $rules, $customMessages);
    }
}
