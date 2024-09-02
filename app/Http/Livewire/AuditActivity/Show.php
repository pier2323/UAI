<?php

namespace App\Http\Livewire\AuditActivity;

use App\Http\Livewire\Components\PlanningSchedule;
use App\Http\Livewire\Components\TableCardsEmployee;
use App\Models\AuditActivity;
use App\Models\Employee;
use App\Services\DesignationService;
use Livewire\Component;

class Show extends Component
{
    public $auditActivity;

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
        foreach ([
            PlanningSchedule::class,
            TableCardsEmployee::class
            ] 
            as $component) 
        {
            $this->dispatch('saving')->to($component);
        }

        $this->dispatch('saved', message: 'guardado');
    }

    public function getDesignationDocument(DesignationService $designation)
    {
       return $designation->generate($this->auditActivity);
    }
}
