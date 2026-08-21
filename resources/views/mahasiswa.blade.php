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
            --bg-canvas: #f8fafc;
            --text-main: #334155;
            --border-color: #cbd5e1;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--bg-canvas);
            color: var(--text-main);
            margin: 0;
            padding: 30px;
        }

        .academic-container {
            max-width: 1050px;
            margin: 0 auto;
            background: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            border-top: 6px solid var(--navy-primary);
        }

        .header-section {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            border-bottom: 2px solid var(--navy-primary);
            padding-bottom: 20px;
            margin-bottom: 25px;
        }

        h1 {
            color: var(--navy-dark);
            margin: 0 0 8px 0;
            font-size: 24px;
        }

        .student-info {
            font-size: 15px;
            color: #475569;
            margin: 0;
        }

        .student-info strong {
            color: var(--navy-primary);
        }

        .badge-major {
            background-color: var(--gold-accent);
            color: #ffffff;
            padding: 2px 8px;
            border-radius: 4px;
            font-size: 13px;
            font-weight: bold;
        }

        .btn-logout {
            background-color: #b91c1c;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
            font-size: 13px;
            transition: background 0.2s;
        }

        .btn-logout:hover {
            background-color: #991b1b;
        }

        h3 {
            color: var(--navy-dark);
            font-size: 18px;
            margin-top: 0;
            margin-bottom: 15px;
            border-left: 4px solid var(--gold-accent);
            padding-left: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            border: 1px solid var(--border-color);
            padding: 12px 15px;
            text-align: left;
            font-size: 14px;
        }

        th {
            background-color: var(--navy-primary);
            color: white;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 0.5px;
        }

        tr:nth-child(even) {
            background-color: #f8fafc;
        }

        .empty-row {
            text-align: center;
            color: #64748b;
            font-style: italic;
            padding: 20px;
        }

        .btn-submit {
            background-color: #047857;
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 3px;
            cursor: pointer;
            font-weight: bold;
            font-size: 12px;
            margin-top: 5px;
        }

        .btn-submit:hover {
            background-color: #065f46;
        }

        input[type="file"] {
            font-size: 12px;
            margin-bottom: 6px;
        }
    </style>
</head>
<body>

    <div class="academic-container">
        <!-- Header & Profil Mahasiswa -->
        <div class="header-section">
            <div>
                <h1>Dashboard Mahasiswa (Tugas Mandiri)</h1>
                <p class="student-info">
                    Jurusan: <span class="badge-major">{{ $mahasiswa->jurusan ?? 'Umum' }}</span>
                </p>
            </div>

            <!-- Tombol Logout -->
            <form action="{{ route('mahasiswa.logout') }}" method="POST" style="margin: 0;">
                @csrf
                <button type="submit" class="btn-logout">Logout</button>
            </form>
        </div>

        <!-- Notifikasi Pesan Sukses -->
        @if(session('sukses'))
            <p style="color: green; background: #ecfdf5; padding: 10px; border-radius: 4px; border: 1px solid #a7f3d0;">
                <strong>{{ session('sukses') }}</strong>
            </p>
        @endif

        <h3>Daftar Tugas Kelas</h3>

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
                    // Ambil data pengumpulan spesifik milik mahasiswa yang sedang login untuk tugas ini
                    $dataPengumpulan = \App\Models\Pengumpulan::where('id_tugas', $t->id)
                                            ->where('id_siswa', Auth::id())
                                            ->first();
                @endphp
                <tr>
                    <td><strong>{{ $t->mataKuliah->nama_matkul ?? $t->id_matkul }}</strong></td>
                    <td>{{ $t->judul }}</td>
                    <td>
                        @if($dataPengumpulan)
                            <span style="color: #047857; font-weight: bold;">Sudah Dikumpul</span>
                        @else
                            <span style="color: #dc2626; font-weight: bold;">Belum Dikumpul</span>
                        @endif
                    </td>
                    <td>
                        <strong>{{ $dataPengumpulan->nilai ?? 'Belum Dinilai' }}</strong>
                    </td>
                    <td>
                        {{ $dataPengumpulan->catatan ?? '-' }}
                    </td>
                    <td>
                        @if(!$dataPengumpulan)
                            <form action="{{ route('mahasiswa.kumpul') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id_tugas" value="{{ $t->id }}">
                                <input type="file" name="berkas" required><br>
                                <button type="submit" class="btn-submit">Kirim</button>
                            </form>
                        @else
                            <a href="{{ asset('storage/'.$dataPengumpulan->jalur_berkas) }}" target="_blank" style="color: #1e3a8a; font-weight: bold; text-decoration: none;">Lihat Berkas Saya</a>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="empty-row">Belum ada tugas yang dibuat untuk jurusan Anda.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</body>
</html>
