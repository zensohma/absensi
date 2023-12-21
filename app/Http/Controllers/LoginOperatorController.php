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

        if (Auth::guard('operator')->attempt(['username' => $request->username, 'password' =>
        $request->password], $request->remember)) {
            return redirect()->intended(route('operator'));
        }

        return back()->with('LoginError', 'Login Failed');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/loginoperator');
    }
}
