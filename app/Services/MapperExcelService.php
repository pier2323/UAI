<?php

namespace App\Services;

use PhpOffice\PhpSpreadsheet\Worksheet\Row as WorksheetRow;

final class MapperExcelService
{
    const auditActivityProperties = [
        'public_id' => 0,
        'is_poa' => '',
        'description' => 2,
        'type_audit_id' => 3,
        'month_start' => 4,
        'month_end' => 5,
        'uai_id' => 6,
        'departament_id' => 7,
        'area_id' => 8,
        'objective' => 9,
    ];

    private $spreadsheet;
    private $worksheet;

    private static self $instance;
    private static string $pathDocument;

    private function __construct(string $pathTempFile)
    {
        $this->spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($pathTempFile);
        $this->worksheet = $this->spreadsheet->getActiveSheet();
    }

    public function getData(): array
    {
        return $this->getDataByRow();
    }

    private function getDataByRow()
    {
        $arrayRow = array();
        $getHighestDataColumn = (integer) $this->worksheet->getHighestDataColumn();
        $rowIterator = $this->worksheet->getRowIterator(1, $getHighestDataColumn);

        foreach ($rowIterator as $row) {
            if ($row->isEmpty() || $row->getRowIndex() === 1)  continue;// Ignore empty rows

            $arrayRow[$row->getRowIndex()] = $this->columnIterator($row);
        }
        return $arrayRow;
    }

    private function columnIterator(WorksheetRow $row)
    {
        $columnIterator = $row->getCellIterator();
        $columnIterator->setIterateOnlyExistingCells(true);

        foreach ($columnIterator as $cell) {

            switch ($cell->getColumn()) {
                case 'A': $cells['public_id'] = $cell->getValue(); break;
                case 'B': $cells['code'] = $cell->getValue(); break;
                case 'C': $cells['description'] = $cell->getValue(); break;
                case 'D': $cells['type_audit'] = $cell->getValue(); break;
                case 'E': $cells['month_start'] = $cell->getValue(); break;
                case 'F': $cells['month_end'] = $cell->getValue(); break;
                case 'G': $cells['uai'] = $cell->getValue(); break;
                case 'H': $cells['departament'] = $cell->getValue(); break;
                case 'I': $cells['area'] = $cell->getValue(); break;
                case 'J': $cells['objective'] = $cell->getValue(); break;

            }
        }

        return $cells;
    }

    public static function getInstance(?string $path): self
    {
        if (empty(self::$instance))

        self::$instance = new self($path ?? self::$pathDocument);

        if (empty($path)) self::$pathDocument = $path;

        return self::$instance;
    }
}
