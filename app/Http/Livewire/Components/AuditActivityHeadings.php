<?php

namespace App\Http\Livewire\Components;

use App\Models\AuditActivity;
use Livewire\Component;

class AuditActivityHeadings extends Component
{
    public $auditActivity;
    public $objective;

    public function mount(AuditActivity $audit, Bool $objective = false)
    {
        $this->auditActivity = $audit;
        $this->objective = $objective;
    }

    public function render()
    {
        return view('livewire.components.audit-activity-headings');
    }
}
