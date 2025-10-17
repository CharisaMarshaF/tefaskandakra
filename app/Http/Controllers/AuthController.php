<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


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
                1 => redirect()->route('produk.index'),
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

        public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Proses registrasi
    public function register(Request $request)
    {
        // Validasi input dari form registrasi
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|unique:users,username',
            'email' => 'required|string|email|unique:users,email',
            'phone' => 'required|string|unique:users,phone',
            'alamat_lengkap' => 'required|string',
            'password' => 'required|string|min:8|confirmed', // Confirm password check
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            return redirect()->back()
                             ->withErrors($validator)
                             ->withInput();
        }

        // Membuat user baru dengan id_role default 9
        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'phone' => $request->phone,
            'alamat_lengkap' => $request->alamat_lengkap,
            'password' => Hash::make($request->password), // Secure password hashing
            'id_role' => 9, // Set default role to 9
        ]);

        // Login otomatis setelah registrasi
        Auth::login($user);

        // Redirect ke halaman yang sesuai
        return redirect()->route('customer.landing'); // Sesuaikan dengan route yang diinginkan setelah login
    }
}