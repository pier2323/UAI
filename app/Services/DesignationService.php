<?php

namespace App\Services;

use Illuminate\Support\Facades\Response;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use App\Models\ActuacionFiscal;
use App\Models\PersonalUai;
use Carbon\Carbon;
use PhpOffice\PhpWord\TemplateProcessor;
// use Illuminate\Support\Facades\Date;
// use PhpOffice\PhpWord\PhpWord;
// use Illuminate\Support\Facades\Storage;

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

    /**
     * Summary of generate
     * @param mixed $request
     * @return BinaryFileResponse
     */
    public function generate($request):BinaryFileResponse
    {
        //* RUTA TEMPORAL DEL DOCUMENTO 
        $this->pathDocument = tempnam(sys_get_temp_dir(), prefix: 'PHPWord');
        $this->date = Carbon::parse("2024-04-10");

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
        $fechaPlanificacionInicio = $this->toFormat($this->date);
        $diasPlanificacion = $diasPlanificacion+$this->countDays($fechaPlanificacionInicio, $diasPlanificacion);
        $fechaPlanificacionFin = $this->toFormat($this->addDays($diasPlanificacion));
        $diasPlanificacion = 5;
        
        //* FECHA DE FASE DE EJECUCION 
        $diasEjecucion = 10;
        $fechaEjecucionInicio = $this->toFormat($this->addDays(1));
        $diasEjecucion = $diasEjecucion+$this->countDays($fechaEjecucionInicio, $diasEjecucion);
        $fechaEjecucionFin = $this->toFormat($this->addDays($diasEjecucion));
        $diasEjecucion = 10;

        //* FECHA DE FASE DE INFORME PREELIMINAR 
        $diasPreeliminar = 10;
        $fechaPreeliminarInicio = $this->toFormat($this->addDays(1));
        $diasPreeliminar = $diasPreeliminar+$this->countDays($fechaPreeliminarInicio, $diasPreeliminar);
        $fechaPreeliminarFin = $this->toFormat($this->addDays($diasPreeliminar));
        $diasPreeliminar = 10;


        //* FECHA DE FASE DE DESCARGO 
        $diasDescargo = 10;
        $fechaDescargoInicio = $this->toFormat($this->addDays(1));
        $diasDescargo = $diasDescargo+$this->countDays($fechaDescargoInicio, $diasDescargo);
        $fechaDescargoFin = $this->toFormat($this->addDays($diasDescargo));
        $diasDescargo = 10;


        //* FECHA DE FASE DE INFORME DEFINITIVO 
        $diasDefinitivo = 5;
        $fechaDefinitivoInicio = $this->toFormat($this->addDays(1));
        $diasDefinitivo = $diasDefinitivo+$this->countDays($fechaDefinitivoInicio, $diasDefinitivo);
        $fechaDefinitivoFin = $this->toFormat($this->addDays($diasDefinitivo));
        $diasDefinitivo = 5;

        $data =
        [
                'año' => $año,
                'actuacionFiscal' => $actuacion->id,
                'fechaInicio' => $fechaInicio,
                'tituloActuacion' => $actuacion->target,
                'auditores' => implode($saltoEnLinea, $this->auditors),
                
                'diasPlanificacion' => $diasPlanificacion,
                'fechaPlanificacionInicio' => Carbon::parse($fechaPlanificacionInicio)->format($this->formatDate),
                'fechaPlanificacionFin' => Carbon::parse($fechaPlanificacionFin)->format($this->formatDate),
                
                'diasEjecucion' => $diasEjecucion,
                'fechaEjecucionInicio' => Carbon::parse($fechaEjecucionInicio)->format($this->formatDate),
                'fechaEjecucionFin' => Carbon::parse($fechaEjecucionFin)->format($this->formatDate),
                
                'diasPreeliminar' => $diasPreeliminar,
                'fechaPreeliminarInicio' => Carbon::parse($fechaPreeliminarInicio)->format($this->formatDate),
                'fechaPreeliminarFin' => Carbon::parse($fechaPreeliminarFin)->format($this->formatDate),
                
                'diasDescargo' => $diasDescargo,
                'fechaDescargoInicio' => Carbon::parse($fechaDescargoInicio)->format($this->formatDate),
                'fechaDescargoFin' => Carbon::parse($fechaDescargoFin)->format($this->formatDate),
                'diasDefinitivo' => $diasDefinitivo,
                'fechaDefinitivoInicio' => Carbon::parse($fechaDefinitivoInicio)->format($this->formatDate),
                'fechaDefinitivoFin' => Carbon::parse($fechaDefinitivoFin)->format($this->formatDate),
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
        foreach ($request->auditor as $auditorId) 
        {
            $letter = $this->letters[$i];
            $cargo = $request->cargo[$i];
            $auditor = PersonalUai::find($auditorId);
            array_push($this->auditors, "$auditor->primer_nombre $auditor->primer_apellido $auditor->segundo_apellido / $cargo ($letter)");
            $i++;
        }
    }

    /**
     * Summary of create
     * @param array $data
     * @return void
     */
    private function create(array $data): void
    {
        $template = new TemplateProcessor($this->templateFile);
        $template->setValues($data);
        $template->saveAs($this->pathDocument);
    }

    /**
     * Summary of countDays
     * @param string $startDate // * "08/05/2024" 
     * @param int $workDays
     * @return int
     */
    private function countDays(string $startDate, int $workDays): int
    {
        $current = Carbon::parse($startDate);
        $weekEndDays = 0;

        for ($i = 0; $i <= $workDays; $i++) 
        {
            // in_array($current->format('d/m/Y'), $excludedDates) || //! fase dos 
            if ($current->isWeekEnd()) 
            {
                $weekEndDays++;
            }
            $current->addDay();
        }

        return $weekEndDays;
    }
    
    /**
     * Summary of addDays
     * @param int $days
     * @return \Carbon\Carbon
     */
    private function addDays(int $days): Carbon
    {
        $this->date->addDays($days);
        while ($this->date->isWeekend()) 
        {
            $this->date->addDay();
        }

      return $this->date;
    }

    private function toFormat (Carbon $date): string
    {
        return $date->toDateString();
    }
}