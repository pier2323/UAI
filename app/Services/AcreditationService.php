<?php

namespace App\Services;

use App\Models\AuditActivity;
use App\Repositories\AuditActivityRepository;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Illuminate\Database\Eloquent\Collection;

final class AcreditationService
{
    private const NAME_TEMPLATE = 'acreditationTemplate.docx';
    private const NAME_DOCUMENT = 'acreditacion.docx';
    private array $auditors = [];
    public WorkingPaper $document;

    public function __construct(
        private readonly AuditActivityRepository $repository, 
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
        // todo save the employee/auditors in "" 
        $this->setAuditor($this->repository->makeQuery()->employee()->orderBy('role', 'desc')->get());

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
        
        foreach ($auditors as $auditor)
        {
            $names = ucwords(strtolower($auditor->first_name . " " . $auditor->second_name ?? ""), " ");
            $surnames = ucwords(strtolower($auditor->first_surname . " " . $auditor->second_surname ?? ""), " ");

            array_push($this->auditors, [
                'personalId' => 'V-' . $auditor->personal_id,
                'fullname' => "$names $surnames",
            ]);
        }
    }    

    private function setData(): void
    {
        $date_release_designation = $this->repository->makeQuery()->designation()->first()->date_release;

        $date_release = // todo make date in spanish example '4 de abril de 2001' 
        $this->document->date->format('j') ." de ". // todo '$day de'   
        $this->document->date->monthName ." de ".   // todo '$month de' 
        $this->document->date->format('Y');         // todo '$year'     

        $this->document->data = [

            'code_audit_activity' => $this->repository->object['code'],
            'code_designation' => 'UAI/GCP/DES-COM ' . $this->repository->object['code'],
            'date_release_designation' => $date_release_designation->format('d/m/Y'),

            // todo checked 
            'date_release' => $date_release,
            'auditActivity_objective' => $this->repository->object['objective'],

            'auditors' => $this->fomatAuditorData('fullname'),

            'personal_id_auditors' => $this->fomatAuditorData('personalId'),
        ];
    }

    private function fomatAuditorData($key): string
    {
        $array = array_column(array: $this->auditors, column_key: $key);

        $allExceptLastOne = implode( // todo Merge an array into a string 
            separator : ', ',
            array: array_slice( // todo Split the array into two parts depending on the input and return a new array 
                array : $array, 
                offset: 0, 
                length: -1 
            )
        );

        $lastOne = array_slice(
            array: $array, 
            offset: -1
        )[0];

        // todo singular 
        if($allExceptLastOne === "") 
        return $key === 'fullname' 
        ? "el ciudadano: " . $lastOne //todo fullname 
        : "titular de la cédula de identidad: " . $lastOne; // todo personalId 

        // todo plural 
        else
        return $key === 'fullname'
        ? "los ciudadanos: " . $allExceptLastOne . ' y ' . $lastOne //todo fullname 
        : "titulares de las cédulas de identidad " . $allExceptLastOne . ' y ' . $lastOne; // todo personalId 
    }

}
