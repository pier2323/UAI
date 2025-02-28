<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Memo;

class SearchMemo extends Component
{
    use WithPagination;

    public $search = ''; // Variable para almacenar el término de búsqueda

    public function render()
    {
        // Filtrar los registros según input_tipo1 y paginar 15 registros por página
        $memos = Memo::where('input_tipo1', 'like', '%' . $this->search . '%')->paginate(15);

        return view('livewire.search-memo', [
            'memos' => $memos,
        ]);
    }

    public function updatingSearch()
    {
        $this->resetPage(); // Resetear la página a 1 cuando se actualiza la búsqueda
    }
}