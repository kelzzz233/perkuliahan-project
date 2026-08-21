<?php

namespace App\Http\Controllers;

use App\Models\MataKuliah;
use App\Models\Pengguna;
use App\Models\Pengumpulan;
use App\Models\Tugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    // ==========================================
    // BAGIAN ADMIN (Kelola User & Mata Kuliah)
    // ==========================================

    public function adminDashboard()
    {
        $users = Pengguna::all();
        $matkuls = MataKuliah::with('pengajar')->get();
        return view('admin', compact('users', 'matkuls'));
    }

    // Tambah Akun User (Admin)
    public function storeUser(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|unique:pengguna,email',
            'kata_sandi' => 'required|string|min:6',
            'peran' => 'required|in:mahasiswa,dosen,admin',
        ]);

        Pengguna::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'kata_sandi' => Hash::make($request->kata_sandi),
            'peran' => $request->peran,
        ]);

        return back()->with('sukses', 'Akun pengguna berhasil ditambahkan!');
    }

    // Edit Akun User (Admin)
    public function updateUser(Request $request, $id)
    {
        $user = Pengguna::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|unique:pengguna,email,' . $id,
            'peran' => 'required|in:mahasiswa,dosen,admin',
        ]);

        $user->nama = $request->nama;
        $user->email = $request->email;
        $user->peran = $request->peran;

        // Password opsional diisi saat edit (hanya jika diisi)
        if ($request->filled('kata_sandi')) {
            $user->kata_sandi = Hash::make($request->kata_sandi);
        }

        $user->save();

        return back()->with('sukses', 'Akun pengguna berhasil diperbarui!');
    }

    // Hapus Akun User (Admin)
    public function deleteUser($id)
    {
        $user = Pengguna::findOrFail($id);

        // Mencegah admin menghapus akunnya sendiri yang sedang login
        if ($user->id === Auth::id()) {
            return back()->with('error', 'Anda tidak dapat menghapus akun yang sedang digunakan saat ini!');
        }

        $user->delete();
        return back()->with('sukses', 'Akun pengguna berhasil dihapus!');
    }

    // Tambah Mata Kuliah oleh Admin (atau bisa pilih pengajar)
    public function storeMatkulAdmin(Request $request)
    {
        $request->validate([
            'nama_matkul' => 'required|string|max:255',
            'id_pengajar' => 'required|exists:pengguna,id',
        ]);

        MataKuliah::create([
            'nama_matkul' => $request->nama_matkul,
            'id_pengajar' => $request->id_pengajar,
        ]);

        return back()->with('sukses_matkul', 'Mata Kuliah berhasil ditambahkan!');
    }

    // Edit Mata Kuliah (Admin)
    public function updateMatkul(Request $request, $id)
    {
        $matkul = MataKuliah::findOrFail($id);

        $request->validate([
            'nama_matkul' => 'required|string|max:255',
            'id_pengajar' => 'required|exists:pengguna,id',
        ]);

        $matkul->update([
            'nama_matkul' => $request->nama_matkul,
            'id_pengajar' => $request->id_pengajar,
        ]);

        return back()->with('sukses_matkul', 'Mata Kuliah berhasil diperbarui!');
    }


    // ==========================================
    // BAGIAN DOSEN
    // ==========================================

    public function dosenDashboard()
    {
        $dosenId = Auth::id();

        $matkuls = MataKuliah::where('id_pengajar', $dosenId)->get();
        $tugas = Tugas::where('id_pengguna', $dosenId)->with('mataKuliah')->get();
        $pengumpulan = Pengumpulan::with(['tugas', 'siswa'])->latest()->get();

        return view('dosen', compact('matkuls', 'tugas', 'pengumpulan'));
    }

    // Simpan Mata Kuliah Baru (Dosen mandiri)
    public function storeMatkul(Request $request)
    {
        $request->validate([
            'nama_matkul' => 'required|string|max:255',
        ]);

        MataKuliah::create([
            'nama_matkul' => $request->nama_matkul,
            'id_pengajar' => Auth::id(),
        ]);

        return back()->with('sukses_matkul', 'Mata Kuliah berhasil ditambahkan!');
    }

    // Simpan Tugas Baru (Dosen)
    public function storeTugas(Request $request)
    {
        $request->validate([
            'id_matkul'      => 'required|exists:mata_kuliah,id',
            'judul'          => 'required|string|max:255',
            'deskripsi'      => 'nullable|string',
            'tenggat_waktu'  => 'required',
            'jurusan_tujuan' => 'required',
        ]);

        Tugas::create([
            'id_matkul'      => $request->id_matkul,
            'id_pengguna'    => Auth::id(),
            'judul'          => $request->judul,
            'deskripsi'      => $request->deskripsi ?? '-',
            'tenggat_waktu'  => $request->tenggat_waktu,
            'jurusan_tujuan' => $request->jurusan_tujuan,
        ]);

        return back()->with('success', 'Tugas berhasil ditambahkan!');
    }

    // Simpan Nilai & Catatan (Dosen)
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


    // ==========================================
    // BAGIAN MAHASISWA
    // ==========================================

    public function mahasiswaDashboard()
    {
        $mahasiswa = Auth::guard('mahasiswa')->user();

        // Pastikan pencarian ini sesuai dengan isi data di database
        $tugas = \App\Models\Tugas::where('jurusan_tujuan', $mahasiswa->jurusan)->get();

        return view('mahasiswa', compact('tugas', 'mahasiswa'));
    }

    // Simpan Pengumpulan Tugas (Mahasiswa)
    public function kumpulTugas(Request $request)
    {
        $request->validate([
            'id_tugas' => 'required',
            'berkas'   => 'required|file|mimes:pdf,doc,docx,zip|max:2048',
        ]);

        $path = $request->file('berkas')->store('tugas_siswa', 'public');

        Pengumpulan::create([
            'id_tugas'     => $request->id_tugas,
            'id_siswa'     => Auth::guard('mahasiswa')->id(),
            'jalur_berkas' => $path,
        ]);

        return back()->with('sukses', 'Tugas berhasil dikirim!');
    }
}
