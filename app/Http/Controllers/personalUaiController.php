<?php

namespace App\Http\Controllers;

use App\Models\PersonalUai;
use Illuminate\Http\Request;

class personalUaiController extends Controller
{
    public function dashboard() 
    {
        $data = PersonalUai::with('cargo')->get();
        return view('personal-uai.dashboard', ['data' => $data]);
    }
}
