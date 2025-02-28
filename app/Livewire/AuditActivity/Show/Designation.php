<?php

namespace App\Livewire\AuditActivity\Show;

use App\Actions\DesignationAcreditation\Designate;
use App\Form\AuditActivity\Show\PlanningScheduleForm;
use App\Form\HandoverDocument\TableCardsEmployeeForm;
use App\Models\AuditActivity;
use App\Models\Acreditation as ModelsAcreditation;
use App\Models\AuditActivityEmployee;
use App\Models\Designation as ModelsDesignation;
use App\Models\TypeAudit;
use App\Services\DesignationService;
use Livewire\Attributes\Modelable;
use Livewire\Attributes\Reactive;
use Livewire\Attributes\Renderless;
use Livewire\Component;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class Designation extends Component
{
    #[Modelable]
    public AuditActivity $auditActivity;

    public TableCardsEmployeeForm $tableEmployees;
    public PlanningScheduleForm $planningSchedule;
    public ?ModelsDesignation $designation;
    public ?ModelsAcreditation $acreditation;
    public ?AuditActivityEmployee $pivot;
    public TypeAudit $typeAudit;
    public bool $isEditing = false;
    public bool $isDeleting = false;
    public bool $isCreated = false;
    public bool $isAcredit = false;

    public function mount(): void
    {
        $this->planningSchedule->mount();
        $this->isCreated = $this->isDesignated();

        if (!$this->isCreated) return;
        
        $this->tableEmployees->load($this->auditActivity);
        $this->planningSchedule->load($this->auditActivity);
        $this->pivot = $this->getPivot();
        $this->designation = $this->getDesignationModel();
        $this->acreditation = $this->getAcreditationModel();
        $this->isAcredit = isset($this->acreditation) ? true : false;
    }

    public function render()
    {
        return view('livewire.audit-activity.show.designation');
    }

    public function designate(): void
    {
        $this->tableEmployees->validate();
        
        $this->planningSchedule->save($this->auditActivity);
        
        $this->designation = (new Designate($this->auditActivity))->create();
        
        $this->tableEmployees->save(
            $this->auditActivity,
            designation: $this->designation->id
        );
        
        $this->isCreated = true;
        $this->dispatch('designation_designate', message: \__('se ha designado la comision correctamente!'));
    }

    #[Renderless]
    public function getDesignationDocument(): BinaryFileResponse
    {
        $code = $this->auditActivity->code;

        if(\in_array($this->auditActivity->typeAudit->code, ['as', 'ae']) )
        $nameTemplate = 'designationTemplateForAsAndAE.docx';

        $designation = new DesignationService(
            auditActivity: $this->auditActivity, 
            date: $this->designation->date_release, 
            nameDocument: "UAI-GCP-DES-COM $code.docx", 
            nameTemplate: $nameTemplate ?? null
        );

        $this->dispatch('designation_download', message: \__('se ha iniciado la descarga!'));
        return $designation->download();
    }

    public function edit(): void
    {
        $this->isEditing = true;
    }

    public function cancelEdit(): void
    {
        // foreach([TableCardsEmployee::class] as $component)
        // $this->dispatch('cancelEdit')->to($component);
        // $this->isEditing = false;
    }

    public function update(): void
    {
        $this->designation->update(['date_release' => $this->planningSchedule->dates['planning_start']]);

        $this->tableEmployees->save(
            $this->auditActivity,
            designation: $this->designation->id
        );

        $this->dispatch('designation_updated', message: \__('se ha actualizado la comision correctamente!'));
        $this->isEditing = false;
    }

    public function delete()
    {
        $this->dispatch('designation_deleted', message: 'se ha eliminado la comisión y la planificación correctamente!');
        $this->dispatch('deleted');
        if(isset($this->designation)) {
            $this->designation->delete();
        }
        if(isset($this->acreditation)) {
            $this->acreditation->delete();
        }
        $this->auditActivity->employee()->detach();
        $this->designation = null;
        $this->acreditation = null;
        $this->isCreated = false;
        $this->isDeleting = false;
        $this->planningSchedule->delete($this->auditActivity);
        $this->designation = ModelsDesignation::make();
        $this->tableEmployees->list = array();
        $this->planningSchedule->load($this->auditActivity);
    }

    private function isDesignated(): bool
    {
        return $this->auditActivity->employee()->first() !== null ? true : false;
    }

    private function getPivot(): AuditActivityEmployee
    {
        return AuditActivityEmployee::where('audit_activity_id', $this->auditActivity->id)->first();
    }

    private function getDesignationModel(): ModelsDesignation
    {
        return $this->pivot->designation()->first();
    }

    private function getAcreditationModel(): ModelsAcreditation|null
    {
        return $this->pivot->acreditation()->first();
    }

    public function updateTableEmployee($data): void
    {
        $this->tableEmployees->update($data);
    }
}
