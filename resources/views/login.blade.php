<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Portal Akademik E-Learning</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-gradient-to-br from-slate-900 via-indigo-950 to-blue-900 min-h-screen flex items-center justify-center p-4">

    <div class="max-w-4xl w-full bg-white/10 backdrop-blur-md rounded-2xl shadow-2xl overflow-hidden grid grid-cols-1 md:grid-cols-2 border border-white/10">

        <!-- Bagian Kiri: Ilustrasi / Tema Kampus -->
        <div class="p-8 hidden md:flex flex-col justify-between bg-gradient-to-tr from-indigo-600 to-blue-500 text-white relative overflow-hidden">
            <div class="absolute -right-10 -bottom-10 w-48 h-48 bg-white/10 rounded-full blur-2xl"></div>
            <div>
                <span class="bg-white/20 text-xs font-semibold px-3 py-1 rounded-full uppercase tracking-wider">Portal Akademik</span>
                <h1 class="text-3xl font-bold mt-4 leading-snug">Sistem Pengelolaan Tugas & Kuliah</h1>
            </div>
            <p class="text-sm text-indigo-100 opacity-90">Kelola tugas kuliah, kumpulkan berkas, dan pantau nilai dengan mudah dalam satu platform terintegrasi.</p>
        </div>

        <!-- Bagian Kanan: Form Login -->
        <div class="p-8 md:p-12 bg-white flex flex-col justify-center">
            <div class="mb-6">
                <h2 class="text-2xl font-bold text-gray-900">Selamat Datang 👋</h2>
                <p class="text-sm text-gray-500 mt-1">Silakan masuk menggunakan akun kampus Anda</p>
            </div>

            <!-- Notifikasi Sukses -->
            @if(session('sukses'))
                <div class="mb-4 bg-emerald-50 border-l-4 border-emerald-500 p-3 text-emerald-700 text-xs rounded">
                    {{ session('sukses') }}
                </div>
            @endif

            <!-- Notifikasi Error -->
            @if($errors->any())
                <div class="mb-4 bg-rose-50 border-l-4 border-rose-500 p-3 text-rose-700 text-xs rounded">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-1">Email Kampus</label>
                    <input type="email" name="email" required class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:ring-2 focus:ring-indigo-500 focus:bg-white focus:outline-none transition" placeholder="mahasiswa@kampus.ac.id">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-1">Password</label>
                    <!-- Perhatikan name="password" agar sinkron dengan Controller -->
                    <input type="password" name="password" required class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:ring-2 focus:ring-indigo-500 focus:bg-white focus:outline-none transition" placeholder="••••••••">
                </div>

                <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2.5 rounded-lg shadow-lg shadow-indigo-500/30 transition duration-200 mt-2">
                    Masuk ke Sistem
                </button>
            </form>

            <p class="text-center text-xs text-gray-500 mt-6">
                Belum punya akun? <a href="{{ route('register') }}" class="text-indigo-600 hover:underline font-semibold">Daftar di sini</a>
            </p>
        </div>

    </div>

</body>
</html>
