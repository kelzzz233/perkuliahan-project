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
        input[type="text"], input[type="datetime-local"], select, textarea { width: 100%; padding: 12px 14px; border: 1px solid #cbd5e1; border-radius: 9px; background: #f8fafc; color: #0f172a; font-size: 14px; outline: none; font-family: inherit; }
        input:focus, select:focus, textarea:focus { border-color: #4f46e5; background: white; box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1); }

        .btn-primary { border: none; padding: 11px 18px; border-radius: 9px; font-weight: 700; cursor: pointer; background: linear-gradient(135deg, #4f46e5, #2563eb); color: white; box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2); }
        .btn-primary:hover { opacity: 0.95; }

        .tugas-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 18px; }
        .tugas-item { background: #f8fafc; border: 1px solid #e2e8f0; padding: 18px; border-radius: 14px; display: flex; flex-direction: column; justify-content: space-between; }
        .tugas-matkul { font-size: 11px; font-weight: 700; color: #4f46e5; margin-bottom: 6px; text-transform: uppercase; }
        .tugas-name { font-size: 15px; font-weight: 600; color: #0f172a; margin-bottom: 8px; }
        .tugas-desc { font-size: 13px; color: #64748b; margin-bottom: 12px; line-height: 1.4; }
        .tugas-date { font-size: 12px; color: #94a3b8; font-weight: 600; margin-bottom: 14px; }
        .empty { text-align: center; padding: 30px; color: #94a3b8; font-size: 14px; }

        /* TOMBOL AKSI */
        .action-group { display: flex; gap: 6px; padding-top: 12px; border-top: 1px dashed #e2e8f0; }
        .btn-action { flex: 1; padding: 8px 0; border-radius: 8px; font-size: 12px; font-weight: 700; border: none; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 4px; text-decoration: none; text-align: center; }
        .btn-view { background: #e0f2fe; color: #0369a1; }
        .btn-view:hover { background: #bae6fd; }
        .btn-edit { background: #fef3c7; color: #b45309; }
        .btn-edit:hover { background: #fde68a; }
        .btn-delete { background: #fee2e2; color: #b91c1c; }
        .btn-delete:hover { background: #fca5a5; }

        /* MODAL POPUP */
        .modal { display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; background: rgba(15, 23, 42, 0.4); backdrop-filter: blur(4px); align-items: center; justify-content: center; }
        .modal-content { background: white; padding: 25px; border-radius: 16px; width: 100%; max-width: 500px; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1); }
        .modal-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 18px; }
        .close-modal { cursor: pointer; font-size: 20px; font-weight: bold; color: #64748b; }
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
                                <div>
                                    <div class="tugas-matkul">
                                        {{ $t->jurusan_tujuan ?? 'Umum' }} — {{ $t->mataKuliah->nama_matkul ?? $t->mataKuliah->nama ?? 'Mata Kuliah' }}
                                    </div>
                                    <div class="tugas-name">{{ $t->judul }}</div>
                                    <div class="tugas-desc">{{ Str::limit($t->deskripsi, 80) }}</div>
                                    @if($t->tenggat_waktu)
                                        <div class="tugas-date">⏰ Deadline: {{ \Carbon\Carbon::parse($t->tenggat_waktu)->format('d M Y, H:i') }}</div>
                                    @endif
                                </div>

                                <!-- TOMBOL AKSI: LIHAT, EDIT, HAPUS -->
                                <div class="action-group">
                                    <button class="btn-action btn-view" onclick="openViewModal('{{ $t->judul }}', '{{ $t->jurusan_tujuan ?? 'Umum' }}', '{{ addslashes($t->deskripsi) }}', '{{ $t->tenggat_waktu }}')">
                                        👁️ Lihat
                                    </button>
                                    <button class="btn-action btn-edit" onclick="openEditModal('{{ $t->id }}', '{{ $t->jurusan_tujuan }}', '{{ $t->id_matkul }}', '{{ addslashes($t->judul) }}', '{{ addslashes($t->deskripsi) }}', '{{ $t->tenggat_waktu }}')">
                                        ✏️ Edit
                                    </button>
                                   <form action="{{ route('dosen.tugas.destroy', $t->id) }}" method="POST" style="flex: 1;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus tugas ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-action btn-delete" style="width: 100%;">
                                            🗑️ Hapus
                                        </button>
                                    </form>
                                </div>
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

    <!-- MODAL LIHAT TUGAS -->
    <div id="modalView" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Detail Tugas</h2>
                <span class="close-modal" onclick="closeModal('modalView')">&times;</span>
            </div>
            <div style="margin-bottom: 12px;">
                <span id="viewJurusan" class="tugas-matkul"></span>
                <h3 id="viewJudul" style="font-size: 17px; margin-top: 4px;"></h3>
            </div>
            <p id="viewDeskripsi" style="font-size: 14px; color: #475569; line-height: 1.5; white-space: pre-line; margin-bottom: 15px;"></p>
            <div id="viewDeadline" class="tugas-date"></div>
        </div>
    </div>

    <!-- MODAL EDIT TUGAS -->
    <div id="modalEdit" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Edit Tugas</h2>
                <span class="close-modal" onclick="closeModal('modalEdit')">&times;</span>
            </div>
            <form id="formEdit" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>Jurusan Tujuan</label>
                    <select name="jurusan_tujuan" id="editJurusan" required>
                        <option value="RPL">RPL</option>
                        <option value="TKJ">TKJ</option>
                        <option value="Multimedia">Multimedia</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Mata Kuliah</label>
                    <select name="id_matkul" id="editMatkul" required>
                        @if(isset($matkuls))
                            @foreach($matkuls as $m)
                                <option value="{{ $m->id }}">{{ $m->nama_matkul ?? $m->nama }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>

                <div class="form-group">
                    <label>Judul Tugas</label>
                    <input type="text" name="judul" id="editJudul" required>
                </div>

                <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea name="deskripsi" id="editDeskripsi" rows="3" required></textarea>
                </div>

                <div class="form-group">
                    <label>Tenggat Waktu</label>
                    <input type="datetime-local" name="tenggat_waktu" id="editDeadline" required>
                </div>

                <button type="submit" class="btn-primary" style="width: 100%;">Simpan Perubahan</button>
            </form>
        </div>
    </div>

    <script>
        function openViewModal(judul, jurusan, deskripsi, deadline) {
            document.getElementById('viewJudul').innerText = judul;
            document.getElementById('viewJurusan').innerText = jurusan;
            document.getElementById('viewDeskripsi').innerText = deskripsi;
            document.getElementById('viewDeadline').innerText = deadline ? '⏰ Deadline: ' + deadline : '';
            document.getElementById('modalView').style.display = 'flex';
        }

        function openEditModal(id, jurusan, idMatkul, judul, deskripsi, deadline) {
            let form = document.getElementById('formEdit');
            form.action = "/dosen/tugas/" + id; // Sesuaikan dengan URL route update di Laravel kamu

            document.getElementById('editJurusan').value = jurusan;
            document.getElementById('editMatkul').value = idMatkul;
            document.getElementById('editJudul').value = judul;
            document.getElementById('editDeskripsi').value = deskripsi;
            document.getElementById('editDeadline').value = deadline;

            document.getElementById('modalEdit').style.display = 'flex';
        }

        function closeModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
        }

        window.onclick = function(event) {
            if (event.target.className === 'modal') {
                event.target.style.display = 'none';
            }
        }
    </script>

</body>
</html>
