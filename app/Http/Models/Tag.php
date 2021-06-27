<?php

namespace App\Http\Models;


use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    use SoftDeletes;

    protected $table = 'tag';

    protected $fillable = [
        'name', 'tag_type_id',
    ];

    public function tagType()
    {
        return $this->belongsTo(TagType::class, 'tag_type_id', 'id');
    }

    public function posts()
    {
        //return $this->belongsToMany(Post::class, 'post_tag', 'post_id','tag_id');
        return $this->belongsToMany(Post::class, 'post_tag', 'tag_id','post_id');
    }
}
