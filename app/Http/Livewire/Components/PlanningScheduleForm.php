<?php

namespace App\Http\Livewire\Components;

use App\Models\AuditActivity;
use App\Traits\ModelPropertyMapper;
use Carbon\Carbon;
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

    public object $dates;

    public function mount(): void
    {
        $this->dates = (object) $this->except('dates');
    }

    public function save(AuditActivity $auditActivity)
    {
        $this->validate();
        $dates = $this->getPropertiesForCarbon();

        // todo format dates
        foreach ($this->only($dates) as $key => $value) {
            $dateCarbon = Carbon::createFromFormat(self::format, $value);
            $this->{$key} = $dateCarbon->format('Y-m-d');
        }

        // todo update dates
        $auditActivity->update($this->all());

        $this->mapModelProperties($auditActivity, $this->all());
    }

    public function load(AuditActivity $auditActivity)
    {
        $this->mapModelProperties($auditActivity, $this->all());
    }

    public function delete(AuditActivity $auditActivity): void
    {
        $this->reset();

        $auditActivity->update($this->all());
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
}
