<?php

namespace App\Http\Livewire\Components;

use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Modelable;
use Livewire\Attributes\Reactive;
use Livewire\Component;

class SelectSomething extends Component
{
    #[Modelable]
    public string $selected;

    #[Reactive]
    public Collection $items;

    public ?string $id;
    public ?string $placeholder;
    public ?string $title;

    public function render()
    {
        return view('livewire.components.select-something');
    }
}
