<?php

namespace App\Http\Livewire\Handover;

use App\Models\AuditActivity;
use App\Models\Designation;
use Livewire\Component;
use Livewire\Attributes\Title;
#[Title('Sap_UAI')] 

class Main extends Component
{
    public $query = '';
    public function render()
    {

        return view('livewire.handover.main', [
           
            'designations' => Designation::with(
                ['auditActivity' => function ($query) {
                    $query->with([
                        'handoverDocument' => [
                            'employeeIncoming',
                            'employeeOutgoing' => [
                                
                            ],
                        ],
                        'typeAudit',
                        'uai',])
                        ->where('audit_activity.description','like', "%$this->query%")
                        ->orWhere('audit_activity.year','like', "%$this->query%")
                        ->orWhere('audit_activity.month_start','like', "%$this->query%")
                        ->orderBy('audit_activity.id', 'asc')
                        ->get();
                }]
            )->paginate(perPage: 10)
        ]);
    }

    public function goTo(string $route, int $id)
    {
        // Redirigir a la ruta especificada
        $this->redirectRoute($route, ['auditActivity' => $id], navigate: true);
        
        
    }

}