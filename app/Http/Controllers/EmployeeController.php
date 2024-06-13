<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\JobTitle;
use App\Models\Uai;

/**
 * Summary of PersonalUaiController
 * * Controller of the Personal UAI Module
 */
class EmployeeController extends Controller
{
    /**
     * todo Summary of dashboard 
     * todo return view general about the employee module 
     */
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        return view(view: 'employee.index', data: [
            'employees' => Employee::with(relations: 'jobTitle')->get(), 
            'jobTitles' => JobTitle::all(), 
            'uais'      => Uai::all()
        ]);
    }

    /**
     * todo Display the specified resource.
     */
    public function show(string $employee): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        return view(view: " employee.show", data: [
            "employee" => Employee::with(relations: ['jobTitle', 'uai'])->find(id: $employee)
        ]);
    }




























    public function edit(string $employee): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        return view(view: " employee.edit", data: [
            "employee" => Employee::with(relations: ['jobTitle', 'uai'])->find(id: $employee),
            'jobTitle'=> Jobtitle::all(),
            'uai'=> Uai::all(),
        ]);
    }
}