<?php

namespace App\Traits;

use Carbon\Carbon;
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
    private function notFoundResponse($data, $message): JsonResponse
    {
        return response()->json([
            'success' => false,
            'data' => $data,
            'message' => $message
        ],404);
    }
    public function formatDates($date): array
    {
        $date = Carbon::parse($date);
        return [
            'date' => $date->format('Y-m-d'),
            'time' => $date->format('H:i:s'),
            'fa_date' => verta($date)->format('Y-m-d'),
            'iso' => Carbon::make($date)->toIso8601String(),
        ];
    }
}
