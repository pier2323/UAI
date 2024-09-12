<?php

namespace App\Http\Livewire\Components;

use App\Models\Acreditation;
use App\Models\AuditActivity;
use App\Models\Designation;
use App\Models\NotWorkingDays;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class Resource extends JsonResource {
    public function __construct(private readonly AuditActivity $auditActivity){}

    public function toArray()
    {
        return [
            'date' => $this->auditActivity->planning_start
        ];
    }
}

class PlanningSchedule extends Component
{
    public 
    $planning_days = '5', $execution_days = '10', $preliminary_days = '10', $download_days = '10', $definitive_days = '5',
    $planning_start, $execution_start, $preliminary_start, $download_start, $definitive_start,
    $planning_end, $execution_end, $preliminary_end, $download_end, $definitive_end;

    #[Locked]
    public $excludeDays;

    #[Locked]
    public $auditActivity;
    public Designation|null $designation;
    public Acreditation|null $acreditation;

    public function mount(AuditActivity $audit)
    {
        $this->auditActivity = new Resource($audit);

        dd($this->auditActivity->toArray());

        // if (isset($this->designation)) {
        //     foreach ($this->getProperty() as $property) $this->{$property} = $this->auditActivity->{$property};
        // }

        // $this->excludeDays = NotWorkingDays::pluck('day');
    }

    public function render()
    {
        return view('livewire.components.planning-schedule');
    }

    #[On('saving')]
    public function save()
    {        
        $format = 'd/m/Y';

        $dates = $this->getProperty();
        
        // todo format dates 
        foreach ($this->only($dates) as $key => $value) {
            $dateCarbon = Carbon::createFromFormat($format, $value);
            $this->{$key} = $dateCarbon->format('Y-m-d');
        }
        
        // todo update dates 
        $this->auditActivity->update($this->all());
    }

    private function getProperty(): array 
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