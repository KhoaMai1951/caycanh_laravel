<?php


namespace App\Http\Helpers;


class ImageUrlHandle
{
    // LẤY DYNAMIC URL CHO ẢNH
    public static function getDynamicImageUrl($imageUrl) {
        return asset($imageUrl);
    }
}
