<?php

namespace App\Livewire\Handover;
use App\Models\Designation;
use App\Models\AuditActivity;
use App\Services\WorkingPaper;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\BinaryFileResponse;


final class RequeriDocumen
{
    public $designation;

    private const NAME_TEMPLATE = 'requerimientoTemplate.docx';
    private const NAME_DOCUMENT = 'requerimiento.docx';
    public WorkingPaper $document;

    public function __construct(
        private readonly AuditActivity $auditActivity, 
        public readonly ?string $nameDocument = null,
        public readonly ?Carbon $date = null,
    ){
        // Obtener el departamento y limpiar el nombre para evitar caracteres no válidos
        $departamento = preg_replace('/[\/:*?"<>|]/', '_', $this->auditActivity->handoverDocument->departament);

        // Cambiar el nombre del documento al momento de crear el WorkingPaper
        $this->document = new WorkingPaper (
            templateFile: WorkingPaper::getTemplate(self::NAME_TEMPLATE), 
            nameDocument: 'SR ' . $this->auditActivity->code . ' - ' . $departamento . '.docx', // Cambiar aquí
            date: $date ?? now()->locale('es_ES'),
        );
    }
    
    public function download(): BinaryFileResponse
    {
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
        $fecha_subcripcion = date('d/m/Y', strtotime($this->auditActivity->handoverDocument->subscription));
        $periodo_inicial = date('d/m/Y', strtotime($this->auditActivity->handoverDocument->start));
        $periodo_cease = date('d/m/Y', strtotime($this->auditActivity->handoverDocument->cease));
        
        $employeeOutgoing = $this->auditActivity->handoverDocument->employeeOutgoing;
        $cargo_saliente = $this->auditActivity->handoverDocument->EmployeeOutgoing->job_title;
        $full_name_Outgoing = "$employeeOutgoing->first_name " . (isset($employeeOutgoing->second_name) ? "$employeeOutgoing->second_name " : '') . "$employeeOutgoing->first_surname" . (isset($employeeOutgoing->second_surnam) ? " $employeeOutgoing->second_surnam " : '');
        
        $employeeIncoming = $this->auditActivity->handoverDocument->employeeIncoming;
        $full_name_Incoming = "$employeeIncoming->first_name " . (isset($employeeIncoming->second_name) ? "$employeeIncoming->second_name " : '') . "$employeeIncoming->first_surname" . (isset($employeeIncoming->second_surnam) ? " $employeeIncoming->second_surnam " : '');
        $Designacion =  $this->auditActivity->employee()->first()->pivot->designation_id;
        $fechaDesignacion = date('d/m/Y', strtotime(Designation::find($Designacion)->date_release));
        $code = $this->auditActivity->code;

        $this->document->data = [
            'code' => $this->auditActivity->code,
            'codigo_desgisnacion' => "UAI\\GCP\\DES-COM $code",
            'fecha_designacion' =>$fechaDesignacion,
            'articulo' => 'Ciudadano', 
            'nombre_saliente' => $full_name_Outgoing,
            'cedula_saliente' => preg_replace('/(\d{1,3})(\d{3})(\d{3})/', '$1.$2.$3', $this->auditActivity->handoverDocument->EmployeeOutgoing->personal_id),
            'fecha_subcripcion' => $fecha_subcripcion, 
            'fecha_requerimiento' => now()->format('d/m/Y'), 
            'fecha_cese' => $periodo_cease, 
            'unidad_entrega' => $this->auditActivity->handoverDocument->departament,
            'unidad_adcripta' => $this->auditActivity->handoverDocument->departament_affiliation,
        ];
    }
}