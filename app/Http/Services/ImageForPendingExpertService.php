<?php


namespace App\Http\Services;


use App\Http\Models\ImageForPendingExpert;

class ImageForPendingExpertService
{
    // LẤY HÌNH ẢNH TỪ ID CỦA PENDING EXPERT
    public function getImagesFromPendingExpertId($pendingExpertid) {
        return ImageForPendingExpert::select('url')
            ->where('pending_expert_id', '=', $pendingExpertid)
            ->get();
    }

    // XÓA RECORD TỪ PENDING EXPERT ID
    public function deleteByPendingExpertId($pendingExpertId) {
        ImageForPendingExpert::where('pending_expert_id', '=', $pendingExpertId)
            ->delete();
    }
}
