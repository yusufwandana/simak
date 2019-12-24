@extends('layouts.master')

@section('title', 'SIMAK2019 | Edit Ruangan')

@section('head', 'Edit Ruangan')

@section('content')
<div class="container-fluid mt--9">
    <!-- Table -->
    <div class="row justify-content-center">
        <div class="col-md-10">
        <div class="card shadow">
            <div class="card-header bg-transparent">
            <h3 class="mb-0">Edit Ruangan</h3>
            </div>
            <form action="{{ route('ruangan.update', $ruangan->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group">
                    <label for="nama">Nama Ruangan</label>
                    <input type="text" class="form-control" placeholder="Masukan nama ruangan.." name="ruangan" id="ruangan" value="{{ $ruangan->ruangan }}" required>
                </div>
                <div class="form-group">
                    @if ($errors->has('jenis'))
                        <label for="jenis">Jenis Ruangan</label>
                        <select name="jenis" id="jenis" class="form-control">
                            <option value="" selected disabled>Pilih jenis ruangan..</option>
                            <option value="Kelas" @if ($ruangan->jenis == 'Kelas') selected @endif>Kelas</option>
                            <option value="Lab.Komputer" @if ($ruangan->jenis == 'Lab.Komputer') selected @endif>Lab.Komputer</option>
                            <small class="text-danger">{{ $errors->first('jenis') }}</small>
                        </select>
                    @else
                        <label for="jenis">jenis</label>
                        <select name="jenis" id="jenis" class="form-control">
                            <option value="" selected disabled>Pilih jenis ruangan..</option>
                            <option value="Kelas" @if ($ruangan->jenis == 'Kelas') selected @endif>Ruang Kelas</option>
                            <option value="Lab.Komputer" @if ($ruangan->jenis == 'Lab.Komputer') selected @endif>Ruang Praktik</option>
                        </select>
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
    </div>
@endsection