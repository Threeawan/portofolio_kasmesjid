<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ManajemenLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.manajemen-login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Mencoba login
        if (Auth::guard('manajemen')->attempt(['username' => $request->username, 'password' => $request->password])) {
            return redirect()->intended('/dashboard'); // Redirect jika berhasil login
        }

        // Jika gagal login
        return redirect()->back()->withInput($request->only('username'))->withErrors(['login' => 'Username atau password salah']);
    }

    public function logout()
    {
        Auth::guard('manajemen')->logout();
        return redirect('/manajemen-login');
    }
}
