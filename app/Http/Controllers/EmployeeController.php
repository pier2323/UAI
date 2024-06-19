<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\JobTitle;
use App\Models\Uai;
use Illuminate\Http\Request;

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
            'uais' => Uai::all()
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
    public function destroy($id)
    {

        $id = Employee::find($id);
        $id->delete();
        return redirect()->route('employee.index');

    }



    public function edit($employee): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        return view(view: " employee.edit", data: [
            "employee" => Employee::with(relations: ['jobTitle', 'uai'])->find(id: $employee),
            'jobTitle' => Jobtitle::all(),
            'uai' => Uai::all(),
        ]);
    }


    public function update(Request $request, string $employee)
    {
        /* dd($employee); */
        $requestAll = $request->all();
        $employee = employee::findOrFail($employee);
        $employee->personal_id = $requestAll['personal_id'];
        $employee->phone = $requestAll['phone'];
        $employee->p00 = $requestAll['p00'];
        $employee->email_cantv = $requestAll['email_cantv'];
        $employee->gmail = $requestAll['gmail'];

        $employee->job_title_id = $requestAll['job_title'];
        $employee->uai_id = $requestAll['uai'];







        $employee->save();
        return redirect()->to(route('employee.show', $employee->id));
    }
}