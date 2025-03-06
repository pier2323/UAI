<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Handover\Main;
use App\Livewire\Handover\Show;
use App\Livewire\Handover\Review;
use App\Livewire\Handover\Register;
use App\Middlewares\HasPermission;

Route::prefix('acta-de-entrega')->name('handover.')->group(
    function (): void {
        Route::get('/', Main::class)->name('index');
        Route::get('/nro/{public_id}', Show::class)->name('show');
        Route::get('/revision', Review::class)->name('reviw');
        Route::get('/registro', Register::class)->name('register')->middleware(HasPermission::class);
    }
);