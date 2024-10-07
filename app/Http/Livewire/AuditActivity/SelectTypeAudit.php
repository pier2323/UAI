<?php

namespace App\Http\Livewire\AuditActivity;

use App\Models\TypeAudit;
use Livewire\Attributes\Modelable;
use Livewire\Component;

class SelectTypeAudit extends Component
{
    #[Modelable]
    public string $selected;

    public $typeAudits;

    public function mount()
    {
        $this->typeAudits = TypeAudit::all();
    }

    public function render()
    {
        return view('livewire.audit-activity.select-type-audit');
    }
}
