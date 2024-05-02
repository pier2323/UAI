<?php

namespace App\Services;

// use PhpOffice\PhpWord\PhpWord;

use App\Models\ActuacionFiscal;
use App\Models\PersonalUai;
use Illuminate\Support\Facades\Response;
use PhpOffice\PhpWord\TemplateProcessor;
use PhpOffice\PhpWord\PhpWord;
use Illuminate\Support\Facades\Storage;

class DesignationService
{
    private $letters = ["A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "Ñ", "O", "P", "Q", "R", "S", "T", "U", "V", "X", "Y", "Z"];
    private $auditors = array();
    private $templateFile = 'designationTemplate.docx';
    private $nameDocument = 'designacion.docx';
    private $pathDocument;
    private $formatDate = 'y-m-d';
    private $formatoFechaDeseado = 'd/m/Y';
    

    public function generate($request)
    {
        //* RUTA TEMPORAL DEL DOCUMENTO 
        $this->pathDocument = tempnam(sys_get_temp_dir(), prefix: 'PHPWord');

        /**
         * todo Obtener los auditores y el coordinador de la designacion y ordernar el string 
         */
        $this->getAuditor($request);

        //* ACTUACION FISCAL 
        $actuacion = ActuacionFiscal::first();
        $saltoEnLinea = str_repeat(' ', 500);

        // * FECHA INICIO 
        $dia = '04';
        $mes = 'mayo';
        $año = '2024';
        $fechaInicio = "$dia de $mes del $año";

        //* DIAS DE FASE DE PLANIFICACION 
        $diasPlanificacion = 5;
        $fechaPlanificacionInicio = date($this->formatDate);
        $fechaPlanificacionFin = date($this->formatDate, strtotime("+$diasPlanificacion days", strtotime($fechaPlanificacionInicio)));



        
        //* DIAS DE FASE DE EJECUCION 
        $diasEjecucion = 10;
        $fechaEjecucionInicio = date($this->formatDate, strtotime("+1 days", strtotime($fechaPlanificacionFin)));
        $fechaEjecucionFin = date($this->formatDate, strtotime("+$diasEjecucion days", strtotime($fechaEjecucionInicio)));

        $data = 
        [
            'fechaInicio'=> $fechaInicio,
            'tituloActuacion'=> $actuacion->target,
            'auditores'=> implode($saltoEnLinea, $this->auditors),
            'fechaPlanificacionInicio'=> $fechaPlanificacionInicio,
            'diasPlanificacion'=> $diasPlanificacion,
            'fechaPlanificacionFin'=> $fechaPlanificacionFin,
            'fechaEjecucionInicio'=> $fechaEjecucionInicio,
            'diasEjecucion'=> $diasEjecucion,
            'fechaEjecucionFin'=> $fechaEjecucionFin,
            'actuacionFiscal'=> $actuacion->id,
            'año'=> $año,
            // 'fechaEjecucion'=> $fechaEjecucion,
            // 'fechaEjecucionFin'=> $fechaEjecucionFin,
            // 'fechaEjecucionFin'=> $fechaEjecucionFin,
            // 'fechaEjecucionFin'=> $fechaEjecucionFin,
            // 'fechaEjecucionFin'=> $fechaEjecucionFin,
            // 'fechaEjecucionFin'=> $fechaEjecucionFin,
            // 'fechaEjecucionFin'=> $fechaEjecucionFin,
            // 'fechaEjecucionFin'=> $fechaEjecucionFin,
        ];

        $this->create($data);
        return Response::download($this->pathDocument, $this->nameDocument);
    }




    /**
     * todo [silvia vargas, coordinador]
     * todo [pier bolech diaz, auditor]
     * todo [geferson moreno palacios, auditor]
     */
    private function getAuditor($request): void
    {
        $i = 0;
        foreach ($request->auditor as $auditorId) {
            $letter = $this->letters[$i];
            $cargo = $request->cargo[$i];
            $auditor = PersonalUai::find($auditorId);
            array_push($this->auditors, "$auditor->primer_nombre $auditor->primer_apellido $auditor->segundo_apellido / $cargo ($letter)");
            $i++;
        }
    }

    private function create(array $data): void
    {
        $template = new TemplateProcessor($this->templateFile);
        $template->setValues($data);
        $template->saveAs($this->pathDocument);
        // header("Content-Disposition: attachment; filename=$this->nameDocument; charse=iso-8859-1");
    }
}
