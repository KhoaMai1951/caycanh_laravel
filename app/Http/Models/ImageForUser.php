<?php


namespace App\Http\Models;


use App\User;
use Illuminate\Database\Eloquent\Model;

class ImageForUser extends Model
{
    protected $table = 'image_for_user';

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
