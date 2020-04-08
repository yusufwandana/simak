@extends('layouts.master')

@section('title', 'Detail Profile')

@section('head', 'Profile')

@section('content')
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
        <div class="card card-profile shadow">
            <div class="row justify-content-center">
            <div class="col-lg-3 order-lg-2">
                <div class="card-profile-image">
                <a href="">
                    <img src="{{ asset('public/image/profile/' . $user->avatar) }}" class="rounded-circle">
                </a>
                </div>
            </div>
            </div>
            <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">

            </div>
            <div class="card-body pt-0 pt-md-4">
            <div class="row">
                <div class="col">
                <div class="card-profile-stats d-flex justify-content-center mt-md-5">
    
                </div>
                </div>
            </div>
            <div class="text-center">
                <h3>
                {{ $dosen->nama }}<span class="font-weight-light"></span>
                </h3>
                <div class="h4 font-weight-300">
                <i class="ni location_pin mr-2"></i>{{ $dosen->nip }}
                </div>
                <div class="h4 font-weight-300">
                <i class="ni location_pin mr-2"></i>
                @if ($dosen->jk == 'L')
                    Laki-laki
                @elseif($dosen->jk == 'P')
                    Perempuan
                @else
                    !!EROR!!
                @endif
                </div>
                <div class="h5 mt-4">
                <i class="ni business_briefcase-24 mr-2"></i>Solution Manager - Creative Tim Officer
                </div>
            </div>
            </div>
        </div>
        </div>
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
        <div class="col-xl-8 order-xl-1">
        <div class="card bg-secondary shadow">
            <div class="card-header bg-white border-0">
            <div class="row align-items-center">
                <div class="col-12">
                <h3>{{ $dosen->nama }} | Profile <a href="{{ route('dosen') }}" class="badge badge-warning float-right">kembali</a></h3>
                
                </div>
            </div>
            </div>
            <div class="card-body">
            <form>
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
                <h6 class="heading-small text-muted mb-4">User information</h6>
                <div class="px-lg-0">
                <div class="row">
                    <div class="col-lg-6">
                    <div class="form-group">
                        <label class="form-control-label" for="input-email">Email address</label>
                        <input type="email" id="input-email" class="form-control form-control-alternative" value="{{ $user->email }}" readonly>
                    </div>
                    </div>
                    <div class="col-lg-6">
                    <div class="form-group">
                        <label class="form-control-label" for="nip">NIP</label>
                        <input type="text" id="nip" class="form-control form-control-alternative" value="{{ $dosen->nip }}" readonly>
                    </div>
                    </div>
                </div>
                <hr class="my-4">
                <h6 class="heading-small text-muted mb-4">Daftar matkul <a href="" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#exampleModal"><i class="ni ni-fat-add"></i>Tambah</a></h6>
                <div class="row mt-4">
                    <div class="col-lg">
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                    <th scope="col">Matkul</th>
                                    <th scope="col">Semester</th>
                                    <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dosen->matkul as $m)
                                    <tr>
                                        <td scope="row">
                                        <div class="media align-items-center">
                                            <div class="media-body">
                                            <span class="mb-0 text-sm">{{ $m->matakuliah }}</span>
                                            </div>
                                        </div>
                                        </td>
                                        <td scope="row">
                                        <div class="media align-items-center">
                                            <div class="media-body">
                                            <span class="mb-0 text-sm">Semester {{ $m->semester->semester }}</span>
                                            </div>
                                        </div>
                                        </td>
                                        <td scope="row">
                                        <a class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin akan menghapus data ini?')" href="{{ route('dosenmatkul.delete', $m->pivot->id) }}"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>                        
                        </div>
                    </div>
                    </div>
                </div>
            </form>
            </div>
        </div>
        </div>
    </div>
    <!-- Footer -->
    <footer class="footer">
        <div class="row align-items-center justify-content-xl-between">
        <div class="col-xl-6">
            <div class="copyright text-center text-xl-left text-muted">
            © 2018 <a href="https://www.creative-tim.com" class="font-weight-bold ml-1" target="_blank">Creative Tim</a>
            </div>
        </div>
        <div class="col-xl-6">
            <ul class="nav nav-footer justify-content-center justify-content-xl-end">
            <li class="nav-item">
                <a href="https://www.creative-tim.com" class="nav-link" target="_blank">Creative Tim</a>
            </li>
            <li class="nav-item">
                <a href="https://www.creative-tim.com/presentation" class="nav-link" target="_blank">About Us</a>
            </li>
            <li class="nav-item">
                <a href="http://blog.creative-tim.com" class="nav-link" target="_blank">Blog</a>
            </li>
            <li class="nav-item">
                <a href="https://github.com/creativetimofficial/argon-dashboard/blob/master/LICENSE.md" class="nav-link" target="_blank">MIT License</a>
            </li>
            </ul>
        </div>
        </div>
    </footer>

    {{-- Modal --}}
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{ route('dosenmatkul.add') }}" method="post">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="exampleModalLabel">
                            Tambah Matkul
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="hidden" name="dosen_id" value="{{ $dosen->id }}">
                            <label for="matkul">Tambah Matkul</label>
                            @if ($errors->has('matkul_id'))
                                <select class="form-control" name="matkul_id" id="matkul_id" required>
                                    <option value="" selected disabled>Pilih matkul</option>
                                    @foreach ($matkul as $m)
                                        <option value="{{ $m->id }}">{{ $m->matakuliah }}</option>
                                    @endforeach
                                </select>
                                <small class="text-danger">{{ $errors->first('jk') }}</small>
                            @else
                                <select class="form-control" name="matkul_id" id="matkul_id" required>
                                    <option value="" selected disabled>Pilih matkul</option>
                                    @foreach ($matkul as $m)
                                        <option value="{{ $m->id }}">{{ $m->matakuliah }} ({{$m->semester->semester}})</option>
                                    @endforeach
                                </select>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm float-right">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    </div>
@endsection