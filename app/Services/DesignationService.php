<?php

namespace App\Services;

use App\Models\AuditActivity;
use App\Traits\ModelPropertyMapper;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Illuminate\Database\Eloquent\Collection;

final class DesignationService
{
    use ModelPropertyMapper;

    private const LETTERS = ["A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "Ñ", "O", "P", "Q", "R", "S", "T", "U", "V", "X", "Y", "Z"];
    private const NAME_TEMPLATE = 'designationTemplate.docx';
    private const NAME_DOCUMENT = 'designacion.docx';
    private array $auditors = [];
    public WorkingPaper $document;

    public function __construct(
        private readonly AuditActivity $auditActivity, 
        public readonly ?string $nameDocument = null,
        public readonly ?Carbon $date = null,
    ){
        $this->document = new WorkingPaper (
            templateFile: WorkingPaper::getTemplate(self::NAME_TEMPLATE), 
            nameDocument: $nameDocument ?? self::NAME_DOCUMENT,
            date: $date ?? now(),
        ); 
        
        $this->mapModelProperties($this->auditActivity, ($this->getPropertiesDates()));
    }
    
    public function download(): BinaryFileResponse
    {
        // todo save the employee/auditors in "" 
        $this->setAuditor($this->auditActivity->employee()->orderBy('role', 'desc')->get());

        // todo save all data 
        $this->setData();

        // todo generate pathDocument 
        $this->document->generatePathDocument();

        // todo generate document 
        $this->document->create();

        $pathDocumentToDownload = $this->document->getPathDocumentToDownload();

        return $pathDocumentToDownload;
    }


    private function setAuditor(Collection $auditors): void
    {
        $i = 0;
        foreach ($auditors as $auditor) {
            $letter = self::LETTERS[$i];
            $jobTitle = $auditor->pivot->role;
            array_push($this->auditors, "$auditor->first_name $auditor->first_surname $auditor->second_surname / $jobTitle ($letter)");
            $i++;
        }
    }
    

    private function setData(): void
    {
        $date_release = // todo make date in spanish example '4 de abril de 2001' 
        $this->document->date->format('j') ." de ". // todo '$day de'   
        $this->document->date->monthName ." de ".   // todo '$month de' 
        $this->document->date->format('Y');   

        $lineJump = str_repeat(' ', 500);

        $this->document->data = [
            'auditActivityCode' => $this->auditActivity->code,
            'actuacionFiscal' => $this->auditActivity->id,
            'fechaInicio' => $date_release,
            'objectiveAuditActivity' => $this->auditActivity->objective,
            'auditores' => implode($lineJump, $this->auditors),
        ];

        foreach ($this->getPropertiesDates() as $property => $nameInDocument)
        $this->document->data[$nameInDocument] = $this->{$property};
    }

    private function getPropertiesDates(): array
    {
        return [
            'planning_days' => 'diasPlanificacion',
            'planning_start' => 'fechaPlanificacionInicio',
            'planning_end' => 'fechaPlanificacionFin',
            'execution_days' => 'diasEjecucion',
            'execution_start' => 'fechaEjecucionInicio',
            'execution_end' => 'fechaEjecucionFin',
            'preliminary_days' => 'diasPreeliminar',
            'preliminary_start' => 'fechaPreeliminarInicio',
            'preliminary_end' => 'fechaPreeliminarFin',
            'download_days' => 'diasDescargo',
            'download_start' => 'fechaDescargoInicio',
            'download_end' => 'fechaDescargoFin',
            'definitive_days' => 'diasDefinitivo',
            'definitive_start' => 'fechaDefinitivoInicio',
            'definitive_end' => 'fechaDefinitivoFin',
        ];
    }
}