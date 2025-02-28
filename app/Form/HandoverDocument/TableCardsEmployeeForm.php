<?php

namespace App\Form\HandoverDocument;

use App\Models\AuditActivity;
use Livewire\Attributes\Modelable;
use Livewire\Attributes\Validate;
use Livewire\Form;

final class TableCardsEmployeeForm extends Form
{
    #[Validate('required|array|between:2,20', as: 'Lista de Auditores')]
    public array $list = array();
    public int $auditorNumber = 0;

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
        $employeesArray = array();
        $employees = $auditActivity
        ->employee()
        ->with('jobTitle')
        ->get()
        ->toArray();

        foreach($employees as $employee) {
            // $employee->jobTitle->first();

            // dd($employee);
            array_push($employeesArray, [
                'data' => $employee,
                'role' => $employee['pivot']['role'],
            ]);
        }

        $this->list = $employeesArray;
    }

    public function update($data): void
    {
        $this->list = $data;
        $this->auditorNumber = count($this->list) + 1;
    }
}
