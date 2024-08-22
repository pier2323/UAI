<?php

namespace App\Http\Livewire\AuditActivity;

use App\Http\Livewire\Components\PlanningSchedule;
use App\Models\AuditActivity;
use App\Models\Employee;
use App\Services\DesignationService;
use Livewire\Component;

class Show extends Component
{
    public $auditActivity;
    public $employees = [];

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
        // todo update dates in App\Http\Livewire\Components\PlanningSchedule 
        $this->dispatch('saving')->to(PlanningSchedule::class);

        // todo sync employees 
        $this->auditActivity->employee()->detach();

        foreach ($this->employees as $value) {
            $key = $value['data']['id'];
            $role = $value['role'] == 1 
            ? 'Coordinador'
            : 'Auditor';
            
            $this->auditActivity->employee()->attach([$key => ['role' => "$role"]]);
        }

        $this->dispatch('saved', message: 'guardado');
    }

    public function addCard($id)
    {
        return Employee::with('jobTitle')->find($id);
    }

    public function getDesignationDocument(DesignationService $designation)
    {
       return $designation->generate($this->auditActivity);
    }

    public function prepare($employees)
    {
        $this->employees = $employees;
    }
}
