<?php

namespace App\Http\Controllers;

use App\Models\RemisionDefinitivo;
use App\Models\AuditActivity;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\TemplateProcessor;

class RemisionDefinitivoController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'codigo' => 'required|string|regex:/^\d{3}$/',
            'para' => 'required|string|max:255',
            'hallazgos' => 'nullable|string',
            'fecha_definitivo' => 'required|date', // Validate the date
        ]);

        $codigo = date('Y') . '-' . $request->codigo;

        // Fetch the objective from AuditActivity
        $auditActivity = AuditActivity::where('public_id', $request->codigo)->first();
        $objective = $auditActivity ? $auditActivity->objective : null;

        // Eliminate specific strings from the objective field
        $search = ['"', 'Actuación fiscal ', 'Verificación acta de entrega', 'Actuación de Seguimiento'];
        $replace = '';
        $objective = str_replace($search, $replace, $objective);

        RemisionDefinitivo::create([
            'codigo' => $codigo,
            'para' => $request->para,
            'objective' => $objective,
            'hallazgos' => $request->hallazgos,
            'fecha_definitivo' => $request->fecha_definitivo, // Save the date
        ]);

        return redirect()->back(); // Redirect back to the previous page
    }

    public function downloadTemplate($id)
    {
        $remision = RemisionDefinitivo::findOrFail($id);
        $templatePath = storage_path('app/templateDocument/Remisión_definitivo_tamplate.docx');
        $templateProcessor = new TemplateProcessor($templatePath);

        $templateProcessor->setValue('codigo', $remision->codigo);
        $templateProcessor->setValue('para', $remision->para); // Asegúrate de pasar el valor de para
        $templateProcessor->setValue('objective', $remision->objective); // Asegúrate de pasar el valor de objective
        $templateProcessor->setValue('hallazgos', $remision->hallazgos); // Asegúrate de pasar el valor de hallazgos

        $tempFilePath = tempnam(sys_get_temp_dir(), 'remision_definitivo_') . '.docx';
        $templateProcessor->saveAs($tempFilePath);

        $fileName = 'Remicion del informe Definitivo ' . $remision->codigo . '.docx';

        return response()->download($tempFilePath, $fileName)->deleteFileAfterSend(true);
    }

    public function update(Request $request, $id)
    {
        $remision = RemisionDefinitivo::findOrFail($id);
        $remision->update($request->all());

        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        $remision = RemisionDefinitivo::findOrFail($id);
        $remision->delete();

        return response()->json(['success' => true]);
    }
}
