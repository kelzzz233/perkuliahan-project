<!DOCTYPE html>
<html>
<head><title>Register</title></head>
<body>
    <h2>Form Registrasi</h2>
    <form action="{{ route('register') }}" method="POST">
        @csrf
        <input type="text" name="nama" placeholder="Nama Lengkap" required><br><br>
        <input type="email" name="email" placeholder="Email" required><br><br>
        <input type="password" name="kata_sandi" placeholder="Password" required><br><br>
        <select name="peran" required>
            <option value="mahasiswa">Mahasiswa</option>
            <option value="dosen">Dosen</option>
            <option value="admin">Admin</option>
        </select><br><br>
        <button type="submit">Daftar</button>
    </form>
    <p>Sudah punya akun? <a href="{{ route('login') }}">Login</a></p>
</body>
</html>
