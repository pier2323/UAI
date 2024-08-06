<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\JobTitle;
use App\Models\Uai;
use BaconQrCode\Renderer\Path\Path;
use GuzzleHttp\Psr7\Message;
use Illuminate\Http\Request;
use Livewire\Attributes\Validate;




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
        $employee = Employee::find($id);
        $employee->delete();
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

        $requestAll = $request->all();





        $code = $requestAll['phone_code'];
        $number = $requestAll['phone_number'];
        $phone = "$code$number";
       

        
        
        
        $request->validate(
            rules: [
                'phone' => 'numeric|min:2',
                'first_name' => ['alpha', 'min:3'],
                'first_surname' => 'alpha|min:3',
                'gmail' => '|required|email',
            ],
            messages: [
                'phone.min' => 'El numero de telefono debe tener al menos 2 digito',
                'first_name.min' => 'El Primer Nombre debe tener al menos 3 caracteres',
                'first_name.alpha' => 'El Primer Nombre solo debe tener letras',
                'first_surname.min' => 'El Primer apellido debe ser mayor a 3 caracteres',
                'first_surname.alpha' => 'El Primer  apellido no debe contener numeros',
                'gmail.email' => 'El Correo Electronico no es Valido',
              'gmail.required' =>'el Correo es Oblitgatorio ',


            ]
        );
      
        $employee = Employee::findOrFail($employee);
        $employee->phone = $phone;  
        $employee->first_name = $requestAll['first_name'];
        $employee->second_name = $requestAll['second_name'];
        $employee->first_surname = $requestAll['first_surname'];
        $employee->second_surname = $requestAll['second_surname'];
        $employee->email_cantv = $requestAll['email_cantv'];
        $employee->gmail = $requestAll['gmail'];
        $employee->job_title_id = $requestAll['job_title'];
        $employee->uai_id = $requestAll['uai'];

        if ($request->hasFile('photo')) {
            $archivoFoto = $request->file('photo');
            $photo = $request->photo->storeAs('public', "$employee->p00.jpg");
            $archivoFoto->move(public_path() . '/storage/', $photo);
        }


        $employee->update($request->all());
        $employee->save();
        return redirect()->to(route('employee.show', $employee->id));
    }

}