<?php

use App\Http\Middleware\HasPermission;
use Illuminate\Support\Facades\Route;

Route::get(
    uri: '/actuacion-fiscal', 
    action: App\Http\Livewire\AuditActivity\Main::class
)->name('auditActivity.index');

Route::get(
    uri: '/actuacion-fiscal/{public_id}', 
    action: App\Http\Livewire\AuditActivity\Show::class
)->name('auditActivity.show');

Route::get(
    uri: '/acta-de-entrega/registro', 
    action: App\Http\Livewire\Handover\Register::class
)
->middleware(HasPermission::class)
->name('handoverDocument.register');