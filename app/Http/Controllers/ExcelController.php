<?php

namespace App\Http\Controllers;
 
use App\Models\hallazgo;
use App\Models\HandoverDocuments;
use App\Models\AuditActivity;
use App\Models\HandoverDocument;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;


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


public function hallazasgo($request){
    $values = $request['checkboxes'];
    $texts = $request['uncheckedCheckboxes'];

    $array = [];
    foreach ($texts as $value => $text)
    {
        $array[$value-1] = [$text];
    }

    $jsonAtrribute = json_encode($array);

    $jsonAtrributes = new HandoverDocument();
    $jsonAtrributes->hallazgo = $jsonAtrribute;
    $jsonAtrributes->save();
    $atrribute = json_decode($jsonAtrributes->hallazgo);
}


    public function downloadExcel(Request $request)

  
    {
        $cedula_recibe = '16.525.105';
        $cedula_saliente =  '17.286.980';
        $unidad_entrega = 'Gerencia General  Mercado Masivos';
        $unidad_adscrita = 'Gerente General de Proyecto Mayores';
         $periodo_saliente_desde = '04/10/2017 ';
         $periodo_saliente_hasta = ' 12/08/2024';
         $nombre_saliente = 'Iván junior Gavranovic Sorman';
         $cedula_saliente = 'C.I.'.$cedula_saliente;
         $auditor_a = 'Ivonne Rojas';
         $auditor_b = 'Silvia Vargas O';
         $nombre_recibe = 'Ernesto Antonio Sandoval Martínes';
         $cedula_recibe = 'C.I.'.$cedula_recibe;
         $cargo = 'Gerente General  de Proyecto Mayores';
         
         $spreadsheet = IOFactory::load('cedulaTemplate.xlsm');
         $hoja1 = $spreadsheet->getSheetByName('ATRIBUTOS');
         $hoja1->setCellValue('A5', "ACTUACIÓN FISCAL SOBRE LA VERIFICACIÓN DE LA SINCERIDAD Y EXACTITUD DEL CONTENIDO DEL ACTA DE ENTREGA DE LA $unidad_entrega ADSCRITA A LA $unidad_adscrita CORRESPONDIENTE AL SERVIDOR(A) PÚBLICO(A) SALIENTE CIUDADANO(A) $nombre_saliente, TITULAR DE LA CÉDULA DE IDENTIDAD NRO. $cedula_saliente, DURANTE EL PERIODO DE GESTIÓN DEL $periodo_saliente_desde AL  $periodo_saliente_hasta");

         $hoja2 = $spreadsheet->getSheetByName('CEDULA');
         $hoja2->setCellValue('A6',  "Actuación $periodo_saliente_desde a la  $periodo_saliente_hasta");
         $hoja2->setCellValue('B10', "$unidad_entrega");
         $hoja2->setCellValue('D10', "$unidad_adscrita");
         $hoja2->setCellValue('K10', "$nombre_saliente");
         $hoja2->setCellValue('K11', "$cedula_saliente");
         $hoja2->setCellValue('P10', "$nombre_recibe");
         $hoja2->setCellValue('P11', "$cedula_recibe");
         $hoja2->setCellValue('T11', "$periodo_saliente_desde");
         $hoja2->setCellValue('V11', "$periodo_saliente_hasta");
         $hoja2->setCellValue('B10', " $unidad_entrega");
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
         $checkboxCells = ['D','E', 'F', 'H', 'I', 'J', 'K', 'L','M', 'N', 'O', 'P', 'R', 'S','T', 'U', 'V', 'W', 'X', 'Y', 'Z',];
         $checkboxIndex = 0; // Índice para recorrer el arreglo de columnas
         $currentRow = 27;  //Inicializar la fila para las casillas de verificación

          //Agregar datos al archivo Excel en las columnas especificadas
         foreach ($checkboxes as $index => $checkbox) {
             if (isset($checkboxCells[$checkboxIndex])) {
                 $hoja2->setCellValue($checkboxCells[$checkboxIndex] . $currentRow, $checkbox);
                 $checkboxIndex++;
             }
         }

         $checkboxes = $request->input('checkboxes', []);
         $uncheckedCheckboxes = $request->input('uncheckedCheckboxes', []);
     
         // Verificar si "Sin Hallazgo" está presente en la solicitud
         if ($request->has('sinHallazgo')) {
             $uncheckedCheckboxes[] = $request->input('sinHallazgo'); // Agregar "Sin Hallazgo" al arreglo
         }
         $hoja3 = $spreadsheet->getSheetByName('HALLAZGOS');
         $hoja3->setCellValue('D7', "$unidad_entrega adscrita a la $unidad_adscrita");
         $hoja3->setCellValue('B5', "  Actuación $periodo_saliente_desde a la  $periodo_saliente_hasta");
         $hoja3->setCellValue('C9', "De la evaluación practicada al contenido del Acta de Entrega de la $unidad_entrega , correspondiente a la servidor(a) público(a) saliente, $nombre_saliente, titular de la cédula de identidad Nro.$cedula_saliente; se determinó lo siguiente:");
      

        //  Reiniciar el índice y la fila para los inputs adicionales de los checkboxes no seleccionados
        foreach ($uncheckedCheckboxes as $unchecked) {
            if (isset($checkboxCells[$checkboxIndex])) {
             }
         }
    
        //  Reiniciar el índice y la fila para los inputs adicionales de los checkboxes no seleccionados
         $checkboxIndex = 0;
         $currentRow = 40; // Fila donde comenzarán los inputs adicionales
         $counter = 1; // Inicializar el contador
    
         foreach ($uncheckedCheckboxes as $unchecked) {
             if (isset($checkboxCells[$checkboxIndex])) {
                 // Desplazar hacia abajo el contenido existente
                  $hoja3->insertNewRowBefore($currentRow, 1);
    
                 // Combinar celdas desde la columna C hasta la columna L
                  $hoja3->mergeCells("C{$currentRow}:H{$currentRow}");
    
                //  Justificar y alinear el texto a la izquierda en la celda combinada
                  $hoja3->getStyle("C{$currentRow}:H{$currentRow}")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
                  $hoja3->getStyle("C{$currentRow}:H{$currentRow}")->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
    
                 // Agregar el comentario en la columna C y poner en negritas
                  $hoja3->setCellValue("C{$currentRow}", $unchecked);
                  $hoja3->getStyle("C{$currentRow}:H{$currentRow}")->getFont()->setBold(true);
                  $hoja3->getStyle("C{$currentRow}:H{$currentRow}")->getFont()->setUnderline(false); // Quitar subrayado
    
                 // Agregar el contador en la columna B y poner en negritas
                  $hoja3->setCellValue("B{$currentRow}", $counter);
                  $hoja3->getStyle("B{$currentRow}")->getFont()->setBold(true);
                  $hoja3->getStyle("B{$currentRow}")->getFont()->setUnderline(false);  //Quitar subrayado
    
                 $currentRow++;
                 $counter++;
             }
         }
    

         session()->put('checkboxes', $checkboxes);
         session()->put('uncheckedCheckboxes', $uncheckedCheckboxes);
         $hoja4 = $spreadsheet->getSheetByName('informe de debilidades');

   // Reiniciar el índice y la fila para los inputs adicionales de los checkboxes no seleccionados
   $checkboxIndex = 0;
   $currentRow = 10; // Fila donde comenzarán los inputs adicionales
   $counter = 1; // Inicializar el contador

   foreach ($uncheckedCheckboxes as $unchecked) {
       if (isset($checkboxCells[$checkboxIndex])) {
          //  Desplazar hacia abajo el contenido existente
            $hoja4->insertNewRowBefore($currentRow, 1);

           // Combinar celdas desde la columna C hasta la columna L
            $hoja4->mergeCells("C{$currentRow}:H{$currentRow}");

          //  Justificar y alinear el texto a la izquierda en la celda combinada
            $hoja4->getStyle("C{$currentRow}:H{$currentRow}")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
            $hoja4->getStyle("C{$currentRow}:H{$currentRow}")->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

          //  Agregar el comentario en la columna C y poner en negritas
            $hoja4->setCellValue("C{$currentRow}", $unchecked);
            $hoja4->getStyle("C{$currentRow}:H{$currentRow}")->getFont()->setBold(true);
            $hoja4->getStyle("C{$currentRow}:H{$currentRow}")->getFont()->setUnderline(false);  //Quitar subrayado

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
         $hoja5->setCellValue('B4', "Dirección, Unidad o Departamento:  $unidad_entrega adscrita a la  $unidad_adscrita ");
    
         // Reiniciar el índice y la fila para los inputs adicionales de los checkboxes no seleccionados

     $checkboxIndex = 0;
     $currentRow = 8;//  Fila donde comenzarán los inputs adicionales
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

              //Agregar el comentario en la columna C y poner en negritas
              $hoja5->setCellValue("C{$currentRow}", $unchecked);
              $hoja5->getStyle("C{$currentRow}:E{$currentRow}")->getFont()->setBold(true);
              $hoja5->getStyle("C{$currentRow}:E{$currentRow}")->getFont()->setUnderline(false);  //Quitar subrayado

             // Agregar el contador en la columna B y poner en negritas
              $hoja5->setCellValue("B{$currentRow}", $counter);
              $hoja5->getStyle("B{$currentRow}")->getFont()->setBold(true);
              $hoja5->getStyle("B{$currentRow}")->getFont()->setUnderline(false);  //Quitar subrayado

             $currentRow++;
             $counter++;
         }
     }
//Enviar el archivo Excel al navegador
         $writer = new Xlsx($spreadsheet);
        

         header('Content-Type: application/vnd.ms-excel');
         header('Content-Disposition: attachment;filename="cedula.xls"');
         header('Cache-Control: max-age=0');
         
         $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xls');
         $writer->save('php://output');
    }


      
    

}
