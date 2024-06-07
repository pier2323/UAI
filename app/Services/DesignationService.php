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
    private $month = ["hola", "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
    private $auditors = array();
    private $templateFile = 'designationTemplate.docx';
    private $nameDocument = 'designacion.docx';
    private $pathDocument;
    private $formatDate = 'd/m/Y';

    /**
     * Summary of generate
     * @param mixed $request
     * @return BinaryFileResponse
     */
    public function generate($request): BinaryFileResponse
    {
        //* RUTA TEMPORAL DEL DOCUMENTO 
        $this->pathDocument = tempnam(sys_get_temp_dir(), prefix: 'PHPWord');

        /**
         * todo Obtener los auditores y el coordinador de la designacion y ordernar el string 
         */
        $this->getAuditor($request);

        //* ACTUACION FISCAL 
        $actuacion = 1;
        $saltoEnLinea = str_repeat(' ', 500);

        // * FECHA INICIO 
        $dateNow = Carbon::now();
        $actionStart = explode("/", $dateNow->format($this->formatDate));

        $dia = $actionStart[0];
        $mes = $this->month[$dateNow->month];
        $año = $actionStart[2];


        $fechaInicio = "$dia de $mes del $año";


        // return $request->all();

        $data =
            [
                'año' => $año,
                'actuacionFiscal' => $actuacion->id,
                'fechaInicio' => $fechaInicio,
                'tituloActuacion' => $actuacion->target,
                'auditores' => implode($saltoEnLinea, $this->auditors),

                'diasPlanificacion' => $request->planningDays,
                'fechaPlanificacionInicio' => $request->planningStart,
                'fechaPlanificacionFin' => $request->planningEnd,

                'diasEjecucion' => $request->executionDays,
                'fechaEjecucionInicio' => $request->executionStart,
                'fechaEjecucionFin' => $request->executionEnd,

                'diasPreeliminar' => $request->preliminaryDays,
                'fechaPreeliminarInicio' => $request->preliminaryStart,
                'fechaPreeliminarFin' => $request->preliminaryEnd,

                'diasDescargo' => $request->downloadDays,
                'fechaDescargoInicio' => $request->downloadStart,
                'fechaDescargoFin' => $request->downloadEnd,
                'diasDefinitivo' => $request->definitiveDays,
                'fechaDefinitivoInicio' => $request->definitiveStart,
                'fechaDefinitivoFin' => $request->definitiveEnd,
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
}
