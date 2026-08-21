<?php

namespace App\Http\Controllers;

use App\Models\Tugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TugasController extends Controller
{
    // Fungsi untuk Dosen menyimpan tugas baru
    public function store(Request $request)
    {
        // 1. Validasi input dari form dosen
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required',
            'jurusan_tujuan' => 'required', // RPL, TKJ, dll
        ]);

        // 2. Simpan ke database
        Tugas::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'jurusan_tujuan' => $request->jurusan_tujuan,
        ]);

        return redirect()->back()->with('success', 'Tugas berhasil dikirim ke jurusan ' . $request->jurusan_tujuan);
    }

    // Fungsi untuk Mahasiswa melihat tugas
    public function index()
    {
        // 1. Ambil data mahasiswa yang sedang login
        $mahasiswa = Auth::guard('mahasiswa')->user();

        // 2. Filter: Hanya ambil tugas yang jurusannya SAMA dengan jurusan mahasiswa
        $tugas = Tugas::where('jurusan_tujuan', $mahasiswa->jurusan)->get();

        // 3. Kirim data ke view
        return view('mahasiswa.tugas', compact('tugas'));
    }
}
