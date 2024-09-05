<?php

namespace App\Http\Livewire\AuditActivity;

use App\Http\Livewire\Components\PlanningSchedule;
use App\Http\Livewire\Components\TableCardsEmployee;
use App\Models\AuditActivity;
use App\Services\AcreditationService;
use App\Services\DesignationService;
use LaraDumps\LaraDumps\Livewire\Attributes\Ds;
use Livewire\Attributes\Renderless;
use Livewire\Attributes\Session;
use Livewire\Component;

#[Ds]
class Show extends Component
{
    #[Session]
    public AuditActivity $auditActivity;

    public function render()
    {
        return view('livewire.audit-activity.show')
        ->title($this->auditActivity->code());
    }

    #[Renderless]
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

    #[Renderless]
    public function getDesignationDocument()
    {
        $designation = new DesignationService($this->auditActivity);
        return $designation->download();
    }
    
    #[Renderless]
    public function getAcreditationDocument()
    {
        $acreditation = new AcreditationService($this->auditActivity);
        return $acreditation->download();
    }
}
