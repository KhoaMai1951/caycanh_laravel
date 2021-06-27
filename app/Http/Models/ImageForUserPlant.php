<?php


namespace App\Http\Models;


use Illuminate\Database\Eloquent\Model;

class ImageForUserPlant extends Model
{
    protected $table = 'image_for_user_plant';

    public $timestamps = false;

    public function userPlant()
    {
        return $this->belongsTo(UserPlant::class, 'user_plant_id', 'id');
    }


}
