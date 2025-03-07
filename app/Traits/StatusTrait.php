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
    private function errorResponse($message, $code): JsonResponse
    {
        return response()->json([
            'success' => false,
            'data' => [],
            'message' => $message
        ], $code);
    }
    private function unauthorizedResponse(array $array, string $string): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => $string,
            'data' => $array
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
    public function getCabinType(string $cabinType): array
    {
        $cabinType = strtolower($cabinType);
        $cabinTypes = [
            'economy' => [
                'name' => 'economy',
                'fa_name' => 'اکونومی',
                'code' => 'Y',
                'number' => 1
            ],
            'premium economy' => [
                'name' => 'premium economy',
                'fa_name' => 'پریمیوم اکونومی',
                'code' => 'S',
                'number' => 2
            ],
            'business' => [
                'name' => 'business',
                'fa_name' => 'بیزینس',
                'code' => 'C',
                'number' => 3
            ],
            'premium business' => [
                'name' => 'premium business',
                'fa_name' => 'پریمیوم بیزینس',
                'code' => 'J',
                'number' => 4
            ],
            'first class' => [
                'name' => 'first class',
                'fa_name' => 'فرست کلس',
                'code' => 'F',
                'number' => 5
            ],
            'premium first class' => [
                'name' => 'premium first class',
                'fa_name' => 'پریمیوم فرست کلس',
                'code' => 'P',
                'number' => 6
            ],
        ];

        return $cabinTypes[$cabinType] ?? $cabinTypes['economy'];
    }

}
