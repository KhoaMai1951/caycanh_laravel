<?php


namespace App\Http\Services;


use Illuminate\Support\Facades\DB;

class ImageForUserService
{
    // lấy link avatar
    public function getAvatarUrl(int $userId) {
        return DB::table('image_for_user')
            ->select('url')
            ->where('user_id', '=', $userId)
            ->first();
    }
}
