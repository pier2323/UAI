<?php
namespace App\Http\Controllers;
use App\Models\Document; // Asegúrate de importar el modelo
use App\Models\AuditActivity; // Asegúrate de importar el modelo de AuditActivity
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use PhpOffice\PhpWord\PhpWord;
use Illuminate\Support\Facades\Storage;

class tuControlador extends Controller
{
    public function descargarCeco(Request $request)
    {
        $request->validate(['auditActivityId' => 'required|string', ]);

        $public_id = $request->input('auditActivityId');
        $auditActivity = AuditActivity::where('public_id', $public_id)->first();

        if (!$auditActivity)
        {
            return response()->json(['message' => 'Actividad de auditoría no encontrada.'], 404);
        }

        // Construir la carpeta de actividad
        $activity_folder = 'Documen' . DIRECTORY_SEPARATOR . $auditActivity->code . '_' . $auditActivity
            ->handoverDocument->departament;

        // Asegúrate de que la carpeta exista
        if (!Storage::exists($activity_folder))
        {
            Storage::makeDirectory($activity_folder);
        }

        $fileName = 'tiene_ceco.docx';
        $filePath = storage_path('app' . DIRECTORY_SEPARATOR . $activity_folder . DIRECTORY_SEPARATOR . $fileName); // Cambia a storage_path
        // Cargar la plantilla
        $templatePath = storage_path('app' . DIRECTORY_SEPARATOR . 'templateDocument' . DIRECTORY_SEPARATOR . 'con CECO.docx');

        if (!file_exists($templatePath))
        {
            return response()->json(['message' => 'Plantilla no encontrada.'], 404);
        }

        $employeeOutgoing = $auditActivity
            ->handoverDocument->employeeOutgoing;
        $full_name_Outgoing = ucwords(strtolower("$employeeOutgoing->first_name " . (isset($employeeOutgoing->second_name) ? "$employeeOutgoing->second_name " : '') . "$employeeOutgoing->first_surname" . (isset($employeeOutgoing->second_surnam) ? " $employeeOutgoing->second_surnam " : '')));

        $fecha_subcripcion = date('d/m/Y', strtotime($auditActivity
            ->handoverDocument
            ->subscription));

        // Usar TemplateProcessor para manejar la plantilla
        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($templatePath);
        $templateProcessor->setValue('unidad_entrega', $auditActivity
            ->handoverDocument
            ->departament);
        $templateProcessor->setValue('unidad_adcripta', $auditActivity
            ->handoverDocument
            ->departament_affiliation);
        $templateProcessor->setValue('fecha_suscripcion', $fecha_subcripcion);
        $templateProcessor->setValue('nombre_saliente', $full_name_Outgoing);
        $templateProcessor->setValue('cedula_saliente', preg_replace('/(\d{1,3})(\d{3})(\d{3})/', '$1.$2.$3', $auditActivity
            ->handoverDocument
            ->EmployeeOutgoing->personal_id,) ,);
        $templateProcessor->setValue('cargo_saliente', $auditActivity
            ->handoverDocument
            ->EmployeeOutgoing
            ->job_title);
        $templateProcessor->setValue('fecha_suscripcion', $fecha_subcripcion);
        $templateProcessor->setValue('fecha_suscripcion', $fecha_subcripcion);
        $templateProcessor->setValue('fecha_suscripcion', $fecha_subcripcion);

        try
        {
            // Guardar el documento modificado
            $templateProcessor->saveAs($filePath);
        }
        catch(\Exception $e)
        {
            return response()->json(['message' => 'Error al guardar el documento.'], 500);
        }

        // Copiar el archivo a storage
        try
        {
            Storage::disk('public')
                ->putFileAs($activity_folder, new \Illuminate\Http\File($filePath) , $fileName);
        }
        catch(\Exception $e)
        {
            return response()->json(['message' => 'Error al copiar el documento.'], 500);
        }

        Document::create(['name' => $fileName, 'path' => 'public/' . $activity_folder . '/' . $fileName, 'audit_activity_id' => $auditActivity->id, ]);

        // Aquí puedes usar el filePath tal como está, ya que debería tener el formato correcto
        return Response::download($filePath)->deleteFileAfterSend(true);
    }
    public function descargarNoCeco(Request $request)
    {
        $request->validate(['auditActivityId' => 'required|string', ]);

        $public_id = $request->input('auditActivityId');
        $auditActivity = AuditActivity::where('public_id', $public_id)->first();

        if (!$auditActivity)
        {
            return response()->json(['message' => 'Actividad de auditoría no encontrada.'], 404);
        }

        // Construir la carpeta de actividad
        $activity_folder = 'Documen' . DIRECTORY_SEPARATOR . $auditActivity->code . '_' . $auditActivity
            ->handoverDocument->departament;

        // Asegúrate de que la carpeta exista
        if (!Storage::exists($activity_folder))
        {
            Storage::makeDirectory($activity_folder);
        }

        $fileName = 'no_tiene_ceco.docx';
        $filePath = storage_path('app' . DIRECTORY_SEPARATOR . $activity_folder . DIRECTORY_SEPARATOR . $fileName); // Cambia a storage_path
        // Cargar la plantilla
        $templatePath = storage_path('app' . DIRECTORY_SEPARATOR . 'templateDocument' . DIRECTORY_SEPARATOR . 'sin CECO.docx');

        if (!file_exists($templatePath))
        {
            return response()->json(['message' => 'Plantilla no encontrada.'], 404);
        }

        $employeeOutgoing = $auditActivity
            ->handoverDocument->employeeOutgoing;
        $full_name_Outgoing = ucwords(strtolower("$employeeOutgoing->first_name " . (isset($employeeOutgoing->second_name) ? "$employeeOutgoing->second_name " : '') . "$employeeOutgoing->first_surname" . (isset($employeeOutgoing->second_surnam) ? " $employeeOutgoing->second_surnam " : '')));

        $fecha_subcripcion = date('d/m/Y', strtotime($auditActivity
            ->handoverDocument
            ->subscription));

        // Usar TemplateProcessor para manejar la plantilla
        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($templatePath);
        $templateProcessor->setValue('unidad_entrega', $auditActivity
            ->handoverDocument
            ->departament);
        $templateProcessor->setValue('unidad_adcripta', $auditActivity
            ->handoverDocument
            ->departament_affiliation);
        $templateProcessor->setValue('fecha_suscripcion', $fecha_subcripcion);
        $templateProcessor->setValue('nombre_saliente', $full_name_Outgoing);
        $templateProcessor->setValue('cedula_saliente', preg_replace('/(\d{1,3})(\d{3})(\d{3})/', '$1.$2.$3', $auditActivity
            ->handoverDocument
            ->EmployeeOutgoing->personal_id,) ,);
        $templateProcessor->setValue('cargo_saliente', $auditActivity
            ->handoverDocument
            ->EmployeeOutgoing
            ->job_title);
        $templateProcessor->setValue('fecha_suscripcion', $fecha_subcripcion);
        $templateProcessor->setValue('fecha_suscripcion', $fecha_subcripcion);
        $templateProcessor->setValue('fecha_suscripcion', $fecha_subcripcion);

        try
        {
            // Guardar el documento modificado
            $templateProcessor->saveAs($filePath);
        }
        catch(\Exception $e)
        {
            return response()->json(['message' => 'Error al guardar el documento.'], 500);
        }

        // Copiar el archivo a storage
        try
        {
            Storage::disk('public')
                ->putFileAs($activity_folder, new \Illuminate\Http\File($filePath) , $fileName);
        }
        catch(\Exception $e)
        {
            return response()->json(['message' => 'Error al copiar el documento.'], 500);
        }

        Document::create(['name' => $fileName, 'path' => 'public/' . $activity_folder . '/' . $fileName, 'audit_activity_id' => $auditActivity->id, ]);

        // Aquí puedes usar el filePath tal como está, ya que debería tener el formato correcto
        return Response::download($filePath)->deleteFileAfterSend(true);
    }

}

