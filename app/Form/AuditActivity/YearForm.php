<?php

namespace App\Form\AuditActivity;

use Livewire\Form;

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