<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Menampilkan form login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Proses login
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Menggunakan Auth::attempt() dengan kolom 'username'
        $credentials = [
            'username' => $request->username,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $role = Auth::user()->id_role;

            // Redirect sesuai role
            return match ($role) {
                1 => redirect('/dashboard-tefa'),
                2 => redirect('/dashboard-admin-sekolah'),
                3 => redirect('/dashboard-waka'),
                4 => redirect('/dashboard-guru'),
                5 => redirect('/dashboard-kepala-sekolah'),
                6 => redirect('/siswa/dashboard'),
                7 => redirect('/dashboard-orang-tua'),
                8 => redirect('/dashboard-perusahaan'),
                9 => redirect('customer/profil_tefa'),
                default => redirect('/login'),
            };
        }

        // Kembali dengan pesan error jika login gagal
        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ])->onlyInput('username');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('status', 'Berhasil logout');
    }
}