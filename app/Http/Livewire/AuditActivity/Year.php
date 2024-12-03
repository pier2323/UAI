<?php

namespace App\Http\Livewire\AuditActivity;

use App\Models\AuditActivity;
use Illuminate\Support\Facades\View;
use Livewire\Component;
use Livewire\Form;
use Livewire\Features\SupportEvents\Event;

class Year extends Component
{
    public bool $is_open = false;
    public YearForm $year;
    public \App\Models\Year $Year;
    public AuditActivity $auditActivity;

    public function mount (): void
    {
        $this->Year = \App\Models\Year::get();
        $this->year->load($this->Year);
        $this->auditActivity = AuditActivity::latest()->first();
    }

    public function render(): \Illuminate\Contracts\View\View
    {
        return View::make('livewire.audit-activity.year');
    }

    public function changeSelected(): Event
    {
        $this->save('selected');
        return $this->dispatch('changeYear');
    }

    public function closeYear(): Event
    {
        $this->year->active = 0;
        $this->year->selected = 0;
        $this->save();
        return $this->dispatch('closeYear');
    }

    private function save(?string $property = null): void
    {
        $this->closeModal();
        $this->year->save($this->Year, isset($property) ? array($property) : ['selected', 'active',]);
    }

    private function closeModal(): void
    {
        $this->is_open = false;
    }
}

class YearForm extends Form
{
    public int $active;
    public int $selected;
    public int $forSelection;

    public function load(\App\Models\Year $year): void
    {
        $this->active = $year->active;
        $this->selected = $year->selected;
        $this->forSelection = $year->selected;
    }

    public function save(\App\Models\Year $year, array $properties): void
    {
        if (!in_array('active', $properties)) $this->selected = $this->forSelection;
        $year->update($this->only($properties));
    }
}
