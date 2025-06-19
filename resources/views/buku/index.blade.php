<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Data Buku</h2>
    <hr>
    <a href="buku/create">Tambah Data</a>
    <table>
        <tr>
            <th>NO</th>
            <th>Judul</th>
            <th>Harga</th>
            <th>Kategori</th>
            <th>Aksi</th>
        </tr>

        @php $no = 1; @endphp
        @foreach ($buku as $data)
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $data['judul'] }}</td>
            <td>{{ $data['harga'] }}</td>
            <td>{{ $data['kategori'] }}</td>
            <td>
                
                <form action="/buku/{{ $data['id'] }}" method="post">
                <a href="/buku/{{ $data['id'] }}">Show</a>
                <a href="/buku/{{ $data['id'] }}/edit">Edit</a>
                    @csrf
                    @method('DELETE')
                <button type="submit" onclick="return confirm('Apakah Anda Yakin?')">
                    Delete
                <button>
                </form>
            </td>
        </tr>

        @endforeach
    </table>
</body>
</html>