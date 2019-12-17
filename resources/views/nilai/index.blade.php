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
                <form action="{{ route('nilai.daftarmhs') }}" method="post">
                    @csrf          
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="">Mata kuliah</label>
                                    <select name="matkul_id" id="matkul_id" class="form-control mb-3" required>
                                        <option value="" selected disabled>Pilih matkul</option>
                                        @foreach ($dosen as $m)
                                            @foreach ($m->Matkul as $mm)
                                                <option value="{{ $mm->id }}">{{ $mm->matakuliah }}</option>
                                            @endforeach
                                        @endforeach
                                    </select>
                                    <button type="submit" class="btn btn-primary btn-sm">Tampilkan</button>
                                </div>  
                            </div>
                        </div>
                    </div>       
                </form>
            </div>
        </div>
    </div>
</div>
@endsection