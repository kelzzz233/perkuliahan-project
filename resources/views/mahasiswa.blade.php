<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Mahasiswa</title>
</head>
<body>
    <h1>Dashboard Mahasiswa (Tugas Mandiri)</h1>

    <!-- Tombol Logout -->
   <form action="{{ route('mahasiswa.logout') }}" method="POST">
        @csrf
        <button type="submit">Logout</button>
    </form>

    <hr>

    <!-- Notifikasi Pesan Sukses -->
    @if(session('sukses'))
        <p style="color: green;"><strong>{{ session('sukses') }}</strong></p>
    @endif

    <h3>Daftar Tugas Kelas</h3>
    <table border="1" cellpadding="5" cellspacing="0">
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
                <td>{{ $t->mataKuliah->nama_matkul ?? $t->id_matkul }}</td>
                <td>{{ $t->judul }}</td>
                <td>
                    @if($dataPengumpulan)
                        <span style="color:green; font-weight:bold;">Sudah Dikumpul</span>
                    @else
                        <span style="color:red; font-weight:bold;">Belum Dikumpul</span>
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
                            <input type="file" name="berkas" required>
                            <button type="submit">Kirim</button>
                        </form>
                    @else
                        <a href="{{ asset('storage/'.$dataPengumpulan->jalur_berkas) }}" target="_blank">Lihat Berkas Saya</a>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" align="center">Belum ada tugas yang dibuat.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
