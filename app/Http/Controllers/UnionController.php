<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\AuditActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpWord\TemplateProcessor;

class UnionController extends Controller
{
    public function union(Request $request)
    {
        // Validar la entrada
        $validator = Validator::make($request->all(), [
            'auditActivityId' => 'required|string',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['message' => 'El ID de actividad de auditoría es requerido.'], 400);
        }
    
        $public_id = $request->input('auditActivityId');
    
        // Obtener la actividad de auditoría
        $auditActivity = AuditActivity::where('public_id', $public_id)->first();
    
        // Manejar el caso en que no se encuentra la actividad
        if (!$auditActivity) {
            return response()->json(['message' => 'Actividad de auditoría no encontrada.'], 404);
        }
    
        // Buscar documentos que contengan "IA-"
        $documentsIA = Document::where('audit_activity_id', $auditActivity->id)
            ->where('name', 'like', '%IA-%')
            ->get();
    
        // Buscar documentos que contengan "Tiene_ceco" sin importar mayúsculas y minúsculas
        $documentsTieneCeco = Document::where('audit_activity_id', $auditActivity->id)
            ->whereRaw('LOWER(name) LIKE ?', ['%tiene_ceco%'])
            ->get();

        // Verificar si se encontraron documentos
        if ($documentsIA->isEmpty() || $documentsTieneCeco->isEmpty()) {
            return response()->json(['message' => 'No se encontraron documentos suficientes para fusionar.'], 404);
        }

        // Definir la ruta base
        $basePath = 'C:\Users\pier\Desktop\UAI\public\storage\\';

        // Cargar los documentos a fusionar
        $templateProcessor1 = new TemplateProcessor($basePath . str_replace('public/', '', $documentsIA->first()->path)); // Construye la ruta para el primer documento
        $templateProcessor2 = new TemplateProcessor($basePath . str_replace('public/', '', $documentsTieneCeco->first()->path)); // Construye la ruta para el segundo documento

        // Combinar los documentos
        $templateProcessor1->cloneBlock('todo', $templateProcessor2); // Asegúrate de que 'todo' sea un bloque definido en el documento 1

        // Guardar el documento resultante
        $outputPath = 'documento_final.docx'; // Ruta donde se guardará el documento final
        $templateProcessor1->saveAs($outputPath);

        // Retornar la respuesta con el archivo generado
        return response()->json([
            'message' => 'Documentos combinados exitosamente.',
            'output_file' => url($outputPath), // Devuelve la URL del archivo generado
        ], 200);
    }
}