<?php

namespace App\Http\Livewire\Employee;

use App\Models\Employee;
use App\Models\JobTitle;
use App\Models\Uai;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class Main extends Component
{
    public Collection $employees;
    public Collection $jobTitles;
    public Collection $uais;
    public function mount(): void
    {
        $this->employees = Employee::with(relations: 'jobTitle')->get();
        $this->jobTitles = JobTitle::all();
        $this->uais = Uai::all();
    }
    public function render()
    {
        return view('livewire.employee.main');
    }
}
