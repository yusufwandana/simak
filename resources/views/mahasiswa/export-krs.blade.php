<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('public\css\bootstrap.css') }}">
    <title>Export</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md">
                <table class="table table-bordered">
                <h3 class="text-center text-red">KRS Mahasiswa Nih babu</h3>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Matkul</th>
                            <th>Matakuliah</th>
                            <th>Jumlah sks</th>
                            <th>Kategori</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i = 1 @endphp
                        @foreach ($data as $x)
                            <tr>
                                <td>{{$i}}</td>
                                <td>{{$x->kd_matkul}}</td>
                                <td>{{$x->matakuliah}}</td>
                                <td>{{$x->sks}}</td>
                                <td>{{$x->kategori}}</td>
                            </tr>
                            @php
                                $i++;
                            @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>