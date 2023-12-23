<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginOperatorController extends Controller
{
    public function index()
    {
        return view('dashboard.operator_login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);
        if (Auth::guard('operator')->attempt($credentials)) {
            // $request->session()->regenerate();   
            // dd($request);
            return redirect()->intended('/');
        }

        return back()->with('LoginError', 'Login Failed');
    }

    public function logout(Request $request)
    {
        Auth::guard('operator')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/loginoperator');
    }
}
