<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpWord\TemplateProcessor;
use App\Models\AuditActivity;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Carbon\Carbon;
use App\Models\Designation;

class DownloadSinHallazgoController extends Controller
{
    public $Designation;
    private string $userMessage;
    private string $fechaVariable;
    private string $cadenaTexto;
    public $auditActivity;

    public function download(Request $request)
    {
        // Asegúrate de que el public_id esté presente en el request
        $auditActivityId = $request->input('auditActivityId');

        // Buscar la actividad de auditoría por public_id
        $this->auditActivity = AuditActivity::where('public_id', $auditActivityId)->first();

        // Verificar si se encontró la actividad de auditoría
        if (!$this->auditActivity) {
            return response()->json(['error' => 'Actividad de auditoría no encontrada.'], 404);
        }

        // Cargar la plantilla
        $templatePath = public_path('IA_sin_ohTemplate.docx'); // Cambiado aquí
        $templateProcessor = new TemplateProcessor($templatePath);

        // Obtener la fecha de suscripción
        $subscriptionDate = Carbon::parse($this->auditActivity->handoverDocument->subscription);
        $fecha_subcripcion = date('d/m/Y', strtotime($this->auditActivity->handoverDocument->subscription));
        $periodo_inicial = date('d/m/Y', strtotime($this->auditActivity->handoverDocument->start));
        $periodo_cease = date('d/m/Y', strtotime($this->auditActivity->handoverDocument->cease));
        $cargo_saliente = $this->auditActivity->handoverDocument->EmployeeOutgoing->job_title;
        $Designacion =  $this->auditActivity->employee()->first()->pivot->designation_id;
        $fechaDesignacion = date('d/m/Y', strtotime(Designation::find($Designacion)->date_release));

        // Obtener nombres completos
        $employeeOutgoing = $this->auditActivity->handoverDocument->employeeOutgoing;
        $full_name_Outgoing = ucwords(strtolower("$employeeOutgoing->first_name " . 
            (isset($employeeOutgoing->second_name) ? "$employeeOutgoing->second_name " : '') . 
            "$employeeOutgoing->first_surname" . 
            (isset($employeeOutgoing->second_surnam) ? " $employeeOutgoing->second_surnam " : '')));

        $employeeIncoming = $this->auditActivity->handoverDocument->employeeIncoming;
        $full_name_Incoming = ucwords(strtolower("$employeeIncoming->first_name " . 
            (isset($employeeIncoming->second_name) ? "$employeeIncoming->second_name " : '') . 
            "$employeeIncoming->first_surname" . 
            (isset($employeeIncoming->second_surnam) ? " $employeeIncoming->second_surnam " : '')));

        // Reemplazar los marcadores de posición con los datos de la actividad de auditoría
        $templateProcessor->setValue('code', $this->auditActivity->code);
        $templateProcessor->setValue('fecha_programa', now()->format('d') . ' de ' . now()->translatedFormat('F') . ' de ' . now()->format('Y'));
        $templateProcessor->setValue('unidad_entrega', $this->auditActivity->handoverDocument->departament);
        $templateProcessor->setValue('unidad_adcripta', $this->auditActivity->handoverDocument->departament_affiliation);
        $templateProcessor->setValue('articulo', 'ciudadana');
        $templateProcessor->setValue('periodo_saliente', "$periodo_inicial al $periodo_cease");
        $templateProcessor->setValue('nombre_saliente', $full_name_Outgoing);
        $templateProcessor->setValue('cedula_saliente', preg_replace('/(\d{1,3})(\d{3})(\d{3})/', '$1.$2.$3', $this->auditActivity->handoverDocument->EmployeeOutgoing->personal_id));
        $templateProcessor->setValue('cargo_saliente', $cargo_saliente);
        $templateProcessor->setValue('fecha_subcripcion', $fecha_subcripcion);
        $templateProcessor->setValue('nu_acreditacion', "UAI\\GCP\\DES\\ACRE-COM {$this->auditActivity->code}");
        $templateProcessor->setValue('codigo_desgisnacion', "UAI\\GCP\\DES-COM {$this->auditActivity->code}");
        $templateProcessor->setValue('fecha_designacion',$fechaDesignacion);
          // Continuación del reemplazo de variables en la plantilla
     
  
          // Calcular la diferencia en días desde la fecha de suscripción hasta hoy
          $daysSinceSubscription = $subscriptionDate->diffInDays(now());
          $templateProcessor->setValue('dias_desde_suscripcion', $daysSinceSubscription);
  
          // Calcular la fecha 120 días hábiles a partir de la fecha de suscripción
          $finalDate = $this->calculateBusinessDays($subscriptionDate, 120);
          $templateProcessor->setValue('fecha_final', $finalDate->format('d') . ' de ' . $finalDate->translatedFormat('F') . ' de ' . $finalDate->format('Y'));
  
          // Inicializar variables para el mensaje y el texto base
          $this->userMessage = "";
          $this->fechaVariable = "";
          $textoBase = "";
  
          // Seleccionar plantilla basada en la diferencia de días y el valor de is_poa
          if ($this->auditActivity->is_poa) {
              if ($daysSinceSubscription > 120) {
                  $this->userMessage = "La diferencia de días es mayor a 120 y es POA. Se descargará la plantilla POA mayor a 120 días.";
                  $this->fechaVariable = "De acuerdo con los requisitos establecidos en las Normas para Regular la Entrega de los Órganos y Entidades de la Administración Pública y de sus Respectivas Oficinas o Dependencias (NREOEAPROD), se efectuó análisis al Acta de Entrega elaborada por {nombre_saliente}, titular de la cédula de identidad V-{cedula_saliente}, {cargo_saliente} (Saliente); así como, a los anexos correspondientes, determinándose las observaciones y hallazgos que se detallan a continuación: ";
                  $textoBase = "En el marco de la formulación del Plan Operativo Anual 2024, aprobado por la Superintendencia Nacional de Auditoría Interna (SUNAI), mediante Oficio SUNAI-23-DS-936 de fecha 5/12/2023, de acuerdo a lo establecido en el artículo 41 de la Ley Orgánica de la Contraloría General de la República y del Sistema Nacional de Control Fiscal, publicada en la Gaceta Oficial de la República Bolivariana de Venezuela Nro. 6013 Extraordinario de fecha 23 de diciembre de 2010, y de conformidad con las instrucciones contenidas en memorando de designación {codigo_desgisnacion} de fecha el {fecha_designacion}, en concordancia con el artículo 23 de las Normas para Regular la Entrega de los Órganos y Entidades de la Administración Pública y de sus Respectivas Oficinas o Dependencias (NREOEAPROD), publicada en la Gaceta Oficial de la República Bolivariana de Venezuela Nro. 39.229 de fecha 28/07/2009, se procedió a verificar la sinceridad y exactitud del contenido del Acta de Entrega de la {unidad_entrega}, correspondiente a la Servidora Pública Saliente ciudadana {nombre_saliente}, titular de la cédula de identidad V-{cedula_saliente}, durante el periodo de gestión {periodo_saliente}.";
              } else {
                $this->userMessage = "La diferencia de días es menor o igual a 120 y es POA. Se descargará la plantilla POA menor a 120 días.";
                $this->fechaVariable = 'hola';
                $textoBase = "En el marco de la formulación del Plan Operativo Anual 2024, aprobado por la Superintendencia Nacional de Auditoría Interna (SUNAI), mediante Oficio SUNAI-23-DS-936 de fecha 5/12/2023, de acuerdo a lo establecido en el artículo 41 de la Ley Orgánica de la Contraloría General de la República y del Sistema Nacional de Control Fiscal, publicada en la Gaceta Oficial de la República Bolivariana de Venezuela Nro. 6013 Extraordinario de fecha 23 de diciembre de 2010, y de conformidad con las instrucciones contenidas en memorando de designación {codigo_desgisnacion} de fecha el {fecha_designacion}, en concordancia con el artículo 23 de las Normas para Regular la Entrega de los Órganos y Entidades de la Administración Pública y de sus Respectivas Oficinas o Dependencias (NREOEAPROD), publicada en la Gaceta Oficial de la República Bolivariana de Venezuela Nro. 39.229 de fecha 28/07/2009, se procedió a verificar la sinceridad y exactitud del contenido del Acta de Entrega de la {unidad_entrega}, correspondiente a la Servidora Pública Saliente ciudadana {nombre_saliente}, titular de la cédula de identidad V-{cedula_saliente}, durante el periodo de gestión {periodo_saliente}.";
            }
        } else {
            if ($daysSinceSubscription > 120) {
                $this->userMessage = "La diferencia de días es mayor a 120. Se descargará la plantilla principal.";
                $this->fechaVariable = "De acuerdo con los requisitos establecidos en las Normas para Regular la Entrega de los Órganos y Entidades de la Administración Pública y de sus Respectivas Oficinas o Dependencias (NREOEAPROD), se efectuó análisis al Acta de Entrega elaborada por {nombre_saliente}, titular de la cédula de identidad V-{cedula_saliente}, {cargo_saliente} (Saliente); así como, a los anexos correspondientes, determinándose las observaciones y hallazgos que se detallan a continuación: ";
                $textoBase = "En el marco de lo establecido en el artículo 41 de la Ley Orgánica de la Contraloría General de la República y del Sistema Nacional de Control Fiscal, publicada en la Gaceta Oficial de la República Bolivariana de Venezuela Nro. 6013 Extraordinario de fecha 23 de diciembre de 2010, y de conformidad con las instrucciones contenidas en memorando de designación {codigo_desgisnacion} de fecha el {fecha_designacion}, en concordancia con el artículo 23 de las Normas para Regular la Entrega de los Órganos y Entidades de la Administración Pública y de sus Respectivas Oficinas o Dependencias (NREOEAPROD), publicada en la Gaceta Oficial de la República Bolivariana de Venezuela Nro. 39.229 de fecha 28/07/2009, se procedió a verificar la sinceridad y exactitud del contenido del Acta de Entrega de la {unidad_entrega}, correspondiente a la Servidora Pública Saliente ciudadana {nombre_saliente}, titular de la cédula de identidad V-{cedula_saliente}, durante el periodo de gestión {periodo_saliente}.";
         
            } else {
                $this->userMessage = "La diferencia de días es menor o igual a 120. Se descargará la plantilla alternativa.";
                $this->fechaVariable = 'como';
                $textoBase = "En el marco de lo establecido en el artículo 41 de la Ley Orgánica de la Contraloría General de la República y del Sistema Nacional de Control Fiscal, publicada en la Gaceta Oficial de la República Bolivariana de Venezuela Nro. 6013 Extraordinario de fecha 23 de diciembre de 2010, y de conformidad con las instrucciones contenidas en memorando de designación {codigo_desgisnacion} de fecha el {fecha_designacion}, en concordancia con el artículo 23 de las Normas para Regular la Entrega de los Órganos y Entidades de la Administración Pública y de sus Respectivas Oficinas o Dependencias (NREOEAPROD), publicada en la Gaceta Oficial de la República Bolivariana de Venezuela Nro. 39.229 de fecha 28/07/2009, se procedió a verificar la sinceridad y exactitud del contenido del Acta de Entrega de la {unidad_entrega}, correspondiente a la Servidora Pública Saliente ciudadana {nombre_saliente}, titular de la cédula de identidad V-{cedula_saliente}, durante el periodo de gestión {periodo_saliente}.";
            }
        }

        // Reemplazo de variables en el texto base
        $this->cadenaTexto = str_replace(
            ['{fecha_designacion}', '{codigo_desgisnacion}', '{nombre_saliente}', '{cedula_saliente}', '{periodo_saliente}', '{unidad_entrega}'],
            [$this->auditActivity->handoverDocument->date, $this->auditActivity->code, $this->auditActivity->handoverDocument->outgoing_person_name, $this->auditActivity->handoverDocument->outgoing_person_id, $this->auditActivity->handoverDocument->management_period, $this->auditActivity->handoverDocument->departament],
            $textoBase
        );

        // Obtener los nombres de los auditores
$auditor_A = $this->auditActivity->employee[0]->first_name . ' ' . $this->auditActivity->employee[0]->first_surname;
$auditor_B = $this->auditActivity->employee[1]->first_name . ' ' . $this->auditActivity->employee[1]->first_surname;

       
        $templateProcessor->setValue('fecha_progrma' , now()->format('d') . ' de ' . now()->translatedFormat('F') . ' de ' . now()->format('Y'));
        $templateProcessor->setValue('nombre_recibe', $full_name_Incoming);
        $templateProcessor->setValue('cedula_recibe', preg_replace('/(\d{1,3})(\d{3})(\d{3})/', '$1.$2.$3', $this->auditActivity->handoverDocument->employeeIncoming->personal_id));
        $templateProcessor->setValue('auditores_designados', $this->getAuditorsString());
        $templateProcessor->setValue('code', $this->auditActivity->code);
        $templateProcessor->setValue('auditor_A', $auditor_A);
        $templateProcessor->setValue('auditor_B', $auditor_B);


        $templateProcessor->setValue('unidad_entrega', $this->auditActivity->handoverDocument->departament);
        $templateProcessor->setValue('unidad_adcripta', $this->auditActivity->handoverDocument->departament_affiliation);
        $templateProcessor->setValue('articulo', 'ciudadana');
        $templateProcessor->setValue('periodo_saliente', "$periodo_inicial al $periodo_cease");
        $templateProcessor->setValue('nombre_saliente', $full_name_Outgoing);
        $templateProcessor->setValue('cedula_saliente', preg_replace('/(\d{1,3})(\d{3})(\d{3})/', '$1.$2.$3', $this->auditActivity->handoverDocument->EmployeeOutgoing->personal_id));
        $templateProcessor->setValue('cargo_saliente', $cargo_saliente);
        $templateProcessor->setValue('fecha_subcripcion', $fecha_subcripcion);
        $templateProcessor->setValue('nu_acreditacion', "UAI\\GCP\\DES\\ACRE-COM {$this->auditActivity->code}");
        $templateProcessor->setValue('codigo_desgisnacion', "UAI\\GCP\\DES-COM {$this->auditActivity->code}");
        $templateProcessor->setValue('fecha_designacion',$fechaDesignacion);
        $templateProcessor->setValue( 'cadena_texto_origenpoa', $this->cadenaTexto); // Usar la cadena de texto correspondiente
        $templateProcessor->setValue( 'fecha_variable', $this->fechaVariable); // Usar la cadena de texto correspondiente

        // Guardar el archivo modificado
        $fileName = 'IA_Sin_OH_' . $this->auditActivity->code . ' - ' . $this->auditActivity->handoverDocument->departament. '.docx';
        $filePath = storage_path('app/public/' . $fileName);
        $templateProcessor->setValue('texto_base', $this->cadenaTexto); // Reemplazar el texto base en la plantilla
        $templateProcessor->saveAs($filePath);

        // Devolver el archivo como respuesta
        return response()->download($filePath)->deleteFileAfterSend(true);
    }

    private function calculateBusinessDays($startDate, $days)
    {
        $holidays = [
            // Días festivos de 2024
            '2024-01-01', // Año Nuevo
            '2024-02-12', // Carnaval
            '2024-02-13', // Carnaval
            '2024-03-28', // Jueves Santo
            '2024-03-29', // Viernes Santo
            '2024-04-19', // Declaración de Independencia
            '2024-05-01', // Día del Trabajador
            '2024-06-24', // Día de la Batalla de Carabobo
            '2024-07-05', // Día de la Independencia
            '2024-07-24', // Natalicio de Simón Bolívar
            '2024-07-28', // Telecomunicador
            '2024-12-24', // Navidad
            '2024-12-25', // Navidad
            '2024-12-31', // Fin de Año
            // Días festivos de 2025
            '2025-01-01', // Año Nuevo
            '2025-03-03', // Lunes Carnaval
            '2025-03-04', // Martes Carnaval
            '2025-04-17', // Jueves Santo
            '2025-04-18', // Viernes Santo
            '2025-04-19', // Declaración de Independencia
            '2025-05-01', // Día del Trabajador
            '2025-06-24', // Día de la Batalla de Carabobo
            '2025-07-05', // Día de la Independencia
            '2025-07-24', // Natalicio de Simón Bolívar
            '2025-07-28', // Telecomunicador
            '2025-12-24', // Navidad
            '2025-12-25', // Navidad
            '2025-12-31', // Fin de Año
        ];

        $currentDate = $startDate->copy();
        $addedDays = 0;

        while ($addedDays < $days) {
            $currentDate->addDay();

            // Verificar si el día actual es un fin de semana o un día festivo
            if ($currentDate->isWeekend() || in_array($currentDate->format('Y-m-d'), $holidays)) {
                continue; // No contar este día
            }

            $addedDays++;
        }

        return $currentDate; // Retornar la fecha final después de agregar los días hábiles
    }

    private function getAuditorsString()
    {
        // Obtener los auditores designados como una cadena
        return ;
    }
}