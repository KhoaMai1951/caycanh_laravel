<?php


namespace App\Http\Models;


use Illuminate\Database\Eloquent\Model;

class ImageForPendingExpert extends Model
{
    protected $table = 'image_for_pending_expert';

    public $timestamps = false;

    protected $fillable  = [
        'url',
        'pending_expert_id'
    ];
}
