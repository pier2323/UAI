<?php

namespace App\Services;

// use PhpOffice\PhpWord\PhpWord;

use App\Models\ActuacionFiscal;
use App\Models\PersonalUai;
use PhpOffice\PhpWord\TemplateProcessor;

class DesignationService
{
    public function generate($request)
    {
        return $request->all();






        // $template = new TemplateProcessor('designation.docx');
        // $coordinador = PersonalUai::find($Coordinador);
        // $auditor = PersonalUai::find($Auditor);
        // $actuacion = ActuacionFiscal::find($Actuacion);
        // $dia = '04';
        // $mes = 'mayo';
        // $año = '2024';
        // $fechaInicio = "$dia de $mes del $año";

        // $diasPlanificacion = 5;
        // $fechaPlanificacionInicio = date('d/m/Y');
        // $fechaPlanificacionFin = strtotime("+$diasPlanificacion days", strtotime($fechaPlanificacionInicio));

        // $diasEjecucion = 10;
        // $fechaEjecucionInicio = strtotime("+1 days", strtotime($fechaPlanificacionFin));
        // $fechaEjecucionFin = strtotime("+$diasEjecucion days", strtotime($fechaEjecucionInicio));


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

        // return $tempfile;
        // header('Content-Disposition: attachment; filename=designation.docx; charse=iso-8859-1');
    }
}
