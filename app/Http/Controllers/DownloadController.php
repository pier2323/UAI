<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Models\AuditActivity; // Asegúrate de incluir el modelo
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use PhpOffice\PhpWord\TemplateProcessor;

class DownloadController extends Controller
{
    public function downloadTemplate($public_id)
    {
        // Obtener la actividad de auditoría utilizando el public_id
        $auditActivity = AuditActivity::with(['designation', 'accreditation', 'handoverDocument' => ['employeeOutgoing', 'employeeIncoming'], 'employee'])
            ->where('public_id', $public_id)
            ->first();
    
        if (!$auditActivity) {
            abort(404, 'Actividad de auditoría no encontrada.');
        }
    
        // Preparar los datos para la plantilla
        // (Aquí va tu lógica para preparar los datos)
    
        // Cargar la plantilla de Word
        $templateProcessor = new TemplateProcessor(storage_path('app/templates/IA_sin_ohTemplate.docx'));
    
        // Reemplazar los marcadores de posición en la plantilla
        // (Aquí va tu lógica para reemplazar los marcadores)
    
        // Guardar el documento resultante en un archivo temporal
        $tempFilePath = tempnam(sys_get_temp_dir(), 'plantilla_') . '.docx';
        $templateProcessor->saveAs($tempFilePath);
    
        // Descargar el archivo
        return response()->download($tempFilePath, 'nombre_del_archivo.docx')->deleteFileAfterSend(true);
    }
}