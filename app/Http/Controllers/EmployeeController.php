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


   
    public function edit( $employee): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        return view(view: " employee.edit", data: [
            "employee" => Employee::with(relations: ['jobTitle', 'uai'])->find(id: $employee),
            'jobTitle' => Jobtitle::all(),
            'uai' => Uai::all(),
        ]);
    }
   

public function update(Request $request, string $employee)
{
    // dd($employee);
    $employee = employee::find($employee);
    $employee->update($request->all());
    $requestAll = $request->all();
    $employee = employee::findOrFail($employee);
    print_r($requestAll['cargo_id']);
    $employee->cargo_id = $requestAll['cargo_id'];

    $employee->uai_id = $requestAll['uai_id'];
    $employee->cedula = $requestAll['cedula'];
    $employee->telefono = $requestAll['telefono'];
    $employee->p00 = $requestAll['p00'];
    $employee->email_cantv = $requestAll['email_cantv'];
    $employee->gmail = $requestAll['gmail'];
    $employee->save();
    return view("employee.store", ["employee" => $employee]);
}
}