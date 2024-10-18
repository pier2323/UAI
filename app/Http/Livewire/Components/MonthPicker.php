<?php

namespace App\Http\Livewire\Components;

use Livewire\Attributes\Modelable;
use Livewire\Component;

class MonthPicker extends Component
{
    public array $months = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
    public string $id = 'hola';
    public string $class = '';
    public string $alpine = '';


    #[Modelable]
    public string $selected = '';

    public function render()
    {
        return view('livewire.components.month-picker');
    }
}