<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi - Portal Akademik</title>
    <style>
        :root {
            --navy-primary: #1e3a8a;
            --navy-dark: #0f172a;
            --gold-accent: #d97706;
            --bg-canvas: #f1f5f9;
            --text-main: #334155;
            --border-color: #cbd5e1;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #0f172a, #1e3a8a);
            color: var(--text-main);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .register-card {
            background: #ffffff;
            width: 100%;
            max-width: 420px;
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 15px 35px rgba(15, 23, 42, 0.2);
        }

        .register-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .register-header h2 {
            margin: 0 0 8px;
            color: var(--navy-dark);
            font-size: 24px;
        }

        .register-header p {
            margin: 0;
            color: #64748b;
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            font-size: 13px;
            color: var(--navy-dark);
        }

        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.2s;
            outline: none;
            background: #f8fafc;
        }

        .form-control:focus {
            border-color: var(--navy-primary);
            background: #ffffff;
            box-shadow: 0 0 0 3px rgba(30, 58, 138, 0.15);
        }

        .btn-submit {
            width: 100%;
            background: var(--navy-primary);
            color: #ffffff;
            border: none;
            padding: 12px;
            border-radius: 8px;
            font-size: 15px;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.2s, transform 0.1s;
            margin-top: 10px;
        }

        .btn-submit:hover {
            background: #172554;
            transform: translateY(-1px);
        }

        .login-link-text {
            text-align: center;
            margin-top: 25px;
            font-size: 14px;
            color: #64748b;
        }

        .login-link-text a {
            color: var(--navy-primary);
            text-decoration: none;
            font-weight: bold;
        }

        .login-link-text a:hover {
            text-decoration: underline;
        }

        .alert-error {
            background: #fee2e2;
            color: #991b1b;
            padding: 10px 12px;
            border-radius: 6px;
            font-size: 13px;
            margin-bottom: 20px;
            border: 1px solid #fecaca;
        }
    </style>
</head>
<body>

    <div class="register-card">
        <div class="register-header">
            <h2>Form Registrasi</h2>
            <p>Portal Akademik Terpadu</p>
        </div>

        @if ($errors->any())
            <div class="alert-error">
                <ul style="margin: 0; padding-left: 15px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('register') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="nama">Nama Lengkap</label>
                <input type="text" id="nama" name="nama" class="form-control" placeholder="Masukkan nama lengkap" value="{{ old('nama') }}" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="nama@email.com" value="{{ old('email') }}" required>
            </div>

            <div class="form-group">
                <label for="kata_sandi">Kata Sandi</label>
                <input type="password" id="kata_sandi" name="kata_sandi" class="form-control" placeholder="Min. 6 karakter" required>
            </div>

            <div class="form-group">
                <label for="peran">Pilih Peran</label>
                <select id="peran" name="peran" class="form-control" required>
                    <option value="" disabled selected>-- Pilih Peran --</option>
                    <option value="mahasiswa">Mahasiswa</option>
                    <option value="dosen">Dosen</option>
                    <option value="admin">Admin</option>
                </select>
            </div>

            <button type="submit" class="btn-submit">Daftar Sekarang</button>
        </form>

        <div class="login-link-text">
            Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a>
        </div>
    </div>

</body>
</html>