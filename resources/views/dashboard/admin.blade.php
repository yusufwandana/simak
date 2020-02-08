@extends('layouts/master')

@section('title', 'SIMAK | Dashboard')

@section('head', 'dashboard')
    
@section('dashboard')
  <div class="container-fluid mt--3">
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
  </div>
  <div class="container-fluid">
      <div class="header-body">
        <!-- Card stats -->
        <div class="row">
          <div class="col-xl-3 col-lg-6">
            <div class="card card-stats mb-4 mb-xl-0">
              <div class="card-body">
                <div class="row">
                  <div class="col">
                    <h5 class="card-title text-uppercase text-muted mb-0">Mahasiswa</h5>
                    <span class="h2 font-weight-bold mb-0">{{ $mahasiswa->count() }}</span>
                  </div>
                  <div class="col-auto">
                    <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                      <i class="fas fa-chart-bar"></i>
                    </div>
                  </div>
                </div>
                <p class="mt-3 mb-0 text-muted text-sm">
                  <a href="/simak/mahasiswa" class="btn btn-primary btn-sm btn-block">Tampilkan</a>
                </p>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-lg-6">
            <div class="card card-stats mb-4 mb-xl-0">
              <div class="card-body">
                <div class="row">
                  <div class="col">
                    <h5 class="card-title text-uppercase text-muted mb-0">Dosen</h5>
                    <span class="h2 font-weight-bold mb-0">{{ $dosen->count() }}</span>
                  </div>
                  <div class="col-auto">
                    <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                      <i class="fas fa-chart-pie"></i>
                    </div>
                  </div>
                </div>
                <p class="mt-3 mb-0 text-muted text-sm">
                  <a href="/simak/dosen" class="btn btn-primary btn-sm btn-block">Tampilkan</a>
                </p>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-lg-6">
            <div class="card card-stats mb-4 mb-xl-0">
              <div class="card-body">
                <div class="row">
                  <div class="col">
                    <h5 class="card-title text-uppercase text-muted mb-0">Mata Kuliah</h5>
                    <span class="h2 font-weight-bold mb-0">{{ $matkul->count() }}</span>
                  </div>
                  <div class="col-auto">
                    <div class="icon icon-shape bg-yellow text-white rounded-circle shadow">
                      <i class="fas fa-users"></i>
                    </div>
                  </div>
                </div>
                <p class="mt-3 mb-0 text-muted text-sm">
                  <a href="/simak/matkul" class="btn btn-primary btn-sm btn-block">Tampilkan</a>
                </p>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-lg-6">
            <div class="card card-stats mb-4 mb-xl-0">
              <div class="card-body">
                <div class="row">
                  <div class="col">
                    <h5 class="card-title text-uppercase text-muted mb-0">Jurusan</h5>
                    <span class="h2 font-weight-bold mb-0">{{ $jurusan->count() }}</span>
                  </div>
                  <div class="col-auto">
                    <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                      <i class="fas fa-percent"></i>
                    </div>
                  </div>
                </div>
                <p class="mt-3 mb-0 text-muted text-sm">
                  <a href="/simak/jurusan" class="btn btn-primary btn-sm btn-block">Tampilkan</a>
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection

@section('content')
    {{-- <div class="container-fluid mt--9 mb-5">
        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-sm alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            <h5 class="text-white">{{ $message }}</h5>
        </div>
        @endif
        @if ($message = Session::get('failed'))
        <div class="alert alert-danger alert-sm alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            <h5 class="text-white">{{ $message }}</h5>
        </div>
        @endif
    </div> --}}
@endsection