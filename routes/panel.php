<?php


use App\Http\Controllers\Api\V1\Panel\AgencyController;
use App\Http\Controllers\Api\V1\Panel\AgencyServiceController;
use App\Http\Controllers\Api\V1\Panel\AgencyWalletController;
use App\Http\Controllers\Api\V1\Panel\ContractController;
use App\Http\Controllers\Api\V1\Panel\PaymentController;
use App\Http\Controllers\Api\V1\Panel\TransactionController;

Route::group(['prefix' => 'panel', 'middleware' => 'auth:sanctum'], function () {
    Route::apiResource('agencies', AgencyController::class);
    Route::group(['prefix' => 'agencies/{agency}'], function () {
        Route::apiResource('services', AgencyServiceController::class);
    });
    Route::apiResource('contracts', ContractController::class);
    Route::get('bank-list', [ContractController::class, 'bankList']);
    Route::get('service-list', [ContractController::class, 'serviceList']);
    Route::group(['prefix' => 'payment'], function () {
        Route::post('pay', [PaymentController::class, 'pay']);
        Route::post('verify', [PaymentController::class, 'verify'])->withoutMiddleware(['auth:sanctum']);
        Route::get('list', [PaymentController::class, 'index']);
        Route::get('{payment}', [PaymentController::class, 'show']);
    });
    Route::group(['prefix' => 'wallet'], function () {
        Route::get('list', [AgencyWalletController::class, 'index']);
        Route::post('charge', [AgencyWalletController::class, 'charge']);
    });
    Route::apiResource('transaction', TransactionController::class);

});
