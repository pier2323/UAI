<?php

namespace App\Http\Livewire\AuditActivity\Show\RegisterFormHandoverDocument;

use App\Models\AuditActivity;
use Livewire\Attributes\Validate;
use Livewire\Form;

final class TableCardsEmployeeForm extends Form
{
    #[Validate('required|array|between:2,20', as: 'Lista de Auditores')]
    public array $list = array();

    public bool $verified = false;

    public function save(AuditActivity $auditActivity, ?int $designation = null, ?int $acreditation = null): array
    {
        $this->validate();

        $employees = array();

        foreach ($this->list as $employee) {
            $id = $employee['data']['id'];
            $role = $employee['role'] == 1 ? 'Coordinador' : 'Auditor';

            $array = array();
            $array['role'] = $role;
            $array['designation_id'] = $designation;
            if(isset($acreditation)) $array['acreditation_id'] = $acreditation;

            $employees[$id] = $array;
        }

        return $auditActivity->employee()->sync($employees);
    }

    public function load(AuditActivity $auditActivity): void
    {
        $employees = array();
        foreach($auditActivity->employee()->get() as $employee) {

            $employee->jobTitle->first();

            array_push($employees, [
                'data' => $employee,
                'role' => $employee->pivot->role,
            ]);
        }

        $this->list = $employees;
    }

    public function update($data): void
    {
        $this->list = $data;
        $this->auditorNumber = count($this->list) + 1;
    }
}
