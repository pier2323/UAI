<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\TemplateProcessor;
use Carbon\Carbon;

class GmailController extends Controller
{
    public function index(Request $request)
    {
        // Validar los datos de la solicitud
        $request->validate([
            'input1' => 'required|string',
            'input2' => 'required|string',
            'input3' => 'required|string',
            'inputStart' => 'required|string',
            'hallazgos' => 'required|array', // Asegúrate de que hallazgos sea un array
            
        ]);
   
        // Procesar las fechas
        $fechaInput = $request->input('inputStart');
        $fechaInputEnd = $request->input('inputEnd');
    
        // Extraer el año de la fecha
        $fecha = Carbon::createFromFormat('d/m/Y', $fechaInput);
        $añoExtraído = $fecha->year;
    
        // Validar y transformar la fecha de fin
        $fechaFin = Carbon::createFromFormat('d/m/Y', $fechaInputEnd);
        if (!$fechaFin || $fechaFin->format('d/m/Y') !== $fechaInputEnd) {
            return response()->json(['error' => 'La fecha de fin no es válida.'], 400);
        }
    
        // Establecer la localización a español
        Carbon::setLocale('es');
    
        // Formatear la fecha de fin en español
        $fechaFinFormateada = $fechaFin->translatedFormat('d \d\e F \d\e Y');
    
        // Ruta de la plantilla
        $templatePath = 'C:\Users\pier\Desktop\UAI\storage\app\templateDocument\hola.docx';
    
        // Cargar la plantilla
        $templateProcessor = new TemplateProcessor($templatePath);
        $fecha = now()->format('d') . ' de ' . now()->translatedFormat('F') . ' de ' . now()->format('Y');
        $añoActual = date('Y');
    
        // Reemplazar variables en la plantilla
        $templateProcessor->setValue('code', $request->input('input1'));
        $templateProcessor->setValue('para', $request->input('input2'));
        $templateProcessor->setValue('adscriptas', $request->input('input3'));
        $templateProcessor->setValue('start', $request->input('inputStart'));
        $templateProcessor->setValue('end', $request->input('inputEnd'));
        $templateProcessor->setValue('hoy', $fecha);
        $templateProcessor->setValue('año', $añoActual);
        $templateProcessor->setValue('años', $añoExtraído);
        $templateProcessor->setValue('fechaFin', $fechaFinFormateada);
    
        // Procesar los hallazgos
        $hallazgos = $request->input('hallazgos');
        foreach ($hallazgos as $index => $hallazgo) {
            $templateProcessor->setValue("hallazgo{$index}_descripcion", $hallazgo['descripcion']);
            $templateProcessor->setValue("hallazgo{$index}_unidad", $hallazgo['unidad']);
        }
    
        // Guardar el documento en un archivo temporal
        $tempFilePath = tempnam(sys_get_temp_dir(), 'documento_') . '.docx';
        $templateProcessor->saveAs($tempFilePath);
    
        // Preparar la descarga del archivo
        return response()->download($tempFilePath, 'documento_generado.docx')->deleteFileAfterSend(true);
    }
}