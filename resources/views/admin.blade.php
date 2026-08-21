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
                <p class="text-sm text-gray-500 mt-1">Kelola Pengguna dan Mata Kuliah Sistem E-Learning</p>
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
        @if(session('error'))
            <div class="bg-rose-50 border-l-4 border-rose-500 p-4 text-rose-700 text-sm rounded shadow-sm">
                {{ session('error') }}
            </div>
        @endif

        <!-- ========================================== -->
        <!-- BAGIAN 1: KELOLA PENGGUNA -->
        <!-- ========================================== -->
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-lg font-bold text-gray-800">Daftar Pengguna</h2>
                <!-- Tombol Tambah User -->
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
                                <!-- Tombol Edit -->
                                <button onclick="toggleModal('modalEditUser{{ $u->id }}')" class="text-indigo-600 hover:text-indigo-800 font-semibold text-sm">Edit</button>

                                <!-- Tombol Hapus -->
                                <form action="{{ route('admin.user.delete', $u->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus pengguna ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-rose-600 hover:text-rose-800 font-semibold text-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>

                        <!-- Modal Edit User (Spesifik per baris) -->
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
        <!-- BAGIAN 2: KELOLA MATA KULIAH -->
        <!-- ========================================== -->
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-lg font-bold text-gray-800">Daftar Mata Kuliah</h2>
                <button onclick="toggleModal('modalTambahMatkul')" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-semibold transition">+ Tambah Matkul</button>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-100 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            <th class="p-4">Nama Mata Kuliah</th>
                            <th class="p-4">Dosen Pengajar</th>
                            <th class="p-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-sm">
                        @foreach($matkuls as $mk)
                        <tr class="hover:bg-gray-50/50 transition">
                            <td class="p-4 font-medium text-gray-900">{{ $mk->nama_matkul }}</td>
                            <td class="p-4 text-gray-600">{{ $mk->pengajar->nama ?? 'Tidak ada dosen' }}</td>
                            <td class="p-4 text-center">
                                <button onclick="toggleModal('modalEditMatkul{{ $mk->id }}')" class="text-indigo-600 hover:text-indigo-800 font-semibold text-sm">Edit</button>
                            </td>
                        </tr>

                        <!-- Modal Edit Matkul -->
                        <div id="modalEditMatkul{{ $mk->id }}" class="fixed inset-0 bg-black/50 hidden flex items-center justify-center z-50">
                            <div class="bg-white p-6 rounded-xl w-full max-w-md shadow-2xl">
                                <h3 class="text-xl font-bold mb-4">Edit Mata Kuliah</h3>
                                <form action="{{ route('admin.matkul.update', $mk->id) }}" method="POST" class="space-y-4">
                                    @csrf
                                    @method('PUT')
                                    <div>
                                        <label class="block text-sm font-semibold mb-1">Nama Mata Kuliah</label>
                                        <input type="text" name="nama_matkul" value="{{ $mk->nama_matkul }}" required class="w-full border rounded-lg px-3 py-2">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-semibold mb-1">Dosen Pengajar</label>
                                        <select name="id_pengajar" required class="w-full border rounded-lg px-3 py-2">
                                            @foreach($users->where('peran', 'dosen') as $dosen)
                                                <option value="{{ $dosen->id }}" {{ $mk->id_pengajar == $dosen->id ? 'selected' : '' }}>{{ $dosen->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="flex justify-end space-x-2 mt-6">
                                        <button type="button" onclick="toggleModal('modalEditMatkul{{ $mk->id }}')" class="px-4 py-2 bg-gray-200 rounded-lg text-sm font-semibold hover:bg-gray-300">Batal</button>
                                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-semibold hover:bg-blue-700">Simpan Perubahan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <!-- ========================================== -->
    <!-- GLOBAL MODALS (Tambah User & Tambah Matkul)-->
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

    <!-- Script untuk Buka/Tutup Modal -->
    <script>
        function toggleModal(modalID) {
            const modal = document.getElementById(modalID);
            if (modal.classList.contains('hidden')) {
                modal.classList.remove('hidden');
            } else {
                modal.classList.add('hidden');
            }
        }
    </script>
</body>
</html>
