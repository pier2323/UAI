<?php

namespace App\Http\Livewire\AuditActivity;

use App\Http\Livewire\Components\PlanningSchedule;
use App\Http\Livewire\Components\TableCardsEmployee;
use App\Models\Acreditation;
use App\Models\AuditActivity;
use App\Models\AuditActivityEmployee;
use App\Models\Designation;
use App\Services\AcreditationService;
use App\Services\DesignationService;
use Illuminate\Contracts\Support\Renderable;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Renderless;
use Livewire\Component;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class Show extends Component
{
    #[Locked]
    public AuditActivity $auditActivity;

    public $acreditation;
    public $designation;

    public function render(): Renderable
    {
        return view('livewire.audit-activity.show');
    }

    public function mount(): void
    {
        $pivot = AuditActivityEmployee::where('audit_activity_id', $this->auditActivity->id)->first();

        if (isset($pivot)){
            $this->designation = Designation::where('pivot_id', $pivot->id)->first();
            $this->acreditation = Acreditation::where('pivot_id', $pivot->id)->first();
        }
    }

    #[Renderless]
    public function designate(): void
    {
        foreach ([PlanningSchedule::class, TableCardsEmployee::class] as $component) {
            $this->dispatch('saving')->to($component);
        }

        $this->dispatch('saved', message: 'designado!');
        $this->mount();
    }
    
    #[Renderless]
    public function accredit(): void
    {
        $this->acreditation = Acreditation::create(['date_release' =>
            $this->accreditDateRelease, 
            'pivot_id' => AuditActivityEmployee::
                where('audit_activity_id', $this->auditActivity->id)
                ->first()
                ->id,
        ]);

        $this->dispatch('saved', message: 'acreditado!');
    }

    #[Renderless]
    public function getDesignationDocument(): BinaryFileResponse
    {
        $designation = new DesignationService($this->auditActivity);
        return $designation->download();
    }
    
    #[Renderless]
    public function getAcreditationDocument(): BinaryFileResponse
    {
        $acreditation = new AcreditationService($this->auditActivity);
        return $acreditation->download();
    }
    
}
