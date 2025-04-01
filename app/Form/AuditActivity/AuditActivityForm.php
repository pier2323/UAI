<?php

namespace App\Form\AuditActivity;

use Livewire\Attributes\Validate;
use Livewire\Form;

class AuditActivityForm extends Form
{
    #[Validate('required|numeric|unique:App\Models\AuditActivity,public_id', as: 'Código')]
    public string $public_id  = '';

    #[Validate(['required', ], as: 'Descripcion')]
    public string $description = '';

    #[Validate(['required', ], as: 'Objetivo')]
    public string $objective = '';

    #[Validate('required', as: 'Area')]
    public string $area = '';

    #[Validate(['required'], as: 'Tipo de Auditoria')]
    public string $type_audit = '';

    #[Validate(['required'], as: 'Mes inicio')]
    public string $month_start = '';

    #[Validate(['required'], as: 'Mes fin')]
    public string $month_end = '';

    #[Validate(['required'], as: 'Mes fin')]
    public string $uai = '';

    #[Validate(['boolean'], as: 'Poa')]
    public bool $is_poa = false;

    public function data(): array
    {
        return [
            'public_id' => $this->public_id,
            'description' => $this->description,
            'objective' => $this->objective,
            'month_start' => $this->month_start,
            'month_end' => $this->month_end,
            'is_poa' => $this->is_poa,
            'year' => \App\Models\Year::pluck('active')->first(),
            'area_id' => \App\Models\Area::where('name', $this->area)->first()->id,
            'type_audit_id' => \App\Models\TypeAudit::where('name', $this->type_audit)->first()->id,
            'uai_id' => \App\Models\Uai::where('name', $this->uai)->first()->id,
        ];
    }

    public function getObjective($handoverDocument): string
    {
        $departament = $handoverDocument->departament;
        $departament_affiliation = $handoverDocument->departament_affiliation;

        $fullnameOutgoing = $handoverDocument->employeeOutgoing->names();

        $personal_id = $handoverDocument->employeeOutgoing->personal_id;
        $subscription = $handoverDocument->subscription->format('d/m/Y');

        return "Actuación Fiscal \"Verificación de la sinceridad y exactitud del contenido del acta de entrega de la $departament adscripta a la $departament_affiliation de la Cantv, correspiente al servidor(a) ciudadano(a) $fullnameOutgoing, titular de la cedula de indentidad V-$personal_id, suscrita en fecha $subscription\"";
    }
}
