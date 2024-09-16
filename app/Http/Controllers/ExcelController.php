<?php

namespace App\Http\Controllers;

use App\Models\AuditActivity;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ExcelController extends Controller
{
    public $auditActivity;
    public $employees = [];

    public $incoming = [];

    public $outgoing = [];

    public function mount($id)
    {
        $relations = ['employee', 'typeAudit', 'handoverDocument', 'uai'];
        $this->auditActivity = AuditActivity::with($relations)->findOrFail($id);
        $this->employees = \App\Models\Employee::all();
        $this->incoming = \App\Models\EmployeeIncoming::all();
        $this->outgoing = \App\Models\EmployeeOutgoing::all();
    }
    public function downloadExcel(Request $request)
    {
        $unidad_entrega = 'gerencia control posterior';
        $unidad_adscrita = 'UAI';
        $periodo_saliente_desde = '20/23/2020';
        $periodo_saliente_hasta = '10/05/2020';
        $nombre_saliente = 'pier';
        $cedula_saliente = '12345678';
        $auditor_a = 'geferson';
        $auditor_b = 'jose';
        $nombre_recibe = 'jose';
        $cedula_recibe = '12345678';
        $periodo_desde = '16/08/2022';
        $periodo_hasta = '20/15/2025';
        $cargo = 'auditro';

        $spreadsheet = IOFactory::load('cedulaTemplate.xlsm');
        $hoja1 = $spreadsheet->getSheetByName('ATRIBUTOS');
        $hoja1->setCellValue('A5', "ACTUACIÓN FISCAL SOBRE LA VERIFICACIÓN DE LA SINCERIDAD Y EXACTITUD DEL CONTENIDO DEL ACTA DE ENTREGA DE LA $unidad_entrega ADSCRITA A LA $unidad_adscrita CORRESPONDIENTE AL SERVIDOR(A) PÚBLICO(A) SALIENTE CIUDADANO(A) $nombre_saliente, TITULAR DE LA CÉDULA DE IDENTIDAD NRO. $cedula_saliente, DURANTE EL PERIODO DE GESTIÓN DEL $periodo_desde AL $periodo_hasta");

        $hoja2 = $spreadsheet->getSheetByName('CEDULA');
        $hoja2->setCellValue('B10', "$unidad_entrega");
        $hoja2->setCellValue('D10', "$unidad_adscrita");
        $hoja2->setCellValue('K10', "$nombre_saliente");
        $hoja2->setCellValue('K11', "$cedula_saliente");
        $hoja2->setCellValue('P10', "$nombre_recibe");
        $hoja2->setCellValue('P11', "$cedula_recibe");
        $hoja2->setCellValue('T11', "$periodo_saliente_desde");
        $hoja2->setCellValue('B10', "$periodo_saliente_hasta");
        $hoja2->setCellValue('C23', "   $auditor_a");
        $hoja2->setCellValue('O23', "$auditor_b");

        // Establecer ancho de las columnas
        $hoja2->getColumnDimension('A')->setWidth(20);
        $hoja2->getColumnDimension('B')->setWidth(10);
        $hoja2->getColumnDimension('C')->setWidth(50);

        $checkboxes = $request->input('checkboxes', []);
        $uncheckedCheckboxes = $request->input('uncheckedCheckboxes', []);

        $hoja2 = $spreadsheet->getSheetByName('Cedula');

        // Arreglo de columnas para las casillas de verificación
        $checkboxCells = ['D', 'F', 'H', 'I', 'J', 'K', 'L','M', 'N', 'O', 'P', 'Q', 'R', 'S','T', 'U', 'V', 'W', 'X', 'Y', 'Z',];
        $checkboxIndex = 0; // Índice para recorrer el arreglo de columnas
        $currentRow = 90; // Inicializar la fila para las casillas de verificación

        // Agregar datos al archivo Excel en las columnas especificadas
        foreach ($checkboxes as $index => $checkbox) {
            if (isset($checkboxCells[$checkboxIndex])) {
                $hoja2->setCellValue($checkboxCells[$checkboxIndex] . $currentRow, $checkbox);
                $checkboxIndex++;
            }
        }

        $hoja3 = $spreadsheet->getSheetByName('HALLAZGOS');
        $hoja3->setCellValue('D7', "$unidad_entrega adscrita a la $unidad_adscrita");
        $hoja3->setCellValue('B5', "  Actuación $periodo_desde a la $periodo_hasta");
        $hoja3->setCellValue('C9', "De la evaluación practicada al contenido del Acta de Entrega de la $unidad_entrega , correspondiente a la servidor(a) público(a) saliente, $nombre_saliente, titular de la cédula de identidad Nro.$cedula_saliente; se determinó lo siguiente:");
        $hoja3->setCellValue('C44', "$auditor_a");
        $hoja3->setCellValue('E44', "$auditor_b");

        // Reiniciar el índice y la fila para los inputs adicionales de los checkboxes no seleccionados
        foreach ($checkboxes as $index => $checkbox) {
            if (isset($checkboxCells[$checkboxIndex])) {
                 $hoja3->setCellValue($checkboxCells[$checkboxIndex] . $currentRow, $checkbox);
                $checkboxIndex++;
            }
        }
    
        // Reiniciar el índice y la fila para los inputs adicionales de los checkboxes no seleccionados
        $checkboxIndex = 0;
        $currentRow = 40; // Fila donde comenzarán los inputs adicionales
        $counter = 1; // Inicializar el contador
    
        foreach ($uncheckedCheckboxes as $unchecked) {
            if (isset($checkboxCells[$checkboxIndex])) {
                // Desplazar hacia abajo el contenido existente
                 $hoja3->insertNewRowBefore($currentRow, 1);
    
                // Combinar celdas desde la columna C hasta la columna L
                 $hoja3->mergeCells("C{$currentRow}:H{$currentRow}");
    
                // Justificar y alinear el texto a la izquierda en la celda combinada
                 $hoja3->getStyle("C{$currentRow}:H{$currentRow}")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
                 $hoja3->getStyle("C{$currentRow}:H{$currentRow}")->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
    
                // Agregar el comentario en la columna C y poner en negritas
                 $hoja3->setCellValue("C{$currentRow}", $unchecked);
                 $hoja3->getStyle("C{$currentRow}:H{$currentRow}")->getFont()->setBold(true);
                 $hoja3->getStyle("C{$currentRow}:H{$currentRow}")->getFont()->setUnderline(false); // Quitar subrayado
    
                // Agregar el contador en la columna B y poner en negritas
                 $hoja3->setCellValue("B{$currentRow}", $counter);
                 $hoja3->getStyle("B{$currentRow}")->getFont()->setBold(true);
                 $hoja3->getStyle("B{$currentRow}")->getFont()->setUnderline(false); // Quitar subrayado
    
                $currentRow++;
                $counter++;
            }
        }
    


        $hoja4 = $spreadsheet->getSheetByName('informe de debilidades');

  // Reiniciar el índice y la fila para los inputs adicionales de los checkboxes no seleccionados
  $checkboxIndex = 0;
  $currentRow = 10; // Fila donde comenzarán los inputs adicionales
  $counter = 1; // Inicializar el contador

  foreach ($uncheckedCheckboxes as $unchecked) {
      if (isset($checkboxCells[$checkboxIndex])) {
          // Desplazar hacia abajo el contenido existente
           $hoja4->insertNewRowBefore($currentRow, 1);

          // Combinar celdas desde la columna C hasta la columna L
           $hoja4->mergeCells("C{$currentRow}:H{$currentRow}");

          // Justificar y alinear el texto a la izquierda en la celda combinada
           $hoja4->getStyle("C{$currentRow}:H{$currentRow}")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
           $hoja4->getStyle("C{$currentRow}:H{$currentRow}")->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

          // Agregar el comentario en la columna C y poner en negritas
           $hoja4->setCellValue("C{$currentRow}", $unchecked);
           $hoja4->getStyle("C{$currentRow}:H{$currentRow}")->getFont()->setBold(true);
           $hoja4->getStyle("C{$currentRow}:H{$currentRow}")->getFont()->setUnderline(false); // Quitar subrayado

          // Agregar el contador en la columna B y poner en negritas
           $hoja4->setCellValue("B{$currentRow}", $counter);
           $hoja4->getStyle("B{$currentRow}")->getFont()->setBold(true);
           $hoja4->getStyle("B{$currentRow}")->getFont()->setUnderline(false); // Quitar subrayado

          $currentRow++;
          $counter++;
      }
  }




        $hoja5 = $spreadsheet->getSheetByName('desglose de hallazgos');
        $hoja5->setCellValue('D16', "$cargo");
        $hoja5->setCellValue(   'D16', "$cargo");
        // Reiniciar el índice y la fila para los inputs adicionales de los checkboxes no seleccionados
      // Reiniciar el índice y la fila para los inputs adicionales de los checkboxes no seleccionados
    $checkboxIndex = 0;
    $currentRow = 8; // Fila donde comenzarán los inputs adicionales
    $counter = 1; // Inicializar el contador

    foreach ($uncheckedCheckboxes as $unchecked) {
        if (isset($checkboxCells[$checkboxIndex])) {
            // Desplazar hacia abajo el contenido existente
             $hoja5->insertNewRowBefore($currentRow, 1);

            // Combinar celdas desde la columna C hasta la columna E
             $hoja5->mergeCells("C{$currentRow}:E{$currentRow}");

            // Justificar y alinear el texto a la izquierda en la celda combinada
             $hoja5->getStyle("C{$currentRow}:E{$currentRow}")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
             $hoja5->getStyle("C{$currentRow}:E{$currentRow}")->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

            // Asegurar que el fondo sea blanco
             $hoja5->getStyle("C{$currentRow}:E{$currentRow}")->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
             $hoja5->getStyle("C{$currentRow}:E{$currentRow}")->getFill()->getStartColor()->setARGB('FFFFFF');

            // Ajustar el texto automáticamente
             $hoja5->getStyle("C{$currentRow}:E{$currentRow}")->getAlignment()->setWrapText(true);

            // Agregar el comentario en la columna C y poner en negritas
             $hoja5->setCellValue("C{$currentRow}", $unchecked);
             $hoja5->getStyle("C{$currentRow}:E{$currentRow}")->getFont()->setBold(true);
             $hoja5->getStyle("C{$currentRow}:E{$currentRow}")->getFont()->setUnderline(false); // Quitar subrayado

            // Agregar el contador en la columna B y poner en negritas
             $hoja5->setCellValue("B{$currentRow}", $counter);
             $hoja5->getStyle("B{$currentRow}")->getFont()->setBold(true);
             $hoja5->getStyle("B{$currentRow}")->getFont()->setUnderline(false); // Quitar subrayado

            $currentRow++;
            $counter++;
        }
    }


        // $hoja5->setCellValue(coordinate: 'D1', '');

        // Enviar el archivo Excel al navegador
        $writer = new Xlsx($spreadsheet);
        $filename = 'Cedula.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . urlencode($filename) . '"');

        $writer->save('php://output');
        exit();
    }

}
