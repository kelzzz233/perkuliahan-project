<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Portal Akademik E-Learning</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Plus Jakarta Sans -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- CSS kustom untuk animasi tambahan -->
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        /* Animasi Blob Bergerak di Background */
        @keyframes blob {
            0% { transform: translate(0px, 0px) scale(1); }
            33% { transform: translate(30px, -50px) scale(1.1); }
            66% { transform: translate(-20px, 20px) scale(0.9); }
            100% { transform: translate(0px, 0px) scale(1); }
        }
        .animate-blob {
            animation: blob 7s infinite ease-in-out;
        }
        .animation-delay-2000 {
            animation-delay: 2s;
        }

        /* Animasi Card Entrance */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .animate-fade-in-up {
            animation: fadeInUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center p-4 relative overflow-hidden bg-cover bg-center bg-no-repeat bg-fixed"
      style="background-image: url('https://www.ypippijkt.sch.id/public/uploads/T74LwVWAQqflxR0mhxfHJEKD6XCeG5.jpg');">

    <!-- Ambient Glowing Background Bubbles -->
    <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-indigo-600/30 rounded-full filter blur-3xl animate-blob pointer-events-none"></div>
    <div class="absolute bottom-1/4 right-1/4 w-96 h-96 bg-blue-600/30 rounded-full filter blur-3xl animate-blob animation-delay-2000 pointer-events-none"></div>

    <!-- Main Card Container -->
    <div class="max-w-4xl w-full bg-white/90 backdrop-blur-xl rounded-3xl shadow-2xl overflow-hidden grid grid-cols-1 md:grid-cols-2 border border-white/20 relative z-10 animate-fade-in-up">

        <!-- ================= BAGIAN KIRI ================= -->
        <div class="p-8 md:p-10 hidden md:flex flex-col justify-between bg-gradient-to-br from-indigo-50/90 via-blue-50/60 to-slate-50/90 border-r border-indigo-100/50 relative overflow-hidden">

            <!-- Header: Badge -->
            <div class="flex items-center justify-between">
                <span class="inline-flex items-center gap-1.5 bg-indigo-600/10 text-indigo-700 text-xs font-bold px-3 py-1.5 rounded-full uppercase tracking-wider border border-indigo-200/50">
                    <span class="w-2 h-2 rounded-full bg-indigo-600 animate-pulse"></span>
                    Portal Akademik
                </span>
            </div>

            <!-- Middle: Logo Besar + Title -->
            <div class="my-auto py-6 flex flex-col items-center text-center">
                <div class="relative group">
                    <div class="absolute -inset-1 bg-gradient-to-r from-indigo-500 to-blue-500 rounded-full blur opacity-25 group-hover:opacity-50 transition duration-300"></div>
                    <img
                        src="{{ asset('images/logo-ippi.png') }}"
                        alt="Logo IPPI"
                        class="relative w-44 h-44 object-contain mb-6 transform group-hover:scale-105 transition duration-300 drop-shadow-lg"
                    >
                </div>

                <h1 class="text-2xl font-extrabold text-slate-900 leading-snug tracking-tight">
                    Sistem Pengelolaan Tugas <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-blue-600">&amp; Kuliah</span>
                </h1>
            </div>

            <!-- Footer Description -->
            <p class="text-xs text-slate-500 text-center max-w-xs mx-auto leading-relaxed">
                Kelola tugas kuliah, kumpulkan berkas, dan pantau nilai dengan mudah dalam satu platform.
            </p>
        </div>


        <!-- ================= BAGIAN KANAN ================= -->
        <div class="p-8 md:p-12 bg-white/95 flex flex-col justify-center">

            <div class="mb-8">
                <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight flex items-center gap-2">
                    Selamat Datang <span class="inline-block animate-bounce">👋</span>
                </h2>
                <p class="text-sm text-slate-500 mt-2">
                    Silakan masuk menggunakan akun kampus Anda
                </p>
            </div>

            <!-- Notifikasi Sukses -->
            @if(session('sukses'))
                <div class="mb-5 bg-emerald-50 border border-emerald-200 text-emerald-700 p-3.5 text-xs rounded-xl flex items-center gap-2">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    <span>{{ session('sukses') }}</span>
                </div>
            @endif

            <!-- Notifikasi Error -->
            @if($errors->any())
                <div class="mb-5 bg-rose-50 border border-rose-200 text-rose-700 p-3.5 text-xs rounded-xl flex items-center gap-2">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0 1 18 0z"></path></svg>
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST" class="space-y-5">
                @csrf

                <!-- Input Nama -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                        Nama / Username
                    </label>
                    <input
                        type="text"
                        name="nama"
                        value="{{ old('nama') }}"
                        required
                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-900 placeholder-slate-400 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:bg-white focus:outline-none transition-all duration-200"
                        placeholder="Masukkan nama akun Anda"
                    >
                </div>

                <!-- Input Password -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                        Password
                    </label>
                    <input
                        type="password"
                        name="password"
                        required
                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-900 placeholder-slate-400 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:bg-white focus:outline-none transition-all duration-200"
                        placeholder="••••••••"
                    >
                </div>

                <!-- Tombol Submit -->
                <button
                    type="submit"
                    class="w-full bg-gradient-to-r from-indigo-600 to-blue-600 hover:from-indigo-700 hover:to-blue-700 text-white font-bold py-3 px-4 rounded-xl shadow-lg shadow-indigo-500/25 hover:shadow-indigo-500/40 active:scale-[0.98] transition-all duration-200 mt-3"
                >
                    Masuk ke Sistem
                </button>
            </form>

            <p class="text-center text-xs text-slate-500 mt-8">
                Belum punya akun?
                <a href="{{ route('register') }}" class="text-indigo-600 hover:text-indigo-700 font-bold transition">
                    Daftar di sini
                </a>
            </p>

        </div>

    </div>

</body>
</html>
