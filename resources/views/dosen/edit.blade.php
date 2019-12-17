@extends('layouts.master')

@section('title', 'SIMAK2019 | Edit dosen')

@section('head', 'Edit Data Dosen')

@section('content')
<div class="container-fluid mt--9">
    <!-- Table -->
    <div class="row justify-content-center">
        <div class="col-md-10">
        <div class="card shadow">
            <div class="card-header bg-transparent">
            <h3 class="mb-0">Form Edit Dosen<a href="{{ route('dosen') }}" class="badge badge-warning float-right">kembali</a></h3>
            
            </div>
            <form action="/simak/dosen/{{ $dosen->id }}/update" method="post">
            @csrf
            <div class="card-body">
                <div class="form-group">
                @if ($errors->first('nip'))
                    <label for="nip">NIP</label>
                    <input type="text" class="form-control" name="nip" value="{{ $dosen->nip }}" placeholder="NIP" id="nip">
                    <small class="text-danger">{{ $errors->first('nip') }}</small>
                @else
                    <label for="nip">NIP</label>
                    <input type="text" class="form-control" value="{{ $dosen->nip }}" placeholder="NIP" name="nip" id="nip">
                @endif
                </div>
                <div class="form-group">
                    @if ($errors->first('nama'))
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" value="{{ $dosen->nama }}" name="nama" placeholder="Masukan nama.." id="nama">
                        <small class="text-danger">{{ $errors->first('nama') }}</small>
                    @else
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" value="{{ $dosen->nama }}" placeholder="Masukan nama.." name="nama" id="nama">
                    @endif
                </div>
                <div class="form-group">
                    @if ($errors->first('jk'))
                        <label for="jk">Jenis Kelamin</label>
                        <select name="jk" id="jk" class="form-control">
                            <option value="" selected disabled>Pilih jenis kelamin..</option>
                            <option value="L" @if ($dosen->jk == 'L') selected @endif>Laki-laki</option>
                            <option value="P" @if ($dosen->jk == 'P') selected @endif>Perempuan</option>
                        </select>
                        <small class="text-danger">{{ $errors->first('jk') }}</small>
                    @else
                    <label for="jk">Jenis kelamin</label>
                    <select name="jk" id="jk" class="form-control">
                        <option value="" selected disabled>Pilih jenis kelamin..</option>
                        <option value="L" @if ($dosen->jk == 'L') selected @endif>Laki-laki</option>
                        <option value="P" @if ($dosen->jk == 'P') selected @endif>Perempuan</option>
                    </select>
                    @endif
                </div>
                <div class="form-group">
                    @if ($errors->first('alamat'))
                        <label for="alamat">Alamat</label>
                        <input type="text" class="form-control" value="{{ $dosen->alamat }}" name="alamat" placeholder="Masukan alamat.." id="alamat">
                        <small class="text-danger">{{ $errors->first('alamat') }}</small>
                    @else
                        <label for="alamat">Alamat</label>
                        <input type="text" class="form-control" value="{{ $dosen->alamat }}" placeholder="Masukan alamat.." name="alamat" id="alamat">
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
            </form>
        </div>
        </div>
    </div>
    <!-- Footer -->
    <footer class="footer">
        <div class="row align-items-center justify-content-xl-between">
        <div class="col-xl-6">
            <div class="copyright text-center text-xl-left text-muted">
            © {{ date('Y') }} <a href="https://www.creative-tim.com" class="font-weight-bold ml-1" target="_blank">Creative Tim</a>
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
    </div>
@endsection