<?php

namespace App\Http\Controllers;

use App\Models\PersonalUai;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __invoke(){}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->save();
        echo "hola";
        return redirect()->to(route('sign.login'));
    }
}
