<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pengajuan Jadwal Anda Telah Expired</title>
</head>

<body>
    <h1>Pengajuan Jadwal Anda Telah Expired</h1>
    <br>
    <div>
        <h3>Deskripsi Jadwal :</h3>
        <table border="0">
            <tr>
                <td>Tanggal</td>
                <td>:</td>
                <td>{{ dateFormat($expiredSchedule['date']) }}</td>
            </tr>
            <tr>
                <td>Waktu</td>
                <td>:</td>
                <td>{{ timeFormat($expiredSchedule['start']) }} - {{ timeFormat($expiredSchedule['end']) }}</td>
            </tr>
            <tr>
                <td>Keterangan</td>
                <td>:</td>
                <td>{{ $expiredSchedule['description'] }}</td>
            </tr>
        </table>
        <hr>
        <p>Jadwal yang anda ajukan telah melewati waktu dan tidak dapat digunakan kembali. Silahkan mengajukan jadwal
            kembali dengan waktu yang baru</p>
    </div>
</body>

</html>
