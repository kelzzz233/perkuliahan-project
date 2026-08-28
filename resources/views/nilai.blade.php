<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nilai & Tugas Mahasiswa - Portal Dosen</title>
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
        .container { max-width: 1200px; margin: 0 auto; }
        
        .alert { padding: 14px 18px; border-radius: 10px; margin-bottom: 20px; font-size: 14px; font-weight: 600; background: #dcfce7; color: #166534; border: 1px solid #bbf7d0; }
        .card { background: white; border-radius: 16px; padding: 25px; margin-bottom: 25px; border: 1px solid #e2e8f0; box-shadow: 0 5px 20px rgba(15, 23, 42, .04); }
        .card-title { display: flex; align-items: center; gap: 12px; margin-bottom: 20px; }
        .icon { width: 40px; height: 40px; background: #eef2ff; color: #4f46e5; display: flex; align-items: center; justify-content: center; border-radius: 10px; font-size: 19px; }
        h2 { font-size: 18px; color: #0f172a; }
        .card-subtitle { font-size: 13px; color: #64748b; margin-top: 2px; }

        /* TABLE STYLING */
        .table-responsive { width: 100%; overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; text-align: left; font-size: 14px; }
        th { background: #f8fafc; color: #475569; padding: 12px 16px; font-weight: 700; border-bottom: 2px solid #e2e8f0; }
        td { padding: 14px 16px; border-bottom: 1px solid #e2e8f0; color: #0f172a; vertical-align: middle; }
        tr:hover td { background: #f8fafc; }

        .link-badge { display: inline-flex; align-items: center; gap: 5px; color: #4f46e5; font-weight: 600; text-decoration: none; background: #eef2ff; padding: 6px 12px; border-radius: 8px; font-size: 13px; }
        .link-badge:hover { background: #e0e7ff; }

        /* INPUT & FORM DI DALAM TABEL */
        .input-nilai { width: 80px; padding: 8px 10px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 14px; text-align: center; }
        .input-catatan { width: 100%; padding: 8px 10px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 13px; margin-top: 5px; }
        
        .btn-sm { background: #4f46e5; color: white; border: none; padding: 8px 14px; border-radius: 8px; font-weight: 600; cursor: pointer; font-size: 13px; transition: 0.2s; }
        .btn-sm:hover { background: #4338ca; }
        
        .badge-status { display: inline-block; padding: 4px 10px; border-radius: 20px; font-size: 12px; font-weight: 600; }
        .badge-dinilai { background: #dcfce7; color: #166534; }
        .badge-pending { background: #fef9c3; color: #854d0e; }
        
        .empty { text-align: center; padding: 40px; color: #94a3b8; font-size: 14px; }
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
            <a href="{{ route('dosen.matkul') }}" class="nav-item">
                📚 Mata Kuliah
            </a>
            <a href="{{ route('dosen.tugas') }}" class="nav-item">
                📝 Buat Tugas
            </a>
            <a href="{{ route('dosen.nilai') }}" class="nav-item active">
                📈 Nilai & Tugas Mhs
            </a>
        </div>
    </div>

    <!-- MAIN CONTENT -->
    <div class="main-content">
        <div class="container">

            @if(session('success') || session('sukses'))
                <div class="alert">
                    ✅ {{ session('success') ?? session('sukses') }}
                </div>
            @endif

            <div class="card">
                <div class="card-title">
                    <div class="icon">📈</div>
                    <div>
                        <h2>Daftar Pengumpulan Tugas Mahasiswa</h2>
                        <div class="card-subtitle">Periksa tautan tugas yang dikumpulkan mahasiswa dan berikan penilaian serta catatan</div>
                    </div>
                </div>

                <div class="table-responsive">
                    @if(isset($pengumpulan) && $pengumpulan->count() > 0)
                        <table>
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Mahasiswa</th>
                                    <th>Judul Tugas</th>
                                    <th>Tautan Tugas</th>
                                    <th>Status / Nilai Saat Ini</th>
                                    <th>Aksi / Beri Nilai</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pengumpulan as $index => $p)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            <strong>{{ $p->siswa->nama ?? 'Mahasiswa' }}</strong><br>
                                            <span style="font-size: 12px; color: #64748b;">NIM: {{ $p->siswa->nim ?? '-' }}</span>
                                        </td>
                                        <td>
                                            <strong>{{ $p->tugas->judul ?? 'Tugas' }}</strong><br>
                                            <span style="font-size: 12px; color: #4f46e5;">{{ $p->tugas->mataKuliah->nama_matkul ?? 'Mata Kuliah' }}</span>
                                        </td>
                                        <td>
                                            <a href="{{ $p->jalur_berkas }}" target="_blank" class="link-badge">
                                                🔗 Buka Tautan
                                            </a>
                                        </td>
                                        <td>
                                            @if($p->nilai !== null)
                                                <span class="badge-status badge-dinilai">Dinilai: {{ $p->nilai }}</span>
                                            @else
                                                <span class="badge-status badge-pending">Belum Dinilai</span>
                                            @endif
                                        </td>
                                        <td>
                                            <!-- Form untuk memberikan nilai -->
                                            <form action="{{ route('dosen.nilai.simpan', $p->id) }}" method="POST">
                                                @csrf
                                                <div style="display: flex; gap: 6px; align-items: center; margin-bottom: 6px;">
                                                    <input type="number" name="nilai" value="{{ $p->nilai }}" placeholder="0-100" min="0" max="100" class="input-nilai" required>
                                                    <button type="submit" class="btn-sm">Simpan</button>
                                                </div>
                                                <input type="text" name="catatan" value="{{ $p->catatan }}" placeholder="Catatan opsional..." class="input-catatan">
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="empty">
                            Belum ada mahasiswa yang mengumpulkan tugas.
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>

</body>
</html>