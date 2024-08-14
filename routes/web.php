<?php

use App\Http\Controllers\designationController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AuditActivityController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Documentos;
use App\Http\Livewire\AuditActivity\RegisterForm\HandoverDocument;
use app\Http\Livewire\Handovere\index;
use Symfony\Component\Routing\Annotation\Route as AnnotationRoute;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::middleware([
])->group(function () {

    Route::get(uri: '/dashboard', action: [MainController::class, '__invoke'])->name('dashboard');

    // * auditActivity Routes 
    Route::get(
        uri: '/actuacion-fiscal', 
        action: App\Http\Livewire\AuditActivity\Main::class
    )->name('auditActivity.index');
    
    Route::get(
        uri: '/actuacion-fiscal/{id}', 
        action: App\Http\Livewire\AuditActivity\Show::class
    )->name('auditActivity.show');



    Route::controller(Documentos::class)->group(function () {
        Route::get('/Leyes', 'leyes')->name('leyes');
        Route::get('/Reglamentos', 'reglamentos')->name('reglamentos');
        Route::get('/Documentos', 'Documentos')->name('documentoNormativo');
     
    });





    Route::get(
        uri: '/acta-de-entrega', 
        action: App\Http\Livewire\Handover::class
    )->name('handover.index');

    Route::get(
        uri: '/acta-de-entrega/{id}', 
        action: App\Http\Livewire\Handover\Show::class
    )->name('handover.show');


   
   

    


    Route::get('/Detalles', function () {
        return view('detalles');
    })->name('detalles');

    Route::get('/poa', function () {
        return view('poa.index');
    })->name('poa');


    Route::controller(EmployeeController::class)->group(function (): void {
        Route::get('/personal', 'index')->name('employee.index');
        Route::post('/personal/almacenar', 'store')->name('employee.store');
        Route::get('/personal/mostrar/{personal}', 'show')->name('employee.show');
        Route::put('/personal/editar/{personal}', 'update')->name('employee.update');
        Route::get('/personal/editar/{personal}', 'edit')->name('employee.edit');
        Route::get('/personal/eliminar/{personal}', 'destroy')->name('employee.delete');
    });

    Route::controller(designationController::class)->group(function (): void {
        Route::get('/Designation', 'index')->name('designation');
        Route::post('/designation', 'download')->name('designation.download'); 
    });
});

