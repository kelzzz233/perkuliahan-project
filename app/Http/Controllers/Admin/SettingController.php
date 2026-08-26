<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\MataKuliah;
use App\Models\Pengguna;

class SettingController extends Controller
{
    // Menampilkan halaman admin dashboard sekaligus membawa data status KRS
    public function index()
    {
        $users = Pengguna::all();
        $matkuls = MataKuliah::with('pengajar')->get();
        
        // Ambil status KRS dari tabel settings, default 1 (Buka) jika belum ada
        $settingKrs = DB::table('settings')->where('key', 'status_krs')->first();
        $statusKrs = $settingKrs ? $settingKrs->value : 1; 

        return view('admin', compact('users', 'matkuls', 'statusKrs'));
    }

    // Memperbarui status Buka/Tutup KRS
    public function updateKrs(Request $request)
    {
        $request->validate([
            'status_krs' => 'required|in:0,1',
        ]);

        DB::table('settings')->updateOrInsert(
            ['key' => 'status_krs'],
            ['value' => $request->status_krs]
        );

        return back()->with('sukses', 'Status pengisian KRS berhasil diperbarui!');
    }
}