<?php

namespace App\Http\Livewire\Handover;


use App\Models\AuditActivity;
use App\Services\WorkingPaper;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

final class RequeriDocumen
{
    private const NAME_TEMPLATE = 'requerimientoTemplate.docx';
    private const NAME_DOCUMENT = 'requerimiento.docx';
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

        $this->document->data = [
            'code' => "$code", 
            'unidad_entrega' => 'Cas', 
            'unidad_adcripta' => 'Gerencia de Control Posteriro', 
            'articulo' => 'el', 
            'nombre_saliente' => 'pier', 
            'cedula_saliente' => '1234567', 
            'fecha_subcripcion' => '12/06/2024', 
            'fecha_requerimiento' => '14/12/2024', 
            'fecha_cese' => '25/04/2024', 
            'fecha_designacion' => '25/45/225',
        ];
    }

}
