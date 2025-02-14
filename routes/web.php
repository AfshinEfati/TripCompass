<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/cache', function () {
    return Cache::get('flights_1_3_2_2025-02-14');
});
