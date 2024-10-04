<?php

namespace App\Http\Livewire\AuditActivity;

use App\Models\Area;
use Livewire\Attributes\Modelable;
use Livewire\Attributes\Validate;
use Livewire\Component;

class SelectArea extends Component
{
    #[Modelable]
    public string $selected;

    public $areas;

    #[Validate(['unique:areas,name'])]
    public string $new;

    public function mount()
    {
        $this->areas = Area::all();
    }

    public function render()
    {
        return view('livewire.audit-activity.select-area');
    }

    public function save()
    {
        $this->validate();
        Area::create(['name' => $this->pull('new')]);
        $this->areas = Area::all();
    }
}