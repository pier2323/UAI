<?php

namespace App\Http\Livewire\Handover;

use App\Models\Audit;
use App\Models\AuditActivity;
use App\Models\AuditActivityEmployee;
use App\Models\Designation;
use Livewire\Component;
use Livewire\Attributes\Title;


#[Title('Sap_UAI')] 
class Main extends Component
{
    // public $query = '';
    public function render()
    {

        return view('livewire.handover.main', [
           
            'auditActivity' => $this->query()
        ]);
    }

    public function goTo(int $id)
    {
        $this->redirectRoute('handover.show', ['public_id' => $id], navigate: true);
       
    }

    private function query()
    {
        $auditActivies = array();
        foreach(AuditActivity::with($this->queryEmployee())->get() as $auditActivity) {
            if($auditActivity->employee->isEmpty()) continue;

            $auditActivies[] = $auditActivity;
        }

        return $auditActivies;
    }

    private function queryEmployee(): array    
    {
        return [
            'employee' => function ($query) {
                $query->first();
            },
        ];
    }




}