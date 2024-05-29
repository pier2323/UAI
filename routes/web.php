<?php

use App\Http\Controllers\designationController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AuditActivityController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get(uri: '/dashboard', action: [MainController::class, '__invoke'])->name('dashboard');

    Route::controller(AuditActivityController::class)->group(function () {
        Route::get(uri: '/actuacion-fiscal', action: 'index')->name('auditActivity.index');
        Route::get(uri: '/actuacion-fiscal/{id}', action: 'show')->name('auditActivity.show');
    });

    Route::controller(EmployeeController::class)->group(function (): void {
        Route::get('/personal', 'index')->name('employee.index');
        Route::get('/personal/mostrar/{personal}', 'show')->name('employee.show');
        Route::get('/personal/editar/{personal}', 'edit')->name('employee.edit');
        Route::post('/personal/almacenar', 'store')->name('employee.store');
        Route::put('/personal/editar/{personal}', 'update')->name('employee.update');
        Route::delete('/personal/eliminar/{personal}', 'destroy')->name('employee.delete');
    });

    Route::controller(designationController::class)->group(function (): void {
        Route::get('/designation', 'index')->name('designation');
        Route::post('/designation', 'download')->name('designation.download'); // todo it shold be codigo-acta/designation/download
    });
});
