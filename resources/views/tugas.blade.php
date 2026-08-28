<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Tugas - Portal Dosen</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        body { background: #f8fafc; color: #0f172a; display: flex; min-height: 100vh; }
        
        /* SIDEBAR */
        .sidebar { width: 260px; background: white; border-right: 1px solid #e2e8f0; padding: 25px 20px; display: flex; flex-direction: column; position: fixed; height: 100vh; }
        .brand { display: flex; align-items: center; gap: 12px; margin-bottom: 30px; }
        .brand-icon { width: 45px; height: 45px; background: linear-gradient(135deg, #4f46e5, #2563eb); border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 22px; box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3); }
        .brand-title { font-size: 17px; font-weight: 700; color: #0f172a; }
        .brand-subtitle { font-size: 12px; color: #64748b; }
        
        .menu-label { font-size: 11px; font-weight: 700; color: #94a3b8; letter-spacing: 0.5px; margin-bottom: 15px; text-transform: uppercase; }
        
        .nav-menu { display: flex; flex-direction: column; gap: 8px; }
        .nav-item { display: flex; align-items: center; gap: 12px; padding: 12px 15px; border-radius: 12px; text-decoration: none; color: #475569; font-weight: 600; font-size: 14px; transition: 0.2s; }
        .nav-item:hover { background: #f1f5f9; color: #0f172a; }
        .nav-item.active { background: #eef2ff; color: #4f46e5; }

        /* MAIN CONTENT */
        .main-content { margin-left: 260px; flex: 1; padding: 40px; max-width: calc(100vw - 260px); }
        .container { max-width: 1100px; margin: 0 auto; }
        
        .alert { padding: 14px 18px; border-radius: 10px; margin-bottom: 20px; font-size: 14px; font-weight: 600; background: #dcfce7; color: #166534; border: 1px solid #bbf7d0; }
        .card { background: white; border-radius: 16px; padding: 25px; margin-bottom: 25px; border: 1px solid #e2e8f0; box-shadow: 0 5px 20px rgba(15, 23, 42, .04); }
        .card-title { display: flex; align-items: center; gap: 12px; margin-bottom: 20px; }
        .icon { width: 40px; height: 40px; background: #eef2ff; color: #4f46e5; display: flex; align-items: center; justify-content: center; border-radius: 10px; font-size: 19px; }
        h2 { font-size: 18px; color: #0f172a; }
        .card-subtitle { font-size: 13px; color: #64748b; margin-top: 2px; }
        
        .form-group { margin-bottom: 18px; }
        label { display: block; font-size: 13px; font-weight: 700; color: #475569; margin-bottom: 7px; }
        input[type="text"], input[type="date"], select, textarea { width: 100%; padding: 12px 14px; border: 1px solid #cbd5e1; border-radius: 9px; background: #f8fafc; color: #0f172a; font-size: 14px; outline: none; font-family: inherit; }
        input:focus, select:focus, textarea:focus { border-color: #4f46e5; background: white; box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1); }
        
        .btn-primary { border: none; padding: 11px 18px; border-radius: 9px; font-weight: 700; cursor: pointer; background: linear-gradient(135deg, #4f46e5, #2563eb); color: white; box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2); }
        .btn-primary:hover { opacity: 0.95; }
        
        .tugas-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 15px; }
        .tugas-item { background: #f8fafc; border: 1px solid #e2e8f0; padding: 16px; border-radius: 12px; }
        .tugas-matkul { font-size: 11px; font-weight: 700; color: #4f46e5; margin-bottom: 6px; text-transform: uppercase; }
        .tugas-name { font-size: 15px; font-weight: 600; color: #0f172a; margin-bottom: 8px; }
        .tugas-desc { font-size: 13px; color: #64748b; margin-bottom: 10px; }
        .empty { text-align: center; padding: 30px; color: #94a3b8; font-size: 14px; }
    </style>
</head>
<body>

    <div class="sidebar">
        <div class="brand">
            <div class="brand-icon">🎓</div>
            <div>
                <div class="brand-title">Portal Dosen</div>
                <div class="brand-subtitle">Akademik Kampus</div>
            </div>
        </div>

        <div class="menu-label">Menu Utama</div>
        <div class="nav-menu">
            <a href="{{ route('dosen.dashboard') }}" class="nav-item">
                📊 Dashboard Utama
            </a>
            <a href="{{ route('dosen.matkul') }}" class="nav-item">
                📚 Mata Kuliah
            </a>
            <a href="{{ route('dosen.tugas') }}" class="nav-item active">
                📝 Buat Tugas
            </a>
            <a href="{{ route('dosen.nilai') }}" class="nav-item">
                📈 Nilai & Tugas Mhs
            </a>
        </div>
    </div>

    <div class="main-content">
        <div class="container">

            @if(session('success') || session('sukses'))
                <div class="alert">
                    📝 {{ session('success') ?? session('sukses') }}
                </div>
            @endif

            <div class="card">
                <div class="card-title">
                    <div class="icon">📝</div>
                    <div>
                        <h2>Buat Tugas Baru</h2>
                        <div class="card-subtitle">Berikan penugasan kepada mahasiswa sesuai mata kuliah dan jurusan</div>
                    </div>
                </div>

                <form action="{{ route('dosen.tugas.store') }}" method="POST">
                    @csrf
                    
                    <div class="form-group">
                        <label>Jurusan Tujuan</label>
                        <select name="jurusan_tujuan" required>
                            <option value="">-- Pilih Jurusan Tujuan --</option>
                            <option value="RPL">RPL</option>
                            <option value="TKJ">TKJ</option>
                            <option value="Multimedia">Multimedia</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Pilih Mata Kuliah</label>
                        <select name="id_matkul" required>
                            <option value="">-- Pilih Mata Kuliah --</option>
                            @if(isset($matkuls))
                                @foreach($matkuls as $m)
                                    <option value="{{ $m->id }}">{{ $m->nama_matkul ?? $m->nama }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Judul Tugas</label>
                        <input type="text" name="judul" placeholder="Contoh: Membuat CRUD Laravel" required>
                    </div>

                    <div class="form-group">
                        <label>Deskripsi / Instruksi Tugas</label>
                        <textarea name="deskripsi" rows="3" placeholder="Tuliskan detail instruksi tugas di sini..." required></textarea>
                    </div>

                    <div class="form-group">
                     <label>Tenggat Waktu</label>
                    <input type="datetime-local" name="tenggat_waktu" required>
                    </div>

                    <button type="submit" class="btn-primary">+ Publikasikan Tugas</button>
                </form>
            </div>

            <div class="card">
                <div class="card-title">
                    <div class="icon">📋</div>
                    <div>
                        <h2>Daftar Tugas Aktif</h2>
                        <div class="card-subtitle">Daftar tugas yang telah Anda berikan ke mahasiswa</div>
                    </div>
                </div>

                @if(isset($tugas) && $tugas->count() > 0)
                    <div class="tugas-grid">
                        @foreach($tugas as $t)
                            <div class="tugas-item">
                                <div class="tugas-matkul">
                                    {{ $t->jurusan_tujuan ?? 'Umum' }} — {{ $t->mataKuliah->nama_matkul ?? $t->mataKuliah->nama ?? 'Mata Kuliah' }}
                                </div>
                                <div class="tugas-name">{{ $t->judul }}</div>
                                <div class="tugas-desc">{{ Str::limit($t->deskripsi, 80) }}</div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="empty">
                        Belum ada tugas yang dibuat. Silakan buat tugas baru melalui form di atas.
                    </div>
                @endif
            </div>

        </div>
    </div>

</body>
</html>