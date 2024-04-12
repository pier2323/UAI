<?php

use App\Http\Controllers\designationController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\PersonalUaiController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::controller(IndexController::class)->group(function () {
        Route::get('/dashboard', 'dashboard')->name('dashboard');
    });

    Route::controller(PersonalUaiController::class)->group(function () {
        Route::get('/personal-uai/dashboard', 'dashboard')->name('personal-uai.dashboard');
        Route::get('/personal-uai/show/{personal}', 'showOne')->name('personal-uai.show');
    });

    Route::controller(designationController::class)->group(function () {
        Route::get('/designation', 'download')->name('acta.designation'); // todo codigo-acta/designation/download
    });
});
