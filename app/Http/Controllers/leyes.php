<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class leyes extends Controller
{
    public function leyes()
    {
        return view('leyes');
    }

        public function reglamentos()
    {
        return view('reglamentos');
    }


}
