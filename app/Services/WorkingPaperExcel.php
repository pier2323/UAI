<?php

namespace App\Services;

use Illuminate\Support\Facades\Response;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use PhpOffice\PhpSpreadsheet\TemplateProcesor;


final class WorkingPaperExcel
{
    const documentTemplateName = 'cedulaTemplate.xlsm';

    public $pathDocument;

    private $template; 

    function __construct(public array $sheets, public readonly string $nameDocument = 'excel.xls'){}

    public function create(array $cells): void
    {
        $this->template = IOFactory::load(self::documentTemplateName);
        $this->setSheets();
        $this->setCells($cells);
        $this->generatePathDocument();
        $this->getPathDocumentToDownload();
    }

    public function download()
    {
       

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . urlencode($this->nameDocument) . '"');

        exit(); 
    }

    public function generatePathDocument():void
    {   
        // todo temporary file path 
        $this->pathDocument = tempnam(sys_get_temp_dir(), prefix: 'PHPExcel');
    }

    public function getPathDocumentToDownload(): BinaryFileResponse
    {
        return Response::download($this->pathDocument, $this->nameDocument);
    }

    public function setSheets(): void
    {
        $sheetsExcel = [];

        foreach($this->sheets as $sheet)
        {
            $sheetsExcel[] =  $this->template->getSheetByName($sheet);
        }

        $this->sheets = $sheetsExcel;
    }

    private function setCells(array $cells): void
    {
        foreach ($this->sheets as $sheet) // todo iterar las hojas 
        {
            foreach ($cells as $cell => $value) // todo iterar las celdas
            {
                $sheet->setCellValue($cell, $value);
            }
        }
    }
}