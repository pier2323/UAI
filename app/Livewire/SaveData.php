<?php

namespace App\Livewire;

use Livewire\Component;

class SaveData extends Component
{

    public $hola;
    public function hola()
    {
        return 'hola';
    }
    public function submitForm()
    {
        // Form submission logic here

        // Trigger the event that the AlpineJS component is listening for
        $this->dispatch('formSubmitted');
    }
    public function render()
    {
        return view('livewire.save-data');
    }
}
