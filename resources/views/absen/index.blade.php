@extends('layouts.master')

@section('title', 'SIMAK2019 | Absen Mahasiswa')

@section('head', 'Absen Mahasiswa')

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
                    <h3 class="mb-0 float-left">Absen Mahasiswa</h3>
                    <h4 class="mb-0 float-right">{{ date('d M Y') }}</h4>
                </div>  
                <form action="{{ route('absen.daftarmhs') }}" method="post">
                    @csrf          
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="matkul_id">Mata kuliah</label>
                                    <select name="matkul_id" id="matkul_id" class="form-control mb-3">
                                        <option value="" selected disabled>Pilih matkul</option>
                                        @foreach ($dosen as $m)
                                            @foreach ($m->Matkul as $mm)
                                                <option value="{{ $mm->id }}">{{ $mm->matakuliah }}</option>
                                            @endforeach
                                        @endforeach
                                    </select>
                                </div> 
                                <button type="submit" class="btn btn-primary btn-sm">Tampilkan</button>
                            </div>
                            <div class="col-md-2"></div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="tanggal">Tanggal absen</label>
                                    <input type="date" class="form-control" name="tanggal" id="tanggal">
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