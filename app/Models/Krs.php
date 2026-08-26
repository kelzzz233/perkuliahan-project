<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Krs extends Model
{
    protected $table = 'krs';
    protected $primaryKey = 'id_krs'; // Sesuaikan jika primary key Anda id_krs

    // TAMBAHKAN BARIS INI:
    protected $fillable = [
        'id_pengguna',
        'id_tugas',
        'semester',
    ];

    // Relasi ke tabel mata_kuliah
    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class, 'id_tugas', 'id'); 
    }
}