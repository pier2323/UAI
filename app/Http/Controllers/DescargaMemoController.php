<?php

namespace App\Http\Controllers;

use App\Models\Memo; // Asegúrate de importar el modelo Memo
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\TemplateProcessor;

class DescargaMemoController extends Controller
{
    public function index($input_tipo1)
    {
        // Busca el memo por input_tipo1
        $memo = Memo::where('input_tipo1', $input_tipo1)->first();

        // Verifica si el memo existe
        if (!$memo) {
            return response("Memo no encontrado", 404); // Manejo de error si el memo no existe
        }

        // Define la ruta del archivo DOCX
        $filePath = 'templateDocument/memo.docx'; // Asegúrate de que la ruta sea correcta

        // Verifica si el archivo DOCX existe
        if (!Storage::exists($filePath)) {
            return response("Documento no encontrado", 404); // Manejo de error si el documento no existe
        }

        // Crea una instancia de TemplateProcessor
        $templateProcessor = new TemplateProcessor(Storage::path($filePath));

        // Reemplaza las variables en la plantilla
        $templateProcessor->setValue('${code}', $memo->input_tipo1);
        $templateProcessor->setValue('${para}', $memo->par);
        $templateProcessor->setValue('${gerencia}', $memo->gerencia);
        $templateProcessor->setValue('${start}', $memo->fecha1);
        $templateProcessor->setValue('${end}', $memo->fecha2);
        $templateProcessor->setValue('${conclusion}', $memo->conclusion);
        $templateProcessor->setValue('${recomendacion}', $memo->recomendaciones);
        $templateProcessor->setValue('${titulo_cuadro}', $memo->titulo_cuadro1);
        $templateProcessor->setValue('${titulo_cuadro2}', $memo->titulo_cuadro2);

        // Formatea la fecha de hoy en el formato "DD de Mes de YYYY"
        $fechaHoy = new \DateTime();
        $dia = $fechaHoy->format('d');
        $mes = $this->obtenerNombreMes($fechaHoy->format('m'));
        $anio = $fechaHoy->format('Y');
        $fechaFormateada = "$dia de $mes de $anio";
        
        // Reemplaza la variable de fecha en la plantilla
        $templateProcessor->setValue('${hoy}', $fechaFormateada);
        $templateProcessor->setValue('${anio_actual}', $anio);

        // Manejo de descripciones y unidades responsables para la tabla
        $descripciones = explode(',', $memo->descripcion);
        $unidadesResponsables = explode(',', $memo->unidad_responsable);

        $tableData = [];
        $maxCount = max(count($descripciones), count($unidadesResponsables));

        for ($index = 0; $index < $maxCount; $index++) {
            $descripcion = isset($descripciones[$index]) ? trim($descripciones[$index]) : '';
            $unidadResponsable = isset($unidadesResponsables[$index]) ? trim($unidadesResponsables[$index]) : '';

            $tableData[] = [
                'numero' => $index + 1,
                'descripcion' => $descripcion,
                'unidad_responsable' => $unidadResponsable
            ];
        }

        // Clona la fila de la tabla según la cantidad de descripciones
        $templateProcessor->cloneRow('descripcion', count($tableData));

        // Reemplaza los valores en las filas clonadas
        foreach ($tableData as $index => $data) {
            $templateProcessor->setValue('descripcion#' . ($index + 1), $data['descripcion']);
            $templateProcessor->setValue('numero#' . ($index + 1), $data['numero']);
            $templateProcessor->setValue('unidad_responsable#' . ($index + 1), $data['unidad_responsable']);
        }

        // Manejo de auditorías
        $auditorias = explode(',', $memo->auditoria);
        $riesgos = explode(',', $memo->riesgo);
        $unidadesResponsablesAuditoria = explode(',', $memo->unidad_responsable_auditoria);
        $transferidos = explode(',', $memo->transferido_a);
        $fechasReporte = explode(',', $memo->fechas_reporte); // Suponiendo que las fechas están separadas por comas

        // Asegúrate de que todos los arreglos tengan la misma longitud
               // Asegúrate de que todos los arreglos tengan la misma longitud
               $maxCountAuditorias = max(count($auditorias), count($riesgos), count($unidadesResponsablesAuditoria), count($transferidos), count($fechasReporte));

               // Clona la fila de la tabla de auditoría según la cantidad de registros
               $templateProcessor->cloneRow('auditoria', $maxCountAuditorias);
       
               // Reemplaza los valores en las filas clonadas de auditoría
               for ($index = 0; $index < $maxCountAuditorias; $index++) {
                   // Verifica si el índice existe en cada arreglo
                   $auditoria = isset($auditorias[$index]) ? trim($auditorias[$index]) : '';
                   $riesgo = isset($riesgos[$index]) ? trim($riesgos[$index]) : '';
                   $unidadResponsableAuditoria = isset($unidadesResponsablesAuditoria[$index]) ? trim($unidadesResponsablesAuditoria[$index]) : '';
                   $transferido = isset($transferidos[$index]) ? trim($transferidos[$index]) : '';
                   $fecha = isset($fechasReporte[$index]) ? trim($fechasReporte[$index]) : '';
       
                   // Asigna los valores a la plantilla
                   $templateProcessor->setValue('auditoria#' . ($index + 1), $auditoria);
                   $templateProcessor->setValue('riesgo#' . ($index + 1), $riesgo);
                   $templateProcessor->setValue('unidad_responsable_auditoria#' . ($index + 1), $unidadResponsableAuditoria);
                   $templateProcessor->setValue('transferido_a#' . ($index + 1), $transferido);
                   $templateProcessor->setValue('fecha_reporte#' . ($index + 1), $fecha); // Reemplaza la fecha en la plantilla
                   $templateProcessor->setValue('numero_fila#' . ($index + 1), $index + 1); // Asigna el número de fila
               }
       
               // Guarda el documento modificado en un archivo temporal
               $tempFilePath = storage_path('app/templateDocument/hola_modificado.docx');
               $templateProcessor->saveAs($tempFilePath);
       
               // Devuelve el archivo modificado como respuesta de descarga
               return response()->download($tempFilePath, 'memo_ISEG.docx')->deleteFileAfterSend(true);
           }
        
           // Función para obtener el nombre del mes en español
           private function obtenerNombreMes($numeroMes)
           {
               $meses = [
                   '01' => 'Enero', '02' => 'Febrero', '03' => 'Marzo', '04' => 'Abril',
                   '05' => 'Mayo', '06' => 'Junio', '07' => 'Julio', '08' => 'Agosto',
                   '09' => 'Septiembre', '10' => 'Octubre', '11' => 'Noviembre', '12' => 'Diciembre'
               ];
       
               return $meses[$numeroMes];
           }
       }