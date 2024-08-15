<?php

namespace App\Http\Livewire\Handover;

use App\Models\AuditActivity;
use Livewire\Component;

class Main extends Component
{
    public $employees = [];
    public $AuditActivity =[];
    public function render()
    {
        return view('livewire.handover.main');
    }

    public function mount()
    {
        $this->employees = \App\Models\Employee::all();
        $relations = ['employee', 'typeAudit', 'handoverDocument', 'uai'];
        $this->AuditActivity = AuditActivity::with($relations)->where('type_audit_id', 1)->get();

    }

    public function hola($id)
    {
        $route = route('handover.show', $id);
        $this->redirect(
            url: $route, 
            navigate: true
        );
    }

}