<?php

namespace App\Http\Controllers;
use App\Models\Document; // Asegúrate de importar el modelo
use App\Models\AuditActivity; // Asegúrate de importar el modelo de AuditActivity
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use PhpOffice\PhpWord\PhpWord;
use Illuminate\Support\Facades\Storage;



class tuControlador extends Controller
{    public function descargarCeco(Request $request)
    
     {$public_id = $request->input('auditActivityId');
        $auditActivity = AuditActivity::where('public_id', $public_id)->first();
        
        if (!$auditActivity) {
            return response()->json(['message' => 'Actividad de auditoría no encontrada.'], 404);
        }
        
        $activity_folder = 'Documen/' . $auditActivity->code . '_' . $auditActivity->handoverDocument->departament;
        
        // Usar Storage para manejar la creación de carpetas y archivos
        if (!Storage::exists($activity_folder)) {
            Storage::makeDirectory($activity_folder);
        }
        
        $fileName = 'tiene_ceco.docx';
        $filePath = public_path($activity_folder . '/' . $fileName);
        
        // Cargar la plantilla
        $templatePath = storage_path('app/templateDocument/con CECO.docx');
        
        if (!file_exists($templatePath)) {
            return response()->json(['message' => 'Plantilla no encontrada.'], 404);
        }
        
        // Usar TemplateProcessor para manejar la plantilla
        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($templatePath);
        
        // Reemplazar la variable ${codes} con "hol a"
        $templateProcessor->setValue('codes', 'hol a');
        
        try {
            // Guardar el documento modificado
            $templateProcessor->saveAs($filePath);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al guardar el documento: ' . $e->getMessage()], 500);
        }
        
        // Asegurarse de que la carpeta de destino exista
        $activity_carpeta = 'Documen/' . $auditActivity->code . '_' . $auditActivity->handoverDocument->departament;
        if (!Storage::exists($activity_carpeta)) {
            Storage::makeDirectory($activity_carpeta);
        }
        
        // Copiar el archivo a storage
        try {
            Storage::disk('public')->putFileAs($activity_carpeta, new \Illuminate\Http\File($filePath), $fileName);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al copiar el documento: ' . $e->getMessage()], 500);
        }
        
        Document::create([
            'name' => $fileName,
            'path' => 'public/' . $activity_folder . '/' . $fileName,
            'audit_activity_id' => $auditActivity->id,
        ]);
        
        return Response::download($filePath)->deleteFileAfterSend(true);
    }
        
        public function descargarNoCeco(Request $request)
        {
            {$public_id = $request->input('auditActivityId');
                $auditActivity = AuditActivity::where('public_id', $public_id)->first();
                
                if (!$auditActivity) {
                    return response()->json(['message' => 'Actividad de auditoría no encontrada.'], 404);
                }
                
                $activity_folder = 'Documen/' . $auditActivity->code . '_' . $auditActivity->handoverDocument->departament;
                
                // Usar Storage para manejar la creación de carpetas y archivos
                if (!Storage::exists($activity_folder)) {
                    Storage::makeDirectory($activity_folder);
                }
                
                $fileName = 'no_ceco.docx';
                $filePath = public_path($activity_folder . '/' . $fileName);
                
                // Cargar la plantilla
                $templatePath = storage_path('app/templateDocument/sin CECO.docx');
                
                if (!file_exists($templatePath)) {
                    return response()->json(['message' => 'Plantilla no encontrada.'], 404);
                }
                
                // Usar TemplateProcessor para manejar la plantilla
                $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($templatePath);
                
                // Reemplazar la variable ${codes} con "hol a"
                $templateProcessor->setValue('codes', 'hol a');
                
                try {
                    // Guardar el documento modificado
                    $templateProcessor->saveAs($filePath);
                } catch (\Exception $e) {
                    return response()->json(['message' => 'Error al guardar el documento: ' . $e->getMessage()], 500);
                }
                
                // Asegurarse de que la carpeta de destino exista
                $activity_carpeta = 'Documen/' . $auditActivity->code . '_' . $auditActivity->handoverDocument->departament;
                if (!Storage::exists($activity_carpeta)) {
                    Storage::makeDirectory($activity_carpeta);
                }
                
                // Copiar el archivo a storage
                try {
                    Storage::disk('public')->putFileAs($activity_carpeta, new \Illuminate\Http\File($filePath), $fileName);
                } catch (\Exception $e) {
                    return response()->json(['message' => 'Error al copiar el documento: ' . $e->getMessage()], 500);
                }
                
                Document::create([
                    'name' => $fileName,
                    'path' => 'public/' . $activity_folder . '/' . $fileName,
                    'audit_activity_id' => $auditActivity->id,
                ]);
                
                return Response::download($filePath)->deleteFileAfterSend(true);
            }
        }
}
