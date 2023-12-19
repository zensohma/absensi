<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index() {
        return view('dashboard.login', [
            'title' => 'login',
            'active' => 'login'
        ]);
          
    }
    public function authenticate(Request $request) {
        // dd($request);
        $credentials = $request->validate([
            'nis' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/');

        }

        return back()->with('LoginError', 'Login Failed');
    }

    public function logout(Request $request) {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
