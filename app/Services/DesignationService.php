<?php

namespace App\Services;

use App\Models\AuditActivity;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Illuminate\Database\Eloquent\Collection;

final class DesignationService
{
    private const LETTERS = ["A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "Ñ", "O", "P", "Q", "R", "S", "T", "U", "V", "X", "Y", "Z"];
    private const NAME_TEMPLATE = 'designationTemplate.docx';
    private const NAME_DOCUMENT = 'designacion.docx';
    private array $auditors = [];
    public WorkingPaper $document;

    public function __construct(
        private readonly AuditActivity $auditActivity, 
        public readonly string|null $nameDocument = null,
        public readonly string|null $date = null,
    ){
        $this->document = new WorkingPaper (
            templateFile: WorkingPaper::getTemplate(self::NAME_TEMPLATE), 
            nameDocument: $nameDocument ?? self::NAME_DOCUMENT,
            date: $date ?? now(),
        );        
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
        $lineJump = str_repeat(' ', 500);

        $this->document->data = [
            'año' => $this->document->date->year(),
            'actuacionFiscal' => $this->auditActivity->id,
            'fechaInicio' => $this->document->date->format('j de F de Y'),
            'tituloActuacion' => $this->auditActivity->description,
            'auditores' => implode($lineJump, $this->auditors),

            'diasPlanificacion' => 5,
            'fechaPlanificacionInicio' => $this->auditActivity->planning_start,
            'fechaPlanificacionFin' => $this->auditActivity->planning_end,

            'diasEjecucion' => 10,
            'fechaEjecucionInicio' => $this->auditActivity->execution_start,
            'fechaEjecucionFin' => $this->auditActivity->execution_end,

            'diasPreeliminar' => 10,
            'fechaPreeliminarInicio' => $this->auditActivity->preliminary_start,
            'fechaPreeliminarFin' => $this->auditActivity->preliminary_end,

            'diasDescargo' => 10,
            'fechaDescargoInicio' => $this->auditActivity->download_start,
            'fechaDescargoFin' => $this->auditActivity->download_end,

            'diasDefinitivo' => 5,
            'fechaDefinitivoInicio' => $this->auditActivity->definitive_start,
            'fechaDefinitivoFin' => $this->auditActivity->definitive_end,
        ];
    }
}