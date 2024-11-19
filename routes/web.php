<?php

use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Documentos;
use App\Http\Controllers\ExcelController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\ZimbraMailController;
use App\Http\Controllers\CalendarController;

use App\Http\Controllers\ReportController;

// Otras rutas...



use App\Http\Controllers\DownloadSinHallazgoController;
use App\Http\Controllers\DocumentController;

Route::get('/documents', [DocumentController::class, 'index'])->name('documents.index');
Route::post('/documents/upload', [DocumentController::class, 'upload'])->name('documents.upload');
Route::get('/document/{filename}', [DocumentController::class, 'show']);
Route::get('/documentos', [DocumentController::class, 'index'])->name('documentos.index');
Route::post('/documentos/upload', [DocumentController::class, 'upload'])->name('upload.documents');

Route::post('/download-sin-hallazgo', [DownloadSinHallazgoController::class, 'download'])->name('download-sin-hallazgo');
Route::post('/download-report', [ReportController::class, 'downloadReport'])
    ->name('download-report')
    ->middleware('auditActivity');

Route::post('/calculate-date', [CalendarController::class, 'calculate'])->name('calculate.date');

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

