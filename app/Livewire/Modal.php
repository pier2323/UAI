<?php

namespace App\Livewire;

use Livewire\Component;

class Modal extends Component
{
    public $open = false;
    public function openModal()
    {
        $this->open = true;
    }
    public function closeModal()
    {
        $this->open = false;
    }
    public function render(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        return view('livewire.liveModal', ['showModal']);
    }
}
