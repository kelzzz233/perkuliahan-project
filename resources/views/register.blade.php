<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi - Portal Akademik Terpadu</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Plus Jakarta Sans -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        /* Animasi Card Entrance */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px) scale(0.96);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        /* Animasi Pulsing Neon Border */
        @keyframes cyberGlow {
            0%, 100% { box-shadow: 0 0 20px rgba(6, 182, 212, 0.3), inset 0 0 15px rgba(6, 182, 212, 0.1); }
            50% { box-shadow: 0 0 35px rgba(59, 130, 246, 0.6), inset 0 0 20px rgba(59, 130, 246, 0.2); }
        }

        .animate-card {
            animation: fadeInUp 0.7s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        .cyber-border {
            animation: cyberGlow 5s infinite ease-in-out;
        }

        /* Radio button hidden custom style */
        .role-radio:checked + label {
            border-color: #38bdf8;
            background-color: rgba(14, 165, 233, 0.15);
            box-shadow: 0 0 15px rgba(56, 189, 248, 0.3);
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center p-4 relative overflow-hidden bg-[#070b14] text-slate-100">

    <!-- Canvas Partikel Interaktif di Background -->
    <canvas id="particleCanvas" class="absolute inset-0 pointer-events-none z-0"></canvas>

    <!-- Glowing Background Orbs -->
    <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-cyan-600/20 rounded-full filter blur-[120px] pointer-events-none z-0"></div>
    <div class="absolute bottom-1/4 right-1/4 w-96 h-96 bg-blue-600/20 rounded-full filter blur-[120px] pointer-events-none z-0"></div>

    <!-- Main Form Card Container -->
    <div class="max-w-md w-full bg-slate-900/80 backdrop-blur-2xl rounded-3xl p-8 border border-cyan-500/30 cyber-border relative z-10 animate-card shadow-2xl my-6">

        <!-- Title Header -->
        <div class="text-center mb-6">
            <span class="inline-flex items-center gap-1.5 bg-cyan-500/10 text-cyan-400 text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-widest border border-cyan-500/20 mb-3">
                <span class="w-1.5 h-1.5 rounded-full bg-cyan-400 animate-ping"></span>
                Sistem Terpadu
            </span>
            <h1 class="text-2xl font-extrabold tracking-tight text-white">
                Buat Akun Portal
            </h1>
            <p class="text-xs text-slate-400 mt-1">
                Pilih peran dan lengkapi data registrasi Anda
            </p>
        </div>

        <!-- Notifikasi Sukses -->
        @if(session('sukses'))
            <div class="mb-4 bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 p-3 text-xs rounded-xl flex items-center gap-2">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                <span>{{ session('sukses') }}</span>
            </div>
        @endif

        <!-- Notifikasi Error -->
        @if($errors->any())
            <div class="mb-4 bg-rose-500/10 border border-rose-500/30 text-rose-400 p-3 text-xs rounded-xl flex items-center gap-2">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0 1 18 0z"></path></svg>
                <span>{{ $errors->first() }}</span>
            </div>
        @endif

        <form action="{{ route('register') }}" method="POST" class="space-y-4">
            @csrf

            <!-- Pilihan Peran Visual (Dosen & Admin Saja) -->
            <div>
                <label class="block text-xs font-semibold text-slate-300 mb-2">
                    Pilih Peran Pengguna
                </label>
                <div class="grid grid-cols-2 gap-3">
                    <!-- Dosen -->
                    <div>
                        <input type="radio" id="role_dosen" name="peran" value="dosen" class="hidden role-radio" required checked>
                        <label for="role_dosen" class="flex flex-col items-center justify-center p-3 bg-slate-800/60 border border-slate-700/60 rounded-xl cursor-pointer hover:border-cyan-500/50 transition-all group">
                            <svg class="w-6 h-6 text-slate-400 group-hover:text-cyan-400 mb-1 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6m-6 4h4"/></svg>
                            <span class="text-[11px] font-medium text-slate-300">Dosen</span>
                        </label>
                    </div>

                    <!-- Admin -->
                    <div>
                        <input type="radio" id="role_admin" name="peran" value="admin" class="hidden role-radio" required>
                        <label for="role_admin" class="flex flex-col items-center justify-center p-3 bg-slate-800/60 border border-slate-700/60 rounded-xl cursor-pointer hover:border-cyan-500/50 transition-all group">
                            <svg class="w-6 h-6 text-slate-400 group-hover:text-cyan-400 mb-1 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                            <span class="text-[11px] font-medium text-slate-300">Admin</span>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Input Nama Lengkap -->
            <div>
                <label class="block text-xs font-semibold text-slate-300 mb-1">
                    Nama Lengkap
                </label>
                <input
                    type="text"
                    name="nama"
                    value="{{ old('nama') }}"
                    required
                    class="w-full px-4 py-2.5 bg-slate-800/80 border border-slate-700 rounded-xl text-sm text-white placeholder-slate-500 focus:outline-none focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400 transition-all"
                    placeholder="Masukkan nama lengkap"
                >
            </div>

            <!-- Input Email -->
            <div>
                <label class="block text-xs font-semibold text-slate-300 mb-1">
                    Email
                </label>
                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    class="w-full px-4 py-2.5 bg-slate-800/80 border border-slate-700 rounded-xl text-sm text-white placeholder-slate-500 focus:outline-none focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400 transition-all"
                    placeholder="nama@email.com"
                >
            </div>

            <!-- Input Kata Sandi -->
            <div>
                <label class="block text-xs font-semibold text-slate-300 mb-1">
                    Kata Sandi
                </label>
                <input
                    type="password"
                    name="kata_sandi"
                    required
                    class="w-full px-4 py-2.5 bg-slate-800/80 border border-slate-700 rounded-xl text-sm text-white placeholder-slate-500 focus:outline-none focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400 transition-all"
                    placeholder="••••••••"
                >
            </div>

            <!-- Tombol Submit -->
            <div class="pt-2">
                <button
                    type="submit"
                    class="w-full relative group overflow-hidden bg-gradient-to-r from-blue-600 via-cyan-500 to-teal-400 hover:from-blue-500 hover:to-cyan-400 text-white font-bold py-3 px-4 rounded-xl shadow-lg shadow-cyan-500/20 active:scale-[0.98] transition-all duration-300"
                >
                    <span class="relative z-10 flex items-center justify-center gap-2 text-sm">
                        Daftar Sekarang
                    </span>
                    <div class="absolute inset-0 bg-white/20 translate-x-[-100%] group-hover:translate-x-[100%] transition-transform duration-700 ease-in-out"></div>
                </button>
            </div>
        </form>

        <!-- Footer Link -->
        <p class="text-center text-xs text-slate-400 mt-5">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="text-cyan-400 hover:text-cyan-300 font-bold transition-colors underline decoration-cyan-400/40 underline-offset-4">
                Login di sini
            </a>
        </p>

    </div>

    <!-- Script Canvas Animation Partikel Background -->
    <script>
        const canvas = document.getElementById('particleCanvas');
        const ctx = canvas.getContext('2d');

        function resizeCanvas() {
            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;
        }
        resizeCanvas();
        window.addEventListener('resize', resizeCanvas);

        const particles = [];
        const particleCount = 45;

        for (let i = 0; i < particleCount; i++) {
            particles.push({
                x: Math.random() * canvas.width,
                y: Math.random() * canvas.height,
                radius: Math.random() * 2 + 1,
                vx: (Math.random() - 0.5) * 0.8,
                vy: (Math.random() - 0.5) * 0.8,
            });
        }

        function drawParticles() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);

            particles.forEach((p, index) => {
                p.x += p.vx;
                p.y += p.vy;

                if (p.x < 0 || p.x > canvas.width) p.vx *= -1;
                if (p.y < 0 || p.y > canvas.height) p.vy *= -1;

                ctx.beginPath();
                ctx.arc(p.x, p.y, p.radius, 0, Math.PI * 2);
                ctx.fillStyle = 'rgba(56, 189, 248, 0.5)';
                ctx.fill();

                for (let j = index + 1; j < particles.length; j++) {
                    const p2 = particles[j];
                    const dist = Math.hypot(p.x - p2.x, p.y - p2.y);
                    if (dist < 120) {
                        ctx.beginPath();
                        ctx.moveTo(p.x, p.y);
                        ctx.lineTo(p2.x, p2.y);
                        ctx.strokeStyle = `rgba(56, 189, 248, ${0.2 * (1 - dist / 120)})`;
                        ctx.lineWidth = 0.6;
                        ctx.stroke();
                    }
                }
            });

            requestAnimationFrame(drawParticles);
        }

        drawParticles();
    </script>
</body>
</html>
