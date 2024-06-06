<?php

use App\Http\Controllers\designationController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\PersonalUaiController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::middleware([
])->group(function () {

    Route::get('/leyes', function () {
        return view('leyes');
    })->name('leyes');


    Route::get('/reglamentos', function () {
        return view('reglamentos');
    })->name('reglamentos');


    Route::get('/documentoNormativo', function () {
        return view('documentoNormativo');
    })->name('documentoNormativo');

    Route::get('/Actuaciones', function () {
        return view('actuaciones');
    })->name('actuaciones');

    Route::get('/Detalles', function () {
        return view('detalles');
    })->name('detalles');

   

    Route::controller(IndexController::class)->group(function (): void {
        Route::get('/dashboard', 'index')->name('dashboard');
        Route::get('/Plan de auditoria', 'action')->name('plan de auditoria');
        Route::get('/Plan de auditoria/{id}', 'show')->name('action.show');

    });

    Route::controller(PersonalUaiController::class)->group(function (): void {
        Route::get('/personal-uai/dashboard', 'dashboard')->name('personal-uai.dashboard');
        Route::get('/personal-uai/show/{personal}', 'show')->name('personal-uai.show');
        Route::get('/personal-uai/edit/{personal}', 'edit')->name('personal-uai.edit');
        Route::post('/personal-uai/store', 'store')->name('personal-uai.store');
        Route::put('/personal-uai/edit/{personal}', 'update')->name('personal-uai.update');
        Route::delete('/personal-uai/delete/{personal}', 'destroy')->name('personal-uai.delete');
    });

    Route::controller(designationController::class)->group(function (): void {
        Route::get('/Designation', 'index')->name('designation');
        Route::post('/designation', 'download')->name('designation.download'); // todo it shold be codigo-acta/designation/download
    });
});
