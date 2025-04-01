<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination; // Importar el trait
use App\Models\Memo;

class SearchMemo extends Component
{
    use WithPagination; // Usar el trait para la paginación

    public $search = ''; // Variable para almacenar el término de búsqueda

    public function mount()
    {
        // No es necesario inicializar $memos aquí, ya que se cargará en el render
    }

    public function render()
    {
        // Filtrar los registros según input_tipo1
        $memos = Memo::where('input_tipo1', 'like', '%' . $this->search . '%')->paginate(20);

        return view('livewire.search-memo', [
            'memos' => $memos, // Pasar los resultados paginados a la vista
        ]);
    }

    // Método para resetear la paginación al actualizar la búsqueda
    public function updatingSearch()
    {
        $this->resetPage(); // Resetear la página a 1 cuando se actualiza la búsqueda
    }

    public function buscar()
    {
        // Este método se puede usar para realizar la búsqueda al hacer clic en el botón
        $this->resetPage(); // Resetear la página a 1
    }
}