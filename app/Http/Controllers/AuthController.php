<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Giriş formunu göster
    public function showLoginForm()
    {
        return view('login');
    }

    // Giriş işlemini yap
    public function postLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->route('dashboard');
        }

        return redirect()->back()->with('error', 'Giriş bilgileriniz hatalı.');
        
    }
}
