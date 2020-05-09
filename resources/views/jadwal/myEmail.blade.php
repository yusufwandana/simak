<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
</head>
<body>
    <h3>Hallo, <b>{{ $nama }}</b>!</h3>
    <p>Anda memiliki jadwal mengajar pada :</p>
    <table>
        <tr>
            <td>Tanggal</td>
            <td>:</td>
            <td>{{ $event }}</td>
        </tr>
        <tr>
            <td>Waktu</td>
            <td>:</td>
            <td>Pukul {{ $mulai }} - {{$selesai}} WIB</td>
        </tr>
        <tr>
            <td>Mata kuliah</td>
            <td>:</td>
            <td>{{ $matkul }}</td>
        </tr>
        <tr>
            <td>Semester</td>
            <td>:</td>
            <td>{{ $semester }}</td>
        </tr>
        <tr>
            <td>Ruangan</td>
            <td>:</td>
            <td>{{ $ruangan }}</td>
        </tr>
    </table>
    <p>Kami mengharapkan kehadiran Anda pada jadwal mengajar tersebut.</p>
    <p>Terima kasih,</p>
    <br>
    <h5>SIMAK APPS</h5>
</body>
</html>