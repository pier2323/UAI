<?php

namespace App\Http\Controllers;

use App\Models\AuditActivity;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use \PhpOffice\PhpSpreadsheet\IOFactory;

use PhpOffice\PhpSpreadsheet\Style\Alignment;

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
        $checkboxCells = ['D' , 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M','N' , 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W' , 'X' , 'Y']; // Arreglo de columnas para las casillas de verificación
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
    
    
        $currentRow = 40;
        $contador = 1; // inicializar contador
        
        // Agregar datos a celdas específicas
        foreach ($data as $item) {
            switch ($item['id']) {
                case 'inputcheckbox1':
                    if ($item['value'] != '') { // verificar si el input checkbox está lleno
                        $hoja3->insertNewRowBefore($currentRow, 1);
                        $hoja3->mergeCells("C{$currentRow}:H{$currentRow}"); // combinar celdas
                        $hoja3->setCellValue("C{$currentRow}", $item['value']); // establecer valor
                        $hoja3->getStyle("C{$currentRow}:H{$currentRow}")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT); // centrar texto
                        $hoja3->setCellValue("B{$currentRow}", $contador); // establecer contador en columna B
                        $contador++; // incrementar contador
                        $currentRow++;
                    }
                    break;
                case 'inputcheckbox2':
                    if ($item['value'] != '') { // verificar si el input checkbox está lleno
                        $hoja3->insertNewRowBefore($currentRow, 1);
                        $hoja3->mergeCells("C{$currentRow}:H{$currentRow}"); // combinar celdas
                        $hoja3->setCellValue("C{$currentRow}", $item['value']); // establecer valor
                        $hoja3->getStyle("C{$currentRow}:H{$currentRow}")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT); // centrar texto
                        $hoja3->setCellValue("B{$currentRow}", $contador); // establecer contador en columna B
                        $contador++; // incrementar contador
                        $currentRow++;
                    }
                    break;
                case 'inputcheckbox3':
                    if ($item['value'] != '') { // verificar si el input checkbox está lleno
                        $hoja3->insertNewRowBefore($currentRow, 1);
                        $hoja3->mergeCells("C{$currentRow}:H{$currentRow}"); // combinar celdas
                        $hoja3->setCellValue("C{$currentRow}", $item['value']); // establecer valor
                        $hoja3->getStyle("C{$currentRow}:H{$currentRow}")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT); // centrar texto
                        $hoja3->setCellValue("B{$currentRow}", $contador); // establecer contador en columna B
                        $contador++; // incrementar contador
                        $currentRow++;
                    }
                    break;
                // Agrega más casos según sea necesario
            }
        }

        $hoja4 = $spreadsheet->getSheetByName('informe de debilidades');
        $currentRow = 10;
        $contador = 1; // inicializar contador
        // Agregar datos a celdas específicas
        foreach ($data as $item) {
            switch ($item['id']) {
                case 'inputcheckbox1':
                    if ($item['value'] != '') { // verificar si el input checkbox está lleno
                        $hoja4->insertNewRowBefore($currentRow, 1);
                        $hoja4->mergeCells("C{$currentRow}:H{$currentRow}"); // combinar celdas
                        $hoja4->setCellValue("C{$currentRow}", $item['value']); // establecer valor
                        $hoja4->getStyle("C{$currentRow}:H{$currentRow}")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT); // centrar texto
                        $hoja4->setCellValue("B{$currentRow}", $contador); // establecer contador en columna B
                        $contador++; // incrementar contador
                        $currentRow++;
                    }
                    break;
                case 'inputcheckbox2':
                    if ($item['value'] != '') { // verificar si el input checkbox está lleno
                        $hoja4->insertNewRowBefore($currentRow, 1);
                        $hoja4->mergeCells("C{$currentRow}:H{$currentRow}"); // combinar celdas
                        $hoja4->setCellValue("C{$currentRow}", $item['value']); // establecer valor
                        $hoja4->getStyle("C{$currentRow}:H{$currentRow}")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT); // centrar texto
                        $hoja4->setCellValue("B{$currentRow}", $contador); // establecer contador en columna B
                        $contador++; // incrementar contador
                        $currentRow++;
                    }
                    break;
                case 'inputcheckbox3':
                    if ($item['value'] != '') { // verificar si el input checkbox está lleno
                         $hoja4->insertNewRowBefore($currentRow, 1);
                         $hoja4->mergeCells("C{$currentRow}:H{$currentRow}"); // combinar celdas
                         $hoja4->setCellValue("C{$currentRow}", $item['value']); // establecer valor
                         $hoja4->getStyle("C{$currentRow}:H{$currentRow}")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT); // centrar texto
                         $hoja4->setCellValue("B{$currentRow}", $contador); // establecer contador en columna B
                        $contador++; // incrementar contador
                        $currentRow++;
                    }
                    break;
                // Agrega más casos según sea necesario
            }
        }

        $hoja5 = $spreadsheet->getSheetByName('desglose de hallazgos');
      
        $currentRow = 7;
        $contador = 1; // inicializar contador
        
        // Agregar datos a celdas específicas
        
        foreach ($data as $item) {
            
            switch ($item['id']) {
                case 'inputcheckbox1':
                    if ($item['value'] != '') { // verificar si el input checkbox está lleno
            
                        $hoja5->insertNewRowBefore($currentRow, 1);
                        $hoja5->mergeCells("C{$currentRow}:E{$currentRow}"); // combinar celdas
                        $hoja5->setCellValue("C{$currentRow}", $item['value']); // establecer valor
                        $style = $hoja5->getStyle("C{$currentRow}:E{$currentRow}"); // obtener estilo de la celda combinada
                        $style->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT); // alinear texto a la izquierda
                        $style->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); // centrar texto verticalmente
                        $style->getAlignment()->setWrapText(true); // justificar texto
                        $style->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID); // establecer fondo blanco
                        $style->getFill()->getStartColor()->setARGB('FFFFFF'); // establecer color blanco
                        
                        $style->getFont()->getColor()->setARGB('000000'); // establecer color de letra negro
                        $hoja5->setCellValue("B{$currentRow}", $contador); // establecer contador en columna B
                        $contador++; // incrementar contador
                        $currentRow++;
                    }
                    break;
                case 'inputcheckbox2':
                    if ($item['value'] != '') { // verificar si el input checkbox está lleno
                        $hoja5->insertNewRowBefore($currentRow, 1);
                        $hoja5->mergeCells("C{$currentRow}:E{$currentRow}"); // combinar celdas
                        $hoja5->setCellValue("C{$currentRow}", $item['value']); // establecer valor
                        $style = $hoja5->getStyle("C{$currentRow}:E{$currentRow}"); // obtener estilo de la celda combinada
                        $style->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT); // alinear texto a la izquierda
                        $style->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); // centrar texto verticalmente
                        $style->getAlignment()->setWrapText(true); // justificar texto
                        $style->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID); // establecer fondo blanco
                        $style->getFill()->getStartColor()->setARGB('FFFFFF'); // establecer color blanco
                        $style->getFont()->getColor()->setARGB('000000'); // establecer color de letra negro
                        $hoja5->setCellValue("B{$currentRow}", $contador); // establecer contador en columna B
                        $contador++; // incrementar contador
                        $currentRow++;
                    }
                    break;
                case 'inputcheckbox3':
                    if ($item['value'] != '') { // verificar si el input checkbox está lleno
                        $hoja5->insertNewRowBefore($currentRow, 1);
                        $hoja5->mergeCells("C{$currentRow}:E{$currentRow}"); // combinar celdas
                        $hoja5->setCellValue("C{$currentRow}", $item['value']); // establecer valor
                        $style = $hoja5->getStyle("C{$currentRow}:E{$currentRow}"); // obtener estilo de la celda combinada
                        $style->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT); // alinear texto a la izquierda
                        $style->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); // centrar texto verticalmente
                        $style->getAlignment()->setWrapText(true); // justificar texto
                        $style->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID); // establecer fondo blanco
                        $style->getFill()->getStartColor()->setARGB('FFFFFF'); // establecer color blanco
                        $style->getFont()->getColor()->setARGB('000000'); // establecer color de letra negro
                        $hoja5->setCellValue("B{$currentRow}", $contador); // establecer contador en columna B
                        $contador++; // incrementar contador
                        $currentRow++;
                    }
                    break;
            }
        }

        
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $Temfile = tempnam(sys_get_temp_dir(), prefix: 'PHPWord');
        $writer->save($Temfile);
        return response()->download($Temfile, name: 'Cedula.xlsx')->deleteFileAfterSend(shouldDelete: true);
        

}
}
