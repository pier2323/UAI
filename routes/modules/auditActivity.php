<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\AuditActivity\Main;
use App\Http\Livewire\AuditActivity\Show;
use Illuminate\Support\Facades\Log;
use Livewire\Livewire;

Livewire::setUpdateRoute(function ($handle) {
    Log::info('livewire update', $handle);
    return Route::post('/livewire/update', $handle);
});
Route::prefix('actuacion-fiscal')->name('auditActivity.')->group(
    function (): void {
        Route::get('/', Main::class)->name('index');
        Route::get('/{id}', Show::class)->name('show');
    }
);

