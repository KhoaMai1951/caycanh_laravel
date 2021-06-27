<?php


namespace App\Http\Controllers;


use App\Http\Models\Tag;
use App\Http\Models\TagType;
use Illuminate\Support\Facades\Response;

class TagTypeController extends Controller
{
    public function test()
    {
        $tags = TagType::find(1)->tags;

        return Response::json([
            'tag' => $tags,
        ], 200);
    }
}
