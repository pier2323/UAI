<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Documentos extends Controller
{
    public function leyes()
    {
        return view('leyes');
    }

        public function Reglamentos()
    {
        return view('reglamentos');
    }
    public function Documentos()
    {
        return view('Documentos');
    }
}
