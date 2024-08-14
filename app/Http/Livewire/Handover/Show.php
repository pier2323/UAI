<?php

namespace App\Http\Livewire\Handover;

use App\Models\AuditActivity;
use Doctrine\Inflector\Rules\Word;
use Livewire\Component;

class Show extends Component
{
    public $auditActivity;
    public $employees = [];

    public $incoming =[];

    public $outgoing =[];

    public function mount($id)
    {
        $relations = ['employee', 'typeAudit', 'handoverDocument', 'uai'];
        $this->auditActivity = AuditActivity::with($relations)->findOrFail($id);
        $this->employees = \App\Models\Employee::all();
        $this->incoming = \App\Models\EmployeeIncoming::all();
        $this->outgoing  = \App\Models\EmployeeOutgoing::all();

       
    }
    
    public $p00;


    public function salve($id){

        dd($id);

    } 
    
    public function render()
    {
        return view('livewire.handover.show');
    }
}
