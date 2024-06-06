<?php

namespace App\Http\Livewire\Employee;

use App\Models\Employee;
use Livewire\Attributes\On;
// use App\Models\JobTitle;
// use App\Models\Uai;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Storage;
use Livewire\Component;

/**
 * Summary of PersonalUaiController
 * * Controller of the Personal UAI Module
 */
class Create extends Component
{
    public $name;
    public function render()
    {
        return view('livewire.create');
    }
    #[On(event: 'launched')]
    public function show()
    {
        $this->render();
    }
}















// public $p00 = "1235";
// public $personal_id = 1;
// public $first_name = "hola";
// public $second_name = "hola";
// public $first_surname = "asd";
// public $second_surname = "sdf";
// public $phone = "654321231";
// public $email_cantv = "asdasdsadas";
// public $gmail = "asdasd";








    /**
     * todo Store a newly created resource in storage 
     */
    // public function save()
    // {
        // // todo validation 
        // // $request->validate(rules: [
            // //     'profile_photo' => 'required|image'
            // // ]);
            
            // $data = [
                //     'p00' => $this->p00,
        //     'personal_id' => $this->personal_id,
        //     'first_name' => $this->first_name,
        //     'second_name' => $this->second_name,
        //     'first_surname' => $this->first_surname,
        //     'second_surname' => $this->second_surname,
        //     'phone' => $this->phone,
        //     'email_cantv' => $this->email_cantv,
        //     'gmail' => $this->gmail,
        // ];


        // // todo store profile_photo 
        // // $data['profile_photo'] = Storage::url(path: $request->file(key: 'profile_photo')->store(path: 'public'));

        // // // todo divide cedula 
        // // $textsExploded = explode(separator: '-', string: $data['personal_id']);
        // // $data['personal_id'] = $textsExploded[1];

        // // todo storage data 
        // Employee::create(attributes: $data);

        // // $employee = Employee::all()->last();
        // // return $this->render(parameters: $employee->id, view: 'employee.show');
    // }

    /**
     * todo Show the form for editing the specified resource 
     */
    // public function edit(string $employee): \Illuminate\Contracts\View\View
    // {
    //     return $this->render(
    //         parameters: [
    //             "employee" => Employee::with(relations: ['jobTitles', 'uai'])->find(id: $employee),
    //             'jobTitles' => JobTitle::all(),
    //             'uai' => Uai::all()
    //         ],
    //         view: "livewire.employee.edit",
    //     );
    // }

    /**
     * todo Update the specified resource in storage.
     */
    // public function update(Request $request, string $personal)
    // {
    //     $requestAll = $request->all();
    //     $personal = PersonalUai::findOrFail($personal);
    //     $personal->cargo_id = $requestAll['cargo_id'];
    //     $personal->uai_id = $requestAll['uai_id'];
    //     $personal->cedula = $requestAll['cedula'];
    //     $personal->telefono = $requestAll['telefono'];
    //     $personal->p00 = $requestAll['p00'];
    //     $personal->email_cantv = $requestAll['email_cantv'];
    //     $personal->gmail = $requestAll['gmail'];
    //     $personal->save();
    //     return view("personal-uai.show", ["personal" => $personal]);
    // }

    /**
     * todo Remove the specified resource from storage.
     */
    // public function destroy(string $employee): \Illuminate\Http\JsonResponse
    // {
    //     $employee = Employee::find(id: $employee);
    //     $employee->delete();
    //     return response()->json(['response' => 'Ok']);
    // }
// }
