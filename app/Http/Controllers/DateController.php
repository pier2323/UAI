<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class DateController extends Controller
{
    public function descargarPlantilla()
    {
        // Fecha actual
        $fechaActual = Carbon::now();

        // Fecha específica (por ejemplo, 1 de enero de 2023)
        $fechaEspecifica = Carbon::create(2023, 1, 1);

        // Diferencia en días entre la fecha actual y la fecha específica
        $diferenciaEnDias = $fechaActual->diffInDays($fechaEspecifica);

        // Variable para almacenar el mensaje
        $mensaje = '';

        if ($diferenciaEnDias > 120) {
            $mensaje = 'La diferencia es superior a 120 días.';
        } else {
            $mensaje = 'La diferencia es inferior a 120 días.';
        }

        // Retornar la vista con el mensaje
        return view('descargar-plantilla', compact('mensaje'));
    }
}