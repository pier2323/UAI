<?php
use Illuminate\Support\Facades\Route;

Route::get(
        uri: '/actuacion-fiscal', 
        action: App\Http\Livewire\AuditActivity\Main::class
    )->name('auditActivity.index');
    
    Route::get(
        uri: '/actuacion-fiscal/{id}', 
        action: App\Http\Livewire\AuditActivity\Show::class
    )->name('auditActivity.show');