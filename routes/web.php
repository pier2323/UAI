<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Documentos;
use App\Http\Controllers\ExcelController;
use App\Http\Controllers\ZimbraMailController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\DownloadSinHallazgoController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\TuControlador; 
use App\Http\Controllers\UnionController; 
use App\Livewire\MemoOficio\MemoOfico;
use App\Http\Controllers\GmailController;
use App\Http\Controllers\HallazgosController;
use App\Http\Controllers\DescargaMemoController;
use App\Http\Controllers\DefinitivoV2Controller; // Import the new controller
use App\Http\Controllers\RemisionDefinitivoController; // Import the new controller
use App\Http\Controllers\ArchivoMovilController;

// todo before login 
Route::get('/', fn() => view('welcome'))->name('welcome');

<<<<<<< HEAD
Route::get('/archivo-movil', [ArchivoMovilController::class, 'index'])->name('archivo.movil');
Route::post('/archivo-movil/save', [ArchivoMovilController::class, 'save'])->name('archivo.movil.save');
=======
Route::controller(Documentos::class)->group(function () {
    Route::get('/Leyes', 'leyes')->name('leyes');
    Route::get('/Reglamentos', 'reglamentos')->name('reglamentos');
    Route::get('/Documentos', 'Documentos')->name('documentoNormativo');
});

// todo after login 
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/dashboard', fn() => view(view: 'dashboard'))->name('dashboard.index');

    // todo auditActivity Routes 
    include_once('modules/auditActivity.php');
    
    // todo handoverDocument Routes 
    include_once('modules/handoverDocument.php');

    // todo employee routes 
    include_once('modules/employee.php');

});
>>>>>>> 89ce0de5e6ebf54375590c38d6284c19271fd101

Route::get(uri: '/memo-ofico', action: MemoOfico::class)->name('memo_ofico.index');
Route::get('/descarga-memo/{input_tipo1}', [DescargaMemoController::class, 'index']);
Route::post('/guardar-memo', [HallazgosController::class, 'guardarMemo'])->name('guardar.memo');
Route::post('/actualizar-memo/{id}', [HallazgosController::class, 'actualizarMemo'])->name('actualizar.memo');
Route::delete('/eliminar-memo/{id}', [HallazgosController::class, 'eliminarMemo'])->name('eliminar.memo');
<<<<<<< HEAD
Route::get('/remision-definitivo/download/{id}', [RemisionDefinitivoController::class, 'downloadTemplate']);
Route::post('/remision-definitivo/update/{id}', [RemisionDefinitivoController::class, 'update'])->name('remision-definitivo.update');
Route::delete('/remision-definitivo/delete/{id}', [RemisionDefinitivoController::class, 'destroy'])->name('remision-definitivo.destroy');
=======
>>>>>>> 89ce0de5e6ebf54375590c38d6284c19271fd101

Route::get('/gmail', [GmailController::class, 'index']);
Route::get('/union', [UnionController::class, 'union'])->name('ruta.union');

<<<<<<< HEAD
Route::get(
    uri: '/acta-de-entrega', 
    action: App\Http\Livewire\Handover\Main::class
)->name('handover.index');

=======
>>>>>>> 89ce0de5e6ebf54375590c38d6284c19271fd101
//Rutas de la carga de los archivos 
Route::get('/documento-ceco', [TuControlador::class, 'descargarCeco'])->name('documento.ceco');
Route::get('/documento-no-ceco', [TuControlador::class, 'descargarNoCeco'])->name('documento.no.ceco');
Route::post('/documents/check', [DocumentController::class, 'checkDocument'])->name('documents.check');
Route::get('/documents', [DocumentController::class, 'index'])->name('documents.index');
Route::post('/documents/upload/', [DocumentController::class, 'upload'])->name('documents.upload');
Route::get('/document/{filename}', [DocumentController::class, 'show']);
Route::get('/documentos', [DocumentController::class, 'index'])->name('documentos.index');
Route::post('/documentos/upload', [DocumentController::class, 'upload'])->name('upload.documents');
Route::delete('/documents/{id}', [DocumentController::class, 'destroy'])->name('documents.destroy');
Route::post('/documents/save-text', [DocumentController::class, 'saveText'])->name('documents.save-text');
Route::post('/generate-word', [DocumentController::class, 'generateWord']);
Route::post('/download-sin-hallazgo', [DownloadSinHallazgoController::class, 'download'])->name('download-sin-hallazgo');
// Fin  Rutas de la carga de los archivos 

// Rutas de la Ceudla y del envio de zizmbra 
Route::post('/calculate-date', [CalendarController::class, 'calculate'])->name('calculate.date');
Route::get('/enviar-correo-zimbra', [ZimbraMailController::class, 'enviarCorreo']);
Route::post('/download-excel', [ExcelController::class, 'downloadExcel'])->name('download-excel');
// Fin  Rutas 

// Route for downloading "Informe Definitivo V2"
Route::post('/download-definitivo-v2', [DefinitivoV2Controller::class, 'download'])->name('download-definitivo-v2');

<<<<<<< HEAD
// Route for storing "Remision Definitivo"
Route::post('/remision-definitivo', [RemisionDefinitivoController::class, 'store'])->name('remision-definitivo.store');

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

=======
>>>>>>> 89ce0de5e6ebf54375590c38d6284c19271fd101
