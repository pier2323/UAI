<?php

namespace App\Http\Livewire\AuditActivity;

use App\Form\AuditActivity\AuditActivityForm;
use App\Models\AuditActivity;
use App\Models\HandoverDocument;
use Livewire\Attributes\On;
use Livewire\Component;

class Add extends Component
{
    public bool $open;

    public AuditActivityForm $auditActivity;
    public ?HandoverDocument $handoverDocument;

    public function mount():void
    {
        $this->auditActivity->public_id = AuditActivity::orderBy('public_id','asc')->get()->last()->public_id + 1;
    }

    public function render()
    {
        return view('livewire.audit-activity.add');
    }

    public function save():void
    {
        $this->auditActivity->validate();
        $auditActivity = AuditActivity::create($this->auditActivity->data());

        if(isset($this->handoverDocument)) {
            $this->handoverDocument->audit_activity_id = $auditActivity->id;
            $this->handoverDocument->save();
        };

        $this->cleanAttributes();
        $this->dispatch('add-audit-activity-save-ok', message: 'Se ha guardado la Actuación Fiscal con exito!');
    }

    public function cancel(): void
    {
        $this->cleanAttributes();
        $this->dispatch('add-audit-activity-cancel-ok', message: 'Se ha cancelado la operación!');
    }

    private function cleanAttributes(): void
    {
        $this->auditActivity->reset();
        $this->handoverDocument = null;
        $this->open = false;
    }

    #[On('add_handoverDocument')]
    public function attach($id)
    {
        $this->handoverDocument = HandoverDocument::with('employeeOutgoing')->find($id);
    }

    public function loadInputs(): void
    {
        if(isset($this->handoverDocument))
        $this->auditActivity->objective = $this->auditActivity->getObjective($this->handoverDocument);
    }
}
