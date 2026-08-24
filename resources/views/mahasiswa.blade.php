<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Mahasiswa - Portal Akademik</title>

    <style>
        :root {
            --navy-primary: #1e3a8a;
            --navy-dark: #0f172a;
            --gold-accent: #d97706;
            --bg-canvas: #f1f5f9;
            --text-main: #334155;
            --border-color: #e2e8f0;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: var(--bg-canvas);
            color: var(--text-main);
            margin: 0;
            padding: 30px;
        }

        .academic-container {
            max-width: 1200px;
            margin: auto;
            background: #ffffff;
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 8px 25px rgba(15, 23, 42, 0.08);
        }

        .header-section {
            background: linear-gradient(135deg, #1e3a8a, #172554);
            color: #ffffff;
            padding: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        h1 {
            margin: 0 0 10px;
            font-size: 26px;
            color: #ffffff !important;
        }

        .student-info {
            margin: 0;
            font-size: 14px;
            color: #dbeafe !important;
        }

        .badge-major {
            display: inline-block;
            background: #d97706;
            color: #ffffff !important;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: bold;
            margin-left: 5px;
        }

        .btn-logout {
            background: #dc2626;
            color: #ffffff !important;
            border: none;
            padding: 10px 18px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            transition: 0.2s;
        }

        .btn-logout:hover {
            background: #b91c1c;
            transform: translateY(-1px);
        }

        .content {
            padding: 30px;
            background: #ffffff;
        }

        h3 {
            color: #0f172a !important;
            font-size: 20px;
            margin: 0 0 20px;
            border-left: 5px solid #d97706;
            padding-left: 12px;
        }

        .success-message {
            color: #047857 !important;
            background: #ecfdf5;
            padding: 12px 15px;
            border-radius: 8px;
            border: 1px solid #a7f3d0;
            margin-bottom: 20px;
        }

        .table-wrapper {
            overflow-x: auto;
            border-radius: 10px;
            border: 1px solid var(--border-color);
            background: #ffffff;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 850px;
            background: #ffffff;
        }

        th {
            background: #1e3a8a !important;
            color: #ffffff !important;
            padding: 14px;
            text-align: left;
            font-size: 12px;
            text-transform: uppercase;
            font-weight: bold;
            white-space: nowrap;
        }

        td {
            padding: 15px;
            border-bottom: 1px solid #e2e8f0;
            font-size: 14px;
            vertical-align: middle;
            color: #334155 !important;
            background: #ffffff;
        }

        td strong {
            color: #0f172a !important;
        }

        tr:nth-child(even) td {
            background: #f8fafc;
        }

        tr:hover td {
            background: #eff6ff;
        }

        .status {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
            white-space: nowrap;
        }

        .status-success {
            background: #dcfce7 !important;
            color: #166534 !important;
        }

        .status-danger {
            background: #fee2e2 !important;
            color: #991b1b !important;
        }

        .nilai {
            font-weight: bold;
            color: #1e3a8a !important;
        }

        .belum-nilai {
            color: #475569 !important;
            font-style: italic;
        }

        .upload-form {
            display: flex;
            flex-direction: column;
            gap: 7px;
        }

        .btn-submit {
            background: #047857 !important;
            color: #ffffff !important;
            border: none;
            padding: 8px 14px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
            width: fit-content;
            transition: 0.2s;
        }

        .btn-submit:hover {
            background: #065f46 !important;
            transform: translateY(-1px);
        }

        .file-link {
            display: inline-block;
            color: #1e3a8a !important;
            font-weight: bold;
            text-decoration: none;
            background: #eff6ff !important;
            padding: 8px 12px;
            border-radius: 6px;
            white-space: nowrap;
        }

        .file-link:hover {
            background: #dbeafe !important;
            color: #172554 !important;
        }

        .empty-row {
            text-align: center;
            color: #64748b !important;
            font-style: italic;
            padding: 30px;
            background: #ffffff !important;
        }
    </style>
</head>

<body>

    <div class="academic-container">

        <!-- HEADER -->
      <div class="header-section">
    <div>
        <h1>Dashboard Mahasiswa</h1>
        <!-- Tambahkan baris ini untuk menampilkan nama -->
        <p class="student-name" style="font-size: 16px; font-weight: bold; margin: 0 0 5px 0; color: #ffffff;">
            Selamat Datang, {{ $mahasiswa->nama }}
        </p>
        <p class="student-info">
            Jurusan:
            <span class="badge-major">
                {{ $mahasiswa->jurusan ?? 'Umum' }}
            </span>
        </p>
    </div>

    <!-- LOGOUT -->
    <form action="{{ route('mahasiswa.logout') }}" method="POST">
        @csrf
        <button type="submit" class="btn-logout">Logout</button>
    </form>
</div>

        <!-- CONTENT -->
        <div class="content">

            <!-- PESAN SUKSES -->
            @if(session('sukses'))
                <div class="success-message">
                    <strong>{{ session('sukses') }}</strong>
                </div>
            @endif

            <h3>Daftar Tugas Kelas</h3>

            <!-- TABLE -->
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>Mata Kuliah</th>
                            <th>Judul Tugas</th>
                            <th>Status</th>
                            <th>Nilai</th>
                            <th>Catatan Dosen</th>
                            <th>Aksi Upload</th>
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
                                <td>
                                    <strong>{{ $t->mataKuliah->nama_matkul ?? $t->id_matkul }}</strong>
                                </td>
                                <td>{{ $t->judul }}</td>
                                <td>
                                    @if($dataPengumpulan)
                                        <span class="status status-success">✓ Sudah Dikumpul</span>
                                    @else
                                        <span class="status status-danger">Belum Dikumpul</span>
                                    @endif
                                </td>
                                <td>
                                    @if($dataPengumpulan && $dataPengumpulan->nilai !== null)
                                        <span class="nilai">{{ $dataPengumpulan->nilai }}</span>
                                    @else
                                        <span class="belum-nilai">Belum Dinilai</span>
                                    @endif
                                </td>
                                <td>{{ $dataPengumpulan->catatan ?? '-' }}</td>
                                <td>
                                    @if(!$dataPengumpulan)
                                        <form action="{{ route('mahasiswa.kumpul') }}" method="POST" class="upload-form">
                                            @csrf
                                            <input type="hidden" name="id_tugas" value="{{ $t->id }}">

                                            <div class="form-group" style="margin-bottom: 8px;">
                                                <input
                                                    type="url"
                                                    name="link_tugas"
                                                    placeholder="https://drive.google.com/..."
                                                    required
                                                    style="width: 100%; padding: 6px; box-sizing: border-box; font-size: 12px;"
                                                >
                                                @error('link_tugas')
                                                    <small style="color: red; display: block; margin-top: 3px;">{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <button type="submit" class="btn-submit">🔗 Kirim Link</button>
                                        </form>
                                    @else
                                        <!-- Mengarah langsung ke link Google Drive/OneDrive yang dikumpul -->
                                        <a href="{{ $dataPengumpulan->jalur_berkas }}" target="_blank" class="file-link">
                                            🔗 Buka Link Tugas
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="empty-row">
                                    Belum ada tugas yang dibuat untuk jurusan Anda.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</body>
</html>