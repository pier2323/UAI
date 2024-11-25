<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Calendario extends Component
{
    public $meses;
    public $anios;

    public function __construct($numAnios = 5)
    {
        $this->meses = [
            'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
            'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
        ];
        
        $this->anios = range(date('Y'), date('Y') + $numAnios); // Años actuales y los próximos N años
    }
    public function render()
    {
        return view('components.calendario');
    }
}