<?php

namespace App\Http\Controllers;

use App\Models\ActaEntrega;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function action()
    {
        $data = ActaEntrega::with('actuacionFiscal', 'personalEntrega.unidad')->get();
        return view('action.index', ['data' => $data]);
    }

    public function index()
    {
        $data = ActaEntrega::with('actuacionFiscal', 'personalEntrega.unidad')->get();
        return view('dashboard', ['data' => $data]);
    }

    public function show()
    {
        return view('action.show');
    }
}
