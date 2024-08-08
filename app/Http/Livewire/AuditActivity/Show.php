<?php

namespace App\Http\Livewire\AuditActivity;

use App\Http\Livewire\AuditActivity\Show\Schedule;
use App\Models\AuditActivity;
use App\Models\Employee;
use Livewire\Component;

class Show extends Component
{
    public $auditActivity;
    public $employees = [];
    public Schedule $schedule;

    public function mount($id)
    {
        $this->auditActivity = AuditActivity::find($id);
    }

    public function render()
    {
        return view('livewire.audit-activity.show');
    }

    public function save()
    {
        dd($this->schedule);
    }

    public function deleteCard($id)
    {
       $employee = array_search($id ,$this->employees);
        if ($employee !== false) {
            array_splice($this->employees, $employee, 1);
        }
    }

    public function addCard($id)
    {
        array_push($this->employees, $id);
        return Employee::with('jobTitle')->find($id);
    }
}
