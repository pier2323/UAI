<?php

namespace App\Http\Controllers;

use App\Models\AuditActivity;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use \PhpOffice\PhpSpreadsheet\IOFactory;

class ExcelController extends Controller
{
   public $auditActivity;
    public $employees = [];

    public $incoming = [];

    public $outgoing = [];

    public function mount($id)
    {
        $relations = ['employee', 'typeAudit', 'handoverDocument', 'uai'];
        $this->auditActivity = auditActivity::with($relations)->findOrFail($id);
        $this->employees = \App\Models\Employee::all();
        $this->incoming = \App\Models\EmployeeIncoming::all();
        $this->outgoing = \App\Models\EmployeeOutgoing::all();
    }
 
    public function downloadExcel(Request $request)
    {
        $unidad_entrega = "gerencia control posterior";
        $unidad_adscrita = "UAI";
        $periodo_saliente_desde = "20/23/2020";
        $periodo_saliente_hasta = "10/05/2020";
        $nombre_saliente = "pier";
        $cedula_saliente = "12345678";
        $auditor_a = "geferson";
        $auditor_b = "jose";
        $nombre_recibe = "jose";
        $cedula_recibe = "12345678";
        $periodo_desde = '16/08/2022';
        $periodo_hasta = '20/15/2025';
        $cargo = "auditro";

      

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


        // Agregar filas con los datos
        $data = $request->all();
        // Obtener los datos enviados por la solicitud AJAX
        $uncheckedValues = json_decode($request->getContent(), true);
        $checkboxCells = ['D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L']; // Arreglo de columnas para las casillas de verificación
        $checkboxIndex = 0; // Índice para recorrer el arreglo de columnas
        $currentRow = 15; // Inicializar la fila para las casillas de verificación
        
        foreach ($data as $item) {
            // Agregar casilla de verificación en una celda específica
            $checkboxCell = $hoja2->getCell($checkboxCells[$checkboxIndex] . $currentRow);
            $checkboxCell->setValue($item['value'] ? 1 : 0); // Set value to 1 if true, 0 if false
            $checkboxCell->getWorksheet()->getCell($checkboxCell->getColumn() . $checkboxCell->getRow())->getStyle()->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $checkboxCell->getWorksheet()->getCell($checkboxCell->getColumn() . $checkboxCell->getRow())->getStyle()->getProtection()->setLocked(\PhpOffice\PhpSpreadsheet\Style\Protection::PROTECTION_UNPROTECTED);
            $checkboxIndex++; // Incrementar el índice para la próxima columna
        }
        $hoja3 = $spreadsheet->getSheetByName('HALLAZGOS');
        $hoja3->setCellValue('D7', "$unidad_entrega adscrita a la $unidad_adscrita");
        $hoja3->setCellValue('B5', "  Actuación $periodo_desde a la $periodo_hasta");
        $hoja3->setCellValue('C9', "De la evaluación practicada al contenido del Acta de Entrega de la $unidad_entrega , correspondiente a la servidor(a) público(a) saliente, $nombre_saliente, titular de la cédula de identidad Nro.$cedula_saliente; se determinó lo siguiente:");
        $hoja3->setCellValue('C44', "$auditor_a");
        $hoja3->setCellValue('E44', "$auditor_b");

   
        $row = 40;
        $column = 'C';
$contador = 1; // Inicializamos el contador en 1

foreach ($uncheckedValues as $uncheckedValue) {
    // Insertar una nueva fila debajo de la actual
    $hoja3->insertNewRowBefore($row, 1);

   
    // Combinar celdas desde la columna C hasta la columna H
    $hoja3->mergeCells("C{$row}:H{$row}");

    // Justificar texto en la celda combinada
    $hoja3->getStyle("C{$row}:H{$row}")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_JUSTIFY);

    // Agregar la columna B con el valor del contador
    $hoja3->setCellValue("B{$row}", $contador);

    // Agregar el comentario en la columna C
    $hoja3->setCellValue("{$column}{$row}", $uncheckedValue['comment']);

    $row++;
    $contador++; // Incrementamos el contador en cada iteración
}
        $hoja5 = $spreadsheet->getSheetByName('desglose de hallazgos');
        $hoja5->setCellValue('D16', "$cargo");
        $hoja5->setCellValue('D1', "");


        
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $Temfile = tempnam(sys_get_temp_dir(), prefix: 'PHPWord');
        $writer->save($Temfile);
        return response()->download($Temfile, name: 'Cedula.xlsx')->deleteFileAfterSend(shouldDelete: true);
        

}
}
