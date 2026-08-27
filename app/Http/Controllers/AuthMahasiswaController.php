<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Pengguna; // <-- 1. Tambahkan import Model Pengguna di sini
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

    // 2. Ubah nama fungsi dari 'prosesLogin' menjadi 'login' agar cocok dengan Route
    public function login(Request $request)
    {
        $request->validate([
            'nim' => 'required|string',
            'password' => 'required|string',
        ]);

        // Cari pengguna berdasarkan kolom nim dan peran mahasiswa
        $user = Pengguna::where('nim', $request->nim)
                        ->where('peran', 'mahasiswa')
                        ->first();

       if ($user && Hash::check($request->password, $user->kata_sandi)) {
    // Gunakan guard mahasiswa agar sesuai dengan middleware web.php kamu
    Auth::guard('mahasiswa')->login($user);
    
    // Gunakan route() dengan nama rute yang benar, bukan string URL pakai titik
    return redirect()->route('mahasiswa.dashboard')->with('sukses', 'Berhasil masuk!');
}

        return back()->withErrors([
            'nim' => 'NIM atau password mahasiswa salah.',
        ])->withInput();
    }


    // Proses Logout Mahasiswa
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('mahasiswa.login');
    }
}