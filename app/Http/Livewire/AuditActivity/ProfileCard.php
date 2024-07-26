<?php

namespace App\Http\Livewire\AuditActivity;

use Livewire\Attributes\Reactive;
use Livewire\Component;

class ProfileCard extends Component
{
    #[Reactive]
    public $employee;

    public function mount($employee)
    {
        $this->employee = $employee;
    }

    public function render()
    {
        return view('livewire.audit-activity.profile-card');
    }
}
