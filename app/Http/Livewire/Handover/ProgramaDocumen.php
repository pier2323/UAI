<?php

namespace App\Http\Livewire\Handover;

use App\Livewire\SaveData;
use App\Models\AuditActivity;
use App\Services\WorkingPaper;
use App\Traits\ModelPropertyMapper;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use League\CommonMark\Node\Block\Document;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use PhpOffice\PhpWord\TemplateProcessor;




final class ProgramaDocumen
{
    
    use ModelPropertyMapper;

    private function countBusinessDays(Carbon $startDate, Carbon $endDate, array $holidays = []): int
{
    $businessDays = 0;

    // Iterar sobre cada día entre las dos fechas
    for ($date = $startDate->copy(); $date->lte($endDate); $date->addDay()) {
        // Verificar si el día es un sábado o domingo
        if ($date->isWeekend()) {
            continue;
        }

        // Verificar si el día es un día feriado
        if (in_array($date->format('Y-m-d'), $holidays)) {
            continue;
        }

        $businessDays++;
    }

    return $businessDays;
}
    private string $planning_start,$planning_end,$execution_start,$execution_end,$preliminary_start,$preliminary_end,$download_start,$download_end,$definitive_start,$definitive_end;
    private const NAME_TEMPLATE = 'programaTemplate.docx';
    private array $auditors = [];
    private const NAME_DOCUMENT = 'programa de trabajo.docx';
    public WorkingPaper $document; 
     private string $userMessage;
    private string $fechaVariable;
    private string $cadenaTexto;
    

    public function __construct(
        private readonly AuditActivity $auditActivity, 
        public readonly ?string $nameDocument = null,
        public readonly ?Carbon $date = null,
    ){
        // Fecha fija
        $fechaFija = Carbon::create(2024, 10, 10);
        // Fecha actual
        $fechaActual = Carbon::now();
    
        // Definir días feriados (ejemplo)
        $holidays = [
                // Días festivos de 2024
              '2024-01-01', // Año Nuevo
              '2024-02-12', // Carnaval
              '2024-02-13', // Carnaval
              '2024-03-28', // jueves santo
              '2024-03-29', // viernes Santo
              '2024-04-19', // Declaracion Indevendencia
              '2024-05-01', // Día del Trabajador
              '2024-06-24', // Día de la Batalla de Carabobo
              '2024-07-05', // Día de la Independencia
              '2024-07-24', // Natalicio de Simón Bolivar
              '2024-07-28', // telecominicador
              '2024-12-24', // Navidad
               '2024-12-25', // Navidad
              '2024-12-31', //Fin de Año
               // Días festivos de 2025
              '2025-01-01', // Año Nuevo
              '2025-03-3', //  Lunes Carnaval
              '2025-03-4', // Martes Carnaval
              '2025-04-17', // jueves santo
              '2025-04-18', // viernes Santo
              '2025-04-19', // Declaracion Indevendencia
              '2025-05-01', // Día del Trabajador
              '2025-06-24', // Día de la Batalla de Carabobo
              '2025-07-05', // Día de la Independencia
              '2025-07-24', // Natalicio de Simón Bolivar
              '2025-07-28', // telecominicador
              '2025-12-24', // Navidad
              '2025-12-25', // Navidad
              '2025-12-31', //Fin de Año
  
          ];
    
        // Ajustar la fecha de inicio para que comience desde el día siguiente
        $startCountingDate = $fechaFija->copy()->addDay();
    
        // Contar días hábiles entre la fecha actual y la fecha fija
        $diferenciaEnDias = $this->countBusinessDays($fechaActual, $startCountingDate, $holidays);
    
        // Fecha fija
      // Suponiendo que $fechaFija es la fecha hasta la que deseas contar
 // Cambiar la fecha fija a la fecha de la suscripción
 $fechaFija = Carbon::parse($this->auditActivity->handoverDocument->subscription); // Asegúrate de que sea una fecha válidas


$fechaActual = Carbon::now(); // Fecha actual

// Ajustar la fecha de inicio para que comience desde el día siguiente
$startCountingDate = $fechaFija->copy()->addDay(); // Comenzar desde el día siguiente

// Contar días hábiles entre la fecha actual y la fecha fija
$diferenciaEnDias = $this->countBusinessDays($fechaActual, $startCountingDate, $holidays);

        $code = $this->auditActivity->code;
        $this->setMapperProperities();
        $periodo_inicial = date('d/m/Y', strtotime($this->auditActivity->handoverDocument->start));
        $periodo_cease = date('d/m/Y', strtotime($this->auditActivity->handoverDocument->cease));
        $Fecha_acreditacion = $this->auditActivity->designation[0]->date_release;
        // Extraer el año con datos estáticos 
        $employeeOutgoing = $this->auditActivity->handoverDocument->employeeOutgoing;
        $full_name_Outgoing = "$employeeOutgoing->first_name " . (isset($employeeOutgoing->second_name) ? "$employeeOutgoing->second_name " : '') . "$employeeOutgoing->first_surname" . (isset($employeeOutgoing->second_surnam) ? " $employeeOutgoing->second_surnam " : '');
        // Definición de variables comunes
        $fechaDesignacion = date_format($this->auditActivity->designation[0]->date_release, 'd/m/Y'); // Cambiar a 'd/m/Y'

        $codigoDesignacion = "UAI\\GCP\\DES-COM $code";
        $nombreSaliente = $full_name_Outgoing;
        $cedulaSaliente = preg_replace('/(\d{1,3})(\d{3})(\d{3})/', '$1.$2.$3', $this->auditActivity->handoverDocument->EmployeeOutgoing->personal_id,);
        $periodoGestion = "$periodo_inicial hasta el $periodo_cease";
        $unidad_entrega = $this->auditActivity->handoverDocument->departament;


        // Seleccionar plantilla basada en la diferencia de días y el valor de is_poa
          // Verdadero  120 dias 
        if ($this->auditActivity->is_poa) {
            if ($diferenciaEnDias > 120) {
                $templateFile =self::NAME_TEMPLATE;
                $this->userMessage = "La diferencia de días es mayor a 120 y es POA. Se descargará la plantilla POA mayor a 120 días.";
                $this->fechaVariable = "De acuerdo con los requisitos establecidos en las Normas para Regular la Entrega de los Órganos y Entidades de la Administración Pública y de sus Respectivas Oficinas o Dependencias (NREOEAPROD), se efectuó análisis al Acta de Entrega elaborada por {nombre_saliente}, titular de la cédula de identidad V-{cedula_saliente}, {cargo_saliente} (Saliente); así como, a los anexos correspondientes, determinándose las observaciones y hallazgos que se detallan a continuación: ";

                $textoBase= "En el marco de la formulación del Plan Operativo Anual 2024, aprobado por la Superintendencia Nacional de Auditoría Interna (SUNAI), mediante Oficio SUNAI-23-DS-936 de fecha 5/12/2023, de acuerdo a lo establecido en el artículo 41 de la Ley Orgánica de la Contraloría General de la República y del Sistema Nacional de Control Fiscal, publicada en la Gaceta Oficial de la República Bolivariana de Venezuela Nro. 6013 Extraordinario de fecha 23 de diciembre de 2010, y de conformidad con las instrucciones contenidas en memorando de  designación {codigo_desgisnacion} de fecha el {fechaDesignacion}, en concordancia con el artículo 23 de las Normas para Regular la Entrega de los Órganos y Entidades de la Administración Pública y de sus Respectivas Oficinas o Dependencias (NREOEAPROD), publicada en la Gaceta Oficial de la República Bolivariana de Venezuela Nro.39.229 de fecha 28/07/2009, se procedió a verificar la sinceridad y exactitud del contenido del Acta de Entrega de la {unidad_entrega}, correspondiente a la Servidora Pública Saliente ciudadana {nombre_saliente}, titular de la cédula de identidad V-{cedula_saliente}, durante el periodo de gestión {periofdo_saliente}.";

            } else {
                  // Verdadero  menos 120 dias 
                $templateFile = self::NAME_TEMPLATE;
                $this->userMessage = "La diferencia de días es menor o igual a 120 y es POA. Se descargará la plantilla POA menor a 120 días.";
                $this->fechaVariable = '';

               $textoBase= "En el marco de la formulación del Plan Operativo Anual 2024, aprobado por la Superintendencia Nacional de Auditoría Interna (SUNAI), mediante Oficio SUNAI-23-DS-936 de fecha 5/12/2023,, de acuerdo a lo establecido en el artículo 41 de la Ley Orgánica de la Contraloría General de la República y del Sistema Nacional de Control Fiscal, publicada en la Gaceta Oficial de la República Bolivariana de Venezuela Nro. 6013 Extraordinario de fecha 23 de diciembre de 2010, y de conformidad con las instrucciones contenidas en memorando de  designación {codigo_desgisnacion} de fecha el {fechaDesignacion}, en concordancia con el artículo 23 de las Normas para Regular la Entrega de los Órganos y Entidades de la Administración Pública y de sus Respectivas Oficinas o Dependencias (NREOEAPROD), publicada en la Gaceta Oficial de la República Bolivariana de Venezuela Nro.39.229 de fecha 28/07/2009, se procedió a verificar la sinceridad y exactitud del contenido del Acta de Entrega de la {unidad_entrega}, correspondiente a la Servidora Pública Saliente ciudadana {nombre_saliente}, titular de la cédula de identidad V-{cedula_saliente}, durante el periodo de gestión {periofdo_saliente}.";
            }
            
              //  false poa mayor a 120 dia 
        } else {
            if ($diferenciaEnDias > 120) {
                $templateFile = self::NAME_TEMPLATE;
                $this->userMessage = "La diferencia de días es mayor a 120. Se descargará la plantilla principal.";
                $this->fechaVariable = "De acuerdo con los requisitos establecidos en las Normas para Regular la Entrega de los Órganos y Entidades de la Administración Pública y de sus Respectivas Oficinas o Dependencias (NREOEAPROD), se efectuó análisis al Acta de Entrega elaborada por {nombre_saliente}, titular de la cédula de identidad V-{cedula_saliente}, {cargo_saliente} (Saliente); así como, a los anexos correspondientes, determinándose las observaciones y hallazgos que se detallan a continuación: ";
               $textoBase= "En el marco de lo establecido en el artículo 41 de la Ley Orgánica de la Contraloría General de la República y del Sistema Nacional de Control Fiscal, publicada en la Gaceta Oficial de la República Bolivariana de Venezuela Nro. 6013 Extraordinario de fecha 23 de diciembre de 2010, y de conformidad con las instrucciones contenidas en memorando de designación  {codigo_desgisnacion} de fecha el {fechaDesignacion}, en concordancia con el artículo 23 de las Normas para Regular la Entrega de los Órganos y Entidades de la Administración Pública y de sus Respectivas Oficinas o Dependencias (NREOEAPROD), publicada en la Gaceta Oficial de la República Bolivariana de Venezuela Nro. 39.229 de fecha 28/07/2009, se procedió a verificar la sinceridad y exactitud del contenido del Acta de Entrega de la {unidad_entrega}, correspondiente a la Servidora Pública Saliente ciudadana {nombre_saliente}, titular de la cédula de identidad V'{cedula_saliente}, durante el periodo de gestión {periofdo_saliente}.";
               
               // false  menos 120 dias 
            } else {
                $templateFile = self::NAME_TEMPLATE;
                $this->userMessage = "La diferencia de días es menor o igual a 120. Se descargará la plantilla alternativa.";
                $this->fechaVariable = '';
                $textoBase = "En el marco de lo establecido en el artículo 41 de la Ley Orgánica de la Contraloría General de la República y del Sistema Nacional de Control Fiscal, publicada en la Gaceta Oficial de la República Bolivariana de Venezuela Nro. 6013 Extraordinario de fecha 23 de diciembre de 2010, y de conformidad con las instrucciones contenidas en memorando de designación  {codigo_desgisnacion} de fecha el {fechaDesignacion}, en concordancia con el artículo 23 de las Normas para Regular la Entrega de los Órganos y Entidades de la Administración Pública y de sus Respectivas Oficinas o Dependencias (NREOEAPROD), publicada en la Gaceta Oficial de la República Bolivariana de Venezuela Nro. 39.229 de fecha 28/07/2009, se procedió a verificar la sinceridad y exactitud del contenido del Acta de Entrega de la {unidad_entrega}, correspondiente a la Servidora Pública Saliente ciudadana {nombre_saliente}, titular de la cédula de identidad V'{cedula_saliente}, durante el periodo de gestión {periofdo_saliente}.";
                
            }
            
        }
        
        
        // Reemplazo de variables
        $this->cadenaTexto = str_replace(
            ['{fechaDesignacion}', '{codigo_desgisnacion}', '{nombre_saliente}', '{cedula_saliente}', '{periofdo_saliente}' ,'{unidad_entrega}'],
            [$fechaDesignacion, $codigoDesignacion, $nombreSaliente, $cedulaSaliente, $periodoGestion, $unidad_entrega,],
            $textoBase
        );
       
        
  

          // Cambiar el nombre del documento al momento de crear el WorkingPaper
    $this->document = new WorkingPaper(
        templateFile: WorkingPaper::getTemplate($templateFile),
        nameDocument: 'PT ' . $this->auditActivity->code . ' - ' . $this->auditActivity->handoverDocument->departament . '.doc', // Cambiar aquí
        date: $this->date ?? now()->locale('es_ES'),
    );
    }
    
    public function download(): BinaryFileResponse
    {

        // todo save all auditors 
        $this->setAuditor($this->auditActivity->employee()->orderBy('role', 'desc')->get());

        

        // todo save all data 
        $this->setData();

        // todo generate pathDocument 
        $this->document->generatePathDocument();

        // todo generate document 
        $this->document->create();
        
        return $this->document->getPathDocumentToDownload();
    }
    
  
    private function setData(): void
    {
        $resultado = $this->auditActivity->preliminary_days + 10 + $this->auditActivity->definitive_days;
        $code = $this->auditActivity->code;
        $this->setMapperProperities();
        // Supongamos que estas son tus variables iniciales

        $fecha_subcripcion = date('d/m/Y', strtotime($this->auditActivity->handoverDocument->subscription));
        $periodo_inicial = date('d/m/Y', strtotime($this->auditActivity->handoverDocument->start));
        $periodo_cease = date('d/m/Y', strtotime($this->auditActivity->handoverDocument->cease));
        // Extraer el año con datos estáticos 

        $employeeOutgoing = $this->auditActivity->handoverDocument->employeeOutgoing;
        $cargo_saliente = $this->auditActivity->handoverDocument->EmployeeOutgoing->job_title;
        $full_name_Outgoing = "$employeeOutgoing->first_name " . (isset($employeeOutgoing->second_name) ? "$employeeOutgoing->second_name " : '') . "$employeeOutgoing->first_surname" . (isset($employeeOutgoing->second_surnam) ? " $employeeOutgoing->second_surnam " : '');
        $employeeIncoming = $this->auditActivity->handoverDocument->employeeIncoming;
        $full_name_Incoming = "$employeeIncoming->first_name " . (isset($employeeIncoming->second_name) ? "$employeeIncoming->second_name " : '') . "$employeeIncoming->first_surname" . (isset($employeeIncoming->second_surnam) ? " $employeeIncoming->second_surnam " : '');
   
 $anio = substr($fecha_subcripcion, 6, 4);
        $fecha_variable = $this->fechaVariable;
        $unidad_entregas = ucwords($this->auditActivity->handoverDocument->departament);
        $unidad_Adcritas = ucwords( $this->auditActivity->handoverDocument->departament_affiliation);

   
        //dd( $periodo_cease );
        $this->document->data = [

            'code' => "UAI\\GCP\\SR-$code",
            'codes'=> $code,
            'unidad_entregas'=> $unidad_entregas,
            'unidad_Adcritas'=>  $unidad_Adcritas,
            'fecha_progrma' => now()->format('d/m/Y'),
            'unidad_entrega' => strtoupper($this->auditActivity->handoverDocument->departament),
            'unidad_adcripta' => strtoupper($this->auditActivity->handoverDocument->departament_affiliation),
            'articulo' => 'ciudadana',
            'periodo_saliente' => "$periodo_inicial HASTA EL  $periodo_cease ",
            'periodo_salientes' => "$periodo_inicial hasta el   $periodo_cease ",
            'nombre_saliente' =>   $full_name_Outgoing,
            'cedula_saliente' => preg_replace('/(\d{1,3})(\d{3})(\d{3})/', '$1.$2.$3', $this->auditActivity->handoverDocument->EmployeeOutgoing->personal_id,),
            'cargo_saliente' => $this->auditActivity->handoverDocument->job_title,
            'Fecha_acreditacion' =>  date_format($this->auditActivity->designation[0]->date_release, 'd-m-Y'),
            'fecha_subcripcion' =>   $fecha_subcripcion,
            'nu_acreditacion' => "UAI\\GCP\\DES\\ACRE $code",
            'dia_planificacion' => $this->auditActivity->planning_days,
            'desde_plan' => $this->planning_start,
            'hasta_plan' =>    $this->planning_end,
            'dia_ejecucion' => $this->auditActivity->execution_days,
            'desde_ejec' => $this->execution_start,
            'hasta_ejec' => $this->execution_end,
           'resultado' =>   $resultado,
            'desde_r' => $this->preliminary_start,
            'hasta_r' => $this->definitive_end,
            'dia_preliminar' => $this->auditActivity->preliminary_days,
            'desde_p' => $this->preliminary_start,
            'hasta_p' => $this->preliminary_end,
            'desde_desc' => $this->download_start,
            'hasta_desc' => $this->download_end,
            'dia_definitivo' =>$this->auditActivity->definitive_days,
            'desde_d' => $this->definitive_start,
            'hasta_d' =>$this->definitive_end,
            'auditores_designados' =>$this->getAuditorsString(),
             'año'=>$anio,
             'fecha_variable' =>   $fecha_variable, // Usar la fecha correspondiente
             'cadena_texto_origenpoa' => $this->cadenaTexto, // Usar la cadena de texto correspondiente


            ];
        }
    private function setAuditor(Collection $auditors): void
    {
       foreach ($auditors as $auditor) {
           
            array_push($this->auditors, "$auditor->first_name $auditor->first_surname $auditor->second_surname ");
        }
    }

   private function getAuditorsString(): string
   {
        return implode(
            separator: "/ ", 
            array: $this->auditors
        );
   }


    private function setMapperProperities(): void {
        $properties = [
            'planning_start',
            'planning_end',
            'execution_start',
            'execution_end',
            'preliminary_start',
            'preliminary_end',
            'download_start',
            'download_end',
            'definitive_start',
            'definitive_end',
        ];
    
        $this->mapModelPropertiesPier(
            model: $this->auditActivity, 
            properties: $properties,
        );
    }
       
    }
    
