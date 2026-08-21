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
        // Debugging: Cek data yang dikirim dari form
        // dd($request->all());

        $request->validate([
            'nama' => 'required|string',
            'password' => 'required',
        ]);

        $mhs = Mahasiswa::where('nama', $request->nama)->first();

        // Gunakan pengecekan langsung jika password di database belum di-hash,
        // atau gunakan Hash::check jika sudah di-hash.
        if ($mhs && ($request->password == $mhs->kata_sandi || Hash::check($request->password, $mhs->kata_sandi))) {
            Auth::guard('mahasiswa')->login($mhs);
            $request->session()->regenerate();
            return redirect()->route('mahasiswa.dashboard');
        }

        return back()->withErrors([
            'nama' => 'Nama atau password mahasiswa salah.',
        ])->onlyInput('nama');
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
