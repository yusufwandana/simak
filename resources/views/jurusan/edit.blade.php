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
            <h3 class="mb-0">Edit Mata Kuliah</h3>
            </div>
            <form action="{{ route('jurusan.update', $jurusan->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group">
                    <label for="nama">Nama jurusan</label>
                    <input type="text" class="form-control" placeholder="Masukan nama mata kuliah.." name="jurusan" id="jurusan" value="{{ $jurusan->jurusan }}">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
            </form>
        </div>
        </div>
    </div>
    </div>
@endsection