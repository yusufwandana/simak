@extends('layouts.master')

@section('head', 'Mahasiswa')

@section('title', 'SIMAK2019 | Mahasiswa')

@section('content')
<div class="container-fluid mt--9 mb-5">
    <div class="col">
        <div class="col-xl-3 col-lg-4" style="padding-top:100px;">
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="row">

                
                    <!-- Data Kehadiran --> 
                        <div class="col-xl-6 col-lg-4">
                            <div class="card card-stats mb-4 mb-xl-4">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h5 class="card-title text-uppercase text-muted mb-0">Kehadiran</h5>
                                            <span class="h2 font-weight-bold mb-0">{{ $hadir }}</span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                                <i class="fas fa-user-check"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="mt-3 mb-0 text-muted text-sm">
                                        <a href="/simak/kehadiran/mahasiswa/kehadiran" class="btn btn-info btn-sm btn-block">Go To</a>
                                    </p>
                                </div>
                                {{-- <button type="button" class="btn btn-info btn-lg btn-block btn-sm" href="/simak/kehadiran/mahasiswa/kehadiran">Deatail</button> --}}
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-4">
                            <div class="card card-stats mb-4 mb-xl-4">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h5 class="card-title text-uppercase text-muted mb-0">tidakhadir</h5>
                                            <span class="h2 font-weight-bold mb-0">
                                                {{ $absen }}
                                            </span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                                <i class="fas fa-user-alt-slash"></i>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <p class="mt-3 mb-0 text-muted text-sm">
                                        <a href="/simak/kehadiran/mahasiswa/tdkhadir" class="btn btn-info btn-sm btn-block">Go To</a>
                                    </p>
                                </div>
                                {{-- <a href="/simak/kehadiran/mahasiswa/tdkhadir" class="btn btn-info btn-lg btn-block btn-sm">Deatail</a> --}}
                            </div>
                        </div>
                    <!-- Data Kehadiran -->


                    <!-- Data Table -->
                        <div class="card shadow ml-3 col-md-11">
                            <div class="card-header border-0">
                                @if ($message = Session::get('success'))
                                <div class="alert alert-success alert-sm alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">Ã—</span></button>
                                    <h5 class="text-white">{{ $message }}</h5>
                                </div>
                                @endif
                                <h3 class="mb-0 float-left">Nilai Mata Kuliah</h3>
                            </div>
                            <div class="table-responsive ">
                                <table class="table align-items-center table-flush">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Tanggal</th>
                                            <th scope="col">Dosen</th>
                                            <th scope="col">Matakuliah</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1; ?>
                                        @foreach($tglhdr as $t)
                                        <tr>
                                            <td>
                                                {{$no}}
                                            </td>
                                            <td>
                                                {{ $t->tanggal}}
                                            </td>
                                            <td>
                                                {{ $t->dosen->nama}}
                                            </td>
                                            <td>
                                                {{ $t->matkul->matakuliah}}
                                            </td>
                                        </tr>
                                        @endforeach
                                        <?php $no++ ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- BIODATA MAHASISWA -->
                @include('layouts.includes.biodata')
            </div>
    </div>
</div>

@endsection