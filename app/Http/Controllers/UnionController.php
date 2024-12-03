<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\AuditActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
            ->whereRaw('LOWER(name) LIKE ?', ['%tiene_ceco%']) // Convertir a minúsculas para comparación
            ->get();
    
        // Función para extraer la carpeta y el nombre del archivo
        $extractFileInfo = function($document) {
            $pathInfo = pathinfo($document->path);
            // Obtener solo la carpeta y el nombre del archivo
            $folderName = $pathInfo['dirname']; // Carpeta completa
            $fileName = $pathInfo['basename']; // Nombre del archivo completo
    
            // Combinar la carpeta y el nombre del archivo
            $folderWithFile = str_replace('public/', '', $folderName) . '/' . $fileName;
    
            return [
                'name' => $document->name,
                'folder' => $folderWithFile, // Carpeta y nombre del archivo
            ];
        };
    
        // Verificar si se encontraron documentos
        if ($documentsIA->isNotEmpty() && $documentsTieneCeco->isNotEmpty()) {
            return response()->json([
                'message' => 'Se encontraron documentos diferentes: uno que contiene "IA-" y otro que contiene "tiene_ceco".',
                'documents' => [
                    'IA_documents' => $documentsIA->map($extractFileInfo),
                    'Tiene_ceco_documents' => $documentsTieneCeco->map($extractFileInfo),
                ],
            ], 200);
        } elseif ($documentsIA->isNotEmpty()) {
            return response()->json(['message' => 'Se encontraron documentos que contienen "IA-", pero no se encontraron documentos que contengan "Tiene_ceco".'], 404);
        } elseif ($documentsTieneCeco->isNotEmpty()) {
            return response()->json(['message' => 'Se encontraron documentos que contienen "Tiene_ceco", pero no se encontraron documentos que contengan "IA-".'], 404);
        } else {
            return response()->json(['message' => 'No existe ningún documento que contenga "IA-" o "Tiene_ceco".'], 404);
        }
    }
}