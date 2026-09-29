<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Menampilkan halaman form register
    public function showregister()
    {
        return view("register");
    }

    // Memproses pendaftaran user baru
    public function register(Request $request)
    {
        // 1. Validasi Input Data beserta Pesan Kustomnya
        $validatedData = $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'name.required'      => 'nama lengkap wajib diisi',
            'email.required'     => 'alamat email wajib diisi',
            'email.email'        => 'format email tidak valid',
            'email.unique'       => 'alamat email sudah terdaftar',
            'password.required'  => 'Kata sandi wajib diisi',
            'password.min'       => 'kata sandi minimal 8 karakter',
            'password.confirmed' => 'konfirmasi kata sandi tidak cocok',
        ]);

        // 2. Simpan User Baru ke Database
        $user = User::create([
            'name'     => $validatedData['name'],
            'email'    => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        // 3. Otomatis Login setelah Pendaftaran Berhasil
        Auth::login($user);

        // 4. Regenerasi Session & Redirect ke Dashboard
        $request->session()->regenerate();

        return redirect()->route('dashboard')->with('status', 'Pendaftaran berhasil! Selamat datang.');
    }

    // 1. Menampilkan halaman form login
    public function showLoginForm()
    {
        return view('login');
    }

    // 2. Memproses submit form login
    public function login(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Cek centangan 'remember me' dari form
        $remember = $request->has('remember');

        // Cek kecocokan data pengguna di database
        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            // Tentukan tujuan redirect berdasarkan role pengguna
            $destination = Auth::user()->role === 'admin'
                ? route('admin.dashboard')
                : route('dashboard');

            // Berhasil login, arahkan ke dashboard yang sesuai
            return redirect()->intended($destination);
        }

        // Jika gagal, kembalikan dengan pesan error
        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ])->onlyInput('email');
    }

    // 3. Memproses logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}