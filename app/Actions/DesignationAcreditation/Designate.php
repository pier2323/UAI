<?php

namespace App\Actions\DesignationAcreditation;

use App\Models\AuditActivity;
use App\Models\Designation;

final class Designate
{
    public function __construct(
        protected AuditActivity $auditActivity
    ) {}

    public function create(): Designation
    {
        return Designation::create([
            'date_release' => $this->auditActivity->planning_start,
        ]);
    }
}