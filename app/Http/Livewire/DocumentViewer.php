<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Document;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class DocumentViewer extends Component
{
    public $auditActivityId; // Propiedad para almacenar el ID de la actividad
    public $files; // Propiedad para almacenar los documentos

    public function mount($auditActivityId) // Método para inicializar el componente
    {
        $this->auditActivityId = $auditActivityId;
        $this->loadDocuments();
    }

    public function loadDocuments() // Método para cargar documentos
    {
        $this->files = Document::where('audit_activity_id', $this->auditActivityId)->get();
    }

    public function download($id) // Método para descargar un documento específico
    {
        $document = Document::findOrFail($id);
        return Storage::download($document->path, $document->name);
    }

    public function downloadZip() // Método para descargar todos los documentos en un ZIP
    {
        $documents = Document::where('audit_activity_id', $this->auditActivityId)->get();
    
        if ($documents->isEmpty()) {
            session()->flash('error', 'No hay documentos para descargar.');
            return;
        }
    
        // Obtener la ruta completa del primer documento para extraer el nombre de la carpeta
        $firstDocumentPath = storage_path("app/{$documents->first()->path}");
        $folderName = basename(dirname($firstDocumentPath)); // Obtener el nombre de la carpeta
    
        // Crear el nombre del archivo ZIP basado en el nombre de la carpeta
        $zipFileName = "{$folderName}{$this->auditActivityId}.zip";
        $zipFilePath = storage_path("app/public/{$zipFileName}");
    
        // Mensaje indicando que se han encontrado documentos
        session()->flash('success', 'Documentos encontrados, preparando descarga...');
    
        $zip = new ZipArchive();
    
        if ($zip->open($zipFilePath, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== true) {
            session()->flash('error', 'No se pudo crear el archivo ZIP.');
            return;
        }
    
        foreach ($documents as $document) {
            $fullPath = storage_path("app/{$document->path}");
            // Agregar el archivo al ZIP
            $zip->addFile($fullPath, $document->name);
        }
    
        $zip->close();
    
        return response()->download($zipFilePath)->deleteFileAfterSend(true);
    }

    public function render()
    {
        return view('livewire.document-viewer');
    }
}