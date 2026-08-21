<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengumpulans', function (Blueprint $table) {
        $table->id();
        $table->foreignId('id_siswa');
        $table->foreignId('id_tugas');
        $table->string('berkas');
        $table->integer('nilai')->nullable();
        $table->string('berkas_nilai')->nullable();
        $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::table('pengumpulans', function (Blueprint $table) {
            $table->dropColumn(['nilai', 'berkas_nilai']);
        });
    }
};
