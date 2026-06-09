<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Jurusan</title>
</head>
<body>
    <h2>Data Jurusan</h2>
    <table border="1" width="100%" cellpadding="10" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Nama Jurusan</th>
            <th>Akreditasi</th>
        </tr>
        @foreach($jurusan as $item)
        <tr>
            <td>{{ $item->id_jurusan }}</td>
            <td>{{ $item->nama_jurusan }}</td>
            <td>{{ $item->akreditasi }}</td>
        </tr>
        @endforeach
    </table>
</body>
</html>
