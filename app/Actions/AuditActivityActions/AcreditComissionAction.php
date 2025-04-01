<?php

namespace App\Actions\AuditActivityActions;

use App\Models\Acreditation;
use App\Models\AuditActivityEmployee;
use Carbon\Carbon;

final class AcreditComissionAction
{
    public function __invoke(string $date_release, int $auditActivityId): Acreditation
    {
        $dateCarbon = Carbon::createFromFormat('d/m/Y', $date_release);
        
        $acreditation = Acreditation::create([
            'date_release' => $dateCarbon->format('Y-m-d'),
        ]);

        foreach (AuditActivityEmployee::where('audit_activity_id', $auditActivityId)->get() as $pivot)
        {
            $pivot->acreditation_id = $acreditation->id;
            $pivot->save();
        }

        return $acreditation;
    }
}