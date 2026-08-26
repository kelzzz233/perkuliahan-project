<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Mahasiswa - Portal Akademik</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #4f46e5;
            --primary-dark: #4338ca;
            --primary-light: #e0e7ff;
            --accent: #f59e0b;
            --bg-body: #f8fafc;
            --card-bg: #ffffff;
            --text-main: #1e293b;
            --text-muted: #64748b;
            --border: #e2e8f0;
            --success: #10b981;
            --danger: #ef4444;
        }

        * {
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            background-color: var(--bg-body);
            color: var(--text-main);
            margin: 0;
            padding: 40px 20px;
        }

        .dashboard-wrapper {
            max-width: 1200px;
            margin: 0 auto;
            background: var(--card-bg);
            border-radius: 20px;
            box-shadow: 0 10px 30px -5px rgba(0, 0, 0, 0.05), 0 0 0 1px rgba(0, 0, 0, 0.03);
            overflow: hidden;
        }

        /* HEADER SECTION */
        .app-header {
            background: linear-gradient(135deg, #1e1b4b 0%, #312e81 100%);
            color: #ffffff;
            padding: 32px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header-left h1 {
            margin: 0 0 6px 0;
            font-size: 24px;
            font-weight: 700;
            letter-spacing: -0.025em;
        }

        .welcome-text {
            margin: 0 0 12px 0;
            font-size: 15px;
            color: #cbd5e1;
        }

        .welcome-text strong {
            color: #ffffff;
        }

        .badge-jurusan {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(4px);
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            color: #fbbf24;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .btn-logout {
            background: rgba(239, 68, 68, 0.15);
            color: #fca5a5;
            border: 1px solid rgba(239, 68, 68, 0.3);
            padding: 10px 18px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 13px;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .btn-logout:hover {
            background: var(--danger);
            color: #ffffff;
            border-color: var(--danger);
        }

        /* NAVIGATION TABS */
        .nav-tabs {
            display: flex;
            background: #ffffff;
            padding: 0 40px;
            border-bottom: 1px solid var(--border);
            gap: 8px;
        }

        .tab-btn {
            background: transparent;
            border: none;
            color: var(--text-muted);
            padding: 16px 20px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            border-bottom: 2px solid transparent;
            margin-bottom: -1px;
        }

        .tab-btn:hover {
            color: var(--primary);
        }

        .tab-btn.active {
            color: var(--primary);
            border-bottom-color: var(--primary);
        }

        /* CONTENT CONTAINER */
        .app-content {
            padding: 40px;
        }

        .tab-pane {
            display: none;
        }

        .tab-pane.active {
            display: block;
            animation: fadeIn 0.3s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(4px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .section-title {
            font-size: 18px;
            font-weight: 700;
            color: var(--text-main);
            margin: 0 0 24px 0;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* ALERTS */
        .alert-success {
            background: #ecfdf5;
            color: #065f46;
            padding: 14px 18px;
            border-radius: 10px;
            border: 1px solid #a7f3d0;
            margin-bottom: 24px;
            font-size: 14px;
            font-weight: 500;
        }

        /* TABLES */
        .table-container {
            border: 1px solid var(--border);
            border-radius: 12px;
            overflow: hidden;
            background: #ffffff;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        th {
            background: #f8fafc;
            color: var(--text-muted);
            padding: 14px 20px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            border-bottom: 1px solid var(--border);
        }

        td {
            padding: 16px 20px;
            font-size: 14px;
            color: var(--text-main);
            border-bottom: 1px solid var(--border);
            vertical-align: middle;
        }

        tr:last-child td {
            border-bottom: none;
        }

        tr:hover td {
            background: #f8fafc;
        }

        /* BADGES & STATUS */
        .badge {
            display: inline-flex;
            align-items: center;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge-success { background: #d1fae5; color: #065f46; }
        .badge-danger { background: #fee2e2; color: #991b1b; }

        /* FORMS & BUTTONS IN TABLE */
        .upload-input {
            width: 100%;
            padding: 8px 12px;
            border: 1px solid var(--border);
            border-radius: 8px;
            font-size: 13px;
            outline: none;
            transition: border-color 0.2s;
        }

        .upload-input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        }

        .btn-action {
            background: var(--primary);
            color: #ffffff;
            border: none;
            padding: 8px 16px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 12px;
            cursor: pointer;
            transition: background 0.2s;
            margin-top: 6px;
        }

        .btn-action:hover {
            background: var(--primary-dark);
        }

        .link-file {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
            font-size: 13px;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .link-file:hover {
            text-decoration: underline;
        }

        /* BIODATA CARD STYLE */
        .biodata-card {
            display: grid;
            grid-template-columns: 220px 1fr;
            gap: 40px;
            background: #ffffff;
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 30px;
            align-items: center;
        }

        .biodata-avatar {
            width: 100%;
            height: 220px;
            background: linear-gradient(135deg, #e2e8f0 0%, #cbd5e1 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-muted);
            font-weight: 600;
            font-size: 14px;
        }

        .biodata-details {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .biodata-item {
            display: flex;
            border-bottom: 1px solid #f1f5f9;
            padding-bottom: 12px;
        }

        .biodata-label {
            width: 160px;
            font-weight: 600;
            color: var(--text-muted);
            font-size: 13px;
        }

        .biodata-val {
            font-weight: 600;
            color: var(--text-main);
            font-size: 14px;
        }

        .empty-state {
            text-align: center;
            padding: 40px;
            color: var(--text-muted);
            font-style: italic;
        }
    </style>
</head>

<body>

    <div class="dashboard-wrapper">

        <!-- HEADER -->
        <div class="app-header">
            <div class="header-left">
                <h1>Portal Akademik</h1>
                <p class="welcome-text">Selamat datang kembali, <strong>{{ $mahasiswa->nama }}</strong></p>
                <span class="badge-jurusan">Jurusan: {{ $mahasiswa->jurusan ?? 'Umum' }}</span>
            </div>

            <form action="{{ route('mahasiswa.logout') }}" method="POST" style="margin: 0;">
                @csrf
                <button type="submit" class="btn-logout">Keluar Sistem</button>
            </form>
        </div>

        <!-- NAVIGATION TABS -->
        <div class="nav-tabs">
            <button class="tab-btn active" onclick="switchTab(event, 'pane-tugas')">📚 Tugas Kelas</button>
            <button class="tab-btn" onclick="switchTab(event, 'pane-krs')">📋 Kartu Rencana Studi</button>
            <button class="tab-btn" onclick="switchTab(event, 'pane-biodata')">👤 Profil Mahasiswa</button>
        </div>

        <!-- CONTENT -->
        <div class="app-content">

            @if(session('sukses'))
                <div class="alert-success">
                    ✨ {{ session('sukses') }}
                </div>
            @endif

            <!-- TAB 1: TUGAS KELAS -->
            <div id="pane-tugas" class="tab-pane active">
                <div class="section-title">Daftar Tugas Kuliah</div>

                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Mata Kuliah</th>
                                <th>Judul Tugas</th>
                                <th>Status</th>
                                <th>Nilai</th>
                                <th>Catatan Dosen</th>
                                <th>Aksi Pengumpulan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($tugas as $t)
                                @php
                                    $dataPengumpulan = \App\Models\Pengumpulan::where('id_tugas', $t->id)
                                        ->where('id_siswa', Auth::guard('mahasiswa')->id())
                                        ->first();
                                @endphp
                                <tr>
                                    <td><strong>{{ $t->mataKuliah->nama_matkul ?? $t->id_matkul }}</strong></td>
                                    <td>{{ $t->judul }}</td>
                                    <td>
                                        @if($dataPengumpulan)
                                            <span class="badge badge-success">Sudah Dikumpul</span>
                                        @else
                                            <span class="badge badge-danger">Belum Dikumpul</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($dataPengumpulan && $dataPengumpulan->nilai !== null)
                                            <span style="font-weight: 700; color: var(--primary);">{{ $dataPengumpulan->nilai }}</span>
                                        @else
                                            <span style="color: var(--text-muted); font-style: italic;">Belum dinilai</span>
                                        @endif
                                    </td>
                                    <td>{{ $dataPengumpulan->catatan ?? '-' }}</td>
                                    <td>
                                        @if(!$dataPengumpulan)
                                            <form action="{{ route('mahasiswa.kumpul') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="id_tugas" value="{{ $t->id }}">
                                                <input type="url" name="link_tugas" class="upload-input" placeholder="https://drive.google.com/..." required>
                                                @error('link_tugas')
                                                    <small style="color: var(--danger); display: block; margin-top: 4px;">{{ $message }}</small>
                                                @enderror
                                                <button type="submit" class="btn-action">Kirim Tugas</button>
                                            </form>
                                        @else
                                            <a href="{{ $dataPengumpulan->jalur_berkas }}" target="_blank" class="link-file">
                                                🔗 Lihat Tugas
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="empty-state">Belum ada tugas tersedia untuk saat ini.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- TAB 3: PROFIL MAHASISWA -->
            <div id="pane-biodata" class="tab-pane">
                <div class="section-title">Informasi Detail Mahasiswa</div>

                <div class="biodata-card">
                    <div class="biodata-avatar">
                        Foto Profil
                    </div>
                    <div class="biodata-details">
                        <div class="biodata-item">
                            <div class="biodata-label">Nama Lengkap</div>
                            <div class="biodata-val">{{ $mahasiswa->nama }}</div>
                        </div>
                        <div class="biodata-item">
                            <div class="biodata-label">Jurusan / Program Studi</div>
                            <div class="biodata-val">{{ $mahasiswa->jurusan ?? 'Umum' }}</div>
                        </div>
                        <div class="biodata-item">
                            <div class="biodata-label">NIM / ID Mahasiswa</div>
                            <div class="biodata-val">{{ $mahasiswa->id ?? '-' }}</div>
                        </div>
                        <div class="biodata-item">
                            <div class="biodata-label">Status Akademik</div>
                            <div class="biodata-val"><span class="badge badge-success">Aktif Berstudi</span></div>
                        </div>
                        <div class="biodata-item" style="border-bottom: none; padding-bottom: 0;">
                            <div class="biodata-label">Tahun Akademik</div>
                            <div class="biodata-val">2025/2026 Genap</div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>


    <!-- TAB 2: KRS -->
<div id="pane-krs" class="tab-pane">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <div class="section-title" style="margin-bottom: 0;">Kartu Rencana Studi (KRS) Aktif</div>
        
        <!-- Badge Informasi Total SKS -->
        <div style="background: #e0e7ff; color: #3730a3; padding: 8px 16px; border-radius: 8px; font-weight: 600; font-size: 14px;">
            Total SKS Diambil: {{ $totalSks ?? 0 }} SKS
        </div>
    </div>

    <!-- Form Tambah Mata Kuliah ke KRS -->
    <div style="background: #f8fafc; padding: 15px; border-radius: 10px; margin-bottom: 20px; border: 1px solid #e2e8f0;">
        <form action="{{ route('mahasiswa.krs.store') }}" method="POST" style="display: flex; gap: 10px; align-items: flex-end;">
            @csrf
            <div style="flex: 1;">
                <label style="display: block; font-size: 13px; font-weight: 600; margin-bottom: 5px; color: #475569;">Pilih Mata Kuliah untuk Ditambah:</label>
                <select name="id_tugas" class="form-control" required style="width: 100%; padding: 8px; border-radius: 6px; border: 1px solid #cbd5e1;">
                    <option value="">-- Pilih Mata Kuliah --</option>
                    @foreach($semuaMatkul as $matkul)
                        <option value="{{ $matkul->id }}">{{ $matkul->nama_matkul ?? $matkul->nama }} ({{ $matkul->sks ?? 3 }} SKS)</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" style="background: #4f46e5; color: white; border: none; padding: 9px 20px; border-radius: 6px; font-weight: 600; cursor: pointer;">+ Ambil MK</button>
        </form>
    </div>

    <!-- Tabel Daftar KRS -->
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>NO</th>
                    <th>KODE MK</th>
                    <th>NAMA MATA KULIAH</th>
                    <th>BOBOT SKS</th>
                    <th>SEMESTER</th>
                    <th>AKSI</th>
                </tr>
            </thead>
            <tbody>
                @forelse($krsList as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td><span style="font-family: monospace; font-weight: 600;">MK-00{{ $index + 1 }}</span></td>
                    <td><strong>{{ $item->mataKuliah->nama_matkul ?? $item->mataKuliah->nama ?? 'Tidak Diketahui' }}</strong></td>
                    <td>{{ $item->mataKuliah->sks ?? 3 }} SKS</td>
                    <td>Semester 1</td>
                    <td>
                        <!-- Tombol Hapus KRS -->
                        <form action="{{ route('mahasiswa.krs.delete', $item->id_krs ?? $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus mata kuliah ini dari KRS?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background: #fee2e2; color: #dc2626; border: none; padding: 5px 10px; border-radius: 4px; font-size: 12px; font-weight: 600; cursor: pointer;">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="empty-state" style="text-align: center; padding: 20px; color: #64748b;">Belum ada data Kartu Rencana Studi (KRS). Silakan ambil mata kuliah di atas.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

    <!-- SCRIPT TAB INTERAKTIF -->
    <script>
        function switchTab(evt, paneId) {
            const panes = document.getElementsByClassName("tab-pane");
            for (let i = 0; i < panes.length; i++) {
                panes[i].classList.remove("active");
            }

            const buttons = document.getElementsByClassName("tab-btn");
            for (let i = 0; i < buttons.length; i++) {
                buttons[i].classList.remove("active");
            }

            document.getElementById(paneId).classList.add("active");
            evt.currentTarget.classList.add("active");
        }
    </script>

</body>
</html>
