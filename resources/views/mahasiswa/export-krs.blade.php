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
                <div class="row">
                    <div class="col-md-7">
                        <img src="{{asset('public/krs-pdf/1.png')}}" width="100%">
                    </div>
                    <div class="col-md-5">
                        <br>
                        <h6><b>STMIK DHARMA NEGARA</b></h6>
                        <small>Bussiness and Informatics School</small><br>
                        <small>Jl. Babakan Sari No.68 Bandung, Jawa Barat - Indonesia</small><br>
                        <small>Telp. 022 7275358 <a href="https://www.stmikdharmanegara.ac.id">www.stmikdharmanegara.ac.id</a></small>
                    </div>
                </div>
                <hr class="mt-3 mb-5">
                <div class="row">
                    <div class="col-md">
                        <h5 class="text-center"><b>KARTU RENCANA STUDI (KRS)</b></h5><br>
                        <table>
                            <tr>
                                <td>NIM</td>
                                <td>&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td>{{$mhs->nim}}</td>
                            </tr>
                            <tr>
                                <td>Nama Mahasiswa</td>
                                <td>&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td>{{$mhs->nama}}</td>
                            </tr>
                            <tr>
                                <td>Program Studi</td>
                                <td>&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td>{{$mhs->jurusan->jurusan}}</td>
                            </tr>
                            <tr>
                                <td>KRS Semester</td>
                                <td>&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td>{{$mhs->semester->semester}}</td>
                            </tr>
                        </table>
                        <br>
                    </div>
                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Mata Kuliah</th>
                            <th>Nama Mata Kuliah</th>
                            <th>Jumlah SKS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i = 1; $total = 0; @endphp
                        @foreach ($data as $x)
                            <tr>
                                <td>{{$i}}.</td>
                                <td>{{$x->kd_matkul}}</td>
                                <td>{{$x->matakuliah}}</td>
                                <td>{{$x->sks}}</td>
                            </tr>
                            @php $i++; @endphp
                            @php $total = $total + $x->sks; @endphp
                        @endforeach
                        <tr>
                            <td class="text-center" colspan="3">Total</td>
                            <td>{{$total}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-6">
                <p>Puket I Bid. Akademik</p>
                <br><br><br><br>
                <p style="text-decoration:underline;" class="mb-0">Iwan Ridwan, ST. M.Kom</p>
                <b>NID. 1022015</b>
            </div>
            <div class="col-md-6">
                <div class="row float-right">
                    <div class="col-md">
                        <p class="my-0">Bandung, ........, .....................................@php echo date('Y') @endphp</p>
                        <p>Mahasiswa YBS,</p>
                        <br><br><br>
                        <p>________________________________________</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        window.print();
        window.setTimeout(function(){
            window.close();
        }, 1000);
    </script>
</body>
</html>