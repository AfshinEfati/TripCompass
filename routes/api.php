<?php

use App\Http\Controllers\Api\V1\Admin\AirlineController;
use App\Http\Controllers\Api\V1\Admin\AirportController;
use App\Http\Controllers\Api\V1\Admin\CityController;
use App\Http\Controllers\Api\V1\Admin\ContentController;
use App\Http\Controllers\Api\V1\Admin\CountryController;
use App\Http\Controllers\Api\V1\Admin\SeoController;
use App\Http\Controllers\Api\V1\Admin\SeoRelationController;
use App\Http\Controllers\Api\V1\Admin\ServiceController;
use App\Http\Controllers\Api\V1\Admin\StateController;
use App\Http\Controllers\Api\V1\Admin\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::get::('/amir',function(){
 $url = "https://v1.vixsm.ir:2053/iXiCORa5PbAFHUG/login";

// داده‌هایی که می‌خواهید ارسال کنید
$data = [
    "username" => "amir",  // نام کاربری خود را وارد کنید
    "password" => "amir",  // رمز عبور خود را وارد کنید
];

// تبدیل داده‌ها به فرمت query string
$postData = http_build_query($data);

// مقداردهی اولیه cURL
$ch = curl_init();

// تنظیمات cURL برای ارسال درخواست POST
curl_setopt($ch, CURLOPT_URL, $url);  // تنظیم URL مقصد
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  // گرفتن پاسخ و ذخیره در متغیر
curl_setopt($ch, CURLOPT_POST, true);  // مشخص کردن نوع درخواست به POST
curl_setopt($ch, CURLOPT_TIMEOUT, 0);  // Timeout in seconds
curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);  // ارسال داده‌ها به صورت POST

// ارسال درخواست و دریافت پاسخ
$response = curl_exec($ch);

// بررسی وجود خطا
if (curl_errno($ch)) {
    echo "cURL Error: " . curl_error($ch);
} else {
    // نمایش پاسخ
    echo $response;
}

// بستن cURL
curl_close($ch);   
});
Route::group(['prefix' => 'v1'], function () {
    Route::group(['prefix' => 'auth'], function () {
        Route::post('login', [UserController::class, 'login']);
        Route::post('verify', [UserController::class, 'verify']);
        Route::get('get-user', [UserController::class, 'getUser'])->middleware('auth:sanctum');
        Route::post('logout', [UserController::class, 'logout'])->middleware('auth:sanctum');
    });
    Route::group(['prefix' => 'admin', 'middleware' => 'auth:sanctum'], function () {
        Route::apiResource('countries', CountryController::class);
        Route::apiResource('states', StateController::class);
        Route::apiResource('cities', CityController::class);
        Route::apiResource('services', ServiceController::class);
        Route::apiResource('users', UserController::class);
        Route::apiResource('airlines', AirlineController::class);
        Route::apiResource('airports', AirportController::class);
        Route::apiResource('seos', SeoController::class);
        Route::post('seos/{seo}/upload', [SeoController::class, 'upload']);
        Route::apiResource('contents', ContentController::class);
        Route::apiResource('seo-relations', SeoRelationController::class);
    });
});
