<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CecoController extends Controller
{
    public function handleResponse(Request $request)
    {
        // Validar la entrada
        $request->validate([
            'has_ceco' => 'required|boolean',
        ]);

        // Obtener la respuesta
        $hasCeco = $request->input('has_ceco');

        if ($hasCeco) {
            // Lógica si el usuario respondió "Sí"
            return response()->json(['message' => 'Usuario tiene Ceco.'], 200);
        } else {
            // Lógica si el usuario respondió "No"
            return response()->json(['message' => 'Usuario no tiene Ceco.'], 200);
        }
    }
}