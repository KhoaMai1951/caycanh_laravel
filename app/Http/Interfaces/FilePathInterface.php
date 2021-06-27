<?php


namespace App\Http\Interfaces;


interface FilePathInterface
{
    const IMAGE_FOR_POST_PATH_TO_PUT_FILE = 'image_for_post/';
    const IMAGE_FOR_POST_DB_URL = '/storage/image_for_post/';

    const IMAGE_FOR_USER_PATH_TO_PUT_FILE = 'image_for_user/';
    const IMAGE_FOR_USER_DB_URL = '/storage/image_for_user/';
}
