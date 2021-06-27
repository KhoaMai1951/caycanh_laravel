<?php


namespace App\Http\Controllers;


use App\Http\Models\Chat;
use App\Http\Services\ChatService;
use App\Http\Services\ImageForUserService;
use App\Http\Services\UserService;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class ChatController extends Controller
{
    private $imageForUserService;
    private $userService;
    private $chatService;

    public function __construct(
        UserService $userService,
        ImageForUserService $imageForUserService,
        ChatService $chatService
    )
    {
        $this->userService = $userService;
        $this->imageForUserService = $imageForUserService;
        $this->chatService = $chatService;
    }

    //Lấy ds user đang chat theo cụm
    public function getChattingUsersList(Request $request) {
        $skip = $request->get('skip');
        $take = $request->get('take');
        $userId = $request->get('user_id');
        $keyword = $request->get('keyword');

        $userIdList = $this->chatService->getChattingUsersId($userId);

        $users = $this->userService->searchUserForChatList(
            $keyword, $skip, $take, $userIdList
        );
        // AVATAR HANDLE
        foreach ($users as $user) {
            $avatar_url = $this->imageForUserService->getAvatarUrl($user->id);
            if ($avatar_url != '' && $avatar_url != null)
                $user->avatar_url = asset($avatar_url->url);
            else $user->avatar_url = '';
        }
        return Response::json([
            'users' => $users,
        ], 200);
    }

    //Tạo record chat cho cả 2 user
    public function createRecordForBoth(Request $request)
    {
        $chatId = $request->get('chat_id');
        $currentUserId = $request->get('current_user_id');
        $userToChatWithId = $request->get('user_to_chat_with_id');
        //check if exist 1
        $chat1 = Chat::select('user_id')
            ->where('user_id', '=', $currentUserId)
            ->where('chat_id', $chatId)
            ->get()
        ;
        if ($chat1->isEmpty())
        {
            //if not exist, create new record
            $chat1 = new Chat();
            $chat1->chat_id = $chatId;
            $chat1->user_id = $currentUserId;
            $chat1->user_to_chat_with_id = $userToChatWithId;
            $chat1->save();
        }

        //check if exist 2
        $chat2 = Chat::select('user_id')
            ->where('user_id', '=', $userToChatWithId)
            ->where('chat_id', $chatId)
            ->get()
        ;

        if ($chat2->isEmpty())
        {
            //if not exist, create new record
            $chat2 = new Chat();
            $chat2->chat_id = $chatId;
            $chat2->user_id = $userToChatWithId;
            $chat2->user_to_chat_with_id = $currentUserId;
            $chat2->save();
        }
        return Response::json([
            'status' => 'ok',
        ], 200);
    }

    //Xóa cuộc trò chuyện
    public function deleteChat(Request $request)
    {
        $userId = $request->get('user_id');
        $chatId = $request->get('chat_id');
        Chat::where('chat_id', 'LIKE', $chatId)
            ->where('user_id', '=', $userId)
            ->delete();
    }
}
