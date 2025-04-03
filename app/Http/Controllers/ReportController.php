<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpWord\PhpWord;
use App\Livewire\Handover\informeAuditor;

class ReportController extends Controller
{
    public function downloadReport(Request $request)
    {
        
        // Obtener los valores de los checkboxes
        $checkboxes = $request->input('checkboxes', []);
        // Obtener los valores de los textarea
        $uncheckedCheckboxes = $request->input('uncheckedCheckboxes', []);
        $sinHallazgo = $request->input('sinHallazgo', '');

        // Crear un nuevo documento de Word
        $phpWord = new PhpWord();
        $section = $phpWord->addSection();

        // Título del documento
        $section->addTitle('Informe de Auditoría', 1);

        // Agregar contenido del checkbox y su textarea
        foreach ($checkboxes as $index => $value) {
            if ($value == '1') { // Solo si el checkbox está desmarcado
                $textAreaContent = $uncheckedCheckboxes[$index] ?? ''; // Obtener el contenido del textarea
                $section->addText("Checkbox: {$index}, Contenido: {$textAreaContent}");
            }
        }

        // Agregar contenido del checkbox "Sin Hallazgo"
        if (!empty($sinHallazgo)) {
            $section->addText("Sin Hallazgo: {$sinHallazgo}");
        }

        // Guardar el documento en un archivo temporal
        $fileName = 'InformeAuditoria.docx';
        $temp_file = tempnam(sys_get_temp_dir(), 'InformeAuditoria');
        $phpWord->save($temp_file, 'Word2007');

        // Descargar el archivo
        return response()->download($temp_file, $fileName)->deleteFileAfterSend(true);
    }
}