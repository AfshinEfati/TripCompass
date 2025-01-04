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
use App\Http\Controllers\Api\V1\Frontend\FrontendController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
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
    Route::group(['prefix' => 'frontend'], function () {
        Route::get('{canonicalUrl}',[FrontendController::class, 'getByCanonicalUrl']);
    });
});
