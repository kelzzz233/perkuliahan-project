<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Mahasiswa - Akademik</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-900 min-h-screen flex items-center justify-center p-6">

    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-4xl overflow-hidden grid grid-cols-1 md:grid-cols-2">
        
        <!-- Bagian Kiri (Banner / Info) -->
        <div class="bg-gradient-to-br from-indigo-600 to-violet-700 p-8 text-white flex flex-col justify-between">
            <div>
                <span class="bg-white/20 text-xs px-3 py-1 rounded-full uppercase tracking-wider font-semibold inline-block mb-4">Portal Mahasiswa</span>
                <h1 class="text-3xl font-bold leading-snug">Sistem Pengelolaan Tugas & Kuliah</h1>
            </div>
            <p class="text-indigo-100 text-sm leading-relaxed">Kelola tugas kuliah, kumpulkan berkas, dan pantau nilai dengan mudah dalam satu platform terintegrasi.</p>
        </div>

        <!-- Bagian Kanan (Form Login Saja) -->
        <div class="p-8 md:p-12 flex flex-col justify-center">

            <div class="mb-6">
                <h2 class="text-2xl font-bold text-gray-800">Masuk Akun</h2>
                <p class="text-sm text-gray-500 mt-1">Silakan masukkan NIM dan password Anda.</p>
            </div>

            @if(session('sukses'))
                <div class="mb-4 text-sm text-green-700 bg-green-50 border-l-4 border-green-500 p-3 rounded-r-lg">
                    {{ session('sukses') }}
                </div>
            @endif

            @if($errors->any())
                <div class="bg-rose-50 border-l-4 border-rose-500 p-3 text-rose-700 text-sm mb-4 rounded-r-lg">
                    {{ $errors->first() }}
                </div>
            @endif

            <!-- FORM LOGIN -->
            <form action="{{ route('mahasiswa.login') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-semibold text-gray-600 uppercase mb-1">NIM Mahasiswa</label>
                    <input type="text" name="nim" value="{{ old('nim') }}" required placeholder="Contoh: 0099282083" class="w-full border border-gray-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-transparent outline-none transition">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-600 uppercase mb-1">Password</label>
                    <input type="password" name="password" required placeholder="••••••••" class="w-full border border-gray-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-transparent outline-none transition">
                </div>

                <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 rounded-xl shadow-lg shadow-indigo-200 text-sm transition duration-200 mt-2">
                    Masuk ke Sistem
                </button>
            </form>

        </div>
    </div>

</body>
</html>