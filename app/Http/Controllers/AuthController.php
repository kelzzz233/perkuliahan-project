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
            'jurusan' => '_'
        ]);

        return redirect()->route('login')->with('sukses', 'Registrasi berhasil! Silakan login.');
    }

    // Halaman Form Login (Admin/Dosen)
    public function showLogin()
    {
        return view('login');
    }

    // Proses Autentikasi Login (Admin/Dosen)
  // Proses Autentikasi Login (Admin/Dosen)
public function login(Request $request)
{
    $request->validate([
        'nama' => 'required',
        'password' => 'required',
    ]);

    // Cari pengguna berdasarkan NAMA
    $user = Pengguna::where('nama', $request->nama)->first();

    // Verifikasi password
    if ($user && Hash::check($request->password, $user->kata_sandi)) {

        // Mahasiswa login lewat halaman khusus
        if ($user->peran === 'mahasiswa') {
            return back()->withErrors([
                'nama' => 'Akun mahasiswa silakan login lewat halaman khusus mahasiswa.'
            ]);
        }

        // Login user
        Auth::login($user);
        $request->session()->regenerate();

        // Redirect berdasarkan peran
        if ($user->peran === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        if ($user->peran === 'dosen') {
            return redirect()->route('dosen.dashboard');
        }
    }

    // Jika login gagal
    return back()->withErrors([
        'nama' => 'Nama atau password salah.',
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
