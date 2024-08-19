<?php

namespace App\Http\Livewire\Components;

use App\Models\AuditActivity;
use Carbon\Carbon;
use Livewire\Attributes\On;
use Livewire\Component;

class PlanningSchedule extends Component
{
    public 
    $planning_days = '5', $execution_days = '10', $preliminary_days = '10', $download_days = '10', $definitive_days = '5',
    $planning_start, $execution_start, $preliminary_start, $download_start, $definitive_start,
    $planning_end, $execution_end, $preliminary_end, $download_end, $definitive_end;

    public $auditActivity;

    public function mount(AuditActivity $auditActivity)
    {
        $this->auditActivity = $auditActivity;
    }

    public function render()
    {
        return view('livewire.components.planning-schedule');
    }

    #[On('saving')]
    public function save()
    {        
        $format = 'd/m/Y';

        $dates = [
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
        
        // todo format dates 
        foreach ($this->only($dates) as $key => $value) {
            $dateCarbon = Carbon::createFromFormat($format, $value);
            $this->{$key} = $dateCarbon->format('Y-m-d');
        }
        
        // todo update dates 
        $this->auditActivity->update($this->toArray());
    }

}