<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{   
    
    
    
    public function index()
    {
        return view('dashboard.login', [
            'title' => 'login',
            'active' => 'login'
        ]);
    }

    public function authenticate(Request $request)
    {
        
        $credentials = $request->validate([
            'nis' => 'required',
            'password' => 'required'
        ]);
        if (Auth::guard('web')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/absensi');
        }
        return back()->with('LoginError', 'Login Failed');
    }
    // ini udah ku coba tapi gamau coy
    //     $this->validate($request, [
    //         'nis' => 'required',
    //         'password' => 'required'
    //     ]);

    //     $nis = $request->nis;
    //     $password = $request->password;
    //     $remember = $request->remember;

    //     if (Auth::guard('web')->attempt(['nis' => $nis, 'password' => $password], $remember)) {
    //         return redirect()->intended(route('dashboard.absen'));
    //     }

    //     return redirect()->back()->withInput($request->only('nis', 'remember'));
    // }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
