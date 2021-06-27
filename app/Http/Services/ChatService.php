<?php


namespace App\Http\Services;


use App\Http\Models\Chat;

class ChatService
{
    // LẤY DS ID CỦA USER ĐANG CHAT
    public function getChattingUsersId($userId)
    {
        return Chat::select('user_to_chat_with_id')
            ->where('user_id', '=', $userId)
            ->get();
    }
}
