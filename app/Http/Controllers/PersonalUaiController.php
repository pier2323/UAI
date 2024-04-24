<?php

namespace App\Http\Controllers;

use App\Models\Cargo;
use App\Models\PersonalUai;
use App\Models\Uai;
use Illuminate\Http\Request;

/**
 * Summary of PersonalUaiController
 * * Controller of the Personal UAI Module
 */
class PersonalUaiController extends Controller
{
    /**
     * Summary of dashboard
     * todo return view general about the personal-uai module
     */
    public function dashboard()
    {
        $personal = PersonalUai::with('cargo')->get();
        $cargos = Cargo::all();
        $uai = Uai::all();
        return view('personal-uai.dashboard', ['data' => $personal, 'cargos' => $cargos, 'uais' => $uai]);
    }

    /**
     * todo Display the specified resource.
     */
    public function show($personal)
    {
        $personal = PersonalUai::with('cargo', 'uai')->find($personal);
        return view("personal-uai.show", ["personal" => $personal]);
    }

    /**
     * todo Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $all = $request->all();
        $textsExploded = explode('-', $all['cedula']);
        $all['cedula'] = $textsExploded[1];
        PersonalUai::create($all);
        return $this->dashboard();
    }

    /**
     * todo Show the form for editing the specified resource.
     */
    public function edit(string $personal)
    {
        $personal = PersonalUai::with('cargo', 'uai')->find($personal);
        $cargos = Cargo::all();
        $departaments = Uai::all();
        return view("personal-uai.edit", [
            "personal" => $personal,
            'uai' => [
                'cargo' => $cargos,
                'departaments' => $departaments
            ]
        ]);
    }

    /**
     * todo Update the specified resource in storage.
     */
    public function update(Request $request, string $personal)
    {
        $requestAll = $request->all();
        $personal = PersonalUai::findOrFail($personal);
        $personal->cargo_id = $requestAll['cargo_id'];
        $personal->uai_id = $requestAll['uai_id'];
        $personal->cedula = $requestAll['cedula'];
        $personal->telefono = $requestAll['telefono'];
        $personal->p00 = $requestAll['p00'];
        $personal->email_cantv = $requestAll['email_cantv'];
        $personal->gmail = $requestAll['gmail'];
        $personal->save();
        return view("personal-uai.show", ["personal" => $personal]);
    }

    /**
     * todo Remove the specified resource from storage.
     */
    public function destroy(string $personal)
    {
        $personal = PersonalUai::find($personal);
        $personal->delete();
        return $this->dashboard();
    }
}