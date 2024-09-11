<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\TemplateProcessor;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

final class WorkingPaper implements WorkingPaperInterface 
{
    const PATH_DIRECTORY = 'templateDocument'; 
    public array $data;
    public string $pathDocument;
    
    public function __construct(public string $templateFile, public string $nameDocument, public Carbon $date){}

    public function create(): void
    {
        $template = new TemplateProcessor($this->templateFile);
        $template->setValues($this->data);
        $template->saveAs($this->pathDocument);
    }

    public function generatePathDocument():void
    {   
        // todo temporary file path 
        $this->pathDocument = tempnam(sys_get_temp_dir(), prefix: 'PHPWord');
    }

    public function getPathDocumentToDownload(): BinaryFileResponse
    {
        return Response::download($this->pathDocument, $this->nameDocument);
    }

    static function getTemplate(string $nameDocument): string
    {
        $documentWithPath = self::PATH_DIRECTORY . "/$nameDocument";
        
        if (!Storage::fileExists($documentWithPath)) {
            dd("no se encontro el document: $documentWithPath");
        }

        return Storage::path(self::PATH_DIRECTORY . "\\$nameDocument");
    }
}