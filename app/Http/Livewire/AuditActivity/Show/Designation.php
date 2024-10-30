<?php

namespace App\Http\Livewire\AuditActivity\Show;

use App\Http\Livewire\AuditActivity\Show\RegisterFormHandoverDocument\TableCardsEmployeeForm;
use App\Http\Livewire\Components\PlanningSchedule;
use App\Http\Livewire\Components\TableCardsEmployee;
use App\Models\AuditActivity;
use App\Models\Acreditation as ModelsAcreditation;
use App\Models\AuditActivityEmployee;
use App\Models\Designation as ModelsDesignation;
use App\Services\DesignationService;
use Livewire\Attributes\Renderless;
use Livewire\Component;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class Designation extends Component
{
    public TableCardsEmployeeForm $tableEmployees;

    public AuditActivity $auditActivity;
    public ?ModelsDesignation $designation;
    public ?ModelsAcreditation $acreditation;
    public bool $isEditing = false;
    public bool $isDeleting = false;
    public bool $isCreated = false;

    public function mount(): void
    {
        $this->isCreated = $this->isDesignated();

        if ($this->isCreated) {
            $this->tableEmployees->load($this->auditActivity);
            $this->designation = $this->getDesignationModel();
        }
    }

    public function render()
    {
        return view('livewire.audit-activity.show.designation');
    }

    public function designate(): void
    {
        $this->designation = $this->create();

       $this->tableEmployees->save(
            $this->auditActivity,
            designation: $this->designation->id
        );

        $this->dispatch('designation_designate', message: \__('se ha designado la comision correctamente!'));
    }

    #[Renderless]
    public function getDesignationDocument(): BinaryFileResponse
    {
        $code = $this->auditActivity->code;
        $designation = new DesignationService($this->auditActivity, date: $this->designation->date_release, nameDocument: "UAI-GCP-DES-COM $code.docx");
        $this->dispatch('designation_download', message: \__('se ha iniciado la descarga!'));
        return $designation->download();
    }

    public function create()
    {
        return ModelsDesignation::create([
            'date_release' => $this->auditActivity->planning_start ?? now()->format("Y-m-d"),
        ]);
    }

    public function edit(): void
    {
        $this->isEditing = true;
    }

    public function cancelEdit(): void
    {
        foreach([TableCardsEmployee::class, PlanningSchedule::class] as $component)
        $this->dispatch('cancelEdit')->to($component);
        $this->isEditing = false;
    }

    public function update(): void
    {
        $this->designation->update(['date_release' => $this->auditActivity->planning_start ?? now()->format("Y-m-d"),]);

        $this->tableEmployees->save(
            $this->auditActivity,
            designation: $this->designation->id
        );

        $this->dispatch('designation_updated', message: \__('se ha actualizado la comision correctamente!'));
        $this->isEditing = false;
    }

    public function delete()
    {
        $this->auditActivity->employee()->detach();
        $this->designation = ModelsDesignation::make();
        $this->isCreated = false;
        $this->isDeleting = false;
        $this->tableEmployees->list = array();
        $this->dispatch('deleted');
    }

    private function isDesignated(): bool
    {
        return $this->auditActivity->employee()->first() !== null ? true : false;
    }

    private function getDesignationModel(): ModelsDesignation
    {
        return AuditActivityEmployee::where('audit_activity_id', $this->auditActivity->id)->first()->designation()->first();
    }

    public function updateTableEmployee($data): void
    {
        $this->tableEmployees->update($data);
    }
}
