<?php


namespace App\Http\Controllers;


use App\Http\Models\Tag;
use App\Http\Models\TagType;
use App\Http\Services\TagService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TagController extends Controller
{
    private $tagService;

    public function __construct(
        TagService $tagService
    )
    {
        $this->tagService = $tagService;
    }

    public function getAllTags()
    {
        return Tag::select('id', 'name')->get();
    }

    public function getAllTagsByTypeId(Request $request)
    {
        return Tag::select('id', 'name')
            ->where('tag_type_id', '=', $request->get('tag_type_id'))
            ->get();
    }

//    public function getTagsByPostId($postId)
//    {
//        return Tag::select('id', 'name')
//            ->where('post_id')
//    }

    //TRANG LIST TAG
    public function listTagPage(Request $request) {
        $keyword = $request->get('keyword');
        //$list = $this->serverPlantService->getPlantListByChunkForWeb(0, 100, $keyword);
        $list = Tag::where('name','LIKE','%' . $keyword . '%')->whereNotIn('id', [-1])->paginate(10);
        return view('/admin_pages/tag/list_tag')->with('list', $list);
    }

    //TRANG CHI TIẾT TAG
    public function detailPage($id)
    {
        $tag = Tag::find($id);
        $tagTypes = TagType::select('*')->whereNotIn('id', [3, 4])->get();
        return view('/admin_pages/tag/detail_tag', [
            'tag' => $tag,
            'tag_types' => $tagTypes
        ]);
    }

    //TRANG THÊM TAG
    public function addTagPage()
    {
        $tagTypes = TagType::select('*')->whereNotIn('id', [3, 4])->get();
        return view('/admin_pages/tag/add_tag', [
            'tag_types' => $tagTypes
        ]);
    }

    //THÊM TAG
    public function addTag(Request $request) {
        $input = $request->except(['_token']);

        // validate
        $rules = [
            'name' => 'required',
        ];
        $validator = Validator::make($input, $rules);

        if($validator->fails())
            return redirect()
                ->intended('/admin/tag/add_tag')
                ->withInput()
                ->withErrors($validator->errors());
//        return view('/admin_pages/tag/detail_tag', [
//            'tag' => $tag,
//            'tag_types' => $tagTypes
//        ]);
        $id = Tag::create($input)->id;
        return redirect('/admin/tag/tag_detail/' . $id)->with([
            'added' => true,
        ]);
    }

    //UPDATE TAG
    public function updateTag(Request $request) {
        $input = $request->except(['_token']);

        DB::table('tag')
            ->where('id', $input['id'])
            ->update($input);
        return redirect('/admin/tag/tag_detail/' . $input['id'])->with(['saved' => true]);
    }
}
