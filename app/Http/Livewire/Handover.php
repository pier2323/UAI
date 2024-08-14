<?php

namespace App\Http\Livewire;

use App\Models\AuditActivity;
use Livewire\Component;

class Handover extends Component
{
    public $employees = [];
    public $AuditActivity =[];
    public function render()
    {
        return view('livewire.handover');
    }

    public function mount()
    {
        $this->employees = \App\Models\Employee::all();
        $relations = ['employee', 'typeAudit', 'handoverDocument', 'uai'];
        $this->AuditActivity = AuditActivity::with($relations)->get();

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