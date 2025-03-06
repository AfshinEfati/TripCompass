<?php


use App\Http\Controllers\Api\V1\Panel\AgencyController;
use App\Http\Controllers\Api\V1\Panel\AgencyServiceController;
use App\Http\Controllers\Api\V1\Panel\ContractController;

Route::group(['prefix' => 'panel', 'middleware' => 'auth:sanctum'], function () {
    Route::apiResource('agencies', AgencyController::class);
    Route::apiResource('{agency}/services', AgencyServiceController::class);
    Route::apiResource('contracts', ContractController::class);

});
