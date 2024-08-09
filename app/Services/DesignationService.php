<?php

namespace App\Services;

use App\Models\AuditActivity;
use Illuminate\Support\Facades\Response;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use App\Models\PersonalUai;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use PhpOffice\PhpWord\TemplateProcessor;
// use Illuminate\Support\Facades\Date;
// use PhpOffice\PhpWord\PhpWord;
// use Illuminate\Support\Facades\Storage;

class DesignationService
{
    public $letters = ["A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "Ñ", "O", "P", "Q", "R", "S", "T", "U", "V", "X", "Y", "Z"];
    public $month = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
    public $auditors = [];
    public $templateFile = 'designationTemplate.docx';
    public $nameDocument = 'designacion.docx';
    public $pathDocument;
    public $data = [];
    public $formatDate = 'd/m/Y';

    public function generate(AuditActivity $audit): BinaryFileResponse
    {
        // todo temporary file path 
        $this->pathDocument = tempnam(sys_get_temp_dir(), prefix: 'PHPWord');

        // todo save the employee/auditors in "" 
        $this->getAuditor($audit->employee()->with('jobTitle')->get());

        $lineJump = str_repeat(' ', 500);

        // todo get $day $month $year 
        $dateNow = Carbon::now();
        $actionStart = explode("/", $dateNow->format($this->formatDate));

        $day = $actionStart[0];
        $month = $this->month[$dateNow->month];
        $year = $actionStart[2];


        $dateStart = "$day de $month del $year";

        // todo save all data 
        $this->getData($audit, $dateStart, $year, $lineJump);

        // todo generate document 
        $this->create();

        return Response::download($this->pathDocument, $this->nameDocument);
    }


    public function getAuditor(Collection $auditors): void
    {
        $i = 0;
        foreach ($auditors as $auditor) {
            $letter = $this->letters[$i];
            $jobTitle = $auditor->jobTitle->name;
            array_push($this->auditors, "$auditor->first_name $auditor->first_surname $auditor->second_surname / $jobTitle ($letter)");
            $i++;
        }
    }
    

    public function getData($audit, $dateStart, $year, $lineJump): void
    {
        $this->data = [
            'año' => $year,
            'actuacionFiscal' => $audit->id,
            'fechaInicio' => $dateStart,
            'tituloActuacion' => $audit->description,
            'auditores' => implode($lineJump, $this->auditors),

            'diasPlanificacion' => 5,
            'fechaPlanificacionInicio' => $audit->planning_start,
            'fechaPlanificacionFin' => $audit->planning_end,

            'diasEjecucion' => 10,
            'fechaEjecucionInicio' => $audit->execution_start,
            'fechaEjecucionFin' => $audit->execution_end,

            'diasPreeliminar' => 10,
            'fechaPreeliminarInicio' => $audit->preliminary_start,
            'fechaPreeliminarFin' => $audit->preliminary_end,

            'diasDescargo' => 10,
            'fechaDescargoInicio' => $audit->download_start,
            'fechaDescargoFin' => $audit->download_end,

            'diasDefinitivo' => 5,
            'fechaDefinitivoInicio' => $audit->definitive_start,
            'fechaDefinitivoFin' => $audit->definitive_end,
        ];
    }

    /**
     * Summary of create
     * @param array $data
     * @return void
     */
    public function create(): void
    {
        $template = new TemplateProcessor($this->templateFile);
        $template->setValues($this->data);
        $template->saveAs($this->pathDocument);
    }
}
