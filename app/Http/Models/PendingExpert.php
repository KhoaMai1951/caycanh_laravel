<?php


namespace App\Http\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PendingExpert extends Model
{
    protected $table = 'pending_expert';

    //use SoftDeletes;

    protected $fillable  = [
        'bio',
        'experience_in',
        'user_id'
    ];

    public function imagesForPendingExpert(){
        return $this->hasMany(ImageForPendingExpert::class);
    }
}
