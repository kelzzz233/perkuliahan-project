<!DOCTYPE html>
<html lang="id" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Mahasiswa - Portal Akademik</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #6366f1;
            --primary-dark: #4f46e5;
            --primary-light: #e0e7ff;
            --accent: #f59e0b;
            --bg-body: #f1f5f9;
            --card-bg: #ffffff;
            --text-main: #0f172a;
            --text-muted: #64748b;
            --border: #e2e8f0;
            --success: #10b981;
            --danger: #ef4444;
            --header-bg: linear-gradient(135deg, #312e81 0%, #4338ca 100%);
            --card-shadow: 0 10px 25px -5px rgba(99, 102, 241, 0.08), 0 8px 10px -6px rgba(99, 102, 241, 0.08);
        }

        [data-theme="dark"] {
            --primary: #818cf8;
            --primary-dark: #6366f1;
            --primary-light: #312e81;
            --accent: #fbbf24;
            --bg-body: #0f172a;
            --card-bg: #1e293b;
            --text-main: #f8fafc;
            --text-muted: #94a3b8;
            --border: #334155;
            --success: #34d399;
            --danger: #f87171;
            --header-bg: linear-gradient(135deg, #090d16 0%, #1e1b4b 100%);
            --card-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.3);
        }

        * {
            box-sizing: border-box;
            font-family: 'Plus Jakarta Sans', sans-serif;
            transition: background-color 0.3s ease, border-color 0.3s ease, color 0.2s ease;
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
            border-radius: 24px;
            box-shadow: var(--card-shadow);
            overflow: hidden;
            border: 1px solid var(--border);
        }

        /* HEADER SECTION */
        .app-header {
            background: var(--header-bg);
            color: #ffffff;
            padding: 36px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
        }

        .header-left h1 {
            margin: 0 0 6px 0;
            font-size: 26px;
            font-weight: 800;
            letter-spacing: -0.03em;
        }

        .welcome-text {
            margin: 0 0 14px 0;
            font-size: 15px;
            color: #cbd5e1;
        }

        .welcome-text strong {
            color: #ffffff;
        }

        .badge-jurusan {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(8px);
            padding: 6px 14px;
            border-radius: 30px;
            font-size: 12px;
            font-weight: 700;
            color: #fbbf24;
            border: 1px solid rgba(255, 255, 255, 0.15);
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .btn-theme {
            background: rgba(255, 255, 255, 0.15);
            color: #ffffff;
            border: 1px solid rgba(255, 255, 255, 0.2);
            width: 42px;
            height: 42px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 18px;
            backdrop-filter: blur(4px);
        }

        .btn-theme:hover {
            background: rgba(255, 255, 255, 0.25);
        }

        .btn-logout {
            background: rgba(239, 68, 68, 0.2);
            color: #fca5a5;
            border: 1px solid rgba(239, 68, 68, 0.3);
            padding: 10px 20px;
            border-radius: 12px;
            font-weight: 700;
            font-size: 13px;
            cursor: pointer;
        }

        .btn-logout:hover {
            background: var(--danger);
            color: #ffffff;
        }

        /* STATS GRID */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: var(--card-bg);
            border: 1px solid var(--border);
            padding: 20px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            gap: 16px;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02);
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            background: var(--primary-light);
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            font-weight: 700;
        }

        .stat-info span {
            display: block;
            font-size: 12px;
            color: var(--text-muted);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .stat-info h3 {
            margin: 4px 0 0 0;
            font-size: 20px;
            font-weight: 800;
            color: var(--text-main);
        }

        /* NAVIGATION TABS */
        .nav-tabs {
            display: flex;
            background: var(--card-bg);
            padding: 0 40px;
            border-bottom: 1px solid var(--border);
            gap: 12px;
        }

        .tab-btn {
            background: transparent;
            border: none;
            color: var(--text-muted);
            padding: 18px 20px;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            border-bottom: 3px solid transparent;
            margin-bottom: -1px;
            display: flex;
            align-items: center;
            gap: 8px;
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
            animation: fadeIn 0.35s cubic-bezier(0.16, 1, 0.3, 1);
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(8px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .section-title {
            font-size: 20px;
            font-weight: 800;
            color: var(--text-main);
            margin: 0 0 24px 0;
            letter-spacing: -0.02em;
        }

        /* ALERTS */
        .alert-success, .alert-error {
            padding: 16px 20px;
            border-radius: 14px;
            margin-bottom: 24px;
            font-size: 14px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alert-success { background: #ecfdf5; color: #065f46; border: 1px solid #a7f3d0; }
        .alert-error { background: #fef2f2; color: #991b1b; border: 1px solid #fecaca; }

        /* TABLES */
        .table-container {
            border: 1px solid var(--border);
            border-radius: 16px;
            overflow: hidden;
            background: var(--card-bg);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        th {
            background: var(--bg-body);
            color: var(--text-muted);
            padding: 16px 20px;
            font-size: 11px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            border-bottom: 1px solid var(--border);
        }

        td {
            padding: 18px 20px;
            font-size: 14px;
            color: var(--text-main);
            border-bottom: 1px solid var(--border);
            vertical-align: middle;
        }

        tr:last-child td { border-bottom: none; }
        tr:hover td { background: rgba(99, 102, 241, 0.02); }

        /* BADGES */
        .badge {
            display: inline-flex;
            align-items: center;
            padding: 6px 14px;
            border-radius: 30px;
            font-size: 12px;
            font-weight: 700;
        }

        .badge-success { background: #d1fae5; color: #065f46; }
        .badge-danger { background: #fee2e2; color: #991b1b; }

        /* FORMS & BUTTONS */
        .upload-input {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid var(--border);
            border-radius: 10px;
            font-size: 13px;
            background: var(--card-bg);
            color: var(--text-main);
            outline: none;
        }

        .upload-input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.15);
        }

        .btn-action {
            background: var(--primary);
            color: #ffffff;
            border: none;
            padding: 9px 18px;
            border-radius: 10px;
            font-weight: 700;
            font-size: 12px;
            cursor: pointer;
            margin-top: 6px;
        }

        .btn-action:hover { background: var(--primary-dark); }

        .link-file {
            color: var(--primary);
            text-decoration: none;
            font-weight: 700;
            font-size: 13px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .link-file:hover { text-decoration: underline; }

        /* BIODATA CARD */
        .biodata-card {
            display: grid;
            grid-template-columns: 220px 1fr;
            gap: 40px;
            background: var(--card-bg);
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 35px;
            align-items: center;
        }

        .biodata-avatar {
            width: 100%;
            height: 220px;
            background: linear-gradient(135deg, #6366f1 0%, #a855f7 100%);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ffffff;
            font-weight: 800;
            font-size: 16px;
            box-shadow: 0 10px 20px rgba(99, 102, 241, 0.2);
        }

        .biodata-details { display: flex; flex-direction: column; gap: 16px; width: 100%; margin: 0; }
        .biodata-item { display: flex; border-bottom: 1px solid var(--border); padding-bottom: 14px; }
        .biodata-label { width: 180px; font-weight: 700; color: var(--text-muted); font-size: 13px; display: flex; align-items: center; }
        .biodata-val { font-weight: 700; color: var(--text-main); font-size: 14px; }

        .empty-state { text-align: center; padding: 50px; color: var(--text-muted); font-style: italic; font-weight: 500; }

        @media(max-width: 768px) {
            .app-header { flex-direction: column; align-items: flex-start; gap: 20px; }
            .header-actions { width: 100%; justify-content: space-between; }
            .biodata-card { grid-template-columns: 1fr; }
            .biodata-avatar { height: 160px; }
            .nav-tabs { padding: 0 20px; overflow-x: auto; }
            .app-content { padding: 20px; }
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
                <span class="badge-jurusan">✨ Jurusan: {{ $mahasiswa->jurusan ?? 'Umum' }}</span>
            </div>

            <div class="header-actions">
                <button class="btn-theme" onclick="toggleTheme()" title="Ganti Tema">🌓</button>
                <form action="{{ route('mahasiswa.logout') }}" method="POST" style="margin: 0;">
                    @csrf
                    <button type="submit" class="btn-logout">Keluar Sistem</button>
                </form>
            </div>
        </div>

        <!-- STATS BAR -->
        <div style="padding: 30px 40px 0 40px;">
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon">📚</div>
                    <div class="stat-info">
                        <span>Total SKS</span>
                        <h3>{{ $totalSks ?? 0 }} SKS</h3>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon" style="background: #ecfdf5; color: #10b981;">⚡</div>
                    <div class="stat-info">
                        <span>Status Mahasiswa</span>
                        <h3 style="color: var(--success);">Aktif</h3>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon" style="background: #fef3c7; color: #d97706;">🎯</div>
                    <div class="stat-info">
                        <span>Semester Berjalan</span>
                        <h3>Semester 1</h3>
                    </div>
                </div>
            </div>
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
                <div class="alert-success">✨ {{ session('sukses') }}</div>
            @endif

            @if(session('error'))
                <div class="alert-error">⚠️ {{ session('error') }}</div>
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
                                            <span style="font-weight: 800; color: var(--primary);">{{ $dataPengumpulan->nilai }}</span>
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

            <!-- TAB 2: KRS -->
            <div id="pane-krs" class="tab-pane">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; flex-wrap: wrap; gap: 15px;">
                    <div class="section-title" style="margin-bottom: 0;">Kartu Rencana Studi (KRS) Aktif</div>
                    <div style="background: var(--primary-light); color: var(--primary-dark); padding: 8px 16px; border-radius: 10px; font-weight: 700; font-size: 14px;">
                        Total SKS Diambil: {{ $totalSks ?? 0 }} SKS
                    </div>
                </div>

                <div style="background: var(--card-bg); padding: 20px; border-radius: 16px; margin-bottom: 24px; border: 1px solid var(--border);">
                    <form action="{{ route('mahasiswa.krs.store') }}" method="POST" style="display: flex; gap: 12px; align-items: flex-end; flex-wrap: wrap;">
                        @csrf
                        <div style="flex: 1; min-width: 250px;">
                            <label style="display: block; font-size: 13px; font-weight: 700; margin-bottom: 6px; color: var(--text-muted);">Pilih Mata Kuliah untuk Ditambah:</label>
                            <select name="id_tugas" class="upload-input" required>
                                <option value="">-- Pilih Mata Kuliah --</option>
                                @foreach($semuaMatkul as $matkul)
                                    <option value="{{ $matkul->id }}">{{ $matkul->nama_matkul ?? $matkul->nama }} ({{ $matkul->sks ?? 3 }} SKS)</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn-action" style="padding: 11px 20px; margin-top: 0;">+ Ambil MK</button>
                    </form>
                </div>

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
                                <td><span style="font-family: monospace; font-weight: 700;">MK-00{{ $index + 1 }}</span></td>
                                <td><strong>{{ $item->mataKuliah->nama_matkul ?? $item->mataKuliah->nama ?? 'Tidak Diketahui' }}</strong></td>
                                <td>{{ $item->mataKuliah->sks ?? 3 }} SKS</td>
                                <td>Semester 1</td>
                                <td>
                                    <form action="{{ route('mahasiswa.krs.delete', $item->id_krs ?? $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus mata kuliah ini dari KRS?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" style="background: #fee2e2; color: #dc2626; border: none; padding: 6px 12px; border-radius: 8px; font-size: 12px; font-weight: 700; cursor: pointer;">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="empty-state">Belum ada data Kartu Rencana Studi (KRS). Silakan ambil mata kuliah di atas.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- TAB 3: PROFIL MAHASISWA -->
            <div id="pane-biodata" class="tab-pane">
                <div class="section-title">Informasi Detail & Perbarui Profil Mahasiswa</div>

                <div class="biodata-card">
                    <div class="biodata-avatar">
                        {{ strtoupper(substr($mahasiswa->nama, 0, 2)) }}
                    </div>
                    
                    <!-- Form untuk memperbarui Nama dan NIM -->
                    <form action="{{ route('mahasiswa.profil.update') }}" method="POST" class="biodata-details">
                        @csrf
                        @method('PUT')

                        <div class="biodata-item" style="align-items: center;">
                            <div class="biodata-label">Nama Lengkap</div>
                            <div class="biodata-val" style="flex: 1;">
                                <input type="text" name="nama" value="{{ old('nama', $mahasiswa->nama) }}" class="upload-input" required>
                            </div>
                        </div>

                        <div class="biodata-item" style="align-items: center;">
                            <div class="biodata-label">NIM / ID Mahasiswa</div>
                            <div class="biodata-val" style="flex: 1;">
                                <input type="text" name="nim" value="{{ old('nim', $mahasiswa->nim) }}" class="upload-input" required>
                            </div>
                        </div>

                        <div class="biodata-item">
                            <div class="biodata-label">Jurusan / Program Studi</div>
                            <div class="biodata-val" style="padding-top: 8px;">{{ $mahasiswa->jurusan ?? 'Umum' }}</div>
                        </div>

                        <div class="biodata-item">
                            <div class="biodata-label">Status Akademik</div>
                            <div class="biodata-val" style="padding-top: 8px;"><span class="badge badge-success">Aktif Berstudi</span></div>
                        </div>

                        <div class="biodata-item" style="border-bottom: none; padding-bottom: 0; align-items: center;">
                            <div class="biodata-label">Tahun Akademik</div>
                            <div class="biodata-val" style="display: flex; justify-content: space-between; align-items: center; width: 100%;">
                                <span>2025/2026 Genap</span>
                                <button type="submit" class="btn-action" style="margin-top: 0;">Simpan Perubahan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <!-- Letakkan ini sementara di dalam file resources/views/mahasiswa.blade.php -->


    <!-- SCRIPT INTERAKTIF & THEME TOGGLE -->
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

        function toggleTheme() {
            const html = document.documentElement;
            const currentTheme = html.getAttribute("data-theme");
            const newTheme = currentTheme === "dark" ? "light" : "dark";
            html.setAttribute("data-theme", newTheme);
            localStorage.setItem("theme", newTheme);
        }

        // Simpan preferensi tema pengguna
        window.addEventListener("DOMContentLoaded", () => {
            const savedTheme = localStorage.getItem("theme") || "light";
            document.documentElement.setAttribute("data-theme", savedTheme);
        });
    </script>



</body>
</html>