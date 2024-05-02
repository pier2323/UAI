<?php

namespace App\Services;

// use PhpOffice\PhpWord\PhpWord;

use App\Models\ActuacionFiscal;
use App\Models\PersonalUai;
use PhpOffice\PhpWord\TemplateProcessor;

class DesignationService
{
    public $letters = ["A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "Ñ", "O", "P", "Q", "R", "S", "T", "U", "V", "X", "Y", "Z"];
    public $auditor = array();
    public function generate($request)
    {
        /**
         * todo [silvia vargas, coordinador]
         * todo [pier bolech diaz, auditor]
         * todo [geferson moreno palacios, auditor]
         */
        $i = 0;
        foreach ($request->auditor as $auditorId) 
        {
            $letter = $this->letters[$i];
            $cargo = $request->cargo[$i];
            $auditor = PersonalUai::find($auditorId);
            array_push($this->auditor, "$auditor->primer_nombre $auditor->primer_apellido $auditor->segundo_apellido / $cargo ($letter)");
            $i++;
        }


        $actuacion = ActuacionFiscal::first();
        $dia = '04';
        $mes = 'mayo';
        $año = `2024`;

        $fechaInicio = "$dia de $mes del $año";

        $diasPlanificacion = 5;
        $fechaPlanificacionInicio = date('d/m/Y');
        $fechaPlanificacionFin = strtotime("+$diasPlanificacion days", strtotime($fechaPlanificacionInicio));

        $diasEjecucion = 10;
        $fechaEjecucionInicio = strtotime("+1 days", strtotime($fechaPlanificacionFin));
        $fechaEjecucionFin = strtotime("+$diasEjecucion days", strtotime($fechaEjecucionInicio));


        // $coordinatorAudit = "$coordinador->primer_nombre $coordinador->primer_apellido";
        // $auditorAudit = "$auditor->primer_nombre $auditor->primer_apellido";


        // $diasPreeliminar = 5;
        // $diasInformeDefinitivo = 5;

        // $template->setValue('nombreCoordinador', "hola \n hola asd \n");




        // $template->setValue('nombreAuditor', "$auditor->primer_nombre $auditor->primer_apellido");
        // $template->setValue('fechaInicio', $fechaInicio);
        // $template->setValue('tituloActuacion', $actuacion->objetivo);

        // $template->setValue('diasPlanificacion', $diasPlanificacion);
        // $template->setValue('fechaPlanificacionInicio', $fechaPlanificacionInicio);
        // $template->setValue('fechaPlanificacionFin', $fechaPlanificacionFin);

        // $template->setValue('fechaEjecucionInicio', $fechaEjecucionInicio);
        // $template->setValue('fechaEjecucionFin', $fechaEjecucionFin);














        // $template->setValue('diasPlanificacion', $diasPlanificacion);
        // $template->setValue('diasPlanificacion', $diasPlanificacion);
        // $template->setValue('diasPlanificacion', $diasPlanificacion);
        // $template->setValue('diasPlanificacion', $diasPlanificacion);
        // $template->setValue('diasPlanificacion', $diasPlanificacion);
        // $template->setValue('diasPlanificacion', $diasPlanificacion);
        // $template->setValue('diasPlanificacion', $diasPlanificacion);
        // $template->setValue('diasPlanificacion', $diasPlanificacion);







        // $tempfile = tempnam(sys_get_temp_dir(), prefix: 'PHPWord');
        // $template->saveAs($tempfile);
        
        // header('Content-Disposition: attachment; filename=designation.docx; charse=iso-8859-1');
        // return $tempfile;
    }
}
