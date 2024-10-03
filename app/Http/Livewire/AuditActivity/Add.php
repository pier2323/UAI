<?php

namespace App\Http\Livewire\AuditActivity;

use App\Models\AuditActivity;
use Livewire\Component;

class Add extends Component
{
    public bool $open;
    public string $year;

    public AuditActivityForm $auditActivity;

    public function mount():void
    {
        $this->year = AuditActivity::all()->last()->year;
        $this->auditActivity->public_id = \App\Models\AuditActivity::all()->last()->public_id + 1;
    }
    
    public function render()
    {
        return view('livewire.audit-activity.add');
    }

    public function save():void
    {
        $this->auditActivity->validate();
        \App\Models\AuditActivity::create($this->auditActivity->data());
        $this->cleanAttributes();
        $this->dispatch('add-audit-activity-save-ok', message: 'Se ha guardado la auditoria con exito!');
    }

    public function cancel(): void
    {
        $this->cleanAttributes();
        $this->dispatch('add-audit-activity-cancel-ok', message: 'Se ha cancelado la operacion!');
    }

    private function cleanAttributes(): void
    {        
        $this->auditActivity->reset();
        $this->open = false;
    }
}
