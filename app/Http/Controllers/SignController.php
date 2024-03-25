<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class SignController extends Controller
{
    public function register()
    {
        return view('sign.register');        
    }

    public function login()
    {
        if(Auth::check())
        {
            redirect()->to(route('index'));
        }
        return view('sign.login');        
    }

    public function logout()
    {
        // Session::flush();
        Auth::logout();
        return Redirect()->to(route('sign.login'));
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
 
        if (!Auth::validate($credentials)) 
        {
            return redirect()->to(route('sign.login'))->withErrors('auth.failed');
        }
        $user = Auth::getProvider()->retrieveByCredentials($credentials);

        Auth::login($user);

        return $this->authenticated($request, $user);
    }

    public function authenticated(Request $request, $user)
    {
        return redirect()->to(route('index'));
    }
}
