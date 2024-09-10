<?php

namespace App\Http\Livewire\Components;

use App\Models\AuditActivity;
use Livewire\Attributes\Locked;
use Livewire\Component;

class AuditActivityHeadings extends Component
{
    #[Locked]
    public AuditActivity $auditActivity;
    
    #[Locked]
    public $objective;

    public function mount(Bool $objective = false)
    {
        $this->objective = $objective;
    }

    public function render()
    {
        return view('livewire.components.audit-activity-headings');
    }
}
