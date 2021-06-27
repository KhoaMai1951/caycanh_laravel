<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Models\Comment;
use App\Http\Models\ImageForUserPlant;
use App\Http\Services\CommentService;
use App\Http\Services\UserService;
use App\Utilities\S3Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class CommentController extends Controller
{
    private $commentService;
    private $userService;

    public function __construct(
        CommentService $commentService,
        UserService $userService
)
    {
        $this->commentService = $commentService;
        $this->userService = $userService;
    }

    // GET COMMENTS BY CHUNK BY POST ID
    public function getCommentsByChunkByPostId(Request $request)
    {
        $comments = $this->commentService->getCommentsByChunkByPostId(
            $request->get('post_id'),
            $request->get('skip'),
            $request->get('take')
        );

        foreach ($comments as $comment) {
            // HANDLE USER INFO
            $comment->user = $this->userService->getUserInfoForComment($comment->user_id);
            // HANDLE IMAGE
            $comment->image_url != '' ? $comment->image_url = asset($comment->image_url) : $comment->image_url =  null ;
            // HANDLE CHECK LIKE
            $comment->is_liked = $this->commentService->checkLikedComment($comment->id, $request->get('user_id'));
        }
        return Response::json([
            'comments' => $comments,
        ], 200);
    }

    public function getAllCommentsByPostId(Request $request)
    {
        $comments = DB::table('comment')
            ->select('user_id', 'post_id', 'content', 'id', 'image_url', 'created_at')
            ->where('post_id', '=', $request->get('post_id'))
            ->orderBy('created_at', 'DESC')
            ->get();


        foreach ($comments as $comment) {
            $username = DB::table('user')
                ->select('username')
                ->where('id', '=', $comment->user_id)
                ->first();
            $comment->username = $username->username;
            $comment->image_url != '' ? $comment->image_url = asset($comment->image_url) : $comment->image_url =  null ;
        }
        return Response::json([
            'comments' => $comments,
        ], 200);
    }

    // GET NUMBER OF COMMENTS FOR A POST
    public function getNumberOfCommentsByPostId(Request $request)
    {
        $comments = DB::table('comment')
            ->select('user_id', 'post_id', 'content', 'id')
            ->where('post_id', '=', $request->get('post_id'))
            ->count();

        return Response::json([
            'comments' => $comments,
        ], 200);
    }

    public function submitComment(Request $request)
    {
        $postId = $request->post_id;
        $userId = $request->get('user_id');
        $content = $request->get('content');

        $comment = new Comment();
        $comment->post_id = $postId;
        $comment->user_id = $userId;
        $comment->content = $content;

        //image handle
        if($request->file('files') != null)
            foreach ($request->file('files') as $file) {
                // image handle ==============================
                //// change new name
                // $fileName = (string)Str::uuid() . $file->getClientOriginalName();
                // upload the image to local storage
//                Storage::disk('public')->putFileAs('image_for_comment/', $file, $fileName);
//                $comment->image_url = '/storage/image_for_comment/'.$fileName;
                $comment->image_url = $this->imageForCommentHandleToS3($comment, $file);
            }

        $comment->save();

        return Response::json([
            'comments' => $comment,
        ], 200);
    }

    public
    function imageForCommentHandleToS3($comment, $file)
    {
        $fileName = (string)Str::uuid() . $file->getClientOriginalName();
        // if upload succeeded
        if (S3Helper::S3UploadFile($file, $fileName) == true) {

            $imageLink = 'https://caycanhapi.s3.ap-southeast-1.amazonaws.com/' . $fileName;



            return $imageLink;
        } // if upload failed
        else {
            return false;
        }
    }

    public
    function likeComment(Request $request)
    {
        $commentId = $request->get('comment_id');
        $userId = $request->get('user_id');

        $checkLikedComment = $this->commentService->checkLikedComment($commentId, $userId);

        $comment = Comment::find($commentId);

        // Nếu chưa like, sẽ like
        if (!$checkLikedComment) {
            // UPDATE TABLE TRUNG GIAN
            DB::table('liked_comment')->insert([
                'comment_id' => $commentId,
                'user_id' => $userId,
            ]);
            // UPDATE TABLE COMMENT CHO CỘT LIKE
            $comment->like++;
            $comment->update();

            return Response::json([
                //'result' => 'liked',
                'liked' => true,
                'likes' => Comment::where('id', $commentId)->select('like')->first(),
            ], 200);
        }
        // Nếu đã like, sẽ unlike
        else {
            // UPDATE TABLE TRUNG GIAN
            DB::table('liked_comment')
                ->select('comment_id', 'user_id')
                ->where('comment_id', '=', $commentId)
                ->where('user_id', '=', $userId)
                ->delete();
            // UPDATE TABLE POST CHO CỘT LIKE
            $comment->like > 0 ? $comment->like-- : null;
            $comment->update();

            return Response::json([
                //'result' => 'unliked',
                'liked' => false,
                'likes' => Comment::where('id', $commentId)->select('like')->first(),
            ], 200);
        }
    }

    public function deleteComment(Request $request)
    {
        //1.Lấy cmt từ id
        $result = $this->commentService->getComment($request->get('id'));
        //2.Nếu có cmt
        if ($result) {
            //2.1.Xóa cmt
            $result->delete();
            //3.Trả mã 200
            return Response::json([
                'message' => 'delete success',
            ], 200);
        }
        //2.2.Trả mã 500
        return Response::json([
            'message' => 'delete fail',
        ], 500);
    }
}
