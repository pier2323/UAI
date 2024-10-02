<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\Storage;

class DataController extends Controller
{
    public function saveData(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'input1' => 'required|string',
            'input2' => 'required|string',
            'input3' => 'required|string',
            'input4' => 'required|string',
        ]);

        // Procesar los datos
        $data = [
            'input1' => $request->input('input1'),
            'input2' => $request->input('input2'),
            'input3' => $request->input('input3'),
            'input4' => $request->input('input4'),
            'checkbox1' => $request->has('checkbox1') ? '0' : '1',
            'checkbox2' => $request->has('checkbox2') ? '0' : '1',
        ];

        // Crear el archivo Excel
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Input 1');
        $sheet->setCellValue('B1', 'Input 2');
        $sheet->setCellValue('C1', 'Input 3');
        $sheet->setCellValue('D1', 'Input 4');
        $sheet->setCellValue('E1', 'Checkbox 1');
        $sheet->setCellValue('F1', 'Checkbox 2');

        $sheet->setCellValue('A2', $data['input1']);
        $sheet->setCellValue('B2', $data['input2']);
        $sheet->setCellValue('C2', $data['input3']);
        $sheet->setCellValue('D2', $data['input4']);
        $sheet->setCellValue('E2', $data['checkbox1']);
        $sheet->setCellValue('F2', $data['checkbox2']);

        $writer = new Xlsx($spreadsheet);
        $fileName = 'data.xlsx';
        $filePath = storage_path('app/public/' . $fileName);
        $writer->save($filePath);

        return response()->download($filePath)->deleteFileAfterSend(true);
    }
}