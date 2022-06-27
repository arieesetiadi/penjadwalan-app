<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Broadcast Notulen</title>
</head>

<body>
    <h1>Broadcast Notulen</h1>
    <br>
    <div>
        <h3>Judul Notulen :</h3>
        <p>{{ $note['title'] }}</p>

        <h3>Isi Notulen :</h3>
        <p>{!! $note['contentText'] !!}</p>
    </div>
</body>

</html>
