<?php


namespace App\Http\Services;


use Illuminate\Support\Facades\DB;

class ImageForPostService
{
    public function getFirstImageForPostByPostId(int $postId) {
        return DB::table('image_for_post')
            ->where('post_id', '=', $postId)
            ->first();
    }
}
