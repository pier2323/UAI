<?php

use Illuminate\Support\Facades\Route;

Route::get(
    uri: '/acta-de-entrega', 
    action: App\Http\Livewire\Handover\Main::class
)->name('handover.index');

Route::get(
    uri: '/acta-de-entrega/{id}', 
    action: App\Http\Livewire\Handover\Show::class
)->name('handover.show');

Route::get(
    uri: '/revicion de actas ', 
    action: App\Http\Livewire\Handover\Review::class
)->name('handover.reviw');