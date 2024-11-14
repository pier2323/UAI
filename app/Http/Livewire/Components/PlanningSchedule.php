<?php

namespace App\Http\Livewire\Components;

use App\Models\Acreditation;
use App\Models\AuditActivity;
use App\Models\Designation;
use App\Models\NotWorkingDays;
use App\Traits\ModelPropertyMapper;
use Carbon\Carbon;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Attributes\Reactive;
use Livewire\Component;

class PlanningSchedule extends Component
{
    use ModelPropertyMapper;

    const string format = 'd/m/Y';

    #[Reactive]
    public bool $isEditing = false;

    public
    $planning_days, $execution_days, $preliminary_days, $download_days, $definitive_days,
    $planning_start, $execution_start, $preliminary_start, $download_start, $definitive_start,
    $planning_end, $execution_end, $preliminary_end, $download_end, $definitive_end;

    #[Locked]
    public $excludeDays;

    #[Locked]
    public AuditActivity $auditActivity;

    public Designation|null $designation;

    public Acreditation|null $acreditation;


    public function mount()
    {
        if (isset($this->designation)) $this->mapModelProperties($this->auditActivity, $this->except($this->getPropertiesExcludes()));

        $this->excludeDays = NotWorkingDays::pluck('day');
    }

    public function render()
    {
        return view('livewire.components.planning-schedule');
    }

    #[On('saving')]
    public function save()
    {
        $dates = $this->getPropertiesForCarbon();

        // todo format dates
        foreach ($this->only($dates) as $key => $value) {
            $dateCarbon = Carbon::createFromFormat(self::format, $value);
            $this->{$key} = $dateCarbon->format('Y-m-d');
        }

        // todo update dates
        $this->auditActivity->update($this->all());

        $this->mapModelProperties($this->auditActivity, $this->except($this->getPropertiesExcludes()));
    }

    #[On('cancelEdit')]
    public function cancelEdit(): void
    {
        $this->mount();
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

    private function getPropertiesExcludes(): array
    {
        return [
            'excludeDays',
            'auditActivity',
            'designation',
            'acreditation',
            'isEditing',
        ];
    }
}
