<?php

namespace App\View\Components\employee;

use Closure;
use App\Models\Employee; // Asegúrate de importar el modelo Employee
use App\Models\JobTitle; // Asegúrate de importar el modelo JobTitle
use App\Models\Uai;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class EmployeeIndex extends Component
{
    /**
     * Create a new component instance.
     */
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        return view(view: 'employee.index', data: [
            'employees' => Employee::with(relations: 'jobTitle')->get(),
            'jobTitles' => JobTitle::all(),
            'uais' => Uai::all()
        ]);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('employee.index');
    }
}
