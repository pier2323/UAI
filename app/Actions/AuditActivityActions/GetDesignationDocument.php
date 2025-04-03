<?php

namespace App\Actions\AuditActivityActions;

use App\Models\Designation;
use App\Services\DesignationService;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use App\Repositories\AuditActivityRepository;
use App\Repositories\DesignationRepository;
use Carbon\Carbon;

final class GetDesignationDocument
{
    public function __invoke(object $object, DesignationRepository $designationRepository, AuditActivityRepository $repository): BinaryFileResponse
    {
        $code = $object->code;
        $date_release = Carbon::createFromFormat('d/m/Y', $designationRepository->object['date_release']);

        if(\in_array($object->type_audit['code'], ['as', 'ae']) )
            $nameTemplate = 'designationTemplateForAsAndAE.docx';

        $document = new DesignationService(
            auditActivity: $repository->makeQuery(), 
            date: $date_release, 
            nameDocument: "UAI-GCP-DES-COM $code.docx", 
            nameTemplate: $nameTemplate ?? null
        );

        return $document->download();
    }
}