<?php


namespace App\Http\Services;


use App\Http\Models\UserFollowUser;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserService
{
    // GET IDS OF FOLLOWING USER
    public function getIdsOfFollowingUser(int $userId) {
        // GET RESULT FROM QUERY GET IDS OF FOLLOWING USER
        $queryFollowingUsersIds = UserFollowUser::select('user_id')
            ->where('follower_user_id', '=', $userId)
            ->get();
        // CREATE AN ARRAY TO STORE THE IDS
        $followingUsersIds = [];
        // PUSH THE CURRENT USER ID TO THE ARRAY
        //array_push($followingUsersIds, $userId);
        // PUSH ALL THE FOLLOWING USER IDS TO THE ARRAY
        foreach ($queryFollowingUsersIds as $followingUsersId) {
            array_push($followingUsersIds, $followingUsersId->user_id);
        }
        return $followingUsersIds;
    }

    // SEARCH USER FOR CHAT LIST
    public function searchUserForChatList($keyword, $skip, $take, $userIdList) {
        return User::select('id', 'name', 'username', 'role_id')
            ->where(function ($query) use ($keyword) {
                // subqueries
                $query->where('username', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('name', 'LIKE', '%' . $keyword . '%');
            })
            ->whereIn('id', $userIdList)
            ->orderBy('username', 'DESC')
            ->skip($skip)
            ->take($take)
            ->get();
    }


    // SEARCH USER
    public function searchUser($keyword, $skip, $take, $roleIdArray)
    {
        return User::select('id', 'name', 'username', 'role_id')
            ->where(function ($query) use ($keyword) {
                // subqueries
                $query->where('username', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('name', 'LIKE', '%' . $keyword . '%');
            })
            ->whereIn('role_id', $roleIdArray)
            ->orderBy('username', 'DESC')
            ->skip($skip)
            ->take($take)
            ->get();
    }

    public function getUserInfoForComment($userId)
    {
        // HANDLE AVATAR
        $avatarLink = DB::table('image_for_user')
            ->select('url')
            ->where('user_id', '=', $userId)
            ->first();
        $user = User::select('name', 'username', 'role_id', 'id')
            ->where('id', '=', $userId)
            ->first();
        $user['avatar_link']= asset($avatarLink->url) ;
        return $user;
    }

    // GET ROLE ID
    public function getRoleId($userId)
    {
        $roleId = User::select('role_id')->where('id', '=', $userId)->get()->toArray();

        return $roleId[0]['role_id'];
    }

    // CHANGE ROLE ID
    public function changeRoleId($userId, $roleIdToChange)
    {
        User::where('id', $userId)->update(['role_id' => $roleIdToChange]);
    }
}
