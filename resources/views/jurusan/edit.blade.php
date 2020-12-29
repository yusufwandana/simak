@extends('layouts.master')

@section('title', 'SIMAK | Jurusan')

@section('head', 'Edit Jurusan')

@section('content')
<div class="container-fluid mt--9">
    <!-- Table -->
    <div class="row justify-content-center">
        <div class="col-md-10">
        <div class="card shadow">
            <div class="card-header bg-transparent">
            <h3 class="mb-0 float-left">Edit Jurusan</h3>
            <a href="{{ route('jurusan.index') }}" class="badge badge-warning float-right mx-3">kembali</a>
            </div>
            <form action="{{ route('jurusan.update', $jurusan->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nama">Nama jurusan sebelumnya</label>
                            <input type="text" class="form-control" value="{{ $jurusan->jurusan }}" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nama">Nama jurusan baru</label>
                            <input type="text" class="form-control" placeholder="Masukan nama baru.." name="jurusan" id="jurusan" required>
                            @if ($errors->has('jurusan'))
                                <small class="text-danger">{{ $errors->first('jurusan') }}</small>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
            </form>
        </div>
        </div>
    </div>
    </div>
@endsection
