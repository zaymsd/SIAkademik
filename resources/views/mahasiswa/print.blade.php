<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data mahasiswa</title>
</head>
<body>
    <h2>Data Mahasiswa</h2>
    <table border="1" width="100%" cellpaddding="10" cellspacing="0">
        <tr>
            <th>No</th>
            <th>NIM</th>
            <th>Nama</th>
            <th>Jurusan</th>
        </tr>
        @foreach($mahasiswa as $item)
        <tr>
            <td>{{ $item->id_mahasiswa }}</td>
            <td>{{ $item->nim }}</td>
            <td>{{ $item->nama }}</td>
            <td>{{ $item->jurusan->nama_jurusan }}</td>
        </tr>
        @endforeach
    </table>
</body>
</html>