<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Berhasil Melakukan Pengajuan Jadwal</title>
</head>

<body>
    <p>Berhasil Melakukan Pengajuan Jadwal</p>
    <br>
    <div>
        <p>Deskripsi Pengajuan :</p>
        <table border="0">
            <tr>
                <td>Tanggal</td>
                <td>:</td>
                <td>{{ dateFormat($request['date']) }}</td>
            </tr>
            <tr>
                <td>Waktu</td>
                <td>:</td>
                <td>{{ timeFormat($request['start']) }} - {{ timeFormat($request['end']) }}</td>
            </tr>
            <tr>
                <td>Ruangan</td>
                <td>:</td>
                <td>{{ $room }}</td>
            </tr>
            <tr>
                <td>Keterangan</td>
                <td>:</td>
                <td>{{ $request['description'] }}</td>
            </tr>
        </table>
        <hr>
        <div>
            <p>Login ke website <a href="{{ url('/') }}">Penjadwalan Ruang Rapat</a> untuk melakukan aksi tindak
                lanjut.</p>
        </div>
    </div>
</body>

</html>
