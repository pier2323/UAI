<?php

namespace App\Http\Livewire\Employee;

use App\Models\Employee;
use Livewire\Attributes\Session;
use Livewire\Component;

class Browser extends Component
{
    public $open = false;

    #[Session]
    public $employees;

    public function mount()
    {
        $this->employees = Employee::with('uai')->get();
    }

    public function render()
    {
        return view('livewire.employee.browser');
    }
}
