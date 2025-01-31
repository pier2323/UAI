<?php

use App\Http\Livewire\Employee\Main;
use App\Http\Livewire\Employee\Show;
use Illuminate\Support\Facades\Route;

Route::prefix('personal')->name('employee.')->group(
    function (): void {
        Route::get('/', Main::class)->name('index');
        Route::get('/{id}', Show::class)->name('show');
    }
);