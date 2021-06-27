<?php


namespace App\Utilities;


use Illuminate\Support\Facades\Storage;

class S3Helper
{
    public static function S3UploadFile($file, $fileName)
    {
        return Storage::disk('s3')->put($fileName, file_get_contents($file), 'public');
    }
}
