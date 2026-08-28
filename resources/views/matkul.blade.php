<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mata Kuliah - Portal Dosen</title>
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
        input[type="text"] { width: 100%; padding: 12px 14px; border: 1px solid #cbd5e1; border-radius: 9px; background: #f8fafc; color: #0f172a; font-size: 14px; outline: none; }
        input[type="text"]:focus { border-color: #4f46e5; background: white; box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1); }
        
        .btn-primary { border: none; padding: 11px 18px; border-radius: 9px; font-weight: 700; cursor: pointer; background: linear-gradient(135deg, #4f46e5, #2563eb); color: white; box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2); }
        .btn-primary:hover { opacity: 0.95; }
        
        .matkul-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 15px; }
        .matkul-item { background: #f8fafc; border: 1px solid #e2e8f0; padding: 16px; border-radius: 12px; transition: 0.2s; }
        .matkul-item:hover { border-color: #cbd5e1; transform: translateY(-2px); box-shadow: 0 4px 12px rgba(0,0,0,0.03); }
        .matkul-id { font-size: 11px; font-weight: 700; color: #4f46e5; margin-bottom: 6px; }
        .matkul-name { font-size: 15px; font-weight: 600; color: #0f172a; }
        .empty { text-align: center; padding: 30px; color: #94a3b8; font-size: 14px; }
    </style>
</head>
<body>

    <!-- SIDEBAR -->
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
            <a href="/dosen/matkul" class="nav-item active">
                📚 Mata Kuliah
            </a>
            <a href="/dosen/tugas" class="nav-item">
                📝 Buat Tugas
            </a>
            <a href="/dosen/nilai" class="nav-item">
                📈 Nilai & Tugas Mhs
            </a>
        </div>
    </div>

    <!-- MAIN CONTENT -->
    <div class="main-content">
        <div class="container">

            <!-- NOTIFIKASI -->
            @if(session('sukses_matkul') || session('success'))
                <div class="alert">
                    📚 {{ session('sukses_matkul') ?? session('success') }}
                </div>
            @endif

            <!-- TAMBAH MATKUL -->
            <div class="card">
                <div class="card-title">
                    <div class="icon">📚</div>
                    <div>
                        <h2>Tambah Mata Kuliah</h2>
                        <div class="card-subtitle">Tambahkan mata kuliah baru yang Anda ajarkan</div>
                    </div>
                </div>

                <form action="{{ route('dosen.matkul.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Nama Mata Kuliah</label>
                        <input type="text" name="nama_matkul" placeholder="Contoh: Pemrograman Web" required>
                    </div>
                    <button type="submit" class="btn-primary">+ Simpan Mata Kuliah</button>
                </form>
            </div>

            <!-- DAFTAR MATKUL -->
            <div class="card">
                <div class="card-title">
                    <div class="icon">📖</div>
                    <div>
                        <h2>Mata Kuliah Saya</h2>
                        <div class="card-subtitle">Daftar mata kuliah yang Anda buat</div>
                    </div>
                </div>

                @if(isset($matkuls) && $matkuls->count() > 0)
                    <div class="matkul-grid">
                        @foreach($matkuls as $m)
                            <div class="matkul-item">
                                <div class="matkul-id">ID MATKUL #{{ $m->id }}</div>
                                <div class="matkul-name">{{ $m->nama_matkul ?? $m->nama }}</div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="empty">
                        Belum ada mata kuliah yang ditambahkan. Silakan tambahkan mata kuliah terlebih dahulu.
                    </div>
                @endif
            </div>

        </div>
    </div>

</body>
</html>