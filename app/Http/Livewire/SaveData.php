<?php

namespace App\Http\Livewire;

use Livewire\Component;

class SaveData extends Component
{
    public $checkboxData = [];

    public function save()
    {
        // Aquí puedes manejar la lógica para guardar los datos en la base de datos
        // Por ejemplo, puedes usar un modelo para guardar los datos

        // Ejemplo:
        // YourModel::create(['data' => json_encode($this->checkboxData)]);

        session()->flash('message', 'Datos guardados correctamente.');
    }

    public function render()
    {
        return view('livewire.save-data');
    }
}