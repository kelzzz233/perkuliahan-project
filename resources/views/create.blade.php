<form action="{{ route('tugas.store') }}" method="POST">
    @csrf
    <label>Judul Tugas:</label>
    <input type="text" name="judul" required>

    <label>Tujuan Jurusan:</label>
    <select name="jurusan_tujuan" required>
        <option value="RPL">RPL</option>
        <option value="TKJ">TKJ</option>
        <option value="Multimedia">Multimedia</option>
    </select>

    <button type="submit">Kirim Tugas</button>
</form>
