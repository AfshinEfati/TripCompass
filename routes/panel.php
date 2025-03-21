<?php


use App\Http\Controllers\Api\V1\Panel\AgencyController;
use App\Http\Controllers\Api\V1\Panel\AgencyServiceController;
use App\Http\Controllers\Api\V1\Panel\ContractController;
use App\Http\Controllers\Api\V1\Panel\PaymentController;

Route::group(['prefix' => 'panel', 'middleware' => 'auth:sanctum'], function () {
    Route::apiResource('agencies', AgencyController::class);
    Route::group(['prefix' => 'agencies/{agency}'], function () {
        Route::apiResource('services', AgencyServiceController::class);
    });
    Route::apiResource('contracts', ContractController::class);
    Route::get('bank-list', [ContractController::class, 'bankList']);
    Route::get('service-list', [ContractController::class, 'serviceList']);
    Route::group(['prefix' => 'payment'], function () {
        Route::post('payment/pay', [PaymentController::class, 'pay']);
        Route::post('/payment/verify', [PaymentController::class, 'verify']);
    });

});
