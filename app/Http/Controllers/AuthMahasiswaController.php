<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthMahasiswaController extends Controller
{
    // Halaman Form Login Mahasiswa
    public function showLogin()
    {
        return view('login-mahasiswa');
    }

    // Proses Login Mahasiswa (Menggunakan Guard 'mahasiswa')
    public function login(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'password' => 'required',
        ]);

        $mhs = Mahasiswa::where('nama', $request->nama)->first();

        if ($mhs && ($request->password == $mhs->kata_sandi || Hash::check($request->password, $mhs->kata_sandi))) {
            Auth::guard('mahasiswa')->login($mhs);
            $request->session()->regenerate();
            return redirect()->route('mahasiswa.dashboard');
        }

        return back()->withErrors([
            'nama' => 'Nama atau password mahasiswa salah.',
        ])->onlyInput('nama');
    }

    // TAMBAHKAN FUNGSI INI UNTUK REGISTER MAHASISWA
   // FUNGSI REGISTER MAHASISWA YANG DIPERBAIKI
    public function register(Request $request)
    {
        $request->validate([
            'nama'       => 'required|string|max:255',
            'email'      => 'required|string|email|unique:pengguna,email', // Diubah dari mahasiswa ke pengguna
            'jurusan'    => 'required|string', // Validasi jurusan wajib diisi
            'kata_sandi' => 'required|string|min:6',
        ]);

        Mahasiswa::create([
            'nama'       => $request->nama,
            'email'      => $request->email,
            'jurusan'    => $request->jurusan, // <--- TAMBAHKAN INI AGAR JURUSAN TERSIMPAN
            'kata_sandi' => Hash::make($request->kata_sandi),
        ]);

        return redirect()->route('mahasiswa.login')->with('sukses', 'Registrasi mahasiswa berhasil! Silakan login.');
    }

    // Proses Logout Mahasiswa
    public function logout(Request $request)
    {
        Auth::guard('mahasiswa')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('mahasiswa.login');
    }
}
