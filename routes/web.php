<?php

use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Documentos;
use App\Http\Controllers\ExcelController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\ZimbraMailController;

Route::get('/enviar-correo-zimbra', [ZimbraMailController::class, 'enviarCorreo']);

Route::post('/download-excel', [ExcelController::class, 'downloadExcel'])->name('download-excel');

Route::post('/save-data', [DataController::class, 'saveData'])->name('saveData');


// todo before login 
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::controller(Documentos::class)->group(function () {
    Route::get('/Leyes', 'leyes')->name('leyes');
    Route::get('/Reglamentos', 'reglamentos')->name('reglamentos');
    Route::get('/Documentos', 'Documentos')->name('documentoNormativo');
});

// todo after login 
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get(uri: '/dashboard', action: [MainController::class, '__invoke'])->name('dashboard.index');

    // todo auditActivity Routes 
    include_once('auditActivity.php');
    
    // todo handoverDocument Routes 
    include_once('handoverDocument.php');

    // todo employee routes 
    include_once('employee.php');




    Route::get(
        uri: '/private/components', 
        action:  App\Http\Livewire\Components\Main::class)
        ->name('components.main');

});

