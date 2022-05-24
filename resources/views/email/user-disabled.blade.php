<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Akun Anda Telah Dinonaktifkan</title>
</head>

<body>
    <p>Akun anda telah dinonaktifkan dengan detail sebagai berikut :</p>
    <br>
    <div>
        <p>Detail Pengguna :</p>
        <table border="0">
            <tr>
                <td>Nama</td>
                <td>:</td>
                <td>{{ $user['name'] }}</td>
            </tr>
            <tr>
                <td>Divisi</td>
                <td>:</td>
                <td>{{ $user->division->name }}</td>
            </tr>
            <tr>
                <td>Email</td>
                <td>:</td>
                <td>{{ $user['email'] }}</td>
            </tr>
            <tr>
                <td>Telepon</td>
                <td>:</td>
                <td>{{ $user['phone'] }}</td>
            </tr>
            <hr>
            <tr>
                <td>Alasan Pe-nonaktifan</td>
                <td>:</td>
                <td>{{ $msg }}</td>
            </tr>
        </table>
    </div>
</body>

</html>
