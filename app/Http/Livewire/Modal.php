<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Modal extends Component
{
    public $modal;
    public $open;

    public function render()
    {
        return view('livewire.modal');
    }
}
