<?php

namespace App\Http\Livewire\Handover;

use App\Models\AuditActivity;
use App\Models\Designation;
use App\Services\WorkingPaper;
use App\Traits\ModelPropertyMapper;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

final class informeAuditor
{
    use ModelPropertyMapper;

    private string $planning_start, $planning_end, $execution_start, $execution_end, $preliminary_start, $preliminary_end, $download_start, $download_end, $definitive_start, $definitive_end;
    private const NAME_TEMPLATE = 'informeAuditorTemplate.docx';
    private const NAME_TEMPLATE_ALTERNATIVE = 'informeAuditorTemplateAlternativa.docx'; // Plantilla alternativa
    private array $auditors = [];
    private const NAME_DOCUMENT = 'informe del auditor.docx';
    public WorkingPaper $document;
    private string $userMessage;

    public function __construct(
        private readonly AuditActivity $auditActivity,
        public readonly ?string $nameDocument = null,
        public readonly ?Carbon $date = null,
    ) {
        // Fecha fija
        $fechaFija = Carbon::create(2025, 10 , 30);
        // Fecha actual
        $fechaActual = Carbon::now();
        // Diferencia en días
        $diferenciaEnDias = $fechaActual->diffInDays($fechaFija);

        // Seleccionar plantilla basada en la diferencia de días
        if ($diferenciaEnDias > 120) {
            $templateFile = self::NAME_TEMPLATE;
            $this->userMessage = "La diferencia de días es mayor a 120. Se descargará la plantilla principal.";
        } else {
            $templateFile = self::NAME_TEMPLATE_ALTERNATIVE;
            $this->userMessage = "La diferencia de días es menor o igual a 120. Se descargará la plantilla alternativa.";
        }

        $this->document = new WorkingPaper(
            templateFile: WorkingPaper::getTemplate($templateFile),
            nameDocument: $nameDocument ?? self::NAME_DOCUMENT,
            date: $date ?? now()->locale('es_ES'),
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

        // Mostrar el mensaje al usuario
        session()->flash('message', $this->userMessage);

        return $this->document->getPathDocumentToDownload();
    }

    private function setData(): void
    {
        $resultado = $this->auditActivity->preliminary_days+ 10 +$this->auditActivity->definitive_days;
        $code = $this->auditActivity->handoverDocument->audit_activity_id;
        $this->setMapperProperities();
   // Supongamos que estas son tus variables iniciales
    $fecha_subcripcion = date('d-m-Y', strtotime($this->auditActivity->handoverDocument->subscription));
      $periodo_inicial =date('d-m-Y', strtotime($this->auditActivity->handoverDocument->start));
      $periodo_cease = date('d-m-Y', strtotime($this->auditActivity->handoverDocument->cease));
   // Extraer el año con datos estaticos 
   $employeeOutgoing = $this->auditActivity->handoverDocument->employeeOutgoing;
   $full_name_Outgoing = "$employeeOutgoing->first_name " .(isset($employeeOutgoing->second_name) ? "$employeeOutgoing->second_name " : '')."$employeeOutgoing->first_surname" .(isset($employeeOutgoing->second_surnam) ? " $employeeOutgoing->second_surnam " : '');
   $employeeIncoming = $this->auditActivity->handoverDocument->employeeIncoming;
   $full_name_Incoming = "$employeeIncoming->first_name " .(isset($employeeIncoming->second_name) ? "$employeeIncoming->second_name " : '')."$employeeIncoming->first_surname" .(isset($employeeIncoming->second_surnam) ? " $employeeIncoming->second_surnam " : '');
  
        $this->document->data = [
            'code' => $this->auditActivity->code,
            'fecha_progrma' =>  now()->format('d') . ' de ' . now()->translatedFormat('F') . ' de ' . now()->format('Y'),
            'unidad_entrega' => $this->auditActivity->handoverDocument->departament,
            'unidad_adcripta' =>  $this->auditActivity->handoverDocument->departament_affiliation,
            'articulo' => 'ciudadana',
            'periodo_saliente' => "$periodo_inicial hasta el $periodo_cease ",
            'nombre_saliente' =>   $full_name_Outgoing,
            'cedula_saliente' => $this->auditActivity->handoverDocument->EmployeeOutgoing->personal_id,
            'cargo_saliente' => $this->auditActivity->handoverDocument->job_title,
            'Fecha_acreditacion' =>  $this->auditActivity->designation[0]->date_release,
            'fecha_subcripcion' =>  $fecha_subcripcion,
            'nu_acreditacion' =>  "UAI\\GCP\\DES\\ACRE-COM $code",
            'codigo_desgisnacion' => "UAI\\GCP\\DES-COM $code",
           'fecha_designacion' => date_format($this->auditActivity->designation[0]->date_release, 'd-m-Y'),
            // 'nombre_recibe' => $full_name_Incoming,
            // 'cedula_recibe' => $this->auditActivity->handoverDocument->employeeIncoming->job_title,
            'auditores_designados' => $this->getAuditorsString(),
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
    
