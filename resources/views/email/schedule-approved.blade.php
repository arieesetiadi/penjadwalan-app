<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Jadwal Telah Disetujui</title>
</head>

<body>
    <h1>Jadwal Telah Disetujui</h1>
    <br>
    <div>
        <h3>Deskripsi Jadwal :</h3>
        <table border="0">
            <tr>
                <td>Tanggal</td>
                <td>:</td>
                <td>{{ dateFormat($schedule['date']) }}</td>
            </tr>
            <tr>
                <td>Waktu</td>
                <td>:</td>
                <td>{{ timeFormat($schedule['start']) }} - {{ timeFormat($schedule['end']) }}</td>
            </tr>
            <tr>
                <td>Keterangan</td>
                <td>:</td>
                <td>{{ $schedule['description'] }}</td>
            </tr>
        </table>
        <hr>
        <h3>Disetujui Oleh :</h3>
        <table border="0">
            <tr>
                <td>Nama</td>
                <td>:</td>
                <td>{{ $officer['name'] }}</td>
            </tr>
            <tr>
                <td>Divisi</td>
                <td>:</td>
                <td>{{ $officer->division->name }}</td>
            </tr>
            <tr>
                <td>Email</td>
                <td>:</td>
                <td>{{ $officer['email'] }}</td>
            </tr>
            <tr>
                <td>Telepon</td>
                <td>:</td>
                <td>{{ $officer['phone'] }}</td>
            </tr>
        </table>
    </div>
</body>

</html>
