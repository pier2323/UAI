<?php

namespace App\Http\Livewire\AuditActivity\Show\RegisterFormHandoverDocument;

use App\Models\AuditActivity;
use Livewire\Attributes\Validate;
use Livewire\Form;

final class TableCardsEmployeeForm extends Form
{
    public array $list = array();

    public bool $verified = false;

    public function save(AuditActivity $auditActivity, ?int $designation = null, ?int $acreditation = null): array
    {
        // todo sync employees

        $employees = array();

        // foreach ($this->list as $employee) {
        //     $employees[] = $employee['data']['first_name'];
        // }

        // dd($employees);

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
    }
}
