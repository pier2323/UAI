<?php

namespace App\Http\Livewire\Components;

use App\Models\AuditActivity;
use App\Models\Designation;
use App\Traits\ModelPropertyMapper;
use Carbon\Carbon;
use Livewire\Attributes\Validate;
use Livewire\Form;

final class PlanningScheduleForm extends Form
{
    use ModelPropertyMapper;

    const string format = 'd/m/Y';

    public
    $planning_days, $execution_days, $preliminary_days, $download_days, $definitive_days,
    $planning_start, $execution_start, $preliminary_start, $download_start, $definitive_start,
    $planning_end, $execution_end, $preliminary_end, $download_end, $definitive_end;

    public function save(AuditActivity $auditActivity)
    {
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
