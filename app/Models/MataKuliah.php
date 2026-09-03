<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Tugas;
use App\Models\Pengguna;

class MataKuliah extends Model
{
    protected $table = 'mata_kuliah';

   protected $fillable = [
        'id_pengajar',
        'nama_matkul',
        'id_matkul', // Hanya ini kolom kustom kita
    ];

    public function pengajar()
    {
        return $this->belongsTo(Pengguna::class, 'id_pengajar');
    }

    public function tugas()
    {
        return $this->hasMany(Tugas::class, 'id_matkul');
    }
}