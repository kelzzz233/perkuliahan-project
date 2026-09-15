<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Mahasiswa - Akademik</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Plus Jakarta Sans -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

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

        /* Animasi Float Ikon */
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        .animate-float {
            animation: float 4s ease-in-out infinite;
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center p-4 relative overflow-hidden bg-cover bg-center bg-no-repeat bg-fixed"
      style="background-image: url('https://www.ypippijkt.sch.id/public/uploads/kegiatan/futsal.jpeg');">

<body class="bg-slate-950 min-h-screen flex items-center justify-center p-4 relative overflow-hidden">

    <!-- Ambient Glowing Background Bubbles -->
    <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-indigo-600/30 rounded-full filter blur-3xl animate-blob pointer-events-none"></div>
    <div class="absolute bottom-1/4 right-1/4 w-96 h-96 bg-violet-600/30 rounded-full filter blur-3xl animate-blob animation-delay-2000 pointer-events-none"></div>

    <!-- Main Card Container -->
    <div class="max-w-4xl w-full bg-white/90 backdrop-blur-xl rounded-3xl shadow-2xl overflow-hidden grid grid-cols-1 md:grid-cols-2 border border-white/20 relative z-10 animate-fade-in-up">

        <!-- Bagian Kiri (Banner Info + Ikon Interaktif) -->
        <div class="p-8 md:p-10 hidden md:flex flex-col justify-between bg-gradient-to-br from-indigo-600 via-indigo-700 to-violet-800 text-white relative overflow-hidden">

            <!-- Header: Badge -->
            <div class="relative z-10 flex items-center justify-between">
                <span class="inline-flex items-center gap-1.5 bg-white/20 text-white text-xs font-bold px-3 py-1.5 rounded-full uppercase tracking-wider backdrop-blur-md">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    Portal Mahasiswa
                </span>
            </div>

            <!-- Middle: Ikon Tugas/Kuliah & Judul -->
            <div class="relative z-10 my-auto py-6 flex flex-col items-center text-center">
                <!-- Ikon pengganti logo -->
                <div class="relative group mb-6">
                    <div class="absolute -inset-3 bg-white/20 rounded-2xl blur-lg opacity-50 group-hover:opacity-80 transition duration-300"></div>
                    <div class="relative w-24 h-24 bg-white/10 border border-white/30 backdrop-blur-md rounded-2xl flex items-center justify-center shadow-2xl animate-float">
                        <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                </div>

                <h1 class="text-2xl font-extrabold text-white leading-snug tracking-tight">
                    Sistem Pengelolaan Tugas <br> &amp; Kuliah
                </h1>
            </div>

            <!-- Footer Description -->
            <p class="relative z-10 text-xs text-indigo-100 text-center max-w-xs mx-auto leading-relaxed">
                Kelola tugas kuliah, kumpulkan berkas, dan pantau nilai dengan mudah dalam satu platform terintegrasi.
            </p>
        </div>

        <!-- Bagian Kanan (Form Login) -->
        <div class="p-8 md:p-12 bg-white flex flex-col justify-center">

            <div class="mb-8">
                <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight flex items-center gap-2">
                    Masuk Akun <span class="inline-block animate-bounce">👋</span>
                </h2>
                <p class="text-sm text-slate-500 mt-2">Silakan masukkan NIM dan password Anda.</p>
            </div>

            @if(session('sukses'))
                <div class="mb-5 bg-emerald-50 border border-emerald-200 text-emerald-700 p-3.5 text-xs rounded-xl flex items-center gap-2">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    <span>{{ session('sukses') }}</span>
                </div>
            @endif

            @if($errors->any())
                <div class="mb-5 bg-rose-50 border border-rose-200 text-rose-700 p-3.5 text-xs rounded-xl flex items-center gap-2">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0 1 18 0z"></path></svg>
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif

            <!-- FORM LOGIN -->
            <form action="{{ route('mahasiswa.login') }}" method="POST" class="space-y-5">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">NIM Mahasiswa</label>
                    <input
                        type="text"
                        name="nim"
                        value="{{ old('nim') }}"
                        required
                        placeholder="Contoh: 0099282083"
                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-900 placeholder-slate-400 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:bg-white focus:outline-none transition-all duration-200"
                    >
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Password</label>
                    <input
                        type="password"
                        name="password"
                        required
                        placeholder="••••••••"
                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-900 placeholder-slate-400 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:bg-white focus:outline-none transition-all duration-200"
                    >
                </div>

                <button
                    type="submit"
                    class="w-full bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-700 hover:to-violet-700 text-white font-bold py-3 px-4 rounded-xl shadow-lg shadow-indigo-500/25 hover:shadow-indigo-500/40 active:scale-[0.98] transition-all duration-200 mt-3"
                >
                    Masuk ke Sistem
                </button>
            </form>

        </div>
    </div>

</body>
</html>
