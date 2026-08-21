<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Pengumpulan; // Sesuaikan namespace jika lokasi model Anda berbeda

class Tugas extends Model
{

    protected $table = 'tugas';

    protected $fillable = [
    'id_matkul',
    'id_pengguna',
    'judul',
    'deskripsi',
    'tenggat_waktu',
  ];
  
    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'id_pengguna');
    }

    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class, 'id_matkul');
    }

    public function pengumpulan()
    {
        return $this->hasMany(Pengumpulan::class, 'id_tugas');
    }
}
