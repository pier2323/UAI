<?php

namespace App\Interfaces\Services;

use Symfony\Component\HttpFoundation\BinaryFileResponse;

interface WorkingPaperInterface
{

    public function create(): void;

    public function generatePathDocument():void;

    public function getPathDocumentToDownload(): BinaryFileResponse;

    static function getTemplate(string $nameDocument): string;

}