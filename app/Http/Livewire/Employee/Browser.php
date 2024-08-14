<?php

namespace App\Http\Livewire\Employee;

use App\Models\Employee;
use Livewire\Component;

class Browser extends Component
{
    public $open = false;
    public $employees;

    public function mount()
    {
        $this->employees = Employee::with('uai')->get();
    }

    public function render()
    {
        return view('livewire.employee.browser');
    }

    public function hydrate()
    {
        // ! it's needed a solution to omit this query 
        $this->employees = Employee::with('uai')->get();
    }
}
