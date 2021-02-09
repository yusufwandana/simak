@extends('layouts.master')

@section('title', 'SIMAK | Edit Mata Kuliah')

@section('head', 'Edit Mata Kuliah')

@section('content')
<div class="container-fluid mt--9">
    <!-- Table -->
    <div class="row justify-content-center">
        <div class="col-md-10">
        <div class="card shadow">
            <div class="card-header bg-transparent">
                <h3 class="mb-0">Edit Mata Kuliah<a href="{{ route('matkul.index') }}" class="badge badge-primary float-right">kembali</a></h3>
            </div>
            <form action="{{ route('matkul.update', $matkul->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="kode_matkul">Kode mata kuliah</label>
                            <input type="text" class="form-control" placeholder="Masukan kode mata kuliah.." name="kd_matkul" id="kd_matkul" value="{{ $matkul->kd_matkul }}" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="matakuliah">Nama mata kuliah</label>
                            <input type="text" class="form-control" placeholder="Masukan kode mata kuliah.." name="matakuliah" id="matakuliah" value="{{ $matkul->matakuliah }}">
                            @if ($errors->has('matakuliah'))<small class="text-danger">{{ $errors->first('matakuliah') }}</small>@endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="semester">Semester</label>
                            <select class="form-control" name="semester" id="semester">
                                <option value="" selected disabled>Pilih semester</option>
                                @foreach ($semesters as $semester)
                                    <option value="{{ $semester->id }}" @if ($matkul->semester->id == $semester->id) selected @endif>Semester {{ $semester->semester }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="kategori">Kategori</label>
                            <select name="kategori" id="kategori" class="form-control" required>
                                <option value="" selected disabled>Pilih kategori</option>
                                <option value="pilihan" @if ($matkul->kategori == 'pilihan') selected @endif>Pilihan</option>
                                <option value="wajib" @if ($matkul->kategori == 'wajib') selected @endif>Wajib</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="sks">Jumlah SKS</label>
                            <input type="text" class="form-control" placeholder="Masukan jumlah sks.." name="sks" id="sks" value="{{ $matkul->sks }}">
                            @if ($errors->has('sks'))<small class="text-danger">{{ $errors->first('sks') }}</small>@endif
                        </div>
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
