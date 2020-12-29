@extends('layouts/master')

@section('title', 'SIMAK | Dashboard')

@section('head', 'dashboard')

@section('dashboard')
    @if ($msg = Session::get('success'))
        <div class="container-fluid mt--3">
            <div class="row justify-content-center">
                <div class="col-md">
                    <div class="card mb-5">
                    <div class="card-body">
                            <h4 class="text-success">{{$msg}}.</h4>
                            {{-- <h3 class="float-left">Selamat datang, &nbsp;<h3 class="text-green float-left"> {{auth()->user()->name}}!</h3></h3> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if ($msg = Session::get('failed'))
        <div class="container-fluid mt--3">
            <div class="row justify-content-center">
                <div class="col-md">
                    <div class="card mb-5">
                    <div class="card-body">
                            <h4 class="text-danger">{{$msg}}</h4>
                            {{-- <h3 class="float-left">Selamat datang, &nbsp;<h3 class="text-green float-left"> {{auth()->user()->name}}!</h3></h3> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    {{-- <div class="container-fluid mt--3">
        <div class="row justify-content-center">
            <div class="col-md">
            <div class="card mb-5">
                <div class="card-body">
                @if ($msg = Session::get('success'))
                    <p class="text-green">{{$msg}}</p>
                @endif
                <h3 class="float-left">Selamat datang, &nbsp;<h3 class="text-green float-left"> {{auth()->user()->name}}!</h3></h3>
                </div>
            </div>
            </div>
        </div>
    </div> --}}
    <div class="container-fluid">
        <div class="header-body">
        <!-- Card stats -->
        {{-- <div class="row">
            <div class="col-xl-3 col-lg-6">
            <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                <div class="row">
                    <div class="col">
                    <h5 class="card-title text-uppercase text-muted mb-0">Mata Kuliah</h5>
                    <span class="h2 font-weight-bold mb-0"></span>
                    </div>
                    <div class="col-auto">
                    <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                        <i class="fas fa-chart-bar"></i>
                    </div>
                    </div>
                </div>
                <p class="mt-3 mb-0 text-muted text-sm">
                    <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                    <span class="text-nowrap"></span>
                </p>
                </div>
            </div>
            </div>
            <div class="col-xl-3 col-lg-6">
            <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                <div class="row">
                    <div class="col">
                    <h5 class="card-title text-uppercase text-muted mb-0">Jadwal</h5>
                    <span class="h2 font-weight-bold mb-0"></span>
                    </div>
                    <div class="col-auto">
                    <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                        <i class="fas fa-chart-pie"></i>
                    </div>
                    </div>
                </div>
                <p class="mt-3 mb-0 text-muted text-sm">
                    <span class="text-danger mr-2"><i class="fas fa-arrow-down"></i> 3.48%</span>
                    <span class="text-nowrap"></span>
                </p>
                </div>
            </div>
            </div>
            <div class="col-xl-3 col-lg-6">
            <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                <div class="row">
                    <div class="col">
                    <h5 class="card-title text-uppercase text-muted mb-0">Sales</h5>
                    <span class="h2 font-weight-bold mb-0">924</span>
                    </div>
                    <div class="col-auto">
                    <div class="icon icon-shape bg-yellow text-white rounded-circle shadow">
                        <i class="fas fa-users"></i>
                    </div>
                    </div>
                </div>
                <p class="mt-3 mb-0 text-muted text-sm">
                    <span class="text-warning mr-2"><i class="fas fa-arrow-down"></i> 1.10%</span>
                    <span class="text-nowrap"></span>
                </p>
                </div>
            </div>
            </div>
            <div class="col-xl-3 col-lg-6">
            <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                <div class="row">
                    <div class="col">
                    <h5 class="card-title text-uppercase text-muted mb-0">Matkul</h5>
                    <span class="h2 font-weight-bold mb-0">49,65%</span>
                    </div>
                    <div class="col-auto">
                    <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                        <i class="fas fa-percent"></i>
                    </div>
                    </div>
                </div>
                <p class="mt-3 mb-0 text-muted text-sm">
                    <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> 12%</span>
                    <span class="text-nowrap"></span>
                </p>
                </div>
            </div>
            </div>
        </div> --}}
        </div>
    </div>
@endsection

@section('content')
    <div class="container-fluid mt--8 mb-5">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header">
                        <h3>Beranda
                            @if (auth()->user()->role != 'admin' || 'dosen')

                            @else
                                <a href="/simak/dosen/postgs" class="btn btn-primary btn-sm float-right">Posting Sesuatu..</a>
                            @endif
                        </h3>
                    </div>
                    <div class="card-body">
                        @foreach ($mt as $data)
                            <div class="row shadow" style="padding:20px; border-radius:10px;">
                                <div class="col-md-1">
                                    <img src="{{ asset('image/profile/' . $data->user->avatar) }}" style="width: 60px;" class="rounded-circle">
                                </div>
                                <div class="col-md-10">
                                    <b>{{ $data->user->name }}</b>@if ($data->user->role == 'admin') <i class="fas fa-check-circle mx-1"></i> @endif
                                    <br>
                                    <small><i>Diposting pada
                                        @php
                                            echo date("d F Y", strtotime($data->tanggal_post));
                                        @endphp</i></small><br><br>
                                    <div class="row">
                                        <div class="col-md" style="text-align:justify;">
                                            {{ $data->deskripsi }}
                                            <br><br>
                                        </div>
                                    </div>
                                    <h5><table>
                                        <tr>
                                            <td>Mata kuliah</td>
                                            <td>&nbsp;:&nbsp;&nbsp;&nbsp;</td>
                                            <td>{{ $data->matkul->matakuliah }} (Semester {{$data->semester->semester}})</td>
                                        </tr>
                                        <tr>
                                            <td>Tenggat</td>
                                            <td>&nbsp;:&nbsp;</td>
                                            <td>{{$data->tanggal_tenggat}} pada pukul {{$data->waktu_tenggat}}</td>
                                        </tr>
                                    </table></h5>
                                    <div class="row">
                                        <div class="col-md-10">
                                            <div class="card" style="border: solid 1px #f0f0ff;">
                                                <div class="card-body">
                                                    <a href="{{asset('files/' . $data->file)}}" target="_blank" style="margin:15px;">
                                                        <i class="fas fa-file"></i>&nbsp;&nbsp;&nbsp;   {{ $data->file }}
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                        @endforeach
                    </div>
                    <hr>
                </div>
            </div>
        </div>
    </div>
@endsection
