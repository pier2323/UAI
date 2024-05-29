<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\JobTitle;
use App\Models\Uai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use function Pest\Laravel\json;

/**
 * Summary of PersonalUaiController
 * * Controller of the Personal UAI Module
 */
class PersonalUaiController extends Controller
{
    public function render(string|array $parameters = null, string $view = "dasboard"): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        return view(view: $view, data: ['data' => $parameters]);
    }

    /**
     * todo Store a newly created resource in storage 
     */
    public function store(Request $request): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        // todo validation 
        $request->validate(rules: [
            'profile_photo' => 'required|image'
        ]);

        $data = $request->all();

        // todo store profile_photo 
        $data['profile_photo'] = Storage::url(path: $request->file(key: 'profile_photo')->store(path: 'public'));

        // todo divide cedula 
        $textsExploded = explode(separator: '-', string: $data['personal_id']);
        $data['personal_id'] = $textsExploded[1];

        // todo storage data 
        Employee::create(attributes: $data);

        $employee = Employee::all()->last();
        return $this->render(parameters: $employee->id, view: 'employee.show');
    }

    /**
     * todo Show the form for editing the specified resource 
     */
    public function edit(string $employee): \Illuminate\Contracts\View\View
    {
        return $this->render(
            parameters: [
                "employee" => Employee::with(relations: ['jobTitles', 'uai'])->find(id: $employee),
                'jobTitles' => JobTitle::all(),
                'uai' => Uai::all()
            ],
            view: "employee.edit",
        );
    }

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
    public function destroy(string $employee): \Illuminate\Http\JsonResponse
    {
        $employee = Employee::find(id: $employee);
        $employee->delete();
        return response()->json(['response' => 'Ok']);
    }
}
