@extends('layouts.master')

@section('title', 'SIMAK2019 | Input Nilai')

@section('head', 'Input Nilai Mahasiswa')

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
                            <h3 class="mb-0">Input Nilai Mahasiswa</h3>
                        </div>
                        <div class="col-md-2">
                            <h4 class="mb-0">@php echo $a; @endphp, {{ date('d/m/Y') }}</h4>
                        </div>
                    </div>
                </div>
                <div class="row mx-2">
                    @foreach ($dosen as $m)
                        @foreach ($m->Matkul as $mm)
                            <div class="col-sm-4 my-4">
                                <a href="{{ route('nilai.daftarmhs', [$mm->id, $mm->slug]) }}">
                                    <div class="card shadow bg-gradient-info">
                                        <div class="card-body">
                                            <h3 class="text-white">{{ $mm->matakuliah }}</h3>
                                            <h4 class="text-white">Semester {{ $mm->semester->semester }}</h4>
                                            <h5 class="text-white">Tampilkan siswa dengan mapel ini..</h5>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection