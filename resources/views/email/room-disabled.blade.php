<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ruangan {{ $room->name }} Telah Dinonaktifkan</title>
</head>

<body>
    <h1>Ruangan {{ $room->name }} Telah Dinonaktifkan</h1>
    <br>
    <div>
        <h3>Alasan Pe-nonaktifan :</h3>
        <p>{{ $msg }}</p>
        <hr>
        <p>Ruangan {{ $room->name }} telah dinonaktifkan dan sedang tidak bisa digunakan saat ini, silahkan gunakan
            ruangan lain untuk melaksanakan kegiatan rapat.</p>
    </div>
</body>

</html>
