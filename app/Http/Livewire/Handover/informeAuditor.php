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
       
        $designacion = $this->auditActivity->date_release;
        $code = $this->auditActivity->code;
        $this->document->data = [
            'code' => '2024-068',
            'fecha_progrma' => now()->format('d/m/Y'),
            'unidad_entrega' => 'Gerencia General Mercado Masivos ',
            'unidad_adcripta' => 'Vicepresidencia presidencia de Prestación de Servicio',
            'articulo' => 'ciudadano',
            'periodo_saliente' => '04/10/2017 hasta el 12/08/2024',
            'nombre_saliente' => 'Iván junior Gavranovic Sorman',
            'cedula_saliente' => '17.286.980 ',
            'cargo_saliente' => 'Gerente General de Proyecto Mayores',
            'Fecha_acreditacion' => '05/09/2024',
            'fecha_subcripcion' => '15/04/2024',
            'nu_acreditacion' => "UAI\\GCP\\ACR-COM 068",
            'periodo_gestion' => '18/08/2022',
            'periodo_gestiona' => '10/04/2024',
            'codigo_desgisnacion' => "UAI\\GCP\\DES-COM 068",
            'fecha_designacion' => '05/09/2024',
            'nombre_recibe' => 'Ernesto Antonio Sandoval Martínes',
            'cedula_recibe' => '16.525.105',
            'auditores_designados' =>'Silvia Vargas O /Ana Ivone Rojas ',
        ];
    }

    private function setAuditor(Collection $auditors): void
    {
        foreach ($auditors as $auditor) {
            $jobTitle = $auditor->pivot->role;
            array_push($this->auditors, "$auditor->first_name $auditor->first_surname $auditor->second_surname / $jobTitle");
        }
    }

    private function getAuditorsString(): string
    {
        return implode(
            separator: ", ",
            array: $this->auditors
        );
    }

    private function setMapperProperities(): void
    {
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

