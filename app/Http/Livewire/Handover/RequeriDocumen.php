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
            'code' =>'' , 
            'unidad_entrega' => 'Gerencia General Seguridad Integral', 
            'unidad_adcripta' => 'Presidencia', 
            'articulo' => 'Ciudadano', 
            'nombre_saliente' => 'Rubén Dario Sanabria Conteras', 
            'cedula_saliente' => 'V-7.412.380', 
            'fecha_subcripcion' => '11/03/2024', 
            'fecha_requerimiento' => now()->format('d/m/Y'), 
            'fecha_cese' => '01/08/2024', 
        ];
    }
}
