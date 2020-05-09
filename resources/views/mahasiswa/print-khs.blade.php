@extends('layouts.master')

@section('content')
    <div class="container-fluid mt--9 mb-5">
        <div class="col">
            <div class="card" style="border:none;">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-1">
                            
                        </div>
                        <div class="col-md-11">
                            <img src="{{asset('public/template/assets/img/brand/dm.png')}}" style="position:absolute; margin-left:5%;" width="12%">
                            <br><br>
                            <h3 class="mb-0 text-center">SEKOLAH TINGGI MANAJEMEN INFORMASI & KOMPUTER</h3>
                            <h3 class="mb-0 text-center">DHARMA NEGARA</h3>
                            <h3 class="mb-0 text-center">BUSSINESS AND INFORMATICS SCHOOL</h3>
                            <br>
                        </div>
                    </div>
                    <hr>
                    <h3 class="mb-0 text-center">KARTU HASIL STUDI</h3>
                    <div class="row p-3">
                        <div class="col-md-6">
                            <table>
                                <tr>
                                    <td>Nama&nbsp;&nbsp;&nbsp;</td>
                                    <td>:&nbsp;&nbsp;&nbsp;</td>
                                    <td>{{$mahasiswa->nama}}</td>
                                </tr>
                                <tr>
                                    <td>NIM</td>
                                    <td>:</td>
                                    <td>{{$mahasiswa->nim}}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table>
                                <tr>
                                    <td>Program Studi&nbsp;&nbsp;&nbsp;</td>
                                    <td>:&nbsp;&nbsp;&nbsp;</td>
                                    <td>{{$mahasiswa->jurusan->jurusan}}</td>
                                </tr>
                                <tr>
                                    <td>Semester</td>
                                    <td>:</td>
                                    <td>{{$mahasiswa->semester->semester}}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    {{-- <div class="table-responsive"> --}}
                        <table class="table align-items-center table-bordered table-hover" id="data-table">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Mata kuliah</th>
                                    <th scope="col">Nilai</th>
                                    <th scope="col">SKS</th>
                                    <th scope="col">Bobot</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no = 1; $index = 0; $nilai_angka = 0; $sks = 0; $bobot = 0; @endphp
                                @foreach ($matkul as $m)
                                    <tr>
                                        <td>{{$no++}}</td>
                                        <td>{{$m->matakuliah}}</td>
                                        <td>
                                            @if ($nilai[$index]['nilai'] > 80)
                                            @php $nilai_angka = 4; @endphp
                                                A
                                            @elseif($nilai[$index]['nilai'] > 68)
                                            @php $nilai_angka = 3; @endphp
                                                B
                                            @elseif($nilai[$index]['nilai'] > 56)
                                            @php $nilai_angka = 2; @endphp
                                                C
                                            @elseif($nilai[$index]['nilai'] > 45)
                                            @php $nilai_angka = 1; @endphp
                                                D
                                            @else
                                            @php $nilai_angka = 0; @endphp
                                                E
                                            @endif
                                        </td>
                                        {{-- <td>{{($nilai[$index]['nilai'])}}</td> --}}
                                        <td>{{$m->sks}}</td>
                                        <td>{{($nilai_angka * $m->sks)}}</td>
                                        @php
                                            $bobot = $bobot + ($nilai_angka * $m->sks);
                                        @endphp
                                    </tr>
                                    @php $index++; $nilai_angka = 0; $sks = $sks + $m->sks; @endphp
                                @endforeach
                                <tr>
                                    <td colspan="2"><h5 class="text-center">Jumlah</h5></td>
                                    <td></td>
                                    <td>{{$sks}}</td>
                                    <td>{{$bobot}}</td>
                                </tr>
                                <tr>
                                    <td colspan="2"><h5 class="text-center">Index prestasi</h5></td>
                                    <td colspan="3">{{$bobot/$sks}}</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="row">
                            <div class="col-md"><br>
                                <p class="float-right">Bandung, {{date('M Y')}} <br> 
                                    Pembantu Ketua I,<br><br>
                                    <img src="{{asset('public/krs-pdf/ttd.png')}}" width="50%" alt=""><br>
                                    Iwan Ridwan, ST., M.Kom
                                </p>
                            </div>
                        </div>
                    {{-- </div> --}}
                </div>
            </div>
        </div>
    </div>
    </body>
    </html>
@endsection

@section('customjs')
    <script>
        $(document).ready(function(){
            $('nav').remove();
            window.print();
            window.setTimeout(function(){
            window.close();
        }, 1000);
        });
    </script>
@endsection
