<?php

namespace App\Http\Livewire\AuditActivity;

use App\Models\AuditActivity;
use Livewire\Component;

class Main extends Component
{
    public $auditActivities;

    public function render()
    {
        return view('livewire.audit-activity.main');
    }

    public function mount()
    {
        $this->auditActivities = AuditActivity::with([
            'handoverDocument' => [
                'employeeIncoming',
                'employeeOutgoing' => [
                    'jobTitle',
                ],
            ],

            'employee' => [
                'uai'
            ],

            'typeAudit',

        ])->get();
    }

    public function goTo($route, $id)
    {
        $this->redirectRoute($route, ['id' => $id], navigate: true);
    }

}