<?php

namespace App\Http\Livewire\AuditActivity;

use App\Dto\AuditActivityNew;
use App\Models\AuditActivity;
use App\Models\Year;
use App\Services\MapperExcelService;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\Features\SupportEvents\Event;
use Livewire\WithFileUploads;

class Loader extends Component
{
    use WithFileUploads;

    public AuditActivityNew $auditActivity;
    public array $auditActivities = array();
    public bool $isLoad = false;
    public int $year;

    public $auditActivitiesNew = array();

    // #[Validate('max:1024')] // 1MB Max
    public $archive;

    public string $query = '';

    public function render(): View
    {
        return view('livewire.audit-activity.loader');
    }

    public function save(): Event
    {
        Year::new();
        foreach ($this->auditActivities as $auditActivity) 
        $this->auditActivitiesNew[] = AuditActivity::create(self::format($auditActivity));
        return $this->dispatch('saved-new-year');
    }
    
    public function here()
    {
        
        return $this->dispatch('saved-new-year');
    }

    #[\Livewire\Attributes\Js]
    public function reload(): string
    {
        return <<<'JS'
            location.reload();
        JS;
    }

    public function cancel(): void
    {
        $this->reset();
    }

    public function getData(): array
    {
        $this->auditActivities = [];
        foreach ($this->spreadsheet()->getData() as $new) {
            $this->auditActivities[] = new AuditActivityNew(
                public_id: $new['public_id'],
                description: $new['description'],
                objective: $new['objective'],
                month_start: $new['month_start'],
                month_end: $new['month_end'],
                area: $new['area'],
                type_audit: $new['type_audit'],
                uai: $new['uai'],
                departament: $new['departament'],
                year: $this->getYear(),
                is_poa: true,
            );
        }

        $this->isLoad = true;
        return $this->auditActivities;
    }

    private static function format(AuditActivityNew $auditActivity)
    {
        foreach ([
            'type_audit',
            'departament',
            // 'uai',
            'area',
        ] as $property)

        if (is_array($auditActivity->{$property}))
        $auditActivity->{$property . '_id'} = $auditActivity->{$property}['id'];

        return $auditActivity->toArray();
    }

    private function getYear(): int
    {
        if(!isset($this->year))
        return $this->year = Year::newYear();

        return $this->year;
    }

    private function spreadsheet(): object
    {
        return MapperExcelService::getInstance($this->archive->path());
    }
}
