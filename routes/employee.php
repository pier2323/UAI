<?php

use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;

Route::get(
    uri: '/personal',
    action: App\Http\Livewire\Employee\Main::class
)->name('employee.index');

Route::controller(EmployeeController::class)->group( function (): void {
    Route::post('/personal/almacenar', 'store')->name('employee.store');
    Route::get('/personal/mostrar/{personal}', 'show')->name('employee.show');
    Route::get('/personal/editar/{personal}', 'edit')->name('employee.edit');
    Route::put('/personal/editar/{personal}', 'update')->name('employee.update');
    Route::delete('/personal/eliminar/{personal}', 'destroy')->name('employee.delete');
});