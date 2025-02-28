<?php

namespace App\Livewire\Employee;

use App\Form\Employee\EmployeeForm;
use App\Models\Employee;
use Livewire\Component;

class Show extends Component
{
    public Employee $employeeModel;
    public EmployeeForm $employeeForm;
    public bool $isDeleting = false;

   public function mount(int $id): void
    {
        $this->employeeModel = Employee::with(relations: ['jobTitle', 'uai'])->find($id);
        $this->employeeForm->load($this->employeeModel);
    }

    public function render()
    {
        return view('livewire.employee.show');
    }

    public function delete(): void
    {
        $this->employeeModel->delete();
        $this->dispatch("employeeDeleted", ["message" => "Employee deleted successfully"]);
    }
}