<?php

namespace App\Http\Livewire\MemoOficio;

use Livewire\Component;

class MemoOfico extends Component
{
    public $titulo;

    public function mount()
    {
        $this->titulo = 'Título del Memo';
    }

    public function render()
    {
        return view('livewire.memo-oficio.memo-ofico'); // Actualiza la ruta de la vista
    }
}