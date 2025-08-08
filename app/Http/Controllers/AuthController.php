<?php

namespace App\Http\Controllers;

use Illuminate\Http\Client\Request as ClientRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function autenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('admin/blogs');
        }

        return back()->withErrors([
            'email' => 'Email tidak cocok'
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->inValidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
