<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Dosen</title>
</head>
<body>
    <h1>Dashboard Dosen (Buat Tugas & Input Nilai)</h1>

    <!-- Tombol Logout -->
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit">Logout</button>
    </form>

    <hr>

    <!-- Notifikasi Sukses / Error -->
    @if(session('success'))
        <p style="color: green;"><strong>{{ session('success') }}</strong></p>
    @endif

    @if(session('sukses'))
        <p style="color: green;"><strong>{{ session('sukses') }}</strong></p>
    @endif

    @if(session('sukses_matkul'))
    <p style="color: green;"><strong>{{ session('sukses_matkul') }}</strong></p>
@endif

<h3>1. Tambah Mata Kuliah Baru</h3>
<form action="{{ route('dosen.matkul.store') }}" method="POST">
    @csrf
    <div>
        <label>Nama Mata Kuliah:</label><br>
        <input type="text" name="nama_matkul" placeholder="Contoh: Pemrograman Web" required>
        <button type="submit">Tambah Matkul</button>
    </div>
</form>

<hr>

<h4>Daftar Mata Kuliah Kamu:</h4>
<table border="1" cellpadding="5" cellspacing="0">
    <thead>
        <tr>
            <th>ID Matkul</th>
            <th>Nama Mata Kuliah</th>
        </tr>
    </thead>
    <tbody>
        @forelse($matkuls as $m)
        <tr>
            <td><strong>{{ $m->id }}</strong></td>
            <td>{{ $m->nama_matkul ?? $m->nama }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="2">Belum ada mata kuliah. Silakan buat dulu di atas.</td>
        </tr>
        @endforelse
    </tbody>
</table>

<hr>



    <!-- Form Buat Tugas Baru -->
    <h3>Buat Tugas Baru</h3>
    <form action="{{ route('dosen.tugas.store') }}" method="POST">
        @csrf
       <div>
    <label>Mata Kuliah:</label><br>
    <select name="id_matkul" required>
        <option value="">-- Pilih Mata Kuliah --</option>
        @foreach($matkuls as $m)
            <option value="{{ $m->id }}">{{ $m->nama_matkul ?? $m->nama ?? 'Matkul ID '.$m->id }}</option>
        @endforeach
    </select>
</div>
        <br>
        <div>
            <label>Judul Tugas:</label><br>
            <input type="text" name="judul" placeholder="Masukkan judul tugas" required>
        </div>
        <br>
        <div>
            <label>Deskripsi Tugas:</label><br>
            <textarea name="deskripsi" placeholder="Instruksi/Deskripsi tugas"></textarea>
        </div>
        <br>
        <div>
            <label>Tenggat Waktu:</label><br>
            <input type="datetime-local" name="tenggat_waktu" required>
        </div>
        <br>
        <button type="submit">Tambah Tugas</button>
    </form>

    <hr>

    <!-- Tabel Pengumpulan Tugas Mahasiswa -->
    <h3>Pengumpulan Tugas Mahasiswa</h3>
    <table border="1" cellpadding="5" cellspacing="0">
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
                <td>{{ $p->siswa->nama ?? $p->id_siswa }}</td>
                <td>{{ $p->tugas->judul ?? '-' }}</td>
                <td>
                    @if($p->jalur_berkas)
                        <a href="{{ asset('storage/'.$p->jalur_berkas) }}" target="_blank">Lihat Berkas</a>
                    @else
                        Tidak Ada Berkas
                    @endif
                </td>
                <td>{{ $p->nilai ?? 'Belum Dinilai' }}</td>
                <td>{{ $p->catatan ?? '-' }}</td>
                <td>
                    <form action="{{ route('dosen.nilai', $p->id) }}" method="POST">
                        @csrf
                        <input type="number" name="nilai" value="{{ $p->nilai }}" placeholder="Nilai" style="width:60px" required>
                        <input type="text" name="catatan" value="{{ $p->catatan }}" placeholder="Catatan">
                        <button type="submit">Simpan</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" align="center">Belum ada pengumpulan tugas dari mahasiswa.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
