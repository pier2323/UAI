<?php

namespace App\Http\Livewire\AuditActivity;

use App\Dto\AuditActivityNew;
use App\Services\MapperExcelService;
use Livewire\Component;
use Livewire\WithFileUploads;

class Loader extends Component
{
    use WithFileUploads;

    public AuditActivityNew $auditActivityNew;

    public $spreadsheet;

    // #[Validate('max:1024')] // 1MB Max
    public $archive;
    public bool $tableNewAuditActivity;

    public function render()
    {
        return view('livewire.audit-activity.loader');
    }

    public function loadData(): void
    {
        // $this->spreadsheet[] = new MapperExcelService($this->archive->path());
        // $this->tableNewAuditActivity = true;
    }

    public function getData(): array
    {
        return $this->spreadsheet[0]->getData();
    }
}
