<?php

namespace App\Http\Livewire\Employee;

use App\Models\JobTitle;
use App\Models\Uai;
use Livewire\Component;

class RegisterForm extends Component
{
    public $isOpened = false;
    public $test;
    public $jobTitles;
    public $uais;

    public function mount()
    {
        $this->jobTitles = JobTitle::all();
        $this->uais = Uai::all();
    }

    public function render()
    {
        return view('livewire.employee.registerForm');
    }

    public function resetComponent()
    {
        $this->reset(['isOpened', 'test']);  
    }
}
