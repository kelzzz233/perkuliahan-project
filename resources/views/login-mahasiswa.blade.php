<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Mahasiswa - Portal Akademik</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-900 min-h-screen flex items-center justify-center p-6">

    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-4xl overflow-hidden grid grid-cols-1 md:grid-cols-2">
        <!-- Bagian Kiri (Banner / Info) -->
        <div class="bg-indigo-600 p-8 text-white flex flex-col justify-between">
            <div>
                <span class="bg-indigo-500 text-xs px-3 py-1 rounded-full uppercase tracking-wider font-semibold">Portal Mahasiswa</span>
                <h1 class="text-3xl font-bold mt-4">Sistem Pengelolaan Tugas & Kuliah</h1>
            </div>
            <p class="text-indigo-200 text-sm">Kelola tugas kuliah, kumpulkan berkas, dan pantau nilai dengan mudah dalam satu platform terintegrasi.</p>
        </div>

        <!-- Bagian Kanan (Form Login) -->
        <div class="p-8 flex flex-col justify-center">
            <h2 class="text-2xl font-bold text-gray-800">Selamat Datang 👋</h2>
            <p class="text-sm text-gray-500 mb-6">Silakan masuk menggunakan akun mahasiswa Anda</p>

            <!-- Tampilkan Error Jika Gagal Login -->
            @if($errors->any())
                <div class="bg-rose-50 border-l-4 border-rose-500 p-3 text-rose-700 text-sm mb-4 rounded">
                    {{ $errors->first() }}
                </div>
            @endif

           <form action="{{ route('mahasiswa.login') }}" method="POST" class="space-y-4">
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
            
        </div>
    </div>

</body>
</html>
