<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Tugas;
use App\Models\MataKuliah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // <-- Ini penting agar Auth terbaca

class MahasiswaController extends Controller
{
    public function index()
    {
        $mahasiswa = Mahasiswa::all();
        return view('mahasiswa', compact('mahasiswa'));
    }

    public function dashboard()
    {
        // 1. Ambil data mahasiswa yang sedang login
        $mahasiswa = Auth::guard('mahasiswa')->user();

        // 2. Ambil data tugas berdasarkan jurusan
        $tugas = Tugas::where('jurusan', $mahasiswa->jurusan)->get();

        // 3. Ambil data mata kuliah untuk KRS
        $krsList = MataKuliah::all();

        // 4. Kirim semua variabel ke view mahasiswa.blade.php
        return view('mahasiswa', compact('mahasiswa', 'tugas', 'krsList'));
    }
}
