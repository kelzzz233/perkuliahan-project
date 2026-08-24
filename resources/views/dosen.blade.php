<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Dosen</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #f1f5f9;
            color: #1e293b;
        }

        /* ================= HEADER ================= */

        .header {
            background: linear-gradient(135deg, #172554, #1d4ed8);
            color: white;
            padding: 25px 40px;
            box-shadow: 0 8px 25px rgba(30, 64, 175, .2);
        }

        .header-content {
            max-width: 1400px;
            margin: auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header h1 {
            font-size: 27px;
            font-weight: 800;
        }

        .header p {
            margin-top: 6px;
            font-size: 14px;
            color: #dbeafe;
        }

        .logout-btn {
            background: #ef4444;
            color: white;
            border: none;
            padding: 10px 18px;
            border-radius: 9px;
            font-weight: 600;
            cursor: pointer;
            transition: .2s;
        }

        .logout-btn:hover {
            background: #dc2626;
            transform: translateY(-2px);
        }

        /* ================= CONTAINER ================= */

        .container {
            max-width: 1400px;
            margin: 30px auto;
            padding: 0 20px;
        }

        /* ================= ALERT ================= */

        .alert {
            padding: 14px 18px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 14px;
            font-weight: 600;
        }

        .alert-success {
            background: #dcfce7;
            color: #166534;
            border: 1px solid #bbf7d0;
        }

        /* ================= CARD ================= */

        .card {
            background: white;
            border-radius: 16px;
            padding: 25px;
            margin-bottom: 25px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 5px 20px rgba(15, 23, 42, .06);
        }

        .card-title {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
        }

        .icon {
            width: 40px;
            height: 40px;
            background: #eef2ff;
            color: #4f46e5;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            font-size: 19px;
        }

        .card h2 {
            font-size: 19px;
            color: #0f172a;
        }

        .card-subtitle {
            font-size: 13px;
            color: #64748b;
            margin-top: 3px;
        }

        /* ================= FORM ================= */

        .form-group {
            margin-bottom: 18px;
        }

        label {
            display: block;
            font-size: 13px;
            font-weight: 700;
            color: #475569;
            margin-bottom: 7px;
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #cbd5e1;
            border-radius: 9px;
            background: #f8fafc;
            color: #0f172a;
            font-family: inherit;
            font-size: 14px;
            outline: none;
            transition: .2s;
        }

        input:focus,
        select:focus,
        textarea:focus {
            border-color: #4f46e5;
            background: white;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, .1);
        }

        textarea {
            min-height: 110px;
            resize: vertical;
        }

        .btn {
            border: none;
            padding: 11px 18px;
            border-radius: 9px;
            font-family: inherit;
            font-weight: 700;
            cursor: pointer;
            transition: .2s;
        }

        .btn-primary {
            background: linear-gradient(135deg, #4f46e5, #2563eb);
            color: white;
            box-shadow: 0 5px 15px rgba(37, 99, 235, .2);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(37, 99, 235, .3);
        }

        /* ================= MATKUL ================= */

        .matkul-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 15px;
            margin-top: 20px;
        }

        .matkul-item {
            padding: 18px;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            background: #f8fafc;
            transition: .2s;
        }

        .matkul-item:hover {
            transform: translateY(-3px);
            border-color: #a5b4fc;
            box-shadow: 0 7px 18px rgba(15, 23, 42, .07);
        }

        .matkul-id {
            font-size: 11px;
            color: #6366f1;
            font-weight: 800;
            text-transform: uppercase;
        }

        .matkul-name {
            margin-top: 7px;
            font-size: 15px;
            font-weight: 700;
            color: #1e293b;
        }

        /* ================= TABLE ================= */

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 900px;
        }

        th {
            background: #eef2ff;
            color: #3730a3;
            text-align: left;
            padding: 14px;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: .4px;
        }

        td {
            padding: 14px;
            border-bottom: 1px solid #e2e8f0;
            font-size: 13px;
            color: #475569;
        }

        tr:hover td {
            background: #f8fafc;
        }

        .student-name {
            font-weight: 700;
            color: #1e293b;
        }

        .file-link {
            display: inline-block;
            background: #eef2ff;
            color: #4f46e5;
            padding: 7px 10px;
            border-radius: 7px;
            text-decoration: none;
            font-weight: 600;
            font-size: 12px;
        }

        .file-link:hover {
            background: #e0e7ff;
        }

        .status-belum {
            color: #f59e0b;
            font-weight: 700;
        }

        .nilai-form {
            display: flex;
            gap: 7px;
            align-items: center;
        }

        .nilai-form input {
            width: 90px;
            padding: 9px;
        }

        .nilai-form input[type="text"] {
            width: 150px;
        }

        .nilai-form button {
            background: #16a34a;
            color: white;
            padding: 9px 12px;
            border-radius: 7px;
            border: none;
            font-weight: 600;
            cursor: pointer;
        }

        .nilai-form button:hover {
            background: #15803d;
        }

        .empty {
            text-align: center;
            padding: 30px;
            color: #94a3b8;
        }

        /* ================= RESPONSIVE ================= */

        @media (max-width: 700px) {

            .header {
                padding: 20px;
            }

            .header-content {
                align-items: flex-start;
                gap: 15px;
            }

            .header h1 {
                font-size: 21px;
            }

            .container {
                padding: 0 12px;
                margin-top: 20px;
            }

            .card {
                padding: 18px;
            }

            .nilai-form {
                flex-direction: column;
                align-items: stretch;
            }

            .nilai-form input,
            .nilai-form input[type="text"] {
                width: 100%;
            }
        }
    </style>
</head>

<body>

    <!-- ================= HEADER ================= -->

    <header class="header">
        <div class="header-content">

            <div>
                <h1>👨‍🏫 Dashboard Dosen</h1>
                <p>Kelola mata kuliah, tugas, dan nilai mahasiswa</p>
            </div>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-btn">
                    Logout
                </button>
            </form>

        </div>
    </header>


    <main class="container">

        <!-- ================= NOTIFIKASI ================= -->

        @if(session('success'))
            <div class="alert alert-success">
                ✅ {{ session('success') }}
            </div>
        @endif

        @if(session('sukses'))
            <div class="alert alert-success">
                ✅ {{ session('sukses') }}
            </div>
        @endif

        @if(session('sukses_matkul'))
            <div class="alert alert-success">
                📚 {{ session('sukses_matkul') }}
            </div>
        @endif


        <!-- ================= TAMBAH MATKUL ================= -->

        <div class="card">

            <div class="card-title">
                <div class="icon">📚</div>

                <div>
                    <h2>Tambah Mata Kuliah</h2>
                    <div class="card-subtitle">
                        Tambahkan mata kuliah yang Anda ajarkan
                    </div>
                </div>
            </div>

            <form action="{{ route('dosen.matkul.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label>Nama Mata Kuliah</label>

                    <input
                        type="text"
                        name="nama_matkul"
                        placeholder="Contoh: Pemrograman Web"
                        required
                    >
                </div>

                <button type="submit" class="btn btn-primary">
                    + Tambah Mata Kuliah
                </button>
            </form>

        </div>


        <!-- ================= DAFTAR MATKUL ================= -->

        <div class="card">

            <div class="card-title">
                <div class="icon">📖</div>

                <div>
                    <h2>Mata Kuliah Saya</h2>
                    <div class="card-subtitle">
                        Daftar mata kuliah yang Anda buat
                    </div>
                </div>
            </div>

            @if($matkuls->count())

                <div class="matkul-grid">

                    @foreach($matkuls as $m)

                        <div class="matkul-item">

                            <div class="matkul-id">
                                ID MATKUL #{{ $m->id }}
                            </div>

                            <div class="matkul-name">
                                {{ $m->nama_matkul ?? $m->nama }}
                            </div>

                        </div>

                    @endforeach

                </div>

            @else

                <div class="empty">
                    Belum ada mata kuliah. Silakan tambahkan mata kuliah terlebih dahulu.
                </div>

            @endif

        </div>


        <!-- ================= BUAT TUGAS ================= -->

        <div class="card">

            <div class="card-title">
                <div class="icon">📝</div>

                <div>
                    <h2>Buat Tugas Baru</h2>
                    <div class="card-subtitle">
                        Buat tugas dan tentukan jurusan mahasiswa yang menerima
                    </div>
                </div>
            </div>

            <form action="{{ route('dosen.tugas.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label>Mata Kuliah</label>

                    <select name="id_matkul" required>

                        <option value="">
                            -- Pilih Mata Kuliah --
                        </option>

                        @foreach($matkuls as $m)

                            <option value="{{ $m->id }}">
                                {{ $m->nama_matkul ?? $m->nama ?? 'Matkul ID '.$m->id }}
                            </option>

                        @endforeach

                    </select>
                </div>


                <div class="form-group">
                    <label>🎯 Target Jurusan</label>

                    <select name="jurusan_tujuan" required>

                        <option value="">
                            -- Pilih Jurusan Tujuan --
                        </option>

                        <option value="RPL">
                            RPL — Rekayasa Perangkat Lunak
                        </option>

                        <option value="TKJ">
                            TKJ — Teknik Komputer & Jaringan
                        </option>

                        <option value="Multimedia">
                            Multimedia
                        </option>

                    </select>
                </div>


                <div class="form-group">
                    <label>Judul Tugas</label>

                    <input
                        type="text"
                        name="judul"
                        placeholder="Contoh: Membuat Website Laravel"
                        required
                    >
                </div>


                <div class="form-group">
                    <label>Deskripsi Tugas</label>

                    <textarea
                        name="deskripsi"
                        placeholder="Tuliskan instruksi atau deskripsi tugas..."
                    ></textarea>
                </div>


                <div class="form-group">
                    <label>⏰ Tenggat Waktu</label>

                    <input
                        type="datetime-local"
                        name="tenggat_waktu"
                        required
                    >
                </div>


                <button type="submit" class="btn btn-primary">
                    🚀 Publikasikan Tugas
                </button>

            </form>

        </div>


        <!-- ================= PENGUMPULAN ================= -->

        <div class="card">

            <div class="card-title">

                <div class="icon">📊</div>

                <div>
                    <h2>Pengumpulan Tugas Mahasiswa</h2>

                    <div class="card-subtitle">
                        Periksa pengumpulan dan berikan nilai mahasiswa
                    </div>
                </div>

            </div>


            <div class="table-wrapper">

                <table>

                    <thead>

                        <tr>
                            <th>Siswa</th>
                            <th>Tugas</th>
                            <th>Berkas</th>
                            <th>Nilai</th>
                            <th>Catatan</th>
                            <th>Aksi</th>
                        </tr>

                    </thead>


                    <tbody>

                        @forelse($pengumpulan as $p)

                            <tr>

                                <td>
                                    <span class="student-name">
                                        {{ $p->siswa->nama ?? $p->id_siswa }}
                                    </span>
                                </td>


                                <td>
                                    {{ $p->tugas->judul ?? '-' }}
                                </td>


                                <td>

                                    @if($p->jalur_berkas)

                                       <a href="{{ $p->jalur_berkas }}" target="_blank" class="file-link">
    🔗 Buka Link Tugas
</a>

                                    @else

                                        Tidak Ada Berkas

                                    @endif

                                </td>


                                <td>

                                    @if($p->nilai !== null)

                                        <strong>
                                            {{ $p->nilai }}
                                        </strong>

                                    @else

                                        <span class="status-belum">
                                            Belum Dinilai
                                        </span>

                                    @endif

                                </td>


                                <td>
                                    {{ $p->catatan ?? '-' }}
                                </td>


                                <td>

                                    <form
                                        action="{{ route('dosen.nilai', $p->id) }}"
                                        method="POST"
                                        class="nilai-form"
                                    >

                                        @csrf

                                        <input
                                            type="number"
                                            name="nilai"
                                            value="{{ $p->nilai }}"
                                            placeholder="Nilai"
                                            min="0"
                                            max="100"
                                            required
                                        >

                                        <input
                                            type="text"
                                            name="catatan"
                                            value="{{ $p->catatan }}"
                                            placeholder="Catatan"
                                        >

                                        <button type="submit">
                                            Simpan
                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="6" class="empty">
                                    📭 Belum ada pengumpulan tugas dari mahasiswa.
                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </main>

</body>
</html>