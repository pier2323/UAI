<?php

namespace App\Http\Livewire\Handover;


use App\Models\AuditActivity;
use App\Services\WorkingPaper;
use App\Traits\ModelPropertyMapper;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

final class ProgramaDocumen
{
    use ModelPropertyMapper;

    private string $planning_start,$planning_end,$execution_start,$execution_end,$preliminary_start,$preliminary_end,$download_start,$download_end,$definitive_start,$definitive_end;
    private const NAME_TEMPLATE = 'programaTemplate.docx';
    private array $auditors = [];
    private const NAME_DOCUMENT = 'programa de trabajo.docx';
    public WorkingPaper $document;

    public function __construct(
        private readonly AuditActivity $auditActivity, 
        public readonly ?string $nameDocument = null,
        public readonly ?Carbon $date = null,
    ){
        $this->document = new WorkingPaper (
            templateFile: WorkingPaper::getTemplate(self::NAME_TEMPLATE), 
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

        return $this->document->getPathDocumentToDownload();
    }


    private function setData(): void
    {
        $code = $this->auditActivity->code;

        $this->setMapperProperities();

        $this->document->data = [
            'code' => $this->auditActivity->code,
            'fecha_progrma' => now()->format('d/m/Y'),
            'unidad_entrega' => 'Cas',
            'unidad_adcripta' => 'Gerencia de Control Posteriro',
            'articulo' => 'ciudadano',
            'periodo_saliente' => '14/10/2024',
            'nombre_saliente' => 'pier',
            'cedula_saliente' => '1234567',
            'cargo_saliente' => '1234567',
            'Fecha_acreditacion' => '12/06/2024',
            'fecha_subcripcion' => '12/06/2024',
            'nu_acreditacion' => "UAI\\GCP\\DES $code",
            'desde_plan' => $this->planning_start,
            'hasta_plan' => $this->planning_end,
            'dia_ejecucion' => $this->auditActivity->execution_days,
            'desde_ejec' => $this->execution_start,
            'hasta_ejec' => $this->execution_end,
            'resultado' => $this->definitive_end,
            'desde_r' => $this->preliminary_start,
            'hasta_r' => $this->definitive_end,
            'dia_preliminar' => $this->auditActivity->preliminary_days,
            'desde_p' => $this->preliminary_start,
            'hasta_p' => $this->preliminary_end,
            'desde_desc' => $this->download_start,
            'hasta_desc' => $this->download_end,
            'dias_definitivo' => $this->auditActivity->definitive_days,
            'desde_d' => $this->definitive_start,
            'hasta_d' => $this->definitive_end,
            'auditores_designados' =>$this->getAuditorsString(),
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
    
