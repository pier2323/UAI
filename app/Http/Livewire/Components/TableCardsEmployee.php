<?php

namespace App\Http\Livewire\Components;

use App\Models\AuditActivity;
use App\Models\Employee;
use Livewire\Attributes\On;
use Livewire\Component;

class TableCardsEmployee extends Component
{
    public $employees;
    public $auditActivity;

    public function render()
    {
        return view('livewire.components.table-cards-employee');
    }

    public function mount(AuditActivity $auditActivity)
    {
        $this->auditActivity = $auditActivity;
    }

    #[On('saving')]
    public function save()
    {
        // todo sync employees 
        $this->auditActivity->employee()->detach();

        foreach ($this->employees as $employee) {
            $key = $employee['data']['id'];
            $role = $employee['role'] == 1 
            ? 'Coordinador'
            : 'Auditor';
            
            $this->auditActivity->employee()->attach([$key => ['role' => "$role"]]);
        }
    }

    public function addCard($id)
    {
        return Employee::with('jobTitle')->find($id);
    }

    public function prepare($employees)
    {
        $this->employees = $employees;
    }
}
