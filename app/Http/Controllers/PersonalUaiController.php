<?php

namespace App\Http\Controllers;

use App\Models\Cargo;
use App\Models\PersonalUai;
use App\Models\Uai;
use Illuminate\Http\Request;

class PersonalUaiController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $all = $request->all();
        $textsExploded = explode('-', $all['cedula']);
        $all['cedula'] = $textsExploded[1];
        PersonalUai::create($all);
        print ('todo Ok!');
    }

    /**
     * Display the specified resource.
     */
    public function showOne($personal)
    {
        $personal = PersonalUai::with('cargo', 'uai')->find($personal);
        return view("personal-uai.show", ["personal" => $personal]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $personal)
    {
        return view
        (
            "personal-uai.edit",
            ["personal" => PersonalUai::with('cargo', 'uai')->find($personal)],
            [
                'uai' =>
                    [
                        'cargo' => Cargo::all(),
                        'departaments' => Uai::all()
                    ]
            ]
        );
    }

    public function dashboard()
    {
        $personal = PersonalUai::with('cargo')->get();
        $cargos = Cargo::all();
        $uai = Uai::all();
        return view('personal-uai.dashboard', ['data' => $personal, 'cargos' => $cargos, 'uais' => $uai]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $personal)
    {
        $requestAll = $request->all();
        $personal = PersonalUai::findOrFail($personal);



        print_r($requestAll['cargo_id']);
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
     * Remove the specified resource from storage.
     */
    public function destroy(string $personal)
    {
        $personal = PersonalUai::find($personal);
        $personal->delete();
        return $this->dashboard();
    }
}
