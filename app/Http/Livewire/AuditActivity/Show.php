<?php

namespace App\Http\Livewire\AuditActivity;

use App\Models\Acreditation;
use App\Models\AuditActivity;
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
    public $pivotEmployee;

    public function render(): Renderable
    {
        return view('livewire.audit-activity.show');
    }

    public function mount(): void
    {
        if ($this->auditActivity->isDesignated()) $this->designation = $this->auditActivity->designation()->first();
        if ($this->auditActivity->isAcredited()) $this->acreditation = $this->auditActivity->acreditation()->first();
    }

    public function designate(): void
    {
        $this->designation = Designation::create([
            'date_release' => $this->auditActivity->planning_start, 
            'pivot_id' => $this->auditActivity->employee()->first()->pivot->id,
        ]);

        $this->dispatch('designation', message: \__('se ha designado la comision correctamente!'));
    }

    
    public function accredit(): void
    {
        $this->acreditation = Acreditation::create([
            'date_release' => $this->accreditDateRelease, 
            'pivot_id' => $this->auditActivity->employee()->first()->pivot->id,
        ]);

        $this->dispatch('saved', message: \__('se ha acreditado la comision correctamente!'));
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