<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Broadcast Notulen</title>
</head>

<body>
    <p>Broadcast Notulen</p>
    <br>
    <div>
        <p>Detail Notulen :</p>
        <table border="0">
            <tr>
                <td>Judul</td>
                <td>:</td>
                <td>{{ $note['title'] }}</td>
            </tr>
            @if ($note['contentText'])
                <tr>
                    <td>Isi Notulen</td>
                    <td>:</td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="3">{!! $note['contentText'] !!}</td>
                </tr>
            @endif
        </table>
    </div>
</body>

</html>
