<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait StatusTrait
{
    public function getStatus($status): array
    {
        return $status?[
            'title'=>'active',
            'title_fa'=>'فعال',
            'code'=>1
        ]:[
            'title'=>'inActive',
            'title_fa'=>'غیرفعال',
            'code'=>0
        ];
    }

    private function successResponse($data, $message): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $data,
            'message' => $message
        ]);
    }
}
