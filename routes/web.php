<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthMahasiswaController;
use App\Http\Controllers\Admin\SettingController; 
use App\Http\Controllers\DosenController;

// Redirect Halaman Utama
Route::get('/', function () {
    return redirect()->route('login');
});

// Route Login & Register Mahasiswa (Terpisah)
Route::get('/login/mahasiswa', [AuthMahasiswaController::class, 'showLogin'])->name('mahasiswa.login');
Route::post('/login/mahasiswa', [AuthMahasiswaController::class, 'login'])->name('mahasiswa.login.proses');
Route::post('/logout/mahasiswa', [AuthMahasiswaController::class, 'logout'])->name('mahasiswa.logout');
Route::post('/register/mahasiswa', [AuthMahasiswaController::class, 'register'])->name('mahasiswa.register');

// Guest (Belum Login - Untuk Admin & Dosen)
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// Logout Admin & Dosen
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route khusus Mahasiswa (Menggunakan Guard 'auth:mahasiswa')
Route::middleware(['auth:mahasiswa'])->prefix('mahasiswa')->name('mahasiswa.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'mahasiswaDashboard'])->name('dashboard');
    Route::post('/kumpul', [DashboardController::class, 'kumpulTugas'])->name('kumpul');
    Route::put('/profil/update', [DashboardController::class, 'updateProfilMahasiswa'])->name('profil.update');

    // Route KRS
    Route::post('/krs/store', [DashboardController::class, 'storeKrs'])->name('krs.store');
    Route::delete('/krs/delete/{id}', [DashboardController::class, 'destroyKrs'])->name('krs.delete');
});

// Route khusus Dosen (Dipecah per halaman)
Route::middleware(['auth', 'peran:dosen'])->prefix('dosen')->name('dosen.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dosenDashboard'])->name('dashboard');
    Route::get('/matkul', [DashboardController::class, 'dosenMatkulIndex'])->name('matkul');
    Route::get('/tugas', [DashboardController::class, 'dosenTugasIndex'])->name('tugas');
    Route::get('/nilai', [DashboardController::class, 'dosenNilaiIndex'])->name('nilai');

    // Proses Simpan / Store
    Route::post('/matkul', [DashboardController::class, 'storeMatkul'])->name('matkul.store');
    Route::post('/tugas', [DashboardController::class, 'storeTugas'])->name('tugas.store');
    Route::post('/nilai/{id}', [DashboardController::class, 'beriNilai'])->name('nilai.simpan');

    // Route lihat berkas mahasiswa oleh dosen
    Route::get('/berkas/{id}', [DashboardController::class, 'lihatBerkas'])->name('berkas.lihat');
});

// Route khusus Admin
Route::middleware(['auth', 'peran:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'adminDashboard'])->name('dashboard');
    Route::post('/user/store', [DashboardController::class, 'storeUser'])->name('user.store');
    Route::put('/user/update/{id}', [DashboardController::class, 'updateUser'])->name('user.update');
    Route::delete('/user/delete/{id}', [DashboardController::class, 'deleteUser'])->name('user.delete');

    // CRUD Mata Kuliah oleh Admin
    Route::post('/matkul/store', [DashboardController::class, 'storeMatkulAdmin'])->name('matkul.store');
    Route::put('/matkul/update/{id}', [DashboardController::class, 'updateMatkul'])->name('matkul.update');

    // === PENGATURAN STATUS KRS ===
    Route::get('/settings', [SettingController::class, 'index'])->name('settings');
    Route::put('/settings/krs', [SettingController::class, 'updateKrs'])->name('update-krs');
});