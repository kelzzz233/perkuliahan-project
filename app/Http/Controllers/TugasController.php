<?php

namespace App\Http\Controllers;

use App\Models\Pengumpulan;
use App\Models\Tugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TugasController extends Controller
{
    // === METHOD DOSEN: BUAT TUGAS ===
    public function store(Request $request)
    {
        $request->validate([
            'jurusan_tujuan' => 'required',
            'id_matkul'      => 'required',
            'judul'          => 'required',
            'deskripsi'      => 'required',
            'tenggat_waktu'  => 'required',
        ]);

        Tugas::create([
            'id_pengguna'    => Auth::id(),
            'id_matkul'      => $request->input('id_matkul'),
            'judul'          => $request->judul,
            'deskripsi'      => $request->deskripsi,
            'jurusan_tujuan' => $request->jurusan_tujuan,
            'tenggat_waktu'  => $request->tenggat_waktu,
            'status'         => 'pending',
        ]);

        return redirect()->back()->with('success', 'Tugas berhasil dibuat!');
    }

    // === METHOD DOSEN: EDIT TUGAS ===
    public function update(Request $request, $id)
    {
        $request->validate([
            'jurusan_tujuan' => 'required',
            'id_matkul'      => 'required',
            'judul'          => 'required',
            'deskripsi'      => 'required',
            'tenggat_waktu'  => 'required',
        ]);

        $tugas = Tugas::findOrFail($id);
        $tugas->update([
            'jurusan_tujuan' => $request->jurusan_tujuan,
            'id_matkul'      => $request->id_matkul,
            'judul'          => $request->judul,
            'deskripsi'      => $request->deskripsi,
            'tenggat_waktu'  => $request->tenggat_waktu,
        ]);

        return redirect()->back()->with('success', 'Tugas berhasil diperbarui!');
    }

    // === METHOD DOSEN: HAPUS TUGAS ===
    public function destroy($id)
    {
        $tugas = Tugas::findOrFail($id);
        $tugas->delete();

        return redirect()->back()->with('success', 'Tugas berhasil dihapus!');
    }

    // === METHOD DOSEN: BERI NILAI TUGAS ===
    public function beriNilai(Request $request, $id)
    {
        $request->validate([
            'nilai'   => 'required|numeric|min:0|max:100',
            'catatan' => 'nullable|string',
        ]);

        $pengumpulan = Pengumpulan::findOrFail($id);
        $pengumpulan->update([
            'nilai'   => $request->nilai,
            'catatan' => $request->catatan,
        ]);

        return back()->with('sukses', 'Nilai berhasil disimpan!');
    }

    // === METHOD MAHASISWA: KUMPUL TUGAS ===
    public function kumpulTugas(Request $request)
    {
        $request->validate([
            'id_tugas'   => 'required|exists:tugas,id',
            'link_tugas' => 'required|url',
        ], [
            'link_tugas.required' => 'Link tugas wajib diisi.',
            'link_tugas.url'      => 'Format link tidak valid. Harus diawali dengan http:// atau https://',
        ]);

        Pengumpulan::create([
            'id_tugas'     => $request->id_tugas,
            'id_siswa'     => Auth::guard('mahasiswa')->id(),
            'jalur_berkas' => $request->link_tugas,
        ]);

        return back()->with('sukses', 'Link tugas berhasil dikirim!');
    }

    // === METHOD UMUM: LIHAT BERKAS/LINK TUGAS ===
    public function lihatBerkas($id)
    {
        $p = Pengumpulan::findOrFail($id);

        if (filter_var($p->jalur_berkas, FILTER_VALIDATE_URL)) {
            return redirect()->away($p->jalur_berkas);
        }

        $path = storage_path('app/public/' . $p->jalur_berkas);

        if (!file_exists($path)) {
            abort(404, 'Berkas fisik tidak ditemukan di server.');
        }

        return response()->file($path);
    }
}
