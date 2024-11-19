<?php

namespace App\Services;

use PhpOffice\Math\Element\Row;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Row as WorksheetRow;
use PhpOffice\PhpSpreadsheet\Worksheet\RowIterator;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpParser\Node\Stmt\Continue_;

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
    private $maxDataRow;
    private $maxDataColumn;

    public function __construct(string $pathTempFile)
    {
        $this->spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($pathTempFile);
        $this->worksheet = $this->spreadsheet->getActiveSheet();
        $this->maxDataRow = $this->worksheet->getHighestDataRow();
        $this->maxDataColumn = $this->worksheet->getHighestDataColumn();
    }

    public function getData()
    {
        $firstRow = 1;
        $dataSorted = array();
        $dataByRow = $this->getDataByRow();
        foreach ($dataByRow as $row => $value) {
            if ($row === $firstRow) continue;

            $dataSorted['departament_id'] = $value[self::auditActivityProperties['departament_id']];
            $dataSorted['type_audit_id'] = $value[self::auditActivityProperties['type_audit_id']];
            $dataSorted['description'] = $value[self::auditActivityProperties['description']];
            $dataSorted['month_start'] = $value[self::auditActivityProperties['month_start']];
            $dataSorted['public_id'] = $value[self::auditActivityProperties['public_id']];
            $dataSorted['objective'] = $value[self::auditActivityProperties['objective']];
            $dataSorted['month_end'] = $value[self::auditActivityProperties['month_end']];
            $dataSorted['area_id'] = $value[self::auditActivityProperties['area_id']];
            $dataSorted['uai_id'] = $value[self::auditActivityProperties['uai_id']];

        }

        dd($dataSorted);
    }

    private function getDataByRow()
    {
        $arrayRow = array();
        $rowIterator = $this->worksheet->getRowIterator(1, $this->maxDataRow);

        foreach ($rowIterator as $row) {
            if ($row->isEmpty())  continue;// Ignore empty rows
            $arrayRow[$row->getRowIndex()] = $this->columnIterator($row);
        }
        return $arrayRow;
    }

    private function columnIterator(WorksheetRow $row)
    {
        $columnIterator = $row->getCellIterator();
        $columnIterator->setIterateOnlyExistingCells(true);
        foreach ($columnIterator as $cell) {
            if ($cell->getValue() === null) continue;
            $cells[] = $cell->getValue();
        }
        return $cells;
    }

    public function operative()
    {
        $data = $this->spreadsheet->getActiveSheet()->toArray();
        // var_dump($data);

        // $userResponseData = [];
        // $count = "0";
        // foreach($data as $row)
        // {
        //     if($count > 0 && $row['0'] != '' && $row['1'] != '' && $row['2'] != '' && $row['3'] != '')
        //     {
        //         $user_id = $row['0'];
        //         $first_name = $row['1'];
        //         $last_name = $row['2'];
        //         $email = $row['3'];
        //         $phone = $row['4'];

        //         $myUserObj = [
        //             'user_id' => $user_id,
        //             'first_name' => $first_name,
        //             'last_name' => $last_name,
        //             'email' => $email,
        //             'phone' => $phone
        //         ];
        //         array_push($userResponseData, $myUserObj);
        //         $msg = true;
        //     }
        //     else
        //     {
        //         $count = "1";
        //     }
        // }

        // $usersArrayList = [
        //     'users'=> $userResponseData
        // ];
        // $newJsonString = stripslashes(json_encode($usersArrayList));
        // file_put_contents($jsonFilePath, $newJsonString);

        // if(isset($msg))
        // {
        //     $_SESSION['message'] = "Excel Imported to JSON Successfully";
        //     header('Location: index.php');
        //     exit(0);
        // }
        // else
        // {
        //     $_SESSION['message'] = "Something Went Wrong!";
        //     header('Location: index.php');
        //     exit(0);
        // }
    }

    public function uploadArchive($file_ext,  $allowed_ext)
    {
        // $jsonFilePath = "users.json";

        // $fileName = $_FILES['import_file']['name'];
        // $file_ext = pathinfo($fileName, PATHINFO_EXTENSION);

        // $allowed_ext = ['xls','csv','xlsx'];

        // if(in_array($file_ext, $allowed_ext)){
        //     $this->operative();
        // }

        // else
        // {
        //     $_SESSION['message'] = "Invalid File";
        //     header('Location: index.php');
        //     exit(0);
        // }
    }
}
