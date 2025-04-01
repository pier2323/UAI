<?php

namespace App\Http\Livewire\AuditActivity\Show;

use App\Actions\AuditActivityActions\DeletedDesignationComissionAction;
use App\Actions\AuditActivityActions\GetDesignationDocument;
use App\Actions\AuditActivityActions\SyncDesignationComissionAction;
use App\Actions\DesignationAcreditation\Designate;
use App\Form\AuditActivity\Show\PlanningScheduleForm;
use App\Form\HandoverDocument\TableCardsEmployeeForm;
use App\Repositories\AcreditationRepository;
use App\Repositories\AuditActivityRepository;
use App\Repositories\ComissionRepository;
use App\Repositories\DesignationRepository;
use Livewire\Attributes\Modelable;
use Livewire\Component;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class Designation extends Component
{
    use \App\Traits\RenderComponentTrait;
    const view = 'livewire.audit-activity.show.designation';

    public AuditActivityRepository $repository;

    #[Modelable]
    public object $object;

    public TableCardsEmployeeForm $tableEmployees;
    public PlanningScheduleForm $planningSchedule;
    public DesignationRepository $designation;
    public AcreditationRepository $acreditation;
    public ComissionRepository $comission;
    public bool $isEditing = false;
    public bool $isDeleting = false;
    public bool $isCreated = false;
    public bool $isAcredit = false;

    public function mount(): void
    {
        $this->planningSchedule->mount(); // ! 

        $this->comission = new ComissionRepository($this->object->id);

        // finish the function if is created
        $this->isCreated = $this->isDesignated();
        if (!$this->isCreated) return;

        // load data
        $this->tableEmployees->load($this->repository);
        $this->planningSchedule->load($this->repository);
        
        $this->designation = new DesignationRepository($this->comission['designation_id']);

        $this->isAcredit = $this->isAcredited();

        if (!$this->isAcredit) return;
        $this->acreditation = new AcreditationRepository($this->comission['acreditation_id']);
    }

    public function designate(): void
    {
        $this->tableEmployees->validate();
        
        $this->planningSchedule->save($this->repository, $this->object);
        
        $action = new Designate($this->planningSchedule->dates->planning_start);
        $designationModel = $action();
        $this->designation = new DesignationRepository($designationModel->id);
        
        $this->tableEmployees->save(
            repository: $this->repository,
            action: new SyncDesignationComissionAction(),
            designation: $this->designation->object['id'],
        );
        
        $this->isCreated = true;
        $this->dispatch('designation_designate', message: \__('se ha designado la comision correctamente!'));
    }

    public function getDesignationDocument(GetDesignationDocument $action): BinaryFileResponse
    {
        return $action($this->object, $this->designation, $this->repository);
    }

    public function cancelEdit(): void
    {
        $this->planningSchedule->mount();
        $this->isEditing = false;
    }

    public function update(): void
    {
        $action = new Designate($this->planningSchedule->dates->planning_start);
        $designationModel = $action();
        $this->designation = new DesignationRepository($designationModel->id);

        $this->planningSchedule->save($this->repository, $this->object);
        $this->tableEmployees->save(
            repository: $this->repository,
            action: new SyncDesignationComissionAction(),
            designation: $this->designation->object['id'],
        );
        
        $this->mount();

        $this->isEditing = false;
        $this->dispatch('designation_updated', message: \__('se ha actualizado la comision correctamente!'));
    }

    public function delete(DeletedDesignationComissionAction $action): void 
    {
        $action($this->repository, (object) [
          'designation' => $this->designation,
          'acreditation' => $this->acreditation ?? null
        ]);
        
        // reseting properties
        $this->reset([
            'designation',
            'acreditation',
            'isCreated',
            'isDeleting',
        ]);

        // reseting forms
        $this->planningSchedule->delete($this->repository);
        $this->tableEmployees->list = array();

        $this->dispatch('designation_deleted', message: 'se ha eliminado la comisión y la planificación correctamente!');
        $this->dispatch('deleted');
    }

    public function updateTableEmployee($data): void //  ? using in table-cards-employees
    {
        $this->tableEmployees->update($data);
    }

    private function isDesignated(): bool
    {
        return !empty($this->comission->object);
    }

    private function isAcredited(): bool
    {
        return $this->comission['acreditation_id'] !== null;
    }
}
