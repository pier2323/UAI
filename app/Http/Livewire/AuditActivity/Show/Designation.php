<?php

namespace App\Http\Livewire\AuditActivity\Show;

use App\Models\AuditActivity;
use App\Models\Acreditation as ModelsAcreditation;
use App\Models\Designation as ModelsDesignation;
use App\Services\DesignationService;
use Livewire\Attributes\Renderless;
use Livewire\Component;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class Designation extends Component
{
    public AuditActivity $auditActivity;
    public ?ModelsDesignation $designation;
    public ?ModelsAcreditation $acreditation;

    public function render()
    {
        return view('livewire.audit-activity.show.designation');
    }

    public function designate(): void
    {
        $this->designation = ModelsDesignation::create([
            'date_release' => $this->auditActivity->planning_start, 
            'pivot_id' => $this->auditActivity->employee()->first()->pivot->id,
        ]);

        $this->dispatch('designation_designate', message: \__('se ha designado la comision correctamente!'));
    }

    #[Renderless]
    public function getDesignationDocument(): BinaryFileResponse
    {
        $designation = new DesignationService($this->auditActivity, date: $this->designation->date_release);
        $this->dispatch('designation_download', message: \__('se ha iniciado la descarga!'));
        return $designation->download();
    }
}
