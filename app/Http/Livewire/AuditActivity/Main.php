<?php

namespace App\Http\Livewire\AuditActivity;

use App\Models\AuditActivity;
use App\Models\Year;
use App\Services\MapperExcelService;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use Livewire\Features\SupportPagination\WithoutUrlPagination;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Main extends Component
{
    use WithPagination, WithoutUrlPagination;

    public Year $year;

    public Collection $auditActivityPoa;
    public Collection $auditActivityNoPoa;

    public function mount(bool $refresh = false): void
    {
        $this->year = Year::get();
        // if ($refresh) dd($this->year);
        $this->auditActivityPoa = AuditActivity::with([
            'handoverDocument' => [
                'employeeIncoming',
                'employeeOutgoing',
            ],
            'typeAudit',
            'uai',])
            ->where('is_poa', true)
            ->where('year', $this->year->selected)
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
            ->where('year', $this->year->selected)
            ->get();
    }

    public function refresh(): void
    {
        $this->mount(true);
        $this->dispatch('refresh');
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
