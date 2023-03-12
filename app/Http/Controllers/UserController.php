<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function getInfo()
    {
        return view('manual-login');
    }

    public function manualLogin(Request $request)
    {
        $privateData = $request->only('email', 'password');
        if(Auth::attempt($privateData)) {
            //* Risposta booleana
            $request->session()->regenerate();
            return redirect()->intended('dashboard'); //% URI
        }

        return redirect()->back()->withErrors([
            'email' => 'Email sbagliata o non presente nel nostro database',
            'password' => 'Password sbagliata o non presente nel nostro database'
        ]);
    }
}
