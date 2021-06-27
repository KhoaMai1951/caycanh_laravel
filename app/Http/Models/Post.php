<?php

namespace App\Http\Models;

use App\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    protected $table = 'post';

    protected $fillable = [
        'title', 'content',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function tags()
    {
        //return $this->belongsToMany(Tag::class, 'post_tag', 'tag_id', 'post_id');
        return $this->belongsToMany(Tag::class, 'post_tag', 'post_id', 'tag_id');
    }

    public function userPlant()
    {
        return $this->belongsToMany(UserPlant::class, 'plant_pending_exchange', 'post_id', 'user_plant_pending_id');
    }

    public function imagesForPost(){
        return $this->hasMany(ImageForPost::class);
    }

    public function comments() {
        return $this->hasMany(Comment::class, 'post_id', 'id');
    }
}
