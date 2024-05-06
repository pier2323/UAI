<?php

namespace App\Services;

// use PhpOffice\PhpWord\PhpWord;

use App\Models\ActuacionFiscal;
use App\Models\PersonalUai;
use Carbon\Carbon;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Response;
use PhpOffice\PhpWord\TemplateProcessor;
use PhpOffice\PhpWord\PhpWord;
use Illuminate\Support\Facades\Storage;

class DesignationService
{
    private $excludedDates =
        [
            "01/01/2024", // * Año Nuevo 
            "12/02/2024", // * Lunes de Carnaval 
            "13/02/2024", // * Martes de Carnaval 
            "19/04/2024", // * Movimiento Precursor de la Independencia 
            "01/05/2024", // * Día del Trabajador 
            "24/06/2024", // * Batalla de Carabobo 
            "05/07/2024", // * Día de la Independencia 
            "24/07/2024", // * Natalicio del Libertador Simón Bolívar 
            "12/10/2024", // * Resistencia Indígena/Fiesta Nacional de España 
            "24/12/2024", // * Noche Buena 
            "25/12/2024", // * Navidad 
            "31/12/2024", // * Fin de Año 
        ];
    private $letters = ["A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "Ñ", "O", "P", "Q", "R", "S", "T", "U", "V", "X", "Y", "Z"];
    private $auditors = array();
    private $templateFile = 'designationTemplate.docx';
    private $nameDocument = 'designacion.docx';
    private $pathDocument;
    private $formatDate = 'd/m/Y';
    private $date;
    public function generate($request)
    {
        //* RUTA TEMPORAL DEL DOCUMENTO 
        $this->pathDocument = tempnam(sys_get_temp_dir(), prefix: 'PHPWord');
        $this->date = Carbon::now();

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

        $diasPlanificacion = 5;
        //* FECHA DE FASE DE PLANIFICACION 
        $fechaPlanificacionInicio = $this->date->format($this->formatDate);
        $diasPlanificacion = $diasPlanificacion+$this->countDays($fechaPlanificacionInicio, $this->excludedDates, $diasPlanificacion);
        $fechaPlanificacionFin = $this->date->addDays($diasPlanificacion)->format($this->formatDate);
        $diasPlanificacion = 5;
        
        //* FECHA DE FASE DE EJECUCION 
        $diasEjecucion = 10;
        $fechaEjecucionInicio = $this->date->addDays(1+$this->countDays($this->date->toDateString(), $this->excludedDates, 2))->toDateString();
        $diasEjecucion = $diasEjecucion+$this->countDays($fechaEjecucionInicio, $this->excludedDates, $diasEjecucion);
        $fechaEjecucionFin = $this->date->addDays($diasEjecucion)->format($this->formatDate);
        $diasEjecucion = 10;

        //* FECHA DE FASE DE INFORME PREELIMINAR 
        $diasPreeliminar = 10;
        $fechaPreeliminarInicio = $this->date->addDays(1+$this->countDays($this->date->toDateString(), $this->excludedDates, 2))->toDateString();
        $diasPreeliminar = $diasPreeliminar+$this->countDays($fechaPreeliminarInicio, $this->excludedDates, $diasPreeliminar);
        $fechaPreeliminarFin = $this->date->addDays($diasPreeliminar)->format($this->formatDate);
        $diasPreeliminar = 10;


        //* FECHA DE FASE DE DESCARGO 
        $diasDescargo = 10;
        $fechaDescargoInicio = $this->date->addDays(1+$this->countDays($this->date->toDateString(), $this->excludedDates, 2))->toDateString();
        $diasDescargo = $diasDescargo+$this->countDays($fechaDescargoInicio, $this->excludedDates, $diasDescargo);
        $fechaDescargoFin = $this->date->addDays($diasDescargo)->format($this->formatDate);
        $diasDescargo = 10;


        //* FECHA DE FASE DE INFORME DEFINITIVO 
        $diasDefinitivo = 5;
        $fechaDefinitivoInicio = $this->date->addDays(1+$this->countDays($this->date->toDateString(), $this->excludedDates, 2))->toDateString();
        $diasDefinitivo = $diasDefinitivo+$this->countDays($fechaDefinitivoInicio, $this->excludedDates, $diasDefinitivo);
        $fechaDefinitivoFin = $this->date->addDays($diasDefinitivo)->format($this->formatDate);
        $diasDefinitivo = 5;


        $data =
            [
                'año' => $año,
                'actuacionFiscal' => $actuacion->id,
                'fechaInicio' => $fechaInicio,
                'tituloActuacion' => $actuacion->target,
                'auditores' => implode($saltoEnLinea, $this->auditors),
                'diasPlanificacion' => $diasPlanificacion,
                'fechaPlanificacionInicio' => $fechaPlanificacionInicio,
                'fechaPlanificacionFin' => $fechaPlanificacionFin,
                'diasEjecucion' => $diasEjecucion,
                'fechaEjecucionInicio' => Carbon::parse($fechaEjecucionInicio)->format($this->formatDate),
                'fechaEjecucionFin' => $fechaEjecucionFin,
                'diasPreeliminar' => $diasPreeliminar,
                'fechaPreeliminarInicio' => Carbon::parse($fechaPreeliminarInicio)->format($this->formatDate),
                'fechaPreeliminarFin' => $fechaPreeliminarFin,
                'diasDescargo' => $diasDescargo,
                'fechaDescargoInicio' => Carbon::parse($fechaDescargoInicio)->format($this->formatDate),
                'fechaDescargoFin' => $fechaDescargoFin,
                'diasDefinitivo' => $diasDefinitivo,
                'fechaDefinitivoInicio' => Carbon::parse($fechaDefinitivoInicio)->format($this->formatDate),
                'fechaDefinitivoFin' => $fechaDefinitivoFin,
            ];

        return $data;

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
        foreach ($request->auditor as $auditorId) 
        {
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
    }

    /**
     * Summary of countDays
     * @param string $startDate // * "08/05/2024" 
     * @param array $excludedDates 
     * @param int $workDays
     * @return int
     */
    private function countDays(string $startDate, array $excludedDates, int $workDays): int
    {
        $current = Carbon::parse($startDate);
        $days = 0;

        for ($i = 0; $i <= $workDays+1; $i++) 
        {
            // in_array($current->format('d/m/Y'), $excludedDates) || //! fase dos 
            if ($current->isWeekEnd()) 
            {
                $days++;
            }
            $current->addDay();
            echo "current es: ".$current->format('d/m/Y'). " fecha: ".$current->isWeekend()."<br>";
        }
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "<br>";
        return $days;
    }
}