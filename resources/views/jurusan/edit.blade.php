@extends('layouts.master')

@section('title', 'SIMAK2019 | Jurusan')

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
                @if ($errors->has('jurusan')) 
                    <div class="form-group">
                        <label for="nama">Nama jurusan</label>
                        <input type="text" class="form-control" placeholder="Masukan nama jurusan.." name="jurusan" id="jurusan" value="{{ $jurusan->jurusan }}">
                        <small class="text-danger">{{ $errors->first('jurusan') }}</small>
                    </div>
                @else
                    <div class="form-group">
                        <label for="nama">Nama jurusan</label>
                        <input type="text" class="form-control" placeholder="Masukan nama jurusan.." name="jurusan" id="jurusan" value="{{ $jurusan->jurusan }}">
                    </div>
                @endif
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-sm">Save changes</button>
                </div>
            </div>
            </form>
        </div>
        </div>
    </div>
    </div>
@endsection