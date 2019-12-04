@extends('layouts.master')

@section('title', 'SIMAK2019 | Input Nilai Mahasiswa')

@section('head', 'Input Nilai Mahasiswa')

@section('content')
<div class="container-fluid mt--9">
    <div class="row">
        <div class="col-md">
            <div class="card shadow">
                <div class="card-header bg-transparent">
                    <h3 class="mb-0 float-left">Daftar Mahasiswa</h3>
                    <a href="{{ route('nilai.index') }}" class="badge badge-warning float-right mx-3">kembali</a>
                    <h4 class="mb-0 float-right">{{ date('d M Y') }}</h4>
                    <br>
                    <br>
                    <table>
                        <tr>
                            <td>Dosen</td>
                            <td>:</td>
                            <td>{{ auth()->user()->name }}</td>
                        </tr>
                        <tr>
                            <td>Matkul</td>
                            <td>:</td>
                            <td>{{ $matkul->matakuliah }}</td>
                        </tr>
                        <tr>
                            <td>Semester </td>
                            <td>: &nbsp; </td>
                            <td>Semester {{ $semester->semester }}</td>
                        </tr>
                    </table>
                </div>  
                <div class="card-body">
                    <form action="{{ route('absen.postabsen') }}" method="post">
                        @csrf       
                        <input type="hidden" name="matkul" value="{{ $matkul->matakuliah }}">   
                        <input type="hidden" name="semester_id" value="{{ $semester->id }}">
                        <input type="hidden" name="matkul_id" value="{{ $matkul->id }}">
                                
                                    <table class="table align-items-center table-flush" id="ini">
                                    <thead class="thead-light">
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">NIM</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Jenis Kelamin</th>
                                        <th scope="col">Detail</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($mahasiswa as $mhs)
                                    <tr>
                                        <th scope="row">
                                            <div class="media align-items-center">
                                            <div class="media-body">
                                                <span class="mb-0 text-sm">{{ $no++ }}</span>
                                            </div>
                                            </div>
                                        </th>
                                        <td scope="row">
                                            <div class="media align-items-center">
                                            <div class="media-body">
                                                <span class="mb-0 text-sm">
                                                {{ $mhs->nim }}
                                                </span>
                                            </div>
                                            </div>
                                        </td>
                                        <td scope="row">
                                            <div class="media align-items-center">
                                            <div class="media-body">
                                                <span class="mb-0 text-sm">
                                                {{ $mhs->nama }}
                                                </span>
                                            </div>
                                            </div>
                                        </td>
                                        <td scope="row">
                                            <div class="media align-items-center">
                                            <div class="media-body">
                                                <span class="mb-0 text-sm">
                                                    @if ($mhs->jk == 'L')
                                                        Laki-laki
                                                    @else
                                                        Perempuan
                                                    @endif
                                                </span>
                                            </div>
                                            </div>
                                        </td>
                                        <td scope="row">
                                            <a class="btn btn-primary btn-sm btn-info" href="{{ route('nilai.show',$mhs->id) }}"><i class="ni ni-books"></i></a>
                                        </td>
                                    </tr>    
                                    @endforeach
                                    </tbody>
                                </table>
                                
                    </div>
                    <div class="card-footer">
                        {{-- <button type="submit" class="btn btn-primary btn-sm">Selesai</button> --}}
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('customjs')

    <script>

        $(document).ready(function(){

            $('#ini').DataTable({
                paging: false,
                info: false
            });

            $('#ini_wrapper .row .col-md-6').removeClass('col-md-6');
            $('#ini_wrapper .row .col-sm-12, #ini_filter, label, input').addClass('pb-1');

        });

    </script>
    
@endsection