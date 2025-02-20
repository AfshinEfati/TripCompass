<?php

use App\Http\Controllers\Api\V1\Admin\AgencyController;
use App\Http\Controllers\Api\V1\Admin\AgencyServiceController;
use App\Http\Controllers\Api\V1\Admin\AirlineController;
use App\Http\Controllers\Api\V1\Admin\AirportController;
use App\Http\Controllers\Api\V1\Admin\AnchorController;
use App\Http\Controllers\Api\V1\Admin\CityController;
use App\Http\Controllers\Api\V1\Admin\ContentController;
use App\Http\Controllers\Api\V1\Admin\CountryController;
use App\Http\Controllers\Api\V1\Admin\FaqController;
use App\Http\Controllers\Api\V1\Admin\SeoController;
use App\Http\Controllers\Api\V1\Admin\SeoRelationController;
use App\Http\Controllers\Api\V1\Admin\ServiceController;
use App\Http\Controllers\Api\V1\Admin\StateController;
use App\Http\Controllers\Api\V1\Admin\UserController;
use App\Http\Controllers\Api\V1\Frontend\FlightController;
use App\Http\Controllers\Api\V1\Frontend\FrontendController;
use App\Http\Controllers\Api\V1\Frontend\Provider\SignupController;
use App\Jobs\FetchAgencyFlightsJob;
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
        Route::apiResource('agencies', AgencyController::class);
        Route::group(['prefix' => 'agencies/{agency_id}'], function () {
            Route::apiResource('services', AgencyServiceController::class);
        });
        Route::apiResource('seos', SeoController::class);
        Route::post('seos/{seo}/upload', [SeoController::class, 'upload']);
        Route::group(['prefix' => 'seos'], function () {
            Route::get('{id}/faqs', [FaqController::class, 'index']);
            Route::post('{id}/faqs', [FaqController::class, 'store']);
            Route::patch('{id}/faqs/{faq_id}', [FaqController::class, 'update']);
            Route::delete('/faqs/{id}', [FaqController::class, 'destroy']);

            Route::get('{id}/anchors', [AnchorController::class, 'getAnchors']);
            Route::post('{id}/anchors', [AnchorController::class, 'storeAnchor']);
            Route::patch('{id}/anchors/{anchor_id}', [AnchorController::class, 'updateAnchor']);
            Route::delete('{id}/anchors/{anchor_id}', [AnchorController::class, 'destroyAnchor']);
        });
        Route::apiResource('contents', ContentController::class);
        Route::apiResource('seo-relations', SeoRelationController::class);
    });
    Route::group(['prefix' => 'frontend'], function () {
        Route::post('airports', [FrontendController::class, 'getAirports']);
        Route::group(['prefix' => 'flight'], function () {
            Route::post('availability', [FlightController::class, 'availability']);
        });
        Route::get('{canonicalUrl}', [FrontendController::class, 'getByCanonicalUrl']);

    });
    Route::group(['prefix' => 'panel',/* 'middleware' => 'auth:provider'*/], function () {
        Route::group(['prefix' => 'provider'], function () {
            Route::post('/', [SignupController::class, 'register']);
            Route::group(['prefix' => 'email'], function () {
                Route::post('/verify', [SignupController::class, 'verifyEmail']);
                Route::get('/verify/{id}/{hash}', [SignupController::class, 'verifyEmailHash']);
                Route::post('/resend', [SignupController::class, 'resendEmail']);
            });
            Route::post('/upload-documents', [SignupController::class, 'uploadDocuments']);
            Route::group(['prefix' => 'address'], function () {
                Route::post('/create', [SignupController::class, 'addAddress']);
            });
            Route::post('/request-approval', [SignupController::class, 'requestApproval']);
        });
    });
});
