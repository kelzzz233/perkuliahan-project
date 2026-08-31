<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Portal Akademik</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Plus Jakarta Sans', sans-serif; } </style>
</head>
<body class="bg-gray-50 min-h-screen p-6">

    <div class="max-w-6xl mx-auto space-y-6">

        <!-- Header & Logout -->
        <div class="flex justify-between items-center bg-white p-6 rounded-xl shadow-sm border border-gray-100">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Dashboard Admin</h1>
                <p class="text-sm text-gray-500 mt-1">Kelola Pengguna, Mata Kuliah, dan Pengaturan Sistem Akademik</p>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="bg-rose-600 hover:bg-rose-700 text-white px-5 py-2.5 rounded-lg text-sm font-semibold transition">Logout</button>
            </form>
        </div>

        <!-- Notifikasi -->
        @if(session('sukses'))
            <div class="bg-emerald-50 border-l-4 border-emerald-500 p-4 text-emerald-700 text-sm rounded shadow-sm">
                {{ session('sukses') }}
            </div>
        @endif
        @if(session('sukses_matkul'))
            <div class="bg-blue-50 border-l-4 border-blue-500 p-4 text-blue-700 text-sm rounded shadow-sm">
                {{ session('sukses_matkul') }}
            </div>
        @endif
        @if(session('success'))
            <div class="bg-emerald-50 border-l-4 border-emerald-500 p-4 text-emerald-700 text-sm rounded shadow-sm">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="bg-rose-50 border-l-4 border-rose-500 p-4 text-rose-700 text-sm rounded shadow-sm">
                {{ session('error') }}
            </div>
        @endif

        <!-- ========================================== -->
        <!-- PENGATURAN STATUS KRS (ON/OFF) -->
        <!-- ========================================== -->
        <div class="bg-gradient-to-r from-indigo-900 to-blue-900 p-6 rounded-2xl shadow-lg text-white flex flex-col md:flex-row justify-between items-center gap-4">
            <div class="space-y-1 text-center md:text-left">
                <span class="bg-blue-500/30 text-blue-200 text-xs font-semibold px-3 py-1 rounded-full border border-blue-400/30">Kontrol Akademik</span>
                <h2 class="text-xl font-bold tracking-tight">Status Pengisian KRS Mahasiswa</h2>
                <p class="text-blue-100/80 text-sm">Buka atau tutup akses mahasiswa untuk melakukan tambah/edit Kartu Rencana Studi.</p>
            </div>

            <form action="{{ route('admin.update-krs') }}" method="POST" class="flex items-center gap-3 bg-white/10 p-3 rounded-xl border border-white/10 backdrop-blur-md w-full md:w-auto justify-end">
                @csrf
                @method('PUT')
                
                <select name="status_krs" class="bg-gray-900 text-white border border-gray-700 rounded-lg px-4 py-2 text-sm font-semibold focus:outline-none focus:ring-2 focus:ring-blue-400">
                    <option value="1" {{ isset($statusKrs) && $statusKrs == 1 ? 'selected' : '' }}>🟢 Buka (Aktif)</option>
                    <option value="0" {{ isset($statusKrs) && $statusKrs == 0 ? 'selected' : '' }}>🔴 Tutup (Non-Aktif)</option>
                </select>

                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-5 py-2 rounded-lg text-sm font-semibold transition shadow-md whitespace-nowrap">
                    Simpan Status
                </button>
            </form>
        </div>

        <!-- ========================================== -->
        <!-- BAGIAN 1: KELOLA PENGGUNA -->
        <!-- ========================================== -->
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-lg font-bold text-gray-800">Daftar Pengguna</h2>
                <button onclick="toggleModal('modalTambahUser')" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm font-semibold transition">+ Tambah Pengguna</button>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-100 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            <th class="p-4">Nama</th>
                            <th class="p-4">Email</th>
                            <th class="p-4 text-center">Peran</th>
                            <th class="p-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-sm">
                        @foreach($users as $u)
                        <tr class="hover:bg-gray-50/50 transition">
                            <td class="p-4 font-medium text-gray-900">{{ $u->nama }}</td>
                            <td class="p-4 text-gray-600">{{ $u->email }}</td>
                            <td class="p-4 text-center">
                                <span class="px-3 py-1 text-xs font-semibold rounded-full
                                    {{ $u->peran == 'admin' ? 'bg-purple-100 text-purple-700' : ($u->peran == 'dosen' ? 'bg-blue-100 text-blue-700' : 'bg-emerald-100 text-emerald-700') }}">
                                    {{ ucfirst($u->peran) }}
                                </span>
                            </td>
                            <td class="p-4 text-center space-x-3">
                                <button onclick="toggleModal('modalEditUser{{ $u->id }}')" class="text-indigo-600 hover:text-indigo-800 font-semibold text-sm">Edit</button>

                                <form action="{{ route('admin.user.delete', $u->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus pengguna ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-rose-600 hover:text-rose-800 font-semibold text-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>

                        <!-- Modal Edit User -->
                        <div id="modalEditUser{{ $u->id }}" class="fixed inset-0 bg-black/50 hidden flex items-center justify-center z-50">
                            <div class="bg-white p-6 rounded-xl w-full max-w-md shadow-2xl">
                                <h3 class="text-xl font-bold mb-4">Edit Pengguna</h3>
                                <form action="{{ route('admin.user.update', $u->id) }}" method="POST" class="space-y-4">
                                    @csrf
                                    @method('PUT')
                                    <div>
                                        <label class="block text-sm font-semibold mb-1">Nama Lengkap</label>
                                        <input type="text" name="nama" value="{{ $u->nama }}" required class="w-full border rounded-lg px-3 py-2">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-semibold mb-1">Email</label>
                                        <input type="email" name="email" value="{{ $u->email }}" required class="w-full border rounded-lg px-3 py-2">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-semibold mb-1">Password Baru (Opsional)</label>
                                        <input type="password" name="kata_sandi" placeholder="Kosongkan jika tidak diganti" class="w-full border rounded-lg px-3 py-2">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-semibold mb-1">Peran</label>
                                        <select name="peran" required class="w-full border rounded-lg px-3 py-2">
                                            <option value="mahasiswa" {{ $u->peran == 'mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
                                            <option value="dosen" {{ $u->peran == 'dosen' ? 'selected' : '' }}>Dosen</option>
                                            <option value="admin" {{ $u->peran == 'admin' ? 'selected' : '' }}>Admin</option>
                                        </select>
                                    </div>
                                    <div class="flex justify-end space-x-2 mt-6">
                                        <button type="button" onclick="toggleModal('modalEditUser{{ $u->id }}')" class="px-4 py-2 bg-gray-200 rounded-lg text-sm font-semibold hover:bg-gray-300">Batal</button>
                                        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm font-semibold hover:bg-indigo-700">Simpan Perubahan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- ========================================== -->
        <!-- BAGIAN 2: KELOLA MATA KULIAH (CARD GRID DESIGN) -->
        <!-- ========================================== -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4 mb-6">
                <div>
                    <h2 class="text-lg font-bold text-gray-800">Daftar Mata Kuliah Berdasarkan Dosen</h2>
                    <p class="text-xs text-gray-500">Kelola dan ubah mata kuliah pengajar dengan mudah</p>
                </div>
                
                <div class="flex items-center gap-3 w-full md:w-auto">
                    <!-- Kotak Pencarian Nama Dosen -->
                    <div class="relative w-full md:w-64">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">🔍</span>
                        <input type="text" id="searchDosen" placeholder="Cari nama dosen..." class="w-full pl-9 pr-3 py-2 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 bg-gray-50/50">
                    </div>
                    
                    <button onclick="toggleModal('modalTambahMatkul')" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-xl text-sm font-semibold transition whitespace-nowrap shadow-sm shadow-blue-200">+ Tambah Matkul</button>
                </div>
            </div>

            <!-- List Dosen dalam bentuk Card Modern -->
            <div class="grid grid-cols-1 gap-4" id="tabelDosenMatkul">
                @php 
                    $no = 1; 
                @endphp
                @foreach($groupedMatkuls as $idPengajar => $items)
                @php 
                    $namaDosen = $items->first()->pengajar->nama ?? 'Tidak Ada Dosen';
                @endphp
                
                <div class="row-dosen bg-white border border-gray-100 hover:border-blue-200 rounded-xl p-5 shadow-sm transition duration-200 flex flex-col md:flex-row justify-between items-start md:items-center gap-4" data-dosen="{{ strtolower($namaDosen) }}">
                    
                    <!-- Kolom Info Dosen -->
                    <div class="flex items-center gap-4 min-w-[220px]">
                        <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 font-bold flex items-center justify-center text-base shadow-inner">
                            👨‍🏫
                        </div>
                        <div>
                            <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Pengajar #{{ $no++ }}</span>
                            <h3 class="font-bold text-gray-900 text-base">{{ ucwords($namaDosen) }}</h3>
                        </div>
                    </div>

                    <!-- Kolom Mata Kuliah & Tombol Aksi yang Terhubung Rapi -->
                    <div class="flex-1 w-full bg-gray-50/70 p-3.5 rounded-xl border border-gray-100">
                        <div class="text-xs font-bold text-gray-400 uppercase mb-2">Mata Kuliah & Aksi:</div>
                        <div class="flex flex-wrap gap-2">
                            @foreach($items as $item)
                                <div class="inline-flex items-center bg-white border border-gray-200/80 rounded-lg p-1 pl-3 shadow-2xs gap-2">
                                    <span class="text-xs font-semibold text-gray-700">📚 {{ $item->nama_matkul }}</span>
                                    <button onclick="toggleModal('modalEditMatkul{{ $item->id }}')" class="bg-indigo-50 hover:bg-indigo-100 text-indigo-600 px-2.5 py-1 rounded-md text-xs font-bold transition">
                                        Edit
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>

                <!-- Modal Edit Matkul (Per Item) -->
                @foreach($items as $item)
                <div id="modalEditMatkul{{ $item->id }}" class="fixed inset-0 bg-black/50 hidden flex items-center justify-center z-50 backdrop-blur-xs">
                    <div class="bg-white p-6 rounded-2xl w-full max-w-md shadow-2xl">
                        <h3 class="text-xl font-bold mb-1 text-gray-900">Edit Mata Kuliah</h3>
                        <p class="text-xs text-gray-500 mb-4">Ubah nama mata kuliah atau pindahkan dosen pengajar.</p>
                        <form action="{{ route('admin.matkul.update', $item->id) }}" method="POST" class="space-y-4">
                            @csrf
                            @method('PUT')
                            <div>
                                <label class="block text-sm font-semibold mb-1 text-gray-700">Nama Mata Kuliah</label>
                                <input type="text" name="nama_matkul" value="{{ $item->nama_matkul }}" required class="w-full border border-gray-200 rounded-xl px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold mb-1 text-gray-700">Dosen Pengajar</label>
                                <select name="id_pengajar" required class="w-full border border-gray-200 rounded-xl px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white">
                                    @foreach($users->where('peran', 'dosen') as $dosen)
                                        <option value="{{ $dosen->id }}" {{ $item->id_pengajar == $dosen->id ? 'selected' : '' }}>{{ $dosen->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="flex justify-end space-x-2 mt-6">
                                <button type="button" onclick="toggleModal('modalEditMatkul{{ $item->id }}')" class="px-4 py-2 bg-gray-100 text-gray-600 rounded-xl text-sm font-semibold hover:bg-gray-200 transition">Batal</button>
                                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-xl text-sm font-semibold hover:bg-blue-700 transition shadow-sm shadow-blue-200">Simpan Perubahan</button>
                            </div>
                        </form>
                    </div>
                </div>
                @endforeach

                @endforeach
            </div>
        </div>

    </div>

    <!-- ========================================== -->
    <!-- GLOBAL MODALS (Tambah User & Tambah Matkul) -->
    <!-- ========================================== -->

    <!-- Modal Tambah User -->
    <div id="modalTambahUser" class="fixed inset-0 bg-black/50 hidden flex items-center justify-center z-50">
        <div class="bg-white p-6 rounded-xl w-full max-w-md shadow-2xl">
            <h3 class="text-xl font-bold mb-4">Tambah Pengguna Baru</h3>
            <form action="{{ route('admin.user.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-semibold mb-1">Nama Lengkap</label>
                    <input type="text" name="nama" required class="w-full border rounded-lg px-3 py-2">
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-1">NIM / NIP</label>
                    <input type="text" name="nim" class="w-full border rounded-lg px-3 py-2" placeholder="Masukkan NIM atau NIP (Opsional)">
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-1">Email</label>
                    <input type="email" name="email" required class="w-full border rounded-lg px-3 py-2">
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-1">Password</label>
                    <input type="password" name="kata_sandi" required class="w-full border rounded-lg px-3 py-2">
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-1">Peran</label>
                    <select name="peran" required class="w-full border rounded-lg px-3 py-2">
                        <option value="mahasiswa">Mahasiswa</option>
                        <option value="dosen">Dosen</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-1">Jurusan</label>
                    <select name="jurusan" class="w-full border rounded-lg px-3 py-2 bg-white">
                        <option value="">-- Tidak Ada / Umum (Untuk Dosen/Admin) --</option>
                        <option value="RPL">RPL</option>
                        <option value="TKJ">TKJ</option>
                        <option value="Multimedia">Multimedia</option>
                    </select>
                </div>
                <div class="flex justify-end space-x-2 mt-6">
                    <button type="button" onclick="toggleModal('modalTambahUser')" class="px-4 py-2 bg-gray-200 rounded-lg text-sm font-semibold hover:bg-gray-300">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm font-semibold hover:bg-indigo-700">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Tambah Matkul -->
    <div id="modalTambahMatkul" class="fixed inset-0 bg-black/50 hidden flex items-center justify-center z-50">
        <div class="bg-white p-6 rounded-xl w-full max-w-md shadow-2xl">
            <h3 class="text-xl font-bold mb-4">Tambah Mata Kuliah</h3>
            <form action="{{ route('admin.matkul.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-semibold mb-1">Nama Mata Kuliah</label>
                    <input type="text" name="nama_matkul" required class="w-full border rounded-lg px-3 py-2">
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-1">Dosen Pengajar</label>
                    <select name="id_pengajar" required class="w-full border rounded-lg px-3 py-2">
                        <option value="" disabled selected>-- Pilih Dosen --</option>
                        @foreach($users->where('peran', 'dosen') as $dosen)
                            <option value="{{ $dosen->id }}">{{ $dosen->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex justify-end space-x-2 mt-6">
                    <button type="button" onclick="toggleModal('modalTambahMatkul')" class="px-4 py-2 bg-gray-200 rounded-lg text-sm font-semibold hover:bg-gray-300">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-semibold hover:bg-blue-700">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Script untuk Modal & Live Search Dosen -->
    <script>
        function toggleModal(modalID) {
            const modal = document.getElementById(modalID);
            if (modal.classList.contains('hidden')) {
                modal.classList.remove('hidden');
            } else {
                modal.classList.add('hidden');
            }
        }

        // Fitur Pencarian Dosen Secara Realtime
        document.getElementById('searchDosen').addEventListener('input', function() {
            let keyword = this.value.toLowerCase().trim();
            let rows = document.querySelectorAll('#tabelDosenMatkul div.row-dosen');

            rows.forEach(function(row) {
                let namaDosen = row.getAttribute('data-dosen');
                
                if (keyword === "" || (namaDosen && namaDosen.includes(keyword))) {
                    row.style.display = ''; // Tampilkan baris jika cocok
                } else {
                    row.style.display = 'none'; // Sembunyikan baris jika tidak cocok
                }
            });
        });
    </script>
</body>
</html>