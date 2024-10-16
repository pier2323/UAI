<?php

namespace App\Http\Livewire\AuditActivity;

use App\Models\AuditActivity;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use Livewire\Features\SupportPagination\WithoutUrlPagination;
use Livewire\WithPagination;

class Main extends Component
{
    use WithPagination, WithoutUrlPagination;

    public string $query = '';

    public Collection $auditActivityPoa;
    public Collection $auditActivityNoPoa;

    public function mount(): void
    {
        $this->auditActivityPoa = AuditActivity::with([
            'handoverDocument' => [
                'employeeIncoming',
                'employeeOutgoing',
            ],
            'typeAudit',
            'uai',])
            ->where('is_poa', true)
            ->orderBy('id', 'asc')
            ->get();

        $this->auditActivityNoPoa = AuditActivity::with([
            'handoverDocument' => [
                'employeeIncoming',
                'employeeOutgoing',
            ],
            'typeAudit',
            'uai',])
            ->where('is_poa', false)
            ->get();
    }

    public function render()
    {
        return view('livewire.audit-activity.main');
    }

    public function goTo(int $id)
    {
        $this->redirectRoute('auditActivity.show', ['public_id' => $id], navigate: true);
    }

}