<?php


namespace App\Http\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServerPlant extends Model
{
    use SoftDeletes;

    protected $table = 'server_plant';

    protected $fillable = [
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
