<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;




class Pengguna extends Authenticatable
{
    use Notifiable;
    protected $table = 'pengguna';
    protected $fillable = [
    'nama',
    'nim', 
    'email',
    'kata_sandi',
    'peran',
    'jurusan',
];
    protected $hidden = ['kata_sandi'];

    public function getAuthPassword() {
        return $this->kata_sandi;
    }
}
