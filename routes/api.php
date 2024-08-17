<?php

use App\Http\Controllers\API\AuthenticateController;
use App\Http\Controllers\API\PenggunaController;
use App\Http\Controllers\API\ProyekController;
use App\Http\Controllers\API\TugasController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::controller(AuthenticateController::class)->group(function () {
        Route::post('login', 'login'); 
    });
    Route::middleware('auth:api')->group(function () {

        Route::controller(AuthenticateController::class)->group(function () {
            Route::post('logout', 'logout');
        });

        Route::controller(PenggunaController::class)->prefix('pengguna')->group(function () {
            Route::get('/', 'index');
            Route::get('{id}', 'show');
            Route::post('/', 'store');
            Route::put('{id}', 'update');
            Route::delete('{id}', 'destroy');
        });

        Route::controller(ProyekController::class)->prefix('proyek')->group(function () {
            Route::get('/', 'index');
            Route::get('{id}', 'show');
            Route::post('/', 'store');
            Route::put('{id}', 'update');
            Route::delete('{id}', 'destroy');
        });

        Route::controller(TugasController::class)->prefix('tugas')->group(function () {
            Route::get('/', 'index');
            Route::get('{id}', 'show');
            Route::post('/', 'store');
            Route::put('{id}', 'update');
            Route::delete('{id}', 'destroy');
        });
    });
});
