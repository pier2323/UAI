<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\AuditActivity;

Route::get('/user', function (Request $request) {
    return json_encode(App\Models\AuditActivity::all());
});

Route::get('/audit-activity/{codigo}', function ($codigo) {
    $auditActivity = AuditActivity::where('public_id', $codigo)->first();
    $objective = $auditActivity ? $auditActivity->objective : null;

    // Eliminar las cadenas específicas del campo objective
    $search = ['"', 'Actuación fiscal ', 'Verificación acta de entrega', 'Actuación de Seguimiento'];
    $replace = '';
    $objective = str_replace($search, $replace, $objective);

    return response()->json([
        'objective' => $objective,
    ]);
});
