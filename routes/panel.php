<?php


use App\Http\Controllers\Api\V1\Panel\AgencyController;

Route::group(['prefix' => 'panel', 'middleware' => 'auth:sanctum'], function () {
    Route::apiResource('agencies', AgencyController::class);
});
