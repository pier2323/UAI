<?php

namespace App\Http\Livewire\Handover;

use App\Models\AuditActivity;
use App\Models\Designation;
use Livewire\Component;

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
                                'jobTitle',
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

    public function goTo($route, $id)
    {
        $this->redirectRoute($route, ['designation' => $id], navigate: true);
    }

}