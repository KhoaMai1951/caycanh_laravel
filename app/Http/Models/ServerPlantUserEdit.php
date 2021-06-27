<?php


namespace App\Http\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServerPlantUserEdit extends Model
{
    use SoftDeletes;

    protected $table = 'server_plant_user_edit';

    protected $fillable = [
        'user_id',
        'server_plant_id',
        'common_name',
        'scientific_name',
        'image_url',
        'pet_friendly',
        'difficulty',
        'water_level',
        'information',
        'sunlight',
        'feed_information',
        'common_issue',
        'max_temperature',
        'min_temperature',
        'max_ph',
        'min_ph',
    ];
}
