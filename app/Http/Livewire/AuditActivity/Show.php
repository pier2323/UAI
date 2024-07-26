<?php

namespace App\Http\Livewire\AuditActivity;

use App\Models\AuditActivity;
use App\Models\Employee;
use Livewire\Component;

class Show extends Component
{
    public $auditActivity;
    public $employees;
    public $employee;
    public $fullName;
    public $profile_photo;
    public $hola;
    public $cards = 0; 

    public function render()
    {
        return view('livewire.audit-activity.show');
    }

    public function mount($id)
    {
        $this->cards = 0;
        $this->auditActivity = AuditActivity::find($id);
        $this->employees = Employee::all();
    }

    public function query($id)
    {
        return Employee::with('jobTitle')->find($id);
    }
}
