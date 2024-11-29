<?php

use App\Http\Controllers\Api\V1\Admin\CountryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::group(['prefix' => 'v1'], function () {
    Route::group(['prefix' => 'admin'], function () {
        Route::apiResource('countries', CountryController::class);
    });
});
