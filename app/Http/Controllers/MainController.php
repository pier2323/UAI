<?php

namespace App\Http\Controllers;

class MainController extends Controller
{
    public function __invoke():\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        return view(view: 'dashboard', );
    }
}