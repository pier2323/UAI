<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\AuditActivity\Main;
use App\Http\Livewire\AuditActivity\Show;

Route::prefix('actuacion-fiscal')->name('auditActivity.')->group(
    function (): void {
        Route::get('/', Main::class)->name('index');
        Route::get('/{public_id}', Show::class)->name('show');
    }
);

