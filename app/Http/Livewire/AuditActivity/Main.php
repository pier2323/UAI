<?php

namespace App\Http\Livewire\AuditActivity;

use App\Models\AuditActivity;
use Livewire\Component;
use Livewire\Features\SupportPagination\WithoutUrlPagination;
use Livewire\WithPagination;

class Main extends Component
{
    use WithPagination, WithoutUrlPagination;

    public string $query = '';

    public function render()
    {
        return view('livewire.audit-activity.main', ['auditActivities' => AuditActivity::with([
            'handoverDocument' => [
                'employeeIncoming',
                'employeeOutgoing',
            ],
            'typeAudit',
            'uai',])
            ->whereDecode("$this->query")
            ->orwhere('description','like', "%$this->query%")
            ->orWhere('year','like', "%$this->query%")
            ->orWhere('month_start','like', "%$this->query%")
            ->orderBy('id', 'asc')
            ->paginate(10)]);
    }

    public function search()
    {

    }

    public function goTo(int $id)
    {
        $this->redirectRoute('auditActivity.show', ['public_id' => $id], navigate: true);
    }

}