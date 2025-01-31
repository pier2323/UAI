<?php

namespace App\Http\Livewire\Employee;

use App\Models\Employee;
use Livewire\Component;

class Show extends Component
{
    public Employee $employee;

   public function mount(int $id): void
    {
        $this->employee = Employee::with(relations: ['jobTitle', 'uai'])
        ->find(id: $id);
    }

    public function render()
    {
        return view('livewire.employee.show');
    }
}
