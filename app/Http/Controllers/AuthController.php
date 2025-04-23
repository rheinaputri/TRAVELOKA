<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if ($credentials['username'] === 'admin' && $credentials['password'] === 'admin') {
            session(['is_admin_logged_in' => true]);
            return redirect('/index');
        }

        return redirect()->back()->with('error', 'Username atau password salah.');
    }
}
