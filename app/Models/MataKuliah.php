<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Tugas;
use App\Models\Pengguna; // Tambahkan ini juga jika Pengguna berada di namespace terpisah
class MataKuliah extends Model
{
    protected $table = 'mata_kuliah';

    protected $fillable = [
        'id_pengajar',
        'nama_matkul',
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
