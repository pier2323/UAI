<?php

namespace App\Form\HandoverDocument;

use App\Actions\AuditActivityActions\SyncDesignationComissionAction;
use App\Models\AuditActivity;
use App\Repositories\AuditActivityRepository;
use Livewire\Attributes\Modelable;
use Livewire\Attributes\Validate;
use Livewire\Form;

final class TableCardsEmployeeForm extends Form
{
    #[Validate('required|array|between:2,20', as: 'Lista de Auditores')]
    public array $list = array();
    public int $auditorNumber = 0;

    public bool $verified = false;

    public function save(AuditActivityRepository $repository, SyncDesignationComissionAction $action, ?int $designation = null, ?int $acreditation = null): array
    {
        $this->validate();

        return $action($repository, $this->list, $designation, $acreditation);
    }

    public function load(AuditActivityRepository $repository): void
    {
        $employeesArray = array();
        $employees = $repository
        ->makeQuery()
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
