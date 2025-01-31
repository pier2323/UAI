<?php

namespace App\Http\Livewire\Components;

use App\Http\Livewire\Components\PlanningScheduleForm;
use App\Models\Acreditation;
use App\Models\AuditActivity;
use App\Models\Designation;
use App\Models\NotWorkingDays;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Modelable;
use Livewire\Attributes\On;
use Livewire\Attributes\Reactive;
use Livewire\Component;

class PlanningSchedule extends Component
{
    #[Reactive]
    public bool $isEditing = false;

    #[Modelable]
    public object $dates;

    #[Locked]
    public $excludeDays;

    #[Locked]
    public AuditActivity $auditActivity;

    #[Reactive]
    public Designation|null $designation;

    public Acreditation|null $acreditation;

    public function mount()
    {
        $this->excludeDays = NotWorkingDays::pluck('day');
    }

    public function render()
    {
        return view('livewire.components.planning-schedule');
    }
}
