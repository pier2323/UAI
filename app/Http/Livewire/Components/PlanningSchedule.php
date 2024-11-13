<?php

namespace App\Http\Livewire\Components;

use App\Http\Livewire\Components\PlanningScheduleForm;
use App\Models\Acreditation;
use App\Models\AuditActivity;
use App\Models\Designation;
use App\Models\NotWorkingDays;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Attributes\Reactive;
use Livewire\Component;

class PlanningSchedule extends Component
{
    #[Reactive]
    public bool $isEditing = false;

    public PlanningScheduleForm $dates;

    #[Locked]
    public $excludeDays;

    #[Locked]
    public AuditActivity $auditActivity;

    #[Reactive]
    public Designation|null $designation;

    public Acreditation|null $acreditation;

    public function mount()
    {
        if (isset($this->designation)) $this->dates->load($this->auditActivity);
        $this->excludeDays = NotWorkingDays::pluck('day');
    }

    #[On('saving')]
    public function save(): void
    {
        $this->dates->save($this->auditActivity);
    }

    #[On('deleted')]
    public function delete(): void
    {
        $this->dates->delete($this->auditActivity);
    }

    public function render()
    {
        return view('livewire.components.planning-schedule');
    }
}
