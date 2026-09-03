<?php

namespace App\Http\Controllers;

use App\Models\MataKuliah;
use App\Models\Pengguna;
use App\Models\Pengumpulan;
use App\Models\Tugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\Krs;

class DashboardController extends Controller
{
    // ==========================================
    // BAGIAN ADMIN (Kelola User & Mata Kuliah)
    // ==========================================

    public function adminDashboard()
    {
        $users = Pengguna::all();

        // Ambil data mata kuliah, lalu group berdasarkan id_pengajar
        $groupedMatkuls = MataKuliah::with('pengajar')->get()->groupBy('id_pengajar');

        $settingKrs = DB::table('settings')->where('key', 'status_krs')->first();
        $statusKrs = $settingKrs ? $settingKrs->value : 1;

        return view('admin', compact('users', 'groupedMatkuls', 'statusKrs'));
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nim' => 'nullable|string|max:50',
            'email' => 'required|string|email|unique:pengguna,email',
            'kata_sandi' => 'required|string|min:6',
            'peran' => 'required|in:mahasiswa,dosen,admin',
            'jurusan' => 'nullable|string|max:255',
        ]);

        Pengguna::create([
            'nama' => $request->nama,
            'nim' => $request->nim,
            'email' => $request->email,
            'kata_sandi' => Hash::make($request->kata_sandi),
            'peran' => $request->peran,
            'jurusan' => $request->jurusan ?? '-',
        ]);

        return redirect()->back()->with('success', 'Pengguna berhasil ditambahkan!');
    }

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

        if ($request->filled('kata_sandi')) {
            $user->kata_sandi = Hash::make($request->kata_sandi);
        }

        $user->save();

        return back()->with('sukses', 'Akun pengguna berhasil diperbarui!');
    }

    public function deleteUser($id)
    {
        $user = Pengguna::findOrFail($id);

        if ($user->id === Auth::id()) {
            return back()->with('error', 'Anda tidak dapat menghapus akun yang sedang digunakan saat ini!');
        }

        $user->delete();
        return back()->with('sukses', 'Akun pengguna berhasil dihapus!');
    }

   public function storeMatkulAdmin(Request $request)
    {
        $request->validate([
            'nama_matkul' => 'required|string|max:255',
            'id_pengajar' => 'required|exists:pengguna,id',
            'id_matkul'   => 'nullable|string|max:255',
        ]);

        $existingMatkul = MataKuliah::where('nama_matkul', $request->nama_matkul)->oldest()->first();

        $assignedIdMatkul = null;
        if ($existingMatkul) {
            $assignedIdMatkul = $existingMatkul->id_matkul ?? $existingMatkul->id;
        } else {
            $assignedIdMatkul = $request->id_matkul;
        }

        MataKuliah::create([
            'nama_matkul' => $request->nama_matkul,
            'id_pengajar' => $request->id_pengajar,
            'id_matkul'   => $assignedIdMatkul,
        ]);

        return back()->with('sukses_matkul', 'Mata Kuliah berhasil ditambahkan!');
    }

    public function updateMatkul(Request $request, $id)
    {
        $matkul = MataKuliah::findOrFail($id);

        $request->validate([
            'nama_matkul' => 'required|string|max:255',
            'id_pengajar' => 'required|exists:pengguna,id',
            'id_matkul' => 'nullable|string|max:255',
        ]);

        $matkul->update([
            'nama_matkul' => $request->nama_matkul,
            'id_pengajar' => $request->id_pengajar,
            'id_matkul' => $request->id_matkul,
        ]);

        return back()->with('sukses_matkul', 'Mata Kuliah berhasil diperbarui!');
    }

    public function updateStatusKrs(Request $request)
    {
        $request->validate([
            'status_krs' => 'required|in:0,1',
        ]);

        DB::table('settings')->updateOrInsert(
            ['key' => 'status_krs'],
            ['value' => $request->status_krs]
        );

        return back()->with('sukses', 'Status KRS berhasil diperbarui!');
    }


    // ==========================================
    // BAGIAN DOSEN
    // ==========================================

    public function dosenDashboard()
    {
        $dosenId = Auth::id();
        $matkuls = MataKuliah::where('id_pengajar', $dosenId)->get();
        $pengumpulan = Pengumpulan::with(['tugas', 'siswa'])->latest()->get();

        return view('dosen', compact('matkuls', 'pengumpulan'));
    }

    public function dosenMatkulIndex()
    {
        $dosenId = Auth::id();
        $matkuls = MataKuliah::where('id_pengajar', $dosenId)->get();

        return view('matkul', compact('matkuls'));
    }

    public function dosenTugasIndex()
    {
        $dosenId = Auth::id();
        $matkuls = MataKuliah::where('id_pengajar', $dosenId)->get();
        $tugas = Tugas::where('id_pengguna', $dosenId)->with('mataKuliah')->get();

        return view('tugas', compact('matkuls', 'tugas'));
    }

    public function dosenNilaiIndex()
    {
        $pengumpulan = Pengumpulan::with(['tugas', 'siswa'])->latest()->get();

        return view('nilai', compact('pengumpulan'));
    }

   public function storeMatkul(Request $request)
    {
        $request->validate([
            'nama_matkul' => 'required|string|max:255',
            'id_matkul'   => 'nullable|string|max:255',
        ]);

        // Cek apakah mata kuliah dengan nama yang sama sudah ada di database
        $existingMatkul = MataKuliah::where('nama_matkul', $request->nama_matkul)->oldest()->first();

        // Tentukan id_matkul: jika sudah ada yang lama, ambil id_matkul miliknya (atau id utamanya jika id_matkul-nya kosong). Jika belum ada, pakai input baru atau biarkan.
        $assignedIdMatkul = null;
        if ($existingMatkul) {
            $assignedIdMatkul = $existingMatkul->id_matkul ?? $existingMatkul->id;
        } else {
            $assignedIdMatkul = $request->id_matkul;
        }

        MataKuliah::create([
            'nama_matkul' => $request->nama_matkul,
            'id_pengajar' => Auth::id(),
            'id_matkul'   => $assignedIdMatkul, 
        ]);

        return back()->with('sukses_matkul', 'Mata Kuliah berhasil ditambahkan!');
    }

    public function storeTugas(Request $request)
    {
        $request->validate([
            'jurusan_tujuan' => 'required',
            'id_matkul'      => 'required',
            'judul'          => 'required',
            'deskripsi'      => 'required',
            'tenggat_waktu'  => 'required',
        ]);

        \App\Models\Tugas::create([
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
        $jurusanMhs = strtolower(trim($mahasiswa->jurusan ?? ''));

        $tugas = \App\Models\Tugas::where(function($query) use ($jurusanMhs) {
            $query->whereRaw('LOWER(TRIM(jurusan_tujuan)) = ?', [$jurusanMhs])
                  ->orWhereRaw('LOWER(TRIM(jurusan_tujuan)) = ?', ['semua'])
                  ->orWhereRaw('LOWER(TRIM(jurusan_tujuan)) = ?', ['-'])
                  ->orWhereNull('jurusan_tujuan');
        })->get();

        $semuaMatkul = \App\Models\MataKuliah::all()->unique('nama_matkul');
        $krsList = \App\Models\Krs::where('id_pengguna', $mahasiswa->id)->get();
        $totalSks = $krsList->sum(function($item) {
            return $item->mataKuliah->sks ?? 3;
        });

        return view('mahasiswa', compact('mahasiswa', 'tugas', 'semuaMatkul', 'krsList', 'totalSks'));
    }

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

   
public function storeKrs(Request $request)
{
    $settingKrs = DB::table('settings')->where('key', 'status_krs')->first();
    $statusKrs = $settingKrs ? $settingKrs->value : 1;

    if ($statusKrs == 0) {
        return redirect()->back()->with('error', 'Maaf, periode pengisian KRS sedang ditutup oleh Admin.');
    }

    $request->validate([
        'id_matkul' => 'required', 
    ]);

    // Tetap gunakan 'id_tugas' jika kolom di database aslinya memang bernama id_tugas
    Krs::create([
        'id_pengguna' => Auth::guard('mahasiswa')->id(),
        'id_tugas'    => $request->id_matkul, // Mengambil input id_matkul, lalu disimpan ke kolom id_tugas database
        'semester'    => 1,
    ]);

    return redirect()->back()->with('sukses', 'Mata kuliah berhasil ditambahkan ke KRS!');
}

    public function destroyKrs($id)
    {
        $settingKrs = DB::table('settings')->where('key', 'status_krs')->first();
        $statusKrs = $settingKrs ? $settingKrs->value : 1;

        if ($statusKrs == 0) {
            return redirect()->back()->with('error', 'Maaf, periode pengisian/perubahan KRS sedang ditutup oleh Admin.');
        }

        $krs = Krs::findOrFail($id);
        $krs->delete();

        return redirect()->back()->with('success', 'Mata kuliah berhasil dihapus dari KRS.');
    }

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

    public function updateProfilMahasiswa(Request $request)
    {
        $user = Auth::guard('mahasiswa')->user();

        $request->validate([
            'nama' => 'required|string|max:255',
            'nim'  => 'required|string|max:50|unique:pengguna,nim,' . $user->id,
        ]);

        $user->update([
            'nama' => $request->nama,
            'nim'  => $request->nim,
        ]);

        return back()->with('sukses', 'Profil berhasil diperbarui!');
    }
}