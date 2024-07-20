<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index() {
        return view('auth.login', [
            "title" => "Petualangan Ceria | Login"
        ]);
    }

    public function authenticate(Request $request) {
        $credentials = $request->validate([
            // "email" => 'required|email:dns'
            "email" => 'required|email',
            "password" => 'required'
        ]);

        $remember = $request->has('remember_me');

        if(Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return back()->with('loginError', 'email/password salah');
    }

    public function logout(Request $request) {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
