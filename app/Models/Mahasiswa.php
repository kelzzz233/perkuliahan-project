<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Mahasiswa extends Authenticatable
{
    protected $table = 'pengguna'; // Sesuaikan dengan nama tabel di database kamu

    protected $fillable = ['nama', 'email', 'kata_sandi'];

    protected $hidden = ['kata_sandi'];

    // Menyesuaikan jika kolom password di database kamu bernama 'kata_sandi'
    public function getAuthPassword()
    {
        return $this->kata_sandi;
    }
}
