<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showlogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $user = User::where('email', $credentials['email'])->first();

        if (!$user) {
            return redirect('/login')
                ->with('error', 'Akun tidak ditemukan. Silakan coba lagi.');
        }

        if ($user->is_active == '0') {
            return redirect('/login')
                ->with('error', 'Akun tidak aktif. Silakan hubungi admin.');
        } else {
            if (Auth::attempt($credentials)) {
                if (Auth::user()->role_id == '1') {
                    return redirect('/admin-dashboard');
                } elseif (Auth::user()->role_id == '2') {
                    return redirect('/user-dashboard');
                }
            }
        }

        return redirect('/login')
            ->with('error', 'Kredensial tidak valid. Silakan coba lagi.');
    }


    public function showregister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:tbl_users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('login')
            ->with('success', 'Register berhasil dihapus.');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        return redirect('/login');
    }
}
