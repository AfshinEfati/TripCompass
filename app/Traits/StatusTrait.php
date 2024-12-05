<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait StatusTrait
{
    public function getStatus($status): array
    {
        return $status?[
            'name'=>'active',
            'fa_name'=>'فعال',
            'code'=>1
        ]:[
            'name'=>'inActive',
            'fa_name'=>'غیرفعال',
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
