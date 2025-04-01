<?php

namespace App\Form\AuditActivity\Show;

use App\Models\AuditActivity;
use App\Models\TypeAudit;
use App\Repositories\AuditActivityRepository;
use App\Traits\ModelPropertyMapper;
use Carbon\Carbon;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Form;

final class PlanningScheduleForm extends Form
{
    use ModelPropertyMapper;

    const string format = 'd/m/Y';

    #[Validate('required', as: "Dias de planificacion")]
    public $planning_days;

    #[Validate('required', as: "Dias de ejecución")]
    public $execution_days;

    #[Validate('required', as: "Dias del informe preliminar")]
    public $preliminary_days;

    #[Validate('required', as: "Dias de descargo")]
    public $download_days;

    #[Validate('required', as: "Dias del informe definitivo")]
    public $definitive_days;

    #[Validate('required', as: "Fecha de inicio de la planificación")]
    public $planning_start;

    #[Validate('required', as: "Fecha de inicio de la Ejecución")]
    public $execution_start;

    #[Validate('required', as: "Fecha de inicio del informe preliminar")]
    public $preliminary_start;

    #[Validate('required', as: "Fecha de inicio de descargo")]
    public $download_start;

    #[Validate('required', as: "Fecha de inicio del informe definitivo")]
    public $definitive_start;

    #[Validate('required', as: "Fecha de fin de la planificación")]
    public $planning_end;

    #[Validate('required', as: "Fecha de fin de la ejecución")]
    public $execution_end;

    #[Validate('required', as: "Fecha de fin del informe preliminar")]
    public $preliminary_end;

    #[Validate('required', as: "Fecha de fin de descargo")]
    public $download_end;

    #[Validate('required', as: "Fecha de fin del informe definitivo")]
    public $definitive_end;

    public object|null $dates;

    public function mount(): void
    {
        $this->dates = (object) $this->except('dates');
    }

    public function save(AuditActivityRepository $repository, object $object): void
    {
        $this->loadVariablesFromDates();
        
        $this->conditionValidate((object) $object->type_audit);

        $dates = !\in_array($object->type_audit['code'], ['as', 'ae']) 
        ? $dates = $this->getPropertiesForCarbon()
        : array_diff($this->getPropertiesForCarbon(), $this->getPropertiesPreliminaryAndDownload());

        // todo format dates
        foreach ($this->only($dates) as $key => $value) {
            $dateCarbon = Carbon::createFromFormat(self::format, $value);
            $this->{$key} = $dateCarbon->format('Y-m-d');
        }

        // todo update dates
        $repository->makeQuery()->update($this->all());

        $this->mapModelProperties($repository->makeQuery(), $this->except('dates'));
        $this->mount();
    }

    public function load(AuditActivityRepository $repository)
    {
        $this->mapModelProperties($repository->makeQuery(), $this->except('dates'));
        $this->mount();
    }

    public function delete(AuditActivityRepository $repository): void
    {
        $this->reset();

        $this->load($repository);
    }

    private function loadVariablesFromDates(): void
    {
        foreach ($this->dates as $property => $date) $this->{$property} = $date;
    }

    private function getPropertiesForCarbon(): array
    {
        return [
            'planning_start',
            'planning_end',
            'execution_start',
            'execution_end',
            'preliminary_start',
            'preliminary_end',
            'download_start',
            'download_end',
            'definitive_start',
            'definitive_end',
        ];
    }

    private function getPropertiesPreliminaryAndDownload(): array
    {
        return [
            'preliminary_start',
            'download_start',
            'preliminary_end',
            'download_end',
            'preliminary_days',
            'download_days',
            'dates',
        ];
    }
    
    private function conditionValidate(object $typeAudit)
    {
        if(!\in_array($typeAudit->code, ['as', 'ae'])) 
        return $this->validate();
        
        $except = $this->except($this->getPropertiesPreliminaryAndDownload());
        $attributes = \array_keys($except);

        foreach ($attributes as $attribute)
        $this->validateOnly($attribute);
    }
}
