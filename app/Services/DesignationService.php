<?php

namespace App\Services;

// use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\TemplateProcessor;

class DesignationService
{
    public function generate()
    {
        $template = new TemplateProcessor('designation.docx');
        $name = 'geferson';
        $template->setValue('name', $name);
        $tempfile = tempnam(sys_get_temp_dir(), prefix: 'PHPWord');
        $template->saveAs($tempfile);

        return $tempfile;
        // header('Content-Disposition: attachment; filename=designation.docx; charse=iso-8859-1');
    }
}
