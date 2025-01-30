<?php

namespace App\Http\Controllers;

use App\Models\Document; // Asegúrate de importar el modelo
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\AuditActivity;
use Illuminate\Support\Facades\Validator;
class DocumentController extends Controller
{
    public function upload(Request $request)
    {
        // Validar los archivos
        $request->validate([
            'file' => 'required|array', // Asegúrate de que se suban archivos
            'file.*' => 'file|mimes:doc,docx,xls,xlsx,pdf|max:2048', // Máximo 2MB por archivo
        ]);
    
        // Obtener el public_id de la actividad de auditoría
        $public_id = $request->input('auditActivityId');
        
        // Obtener la actividad de auditoría utilizando el public_id
        $auditActivity = AuditActivity::where('public_id', $public_id)->first();
    
        // Manejar el caso en que no se encuentra la actividad
        if (!$auditActivity) {
            return back()->withErrors(['error' => 'Actividad de auditoría no encontrada.']);
        }
        
        // Definir el nombre de la carpeta utilizando el código de la actividad y el departamento
        $activity_folder = 'public/Documen/' . $auditActivity->code . '_' . $auditActivity->handoverDocument->departament;
    
        // Crear la carpeta específica para la actividad si no existe
        if (!Storage::exists($activity_folder)) {
            Storage::makeDirectory($activity_folder, 0755, true);
        }
    
        try {
            // Iterar sobre los archivos y guardarlos
foreach ($request->file('file') as $file) {
    // Obtener el nombre original del archivo
    $originalFileName = $file->getClientOriginalName();
    
    // Usar una expresión regular para eliminar cualquier número seguido de un guion bajo al inicio del nombre
    $modifiedFileName = preg_replace('/^\d+_/', '', $originalFileName);
    
    // Guardar el archivo en la carpeta específica
    $path = $file->storeAs($activity_folder, $modifiedFileName);
    
    // Guardar el nombre y la ruta en la base de datos
    Document::create([
        'name' => $modifiedFileName,
        'path' => $path,
        'audit_activity_id' => $auditActivity->id,
    ]);
}
            
            // Mensaje de éxito
            return back()->with('success', 'Documentos subidos correctamente.');
        } catch (\Exception $e) {
            // Manejo de errores en caso de fallo en la carga
            return back()->withErrors(['error' => 'Error al subir los documentos.']);
        }
    }

    public function destroy($id)
    {
        $document = Document::findOrFail($id);
        
        // Eliminar el archivo del sistema
        Storage::delete($document->path);
        
        // Eliminar el documento de la base de datos
        $document->delete();
        
        return back()->with('success', 'Documento eliminado correctamente.');
    }
    public function checkDocument(Request $request)
    {
        $public_id = $request->input('auditActivityId');
    
        // Obtener la actividad de auditoría utilizando el public_id
        $auditActivity = AuditActivity::where('public_id', $public_id)->first();
    
        // Manejar el caso en que no se encuentra la actividad
        if (!$auditActivity) {
            return response()->json(['message' => 'Actividad de auditoría no encontrada.'], 404);
        }
    
        // Buscar si existe algún documento que contenga "IA-" en el nombre
        $document = Document::where('audit_activity_id', $auditActivity->id)
            ->where('name', 'like', '%IA-%') // Busca cualquier nombre que contenga "IA-"
            ->first(); // Cambiar a first() para obtener el documento
    
        if ($document) {
            // Si existe, capturar la ruta del documento
            $documentPath = $document->path; // Suponiendo que 'path' es el nombre del campo que almacena la ruta
            return response()->json([
                'message' => 'El documento que contiene "IA-" existe. Ruta: ' . $documentPath,
                'document_path' => $documentPath // Enviar la ruta del documento en la respuesta
            ], 200);
        } else {
            return response()->json(['message' => 'No existe ningún documento que contenga "IA-".'], 404);
        }
    }

    public function index(Request $request)
    {
        $public_id = $request->input('auditActivityId'); // Obtener el public_id de la actividad
        $auditActivity = AuditActivity::where('public_id', $public_id)->first();
    
        // Manejar el caso en que no se encuentra la actividad
        if (!$auditActivity) {
            return back()->withErrors(['error' => 'Actividad de auditoría no encontrada.']);
        }
    
        $files = Document::where('audit_activity_id', $auditActivity->id)->get(); // Filtrar documentos por ID de actividad
    
        return view('archivador', compact('files')); // Pasar la variable $files a la vista
    }
}