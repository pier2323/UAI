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
        Route::get('/personal-uai/show/{personal}', 'edit')->name('personal-uai.edit');
        Route::post('/personal-uai/show/{personal}', 'store')->name('personal-uai.store');
        Route::put('/personal-uai/show/{personal}', 'update')->name('personal-uai.edit');
        Route::delete('/personal-uai/show/{personal}', 'destroy')->name('personal-uai.delete'); 
    });

    Route::controller(designationController::class)->group(function () {
        Route::get('/designation', 'download')->name('acta.designation'); // todo it shold be codigo-acta/designation/download
    });
});
