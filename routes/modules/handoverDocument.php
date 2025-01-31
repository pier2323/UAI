<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Handover\Main;
use App\Http\Livewire\Handover\Show;
use App\Http\Livewire\Handover\Review;
use App\Http\Livewire\Handover\Register;
use App\Http\Middleware\HasPermission;

Route::prefix('acta-de-entrega')->name('handoverDocument.')->group(
    function (): void {
        Route::get('/', Main::class)->name('index');
        Route::get('/nro/{public_id}', Show::class)->name('show');
        Route::get('/revision', Review::class)->name('reviw');
        Route::get('/registro', Register::class)->name('register')->middleware(HasPermission::class);
    }
);