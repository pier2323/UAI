<?php

namespace App\Http\Controllers;

use App\Models\PersonalUai;
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
        PersonalUai::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function showOne($personal)
    {
        $personal = PersonalUai::with('cargo', 'uai')->find($personal);
        return view("personal-uai.show", ["personal"=> $personal]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $personal)
    {
        $personal = PersonalUai::with('cargo', 'uai')->find($personal);
        return view("personal-uai.edit", ["personal"=> $personal]);
    }

    public function dashboard() 
    {
        $data = PersonalUai::with('cargo')->get();
        return view('personal-uai.dashboard', ['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $personal)
    {
        $personal = PersonalUai::find($personal);
        $personal->update($request->all());
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
