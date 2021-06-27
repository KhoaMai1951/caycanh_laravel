<?php


namespace App\Http\Services;


use App\Http\Models\PendingExpert;

class PendingExpertService
{
    // TÌM THEO USER ID
    public function find($userId)
    {
        return PendingExpert::select('*')
            ->where('user_id', '=', $userId)
            ->get()
            ->toArray();
    }

    // XÓA RECORD
    public function delete($id) {
        PendingExpert::where('id', '=', $id)->delete();
    }
}
