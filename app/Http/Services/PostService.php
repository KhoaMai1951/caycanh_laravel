<?php

namespace App\Http\Services;

use App\Http\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostService
{
    private $userService;

    public function __construct(
        UserService $userService
    )
    {
        $this->userService = $userService;
    }

    // LẤY BÀI VIẾT THEO ID
    public function getPost($id)
    {
        return Post::find($id);
    }

    // LẤY DS BÀI VIẾT CỦA USER CHO TRANG PROFILE THEO CỤM
    public function getUserPosts(
        $audience,
        int $userId,
        int $skip,
        int $take
    )
    {
        return Post::select('id', 'title', 'created_at', 'like', DB::raw('SUBSTRING(content, 1, 70) AS short_content'))
            ->where('user_id', '=', $userId)
            ->whereIn('audience', $audience)
            ->orderBy('created_at', 'DESC')
            ->skip($skip)
            ->take($take)
            ->get();
    }

    // KIỂM TRA ĐÃ LIKE POST HAY CHƯA
    public function checkLikedPost($userId, $postId)
    {
        $result = DB::table('liked_post')
            ->select('post_id', 'user_id')
            ->where('user_id', '=', $userId)
            ->where('post_id', '=', $postId)
            ->get();
        return !$result->isEmpty();
    }

    // LẤY DS ID CỦA CÁC POST ĐƯỢC SAVE TỪ USER ID
    public function getSavedPostIdsFromUserId(int $userId)
    {
        $postIdsResult = DB::table('saved_post')
            ->select('post_id')
            ->where('user_id', '=', $userId)
            ->get();
        $postIds = [];
        foreach ($postIdsResult as $value) {
            array_push($postIds, $value->post_id);
        }
        return $postIds;
    }

    // LẤY DS POST THEO CỤM TỪ DS ID CỦA CÁC POST
    public function getSavedPostFromIdsArray($audience, $postIds, int $skip, int $take)
    {
        return Post::select('id', 'title', 'created_at', 'like', DB::raw('SUBSTRING(content, 1, 70) AS short_content'))
            ->whereIn('id', $postIds)
            ->whereIn('audience', $audience)
            ->orderBy('created_at', 'DESC')
            ->skip($skip)
            ->take($take)
            ->get();
    }

    // GET POSTS FOR HOME NEWSFEED
    public function getPostForHomeNewsfeed($request)
    {
        $title = 'a';
        $content = 'a';
        $skip = $request->get('skip');
        $take = $request->get('take');
        $keyword = $request->get('keyword');
        $userId = $request->get('user_id');
        $tagIds = $request->get('tag_ids');
        // GET FOLLOWING USERS IDS
        $followingUserIds = $this->userService->getIdsOfFollowingUser($userId);
        // GET USER ROLE
        $role_id = $this->userService->getRoleId($userId);
        // GET AUDIENCE LIST
        $role_id == 1 ? $audienceList = [1] : $audienceList = [1, 2]; //NẾU LÀ EXPERT ĐƯỢC XEM HẾT, USER CHỈ ĐƯỢC XEM CỦA USER

        return Post::select('id', 'user_id', 'audience', 'title', 'created_at', 'like', DB::raw('SUBSTRING(content, 1, 1000) AS short_content'))
            // GET TAGS EXCEPT ID = -1
            ->with(array('tags' => function ($q) {
                $q->select('name', 'id', 'tag_type_id')
                    ->where('id', '!=', -1);
            }))
            // WHERE 1
            ->where(function ($query) use ($title, $content, $keyword, $followingUserIds, $audienceList, $userId) {
                //WHERE 1.1
                // where ( where(title/content = keyword) and where(user_id = following user ids) and whereIn(audience, audience list) )
                $query->where(function ($query) use ($title, $content, $keyword, $followingUserIds, $audienceList) {
                    $query->where(function ($query) use ($title, $content, $keyword) {
                        if ($title != null && $content != null)
                            $query->where('content', 'LIKE', '%' . $keyword . '%')
                                ->orWhere('title', 'LIKE', '%' . $keyword . '%');
                        if ($title != null && $content == null)
                            $query->where('title', 'LIKE', '%' . $keyword . '%');
                        if ($title == null && $content != null)
                            $query->where('content', 'LIKE', '%' . $keyword . '%');
                    })
                        ->whereIn('user_id', $followingUserIds) //record có user id nằm trong mảng userIds
                        ->whereIn('audience', $audienceList); //và record có audience nằm trong mảng
                })
                //WHERE 1.2
                // orWhere ( where(title/content = keyword) and where(user_id = current user id) and whereIn(audience, [1, 2]) )
                    ->orWhere(function ($query) use ($title, $content, $keyword, $userId) {
                        $query->where(function ($query) use ($title, $content, $keyword) {
                            if ($title != null && $content != null)
                                $query->where('content', 'LIKE', '%' . $keyword . '%')
                                    ->orWhere('title', 'LIKE', '%' . $keyword . '%');
                            if ($title != null && $content == null)
                                $query->where('title', 'LIKE', '%' . $keyword . '%');
                            if ($title == null && $content != null)
                                $query->where('content', 'LIKE', '%' . $keyword . '%');

                        })
                            ->where('user_id', '=', $userId) //record có user id nằm trong mảng userIds
                            ->whereIn('audience', [1, 2]); //và record có audience nằm trong mảng
                    });
            })
            // WHERE 2
            ->whereHas('tags', function ($query) use ($tagIds) {
                /*if(!empty($tagIds))
                    $query->whereIn('id', $tagIds);*/
                if ($tagIds != null)
                    $query->whereIn('id', $tagIds);
                    //->having(DB::raw('count(*)'), '=', count($tagIds));
            })
//            ->whereHas('tags', function($query) use($tagIds) {
//                $query->whereIn('id', $tagIds);
//            }, '=', count($tagIds))->get()
            ->orderBy('created_at', 'DESC')
//            ->sortByDesc('created_at')
            ->skip($skip)
            ->take($take)
            ->get();
    }

    // GET POSTS FOR GLOBAL NEWSFEED
    public function getPostForGlobalNewsfeed(
        int $userId,
        $audienceList,
        int $skip,
        int $take,
        $keyword,
        $request
    )
    {
        $tagIds = $request->get('tag_ids');
        return Post::select('id', 'user_id', 'audience', 'title', 'created_at', 'like', DB::raw('SUBSTRING(content, 1, 70) AS short_content'))
            // GET TAGS EXCEPT ID = -1
            ->with(array('tags' => function ($q) {
                $q->select('name', 'id', 'tag_type_id')
                    ->where('id', '!=', -1);
            }))
            // where( where(title / content = keyword) andWhereIn(audience, audienceList) andWhere(user_id != current user id) )
            ->where(function ($query) use ($keyword, $audienceList, $userId) {
                $query->where(function ($query) use ($keyword) {
                    $query->where('content', 'LIKE', '%' . $keyword . '%')
                        ->orWhere('title', 'LIKE', '%' . $keyword . '%');
                })
                    ->whereIn('audience', $audienceList) //và record có audience nằm trong mảng
                    ->where('user_id', '!=', $userId); //user_id != current user id
            })
            // orWhere( where(title / content = keyword) andWhereIn(audience, audienceList) andWhere(user_id != current user id) )
            ->orWhere(function ($query) use ($keyword, $audienceList, $userId) {
                $query->where(function ($query) use ($keyword) {
                    $query->where('content', 'LIKE', '%' . $keyword . '%')
                        ->orWhere('title', 'LIKE', '%' . $keyword . '%');

                })
                    ->whereIn('audience', [1, 2]) //và record có audience nằm trong mảng
                    ->where('user_id', '=', $userId); //user_id != current user id
            })
            ->whereHas('tags', function ($query) use ($tagIds) {
                if ($tagIds != null)
                    $query->whereIn('id', $tagIds);
            })
            ->orderBy('created_at', 'DESC')
            ->skip($skip)
            ->take($take)
            ->get();
    }

    // KIỂM TRA ĐÃ LƯU BÀI VIẾT
    public function checkSavePost(int $userId, int $postId)
    {
        $getRecord = DB::table('saved_post')
            ->where('user_id', '=', $userId)
            ->where('post_id', '=', $postId)
            ->get();
        return !$getRecord->isEmpty();
    }

    // LƯU BÀI VIẾT
    public function savePost($userId, $postId)
    {
        DB::table('saved_post')
            ->insert([
                'user_id' => $userId,
                'post_id' => $postId,
            ]);
    }

    // BỎ LƯU BÀI VIẾT
    public function unsavePost($userId, $postId)
    {
        $getRecord = DB::table('saved_post')
            ->where('user_id', '=', $userId)
            ->where('post_id', '=', $postId)
            ->delete();
    }

    // LẤY DS AUDIENCE TỪ USER ROLE ID
    public function getPostAudienceFromUserId($userId)
    {
        $role_id = $this->userService->getRoleId($userId);
        return $role_id == 1 ? $audienceList = [1] : $audienceList = [1, 2];
    }
}
