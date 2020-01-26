@extends('layouts.master')

@section('title', 'SIMAK | Edit dosen')

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
                    <label for="nip">NIP</label>
                    <input type="text" class="form-control" name="nip" value="{{ $dosen->nip }}" placeholder="NIP" id="nip" readonly>
                    @if ($errors->has('nip'))
                        <small class="text-danger">{{ $errors->first('nip') }}</small>
                    @endif
                </div>
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" class="form-control" value="{{ $dosen->nama }}" name="nama" placeholder="Masukan nama.." id="nama">
                    @if ($errors->has('nama'))
                        <small class="text-danger">{{ $errors->first('nama') }}</small>
                   @endif
                </div>
                <div class="form-group">
                    <label for="jk">Jenis Kelamin</label>
                    <select name="jk" id="jk" class="form-control">
                        <option value="" selected disabled>Pilih jenis kelamin..</option>
                        <option value="L" @if ($dosen->jk == 'L') selected @endif>Laki-laki</option>
                        <option value="P" @if ($dosen->jk == 'P') selected @endif>Perempuan</option>
                    </select>
                    @if ($errors->has('jk'))
                        <small class="text-danger">{{ $errors->first('jk') }}</small>
                    @endif
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <textarea name="alamat" id="alamat" cols="10" rows="5" class="form-control">{{ $dosen->alamat }}</textarea>
                    @if ($errors->first('alamat'))
                        <small class="text-danger">{{ $errors->first('alamat') }}</small>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-sm">Save changes</button>
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
                © {{ date('Y') }} <a href="https://www.creative-tim.com" class="font-weight-bold ml-1" target="_blank">SIMAK TEAM</a>
                </div>
            </div>
        </div>
    </footer>
    </div>
@endsection