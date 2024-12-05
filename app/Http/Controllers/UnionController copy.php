<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\AuditActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;

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
    
        // Función para extraer la carpeta y el nombre del archivo
        $extractFileInfo = function($document) {
            $pathInfo = pathinfo($document->path);
            $folderName = $pathInfo['dirname'];
            $fileName = $pathInfo['basename'];
            $folderWithFile = str_replace('public/', '', $folderName) . '/' . $fileName;
    
            return [
                'name' => $document->name,
                'folder' => $folderWithFile,
            ];
        };
    
        // Función para abrir y leer el contenido del archivo
        $readFileContent = function($folderWithFile) {
            $basePath = 'C:\Users\pier\Desktop\UAI\public\storage\\';
            $fullPath = $basePath . $folderWithFile;
            $fullPath = str_replace(['\\', '/'], '\\', $fullPath);

            // Verificar si el archivo existe
            if (file_exists($fullPath)) {
                $content = file_get_contents($fullPath);
                
                // Intentar detectar la codificación del contenido
                $encoding = mb_detect_encoding($content, mb_detect_order(), true);
                if ($encoding && $encoding !== 'UTF-8') {
                    // Convertir a UTF-8 y eliminar caracteres no válidos
                    $content = mb_convert_encoding($content, 'UTF-8', $encoding);
                }

                // Eliminar caracteres no válidos
                $content = preg_replace('/[^\x20-\x7E]/', '', $content); // Solo caracteres ASCII

                return [
                    'success' => true,
                    'content' => $content
                ];
            } else {
                return [
                    'success' => false,
                    'message' => 'No se puede acceder a la ruta: ' . $fullPath,
                    'content' => null
                ];
            }
        };

        // Almacenar el contenido de los documentos
        $contentIA = '';
        foreach ($documentsIA as $document) {
            $fileInfo = $extractFileInfo($document);
            $result = $readFileContent($fileInfo['folder']);
            if ($result['success']) {
                $contentIA .= $result['content'] . "\n"; // Concatenar el contenido
            } else {
                // Manejar el mensaje de error
                $contentIA .= $result['message'] . "\n"; // Imprimir mensaje de error
            }
        }

        $contentTieneCeco = '';
        foreach ($documentsTieneCeco as $document) {
            $fileInfo = $extractFileInfo($document);
            $result = $readFileContent($fileInfo['folder']);
            if ($result['success']) {
                $contentTieneCeco .= $result['content'] . "\n"; // Concatenar el contenido
            } else {
                // Manejar el mensaje de error
                $contentTieneCeco .= $result['message'] ."\n"; // Imprimir mensaje de error
            }
        }

        // Crear el contenido combinado
        $combinedContent = "Informe Definitivo\n\n";
        $combinedContent .= "Contenido de documentos que contienen 'IA-':\n";
        $combinedContent .= !empty($contentIA) ? $contentIA : "No se encontraron documentos que contengan 'IA-'.\n";
        $combinedContent .= "\nContenido de documentos que contienen 'Tiene_ceco':\n";
        $combinedContent .= !empty($contentTieneCeco) ? $contentTieneCeco : "No se encontraron documentos que contengan 'Tiene_ceco'.\n";

        // Guardar el informe en un archivo
        $reportFileName = 'informe_definitivo.txt';
        $reportFilePath = 'C:\Users\pier\Desktop\UAI\public\storage\\' . $reportFileName;

        // Escribir el contenido combinado en el archivo
        file_put_contents($reportFilePath, $combinedContent);

        // Preparar la respuesta para la descarga
        return response()->download($reportFilePath)->deleteFileAfterSend(true);
    }
}