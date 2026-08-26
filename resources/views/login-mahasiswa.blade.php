<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Mahasiswa - Akademik</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Alpine.js untuk fitur pindah tab Login/Register -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-slate-900 min-h-screen flex items-center justify-center p-6" x-data="{ tab: 'login' }">

    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-4xl overflow-hidden grid grid-cols-1 md:grid-cols-2">
        <!-- Bagian Kiri (Banner / Info) -->
        <div class="bg-indigo-600 p-8 text-white flex flex-col justify-between">
            <div>
                <span class="bg-indigo-500 text-xs px-3 py-1 rounded-full uppercase tracking-wider font-semibold">Portal Mahasiswa</span>
                <h1 class="text-3xl font-bold mt-4">Sistem Pengelolaan Tugas & Kuliah</h1>
            </div>
            <p class="text-indigo-200 text-sm">Kelola tugas kuliah, kumpulkan berkas, dan pantau nilai dengan mudah dalam satu platform terintegrasi.</p>
        </div>

        <!-- Bagian Kanan (Form Login & Register) -->
        <div class="p-8 flex flex-col justify-center">

            <!-- Tombol Pilihan Tab (Masuk / Daftar) -->
            <div class="flex border-b mb-6">
                <button @click="tab = 'login'" :class="tab === 'login' ? 'border-b-2 border-indigo-600 text-indigo-600' : 'text-gray-400'" class="w-1/2 pb-2 font-semibold text-sm transition">Masuk</button>
                <button @click="tab = 'register'" :class="tab === 'register' ? 'border-b-2 border-indigo-600 text-indigo-600' : 'text-gray-400'" class="w-1/2 pb-2 font-semibold text-sm transition">Daftar Akun</button>
            </div>

            <!-- Notifikasi Sukses / Error -->
            @if(session('sukses'))
                <div class="mb-4 text-sm text-green-700 bg-green-50 border-l-4 border-green-500 p-3 rounded">
                    {{ session('sukses') }}
                </div>
            @endif

            @if($errors->any())
                <div class="bg-rose-50 border-l-4 border-rose-500 p-3 text-rose-700 text-sm mb-4 rounded">
                    {{ $errors->first() }}
                </div>
            @endif

            <!-- FORM LOGIN -->
            <form x-show="tab === 'login'" action="{{ route('mahasiswa.login') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-semibold text-gray-600 uppercase mb-1">Nama Mahasiswa</label>
                    <input type="text" name="nama" value="{{ old('nama') }}" required placeholder="Masukkan Nama Anda" class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-indigo-500 outline-none">
                </div>



                <div>
                    <label class="block text-xs font-semibold text-gray-600 uppercase mb-1">Password</label>
                    <input type="password" name="password" required placeholder="••••••••" class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-indigo-500 outline-none">
                </div>
                <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2.5 rounded-lg text-sm transition">
                    Masuk ke Sistem
                </button>
            </form>

            <!-- FORM REGISTER -->
            <form x-show="tab === 'register'" action="{{ route('mahasiswa.register') }}" method="POST" class="space-y-4" style="display: none;">
                @csrf
                <div>
                    <label class="block text-xs font-semibold text-gray-600 uppercase mb-1">Nama Lengkap</label>
                    <input type="text" name="nama" required placeholder="Nama Lengkap Anda" class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-indigo-500 outline-none">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 uppercase mb-1">Email</label>
                    <input type="email" name="email" required placeholder="email@student.com" class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-indigo-500 outline-none">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-600 uppercase mb-1">Pilih Jurusan</label>
                    <select name="jurusan" required class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-indigo-500 outline-none bg-white">
                        <option value="">-- Pilih Jurusan --</option>
                        <option value="RPL">RPL (Rekayasa Perangkat Lunak)</option>
                        <option value="TKJ">TKJ (Teknik Komputer & Jaringan)</option>
                        <option value="Multimedia">Multimedia</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-600 uppercase mb-1">Password (Kata Sandi)</label>
                    <input type="password" name="kata_sandi" required placeholder="Minimal 6 karakter" class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-indigo-500 outline-none">
                </div>
                <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-semibold py-2.5 rounded-lg text-sm transition">
                    Daftar Sekarang
                </button>
            </form>

        </div>
    </div>

</body>
</html>
