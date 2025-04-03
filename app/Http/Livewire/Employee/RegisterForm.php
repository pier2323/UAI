<?php

namespace App\Http\Livewire\Employee;

use App\Form\Employee\EmployeeForm;
use App\Models\JobTitle;
use App\Models\Uai;
use Livewire\Attributes\Modelable;
use Livewire\Component;
use Livewire\WithFileUploads;


class RegisterForm extends Component
{
    use WithFileUploads;

    #[Modelable]
    public bool $isOpened;

    public EmployeeForm $employeeForm;
    public $test;
    public $jobTitles = [];
    public $uais = [];
    public $valido;

    public function mount()
    {
        $this->jobTitles = JobTitle::all();
        $this->uais = Uai::all();
        $this->valido = 0;
    }

    public function limpiar()
    {
        $this->resetExcept(['isOpened']);
        $this->mount();
    }

    public function validar()
    {
        $this->valido = 2;
        $this->validate();
        $this->valido = 1;
    }

    public function save()
    {
        $this->employeeForm->save();
    }

    public function render()
    {
        return view('livewire.employee.registerForm');
    }

    public function resetComponent()
    {
        $this->reset(['isOpened', 'test']);
    }

    public function verify(): void
    {
        $this->employeeForm->verify();
    }
}
