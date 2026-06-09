<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Mata Kuliah</title>
</head>
<body>
    <h2>Data Mata Kuliah</h2>
    <table border="1" width="100%" cellpadding="10" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Nama Matakuliah</th>
            <th>SKS</th>
            <th>Jurusan</th>
        </tr>
        @foreach($matakuliah as $item)
        <tr>
            <td>{{ $item->id_matakuliah }}</td>
            <td>{{ $item->nama_matakuliah }}</td>
            <td>{{ $item->sks }}</td>
            <td>{{ $item->jurusan->nama_jurusan ?? '-' }}</td>
        </tr>
        @endforeach
    </table>
</body>
</html>
