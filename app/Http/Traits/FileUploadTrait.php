<?php


namespace App\Http\Traits;


use App\Http\Models\ImageForPost;
use App\Http\Models\ImageForUser;
use App\Utilities\S3Helper;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait FileUploadTrait
{
    public function imageForPostHandleToStorage($post, $file, $DBPath)
    {
        // change new name
        $fileName = (string)Str::uuid() . $file->getClientOriginalName();
        // upload the image to local storage
        $this->uploadImageToStorage($file, $fileName);
        // create new image for post object and associate it with post object
        $imageForPost = new ImageForPost();
        $imageLink = $DBPath . $fileName;
        $imageForPost->url = $imageLink;
        $imageForPost->post()->associate($post);
        $imageForPost->save();
        return true;

    }

    public function imageForUserHandleToStorage($userId, $file, $DBPath, $pathToPutFile)
    {
        // change new name
        $fileName = (string)Str::uuid() . $file->getClientOriginalName();
        // upload the image to local storage
        $this->uploadImageToStorage($file, $fileName, $pathToPutFile);
        // create new image for object and associate it with object
        $imageForUser = new ImageForUser();
        $imageLink = $DBPath . $fileName;
        $imageForUser->url = $imageLink;
        $imageForUser->user_id = $userId;
        $imageForUser->save();
        return true;

    }

    public function uploadImageToStorage($file, $fileName, $pathToPutFile)
    {
        Storage::disk('public')->putFileAs($pathToPutFile, $file, $fileName);
    }

}
