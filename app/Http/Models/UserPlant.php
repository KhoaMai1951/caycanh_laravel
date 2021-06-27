<?php


namespace App\Http\Models;


use App\User;
use Illuminate\Database\Eloquent\Model;

class UserPlant extends Model
{
    protected $table = 'user_plant';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function imagesForUserPlant(){
        return $this->hasMany(ImageForUserPlant::class, 'user_plant_id', 'id');
    }
}
