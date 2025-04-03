<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ArchivoMovil;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log; // Import the Log facade

class ArchivoMovilController extends Controller
{
    public function index()
    {
        // Fetch data from the database
        $archivoMoviles = ArchivoMovil::all();

        return view('carchivo_movil.archivo_movil', compact('archivoMoviles'));
    }

    public function uploadExcel(Request $request)
    {
        $file = $request->file('excelFile');

        if (!$file) {
            return response()->json(['error' => 'No file uploaded'], 400);
        }

        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::load($file->getPathname());
        $sheet = $reader->getActiveSheet();
        $rows = $sheet->toArray(null, true, true, true); // Convert sheet to array

        // Log the raw data for debugging
        Log::info('Raw Excel Data:', $rows);

        $data = [];
        foreach ($rows as $index => $row) {
            if ($index === 0) {
                // Skip the header row
                continue;
            }

            // Extract data from columns A to D
            $id = isset($row['A']) ? trim($row['A']) : null; // Column A
            $numeroArchivo = isset($row['B']) ? trim($row['B']) : null; // Column B
            $año = isset($row['C']) ? trim($row['C']) : null; // Column C
            $codigoAuditoria = isset($row['D']) ? trim($row['D']) : null; // Column D

            // Ensure rows with valid IDs are processed
            if ($id !== null && $id !== '') {
                $data[] = [
                    'id' => $id,
                    'numero_archivo' => $numeroArchivo,
                    'año' => $año,
                    'codigo_auditoria' => $codigoAuditoria
                ];
            }
        }

        // Log the processed data for debugging
        Log::info('Processed Data:', $data);

        // Save the data using the model
        foreach ($data as $item) {
            ArchivoMovil::updateOrCreate(
                ['id' => $item['id']], // Use 'id' as the unique identifier
                [
                    'numero_archivo' => $item['numero_archivo'], // Update or insert Numero Archivo
                    'año' => $item['año'], // Update or insert Año
                    'codigo_auditoria' => $item['codigo_auditoria'] // Update or insert Codigo Auditoria
                ]
            );
        }

        return response()->json(['success' => 'Data uploaded successfully']);
    }

    public function save(Request $request)
    {
        try {
            $data = $request->input('data');

            if (!$data || !is_array($data)) {
                return response()->json(['success' => false, 'message' => 'No data provided.'], 400);
            }

            foreach ($data as $item) {
                ArchivoMovil::updateOrCreate(
                    ['id' => $item['id']], // Use 'id' as the unique identifier
                    [
                        'numero_archivo' => $item['numero_archivo'], // Update or insert Numero Archivo
                        'año' => $item['año'], // Update or insert Año
                        'codigo_auditoria' => $item['codigo_auditoria'] // Update or insert Codigo Auditoria
                    ]
                );
            }

            return response()->json(['success' => true, 'message' => 'Data saved successfully.']);
        } catch (\Exception $e) {
            Log::error('Error saving data: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'An internal server error occurred.'], 500);
        }
    }
}
