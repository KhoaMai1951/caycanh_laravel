<?php


namespace App\Http\Repositories;


use App\Http\Models\EmailActivate;

class EmailActiveRepository
{
    public static function getByEmail($email)
    {
        return EmailActivate::where('email', 'LIKE', $email)->first();
    }

    public static function deleteByEmail($email)
    {
        return EmailActivate::where('email', 'LIKE', $email)->delete();
    }
}
