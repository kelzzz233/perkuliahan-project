<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengumpulan extends Model
{
    use HasFactory;

    // Sesuaikan dengan nama tabel tunggal atau jamak yang kamu simpan di database
    protected $table = 'pengumpulan'; // Ubah jadi 'pengumpulans' jika itu tabel yang kamu pakai

    protected $fillable = [
        'id_tugas',
        'id_siswa',
        'jalur_berkas',
        'nilai',
        'catatan',
    ];

    public function tugas()
    {
        return $this->belongsTo(Tugas::class, 'id_tugas');
    }

    public function siswa()
    {
        return $this->belongsTo(Pengguna::class, 'id_siswa');
    }
}
