<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Modal extends Component
{
    public $id;
    
    public function mount($id)
    {
        $this->id = $id;
    }

    public function render()
    {
        return view('livewire.modal');
    }
}
