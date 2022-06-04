<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pengajuan Jadwal</title>
</head>

<body>
    <h1>Pengajuan Jadwal</h1>
    <br>
    <div>
        <h3>Detail Peminjam :</h3>
        <table border="0">
            <tr>
                <td>Nama</td>
                <td>:</td>
                <td>{{ $borrower['name'] }}</td>
            </tr>
            <tr>
                <td>Divisi</td>
                <td>:</td>
                <td>{{ $borrower->division->name }}</td>
            </tr>
            <tr>
                <td>Email</td>
                <td>:</td>
                <td>{{ $borrower['email'] }}</td>
            </tr>
            <tr>
                <td>Telepon</td>
                <td>:</td>
                <td>{{ $borrower['phone'] }}</td>
            </tr>
        </table>
        <hr>
        <h3>Deskripsi Pengajuan :</h3>
        <table border="0">
            <tr>
                <td>Ruangan</td>
                <td>:</td>
                <td>{{ $room}}</td>
            </tr>
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
