@extends('layouts.master')

@section('title', 'SIMAK2019 | Pilih Semester')

@section('head', 'Data Nilai Mahasiswa')

@section('content')
<div class="container-fluid mt--9">
    <div class="row">
        <div class="col-md">
            <div class="card shadow">
                <div class="card-header bg-transparent">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-sm alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <h5 class="text-white">{{ $message }}</h5>
                        </div>
                    @endif
                    @if ($message = Session::get('error'))
                        <div class="alert alert-danger alert-sm alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <h5 class="text-white">{{ $message }}</h5>
                        </div>
                    @endif
                    @php
                        $a = date('D');
                        switch ($a) {
                        case 'Sun':
                            $a = 'Minggu';
                            break;
                        case 'Mon':
                            $a = 'Senin';
                            break;
                        case 'Tue':
                            $a = 'Selasa';
                            break;
                        case 'Wed':
                            $a = 'Rabu';
                            break;
                        case 'Thu':
                            $a = 'Kamis';
                            break;
                        case 'Fri':
                            $a = 'Jumat';
                            break;
                        case 'Sat':
                            $a = 'Sabtu';
                            break;
                        
                        default:
                            $a = 'False';
                            break;
                        }
                        @endphp
                    <div class="row">
                        <div class="col-md-10">
                            <h3 class="mb-0">Pilih Semester</h3>
                        </div>
                        <div class="col-md-2">
                            <h4 class="mb-0">@php echo $a; @endphp, {{ date('d/m/Y') }}</h4>
                        </div>
                    </div>
                </div>
                <div class="row mx-2">
                    @foreach ($data as $matkul)
                        <div class="col-sm-4 my-4">
                            <a href="{{route('admin.nilai', $matkul->semester_id)}}">
                                <div class="card shadow bg-gradient-info">
                                    <div class="card-body">
                                        <h3 class="text-white">{{$matkul->matakuliah}}</h3>
                                        <h4 class="text-white">Semester {{$matkul->semester->semester}}</h4>
                                        <h5 class="text-white">Tampilkan siswa matkul ini..</h5>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection