<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <h1 class="text-3xl font-bold mt-4 leading-snug">
    Sistem Pengelolaan Tugas & Kuliah
</h1>

<img 
    src="{{ asset('images/logo-ippi.png') }}" 
    alt="Logo IPPI"
    class="w-28 h-28 object-contain mt-5"
>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    <style>
        * {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        body {
            margin: 0;
        }

        .glass {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(15px);
        }

        .logo-ippi {
            transition: all 0.3s ease;
        }

        .logo-ippi:hover {
            transform: scale(1.05);
        }

        .input-focus:focus {
            border-color: #4f46e5;
            box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.10);
        }

        .login-button {
            transition: all 0.3s ease;
        }

        .login-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(79, 70, 229, 0.30);
        }
    </style>
</head>

<body class="min-h-screen bg-slate-950">

    <!-- Background -->
    <div class="min-h-screen bg-gradient-to-br from-slate-950 via-indigo-950 to-blue-950
                flex items-center justify-center px-4 py-8">

        <!-- Container -->
        <div class="w-full max-w-6xl">

            <div class="glass overflow-hidden rounded-3xl shadow-2xl
                        border border-white/20
                        grid grid-cols-1 lg:grid-cols-2">

                <!-- ================================================= -->
                <!-- BAGIAN KIRI -->
                <!-- ================================================= -->
                <div class="relative overflow-hidden
                            bg-gradient-to-br from-indigo-700 via-indigo-600 to-blue-600
                            px-8 py-10 lg:px-12 lg:py-12
                            text-white">

                    <!-- Decorative Circle -->
                    <div class="absolute -top-24 -right-24
                                w-72 h-72 rounded-full
                                bg-white/10"></div>

                    <div class="absolute -bottom-32 -left-24
                                w-80 h-80 rounded-full
                                bg-blue-400/10"></div>

                    <div class="relative z-10 h-full flex flex-col justify-between">

                        <!-- Logo & Title -->
                        <div>

                            <!-- Badge -->
                            <div class="inline-flex items-center gap-2
                                        px-4 py-2 mb-6
                                        rounded-full
                                        bg-white/15
                                        border border-white/20
                                        text-xs font-bold
                                        tracking-wider uppercase">

                                <span class="w-2 h-2 rounded-full bg-green-300"></span>

                                Portal Mahasiswa
                            </div>

                            <!-- Title -->
                            <h1 class="text-3xl lg:text-4xl
                                       font-extrabold
                                       leading-tight
                                       tracking-tight">

                                Sistem Pengelolaan
                                <br>
                                Tugas & Kuliah
                            </h1>

                            <!-- Logo IPPI -->
                            <div class="mt-7 flex items-center">

                                <div class="bg-white rounded-2xl
                                            p-4 shadow-xl
                                            logo-ippi">

                                    <img
                                        src="{{ asset('images/logo-ippi.png') }}"
                                        alt="Logo IPPI"
                                        class="w-32 h-32 lg:w-36 lg:h-36
                                               object-contain"
                                    >

                                </div>

                            </div>

                            <!-- Description -->
                            <p class="mt-7 max-w-md
                                      text-sm lg:text-base
                                      leading-relaxed
                                      text-indigo-100">

                                Kelola tugas kuliah, kumpulkan berkas,
                                dan pantau nilai dengan mudah dalam satu
                                platform terintegrasi.

                            </p>

                        </div>

                        <!-- Footer -->
                        <div class="mt-10">

                            <div class="flex items-center gap-3 text-sm text-indigo-100">

                                <div class="w-10 h-10 rounded-xl
                                            bg-white/10
                                            flex items-center justify-center">

                                    🎓

                                </div>

                                <div>
                                    <p class="font-semibold text-white">
                                        Portal Akademik
                                    </p>

                                    <p class="text-xs text-indigo-200">
                                        Institut Pengembangan Pendidikan Indonesia
                                    </p>
                                </div>

                            </div>

                        </div>

                    </div>
                </div>


                <!-- ================================================= -->
                <!-- BAGIAN KANAN -->
                <!-- ================================================= -->
                <div class="bg-white px-7 py-8 lg:px-10 lg:py-10">

                    <!-- Header -->
                    <div class="mb-7">

                        <h2 class="text-2xl font-extrabold text-gray-900">
                            Selamat Datang 👋
                        </h2>

                        <p class="mt-2 text-sm text-gray-500">
                            Silakan masuk menggunakan akun mahasiswa Anda.
                        </p>

                    </div>


                    <!-- ================================================= -->
                    <!-- TAB -->
                    <!-- ================================================= -->
                    <div class="grid grid-cols-2 mb-7
                                border-b border-gray-200">

                        <button
                            type="button"
                            id="tabLogin"
                            class="tab-button
                                   py-3
                                   text-sm font-semibold
                                   text-indigo-600
                                   border-b-2 border-indigo-600">

                            Masuk

                        </button>

                        <button
                            type="button"
                            id="tabRegister"
                            class="tab-button
                                   py-3
                                   text-sm font-semibold
                                   text-gray-400
                                   border-b-2 border-transparent">

                            Daftar Akun

                        </button>

                    </div>


                    <!-- ================================================= -->
                    <!-- LOGIN -->
                    <!-- ================================================= -->
                    <div id="loginForm">

                        <!-- Success -->
                        @if(session('sukses'))

                            <div class="mb-5
                                        bg-emerald-50
                                        border border-emerald-200
                                        text-emerald-700
                                        px-4 py-3
                                        rounded-xl
                                        text-sm">

                                <div class="flex items-center gap-2">

                                    <span>✓</span>

                                    <span>
                                        {{ session('sukses') }}
                                    </span>

                                </div>

                            </div>

                        @endif


                        <!-- Error -->
                        @if($errors->any())

                            <div class="mb-5
                                        bg-rose-50
                                        border border-rose-200
                                        text-rose-700
                                        px-4 py-3
                                        rounded-xl
                                        text-sm">

                                <div class="flex items-start gap-2">

                                    <span class="mt-0.5">⚠</span>

                                    <div>
                                        @foreach($errors->all() as $error)

                                            <p>{{ $error }}</p>

                                        @endforeach
                                    </div>

                                </div>

                            </div>

                        @endif


                        <!--
                            PENTING:
                            Jika form action pada kode lama berbeda,
                            pertahankan action kode lama.
                        -->
                        <form
                            method="POST"
                            action="{{ url('/login/mahasiswa') }}"
                            class="space-y-5">

                            @csrf


                            <!-- Nama -->
                            <div>

                                <label
                                    for="nama"
                                    class="block mb-2
                                           text-sm font-semibold
                                           text-gray-700">

                                    Nama Mahasiswa

                                </label>

                                <input
                                    type="text"
                                    name="nama"
                                    id="nama"
                                    value="{{ old('nama') }}"
                                    placeholder="Masukkan nama Anda"
                                    required
                                    autocomplete="name"
                                    class="input-focus
                                           w-full
                                           px-4 py-3
                                           rounded-xl
                                           border border-gray-200
                                           bg-gray-50
                                           text-gray-800
                                           text-sm
                                           outline-none
                                           transition">

                            </div>


                            <!-- Jurusan -->
                            <div>

                                <label
                                    for="jurusan"
                                    class="block mb-2
                                           text-sm font-semibold
                                           text-gray-700">

                                    Pilih Jurusan

                                </label>

                                <select
                                    name="jurusan"
                                    id="jurusan"
                                    required
                                    class="input-focus
                                           w-full
                                           px-4 py-3
                                           rounded-xl
                                           border border-gray-200
                                           bg-gray-50
                                           text-gray-800
                                           text-sm
                                           outline-none
                                           transition">

                                    <option value="">
                                        -- Pilih Jurusan Anda --
                                    </option>

                                    <option
                                        value="RPL"
                                        {{ old('jurusan') == 'RPL' ? 'selected' : '' }}>

                                        RPL

                                    </option>

                                    <option
                                        value="TKJ"
                                        {{ old('jurusan') == 'TKJ' ? 'selected' : '' }}>

                                        TKJ

                                    </option>

                                    <option
                                        value="MULTIMEDIA"
                                        {{ old('jurusan') == 'MULTIMEDIA' ? 'selected' : '' }}>

                                        MULTIMEDIA

                                    </option>

                                </select>

                            </div>


                            <!-- Password -->
                            <div>

                                <label
                                    for="password"
                                    class="block mb-2
                                           text-sm font-semibold
                                           text-gray-700">

                                    Password

                                </label>

                                <div class="relative">

                                    <input
                                        type="password"
                                        name="password"
                                        id="password"
                                        placeholder="Masukkan password"
                                        required
                                        autocomplete="current-password"
                                        class="input-focus
                                               w-full
                                               px-4 py-3 pr-12
                                               rounded-xl
                                               border border-gray-200
                                               bg-gray-50
                                               text-gray-800
                                               text-sm
                                               outline-none
                                               transition">

                                    <button
                                        type="button"
                                        id="togglePassword"
                                        class="absolute right-3 top-1/2
                                               -translate-y-1/2
                                               text-gray-400
                                               hover:text-indigo-600
                                               transition">

                                        <svg
                                            id="eyeOpen"
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="w-5 h-5"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor">

                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />

                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />

                                        </svg>

                                    </button>

                                </div>

                            </div>


                            <!-- Submit -->
                            <button
                                type="submit"
                                class="login-button
                                       w-full
                                       py-3.5
                                       rounded-xl
                                       bg-gradient-to-r
                                       from-indigo-600
                                       to-blue-600
                                       hover:from-indigo-700
                                       hover:to-blue-700
                                       text-white
                                       font-bold
                                       text-sm
                                       shadow-lg
                                       shadow-indigo-500/20">

                                <span class="flex items-center justify-center gap-2">

                                    Masuk ke Sistem

                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="w-4 h-4"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor">

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M13 7l5 5m0 0l-5 5m5-5H6" />

                                    </svg>

                                </span>

                            </button>

                        </form>

                    </div>


                    <!-- ================================================= -->
                    <!-- REGISTER -->
                    <!-- ================================================= -->
                    <div
                        id="registerForm"
                        class="hidden">

                        <div class="rounded-2xl
                                    bg-indigo-50
                                    border border-indigo-100
                                    p-6
                                    text-center">

                            <div class="mx-auto mb-4
                                        w-14 h-14
                                        rounded-2xl
                                        bg-indigo-100
                                        flex items-center justify-center">

                                🎓

                            </div>

                            <h3 class="font-bold text-gray-800 text-lg">
                                Daftar Akun Mahasiswa
                            </h3>

                            <p class="mt-2 text-sm text-gray-500">
                                Silakan melakukan pendaftaran akun
                                untuk menggunakan sistem akademik.
                            </p>

                            <a
                                href="{{ url('/register') }}"
                                class="inline-flex
                                       items-center
                                       justify-center
                                       gap-2
                                       mt-5
                                       px-6 py-3
                                       rounded-xl
                                       bg-indigo-600
                                       hover:bg-indigo-700
                                       text-white
                                       text-sm
                                       font-bold
                                       transition">

                                Daftar Akun

                                <span>→</span>

                            </a>

                        </div>

                    </div>


                    <!-- Footer -->
                    <div class="mt-8 pt-5
                                border-t border-gray-100
                                text-center">

                        <p class="text-xs text-gray-400">

                            © {{ date('Y') }}
                            Portal Akademik.
                            Semua hak dilindungi.

                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <!-- ================================================= -->
    <!-- JAVASCRIPT -->
    <!-- ================================================= -->
    <script>

        document.addEventListener('DOMContentLoaded', function () {

            /*
            |--------------------------------------------------------------------------
            | TAB LOGIN & REGISTER
            |--------------------------------------------------------------------------
            */

            const tabLogin = document.getElementById('tabLogin');
            const tabRegister = document.getElementById('tabRegister');

            const loginForm = document.getElementById('loginForm');
            const registerForm = document.getElementById('registerForm');


            tabLogin.addEventListener('click', function () {

                loginForm.classList.remove('hidden');
                registerForm.classList.add('hidden');

                tabLogin.classList.add(
                    'text-indigo-600',
                    'border-indigo-600'
                );

                tabLogin.classList.remove(
                    'text-gray-400',
                    'border-transparent'
                );

                tabRegister.classList.remove(
                    'text-indigo-600',
                    'border-indigo-600'
                );

                tabRegister.classList.add(
                    'text-gray-400',
                    'border-transparent'
                );

            });


            tabRegister.addEventListener('click', function () {

                loginForm.classList.add('hidden');
                registerForm.classList.remove('hidden');

                tabRegister.classList.add(
                    'text-indigo-600',
                    'border-indigo-600'
                );

                tabRegister.classList.remove(
                    'text-gray-400',
                    'border-transparent'
                );

                tabLogin.classList.remove(
                    'text-indigo-600',
                    'border-indigo-600'
                );

                tabLogin.classList.add(
                    'text-gray-400',
                    'border-transparent'
                );

            });


            /*
            |--------------------------------------------------------------------------
            | SHOW / HIDE PASSWORD
            |--------------------------------------------------------------------------
            */

            const togglePassword =
                document.getElementById('togglePassword');

            const password =
                document.getElementById('password');


            togglePassword.addEventListener('click', function () {

                if (password.type === 'password') {

                    password.type = 'text';

                    togglePassword.innerHTML = `
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="w-5 h-5"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M13.875 18.825A10.05 10.05 0 0112 19
                                c-4.478 0-8.268-2.943-9.542-7
                                a9.97 9.97 0 013.362-4.592
                                M6.228 6.228A9.956 9.956 0 0112 5
                                c4.478 0 8.268 2.943 9.542 7
                                a9.973 9.973 0 01-4.132 5.411
                                M6.228 6.228L3 3m3.228 3.228
                                l11.544 11.544M9.88 9.88
                                A3 3 0 0014.12 14.12" />

                        </svg>
                    `;

                } else {

                    password.type = 'password';

                    togglePassword.innerHTML = `
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="w-5 h-5"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M2.458 12C3.732 7.943
                                7.523 5 12 5c4.478 0
                                8.268 2.943 9.542 7
                                -1.274 4.057-5.064 7
                                -9.542 7-4.477 0
                                -8.268-2.943-9.542-7z" />

                        </svg>
                    `;

                }

            });

        });

    </script>

</body>

</html>