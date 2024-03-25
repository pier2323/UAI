<?php

namespace App\Http\Controllers;

use App\Models\ActaEntrega;
use Illuminate\Http\Request;

class ActaEntregaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     return view('index');
    // }

    /**
     * Show the form for creating a new resource.
     */
    // public function create(Request $request)
    // {
    //     ModelsActaEntrega::create($request->all());
    // }

    /**
     * Store a newly created resource in storage.
     */
    public function guardar(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function mostrarTodo()
    {
        return response()->json(ActaEntrega::all());
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
