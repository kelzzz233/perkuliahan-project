<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Halaman Form Register (Admin/Dosen)
    public function showRegister()
    {
        return view('register');
    }

    // Proses Simpan Register (Admin/Dosen)
    public function register(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|unique:pengguna,email',
            'kata_sandi' => 'required|string|min:6',
            'peran' => 'required|in:dosen,admin', // Mahasiswa dipisah ke controller lain
        ]);

        Pengguna::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'kata_sandi' => Hash::make($request->kata_sandi),
            'peran' => $request->peran,
        ]);

        return redirect()->route('login')->with('sukses', 'Registrasi berhasil! Silakan login.');
    }

    // Halaman Form Login (Admin/Dosen)
    public function showLogin()
    {
        return view('login');
    }

    // Proses Autentikasi Login (Admin/Dosen)
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Cek data pengguna di tabel 'pengguna' berdasarkan email
        $user = Pengguna::where('email', $request->email)->first();

        // Verifikasi password dan pastikan rolenya bukan mahasiswa
        if ($user && Hash::check($request->password, $user->kata_sandi)) {
            if ($user->peran === 'mahasiswa') {
                return back()->withErrors(['email' => 'Akun mahasiswa silakan login lewat halaman khusus mahasiswa.']);
            }

            Auth::login($user);
            $request->session()->regenerate();

            if ($user->peran === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($user->peran === 'dosen') {
                return redirect()->route('dosen.dashboard');
            }
        }

        return back()->withErrors([
            'username' => 'nama atau password salah.',
        ])->onlyInput('nama');
    }

    // Proses Logout (Admin/Dosen)
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
