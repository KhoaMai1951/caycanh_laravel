<?php


namespace App\Http\Models;


use Illuminate\Database\Eloquent\Model;

class TagType extends Model
{
    protected $table = 'tag_type';

    public function tags()
    {
        return $this->hasMany(Tag::class, '');
    }
}
