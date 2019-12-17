@extends('layouts.master')

@section('title', 'SIMAK2019 | Edit Mata Kuliah')

@section('head', 'Edit Mata Kuliah')

@section('content')
<div class="container-fluid mt--9">
    <!-- Table -->
    <div class="row justify-content-center">
        <div class="col-md-10">
        <div class="card shadow">
            <div class="card-header bg-transparent">
            <h3 class="mb-0">Edit Mata Kuliah</h3>
            </div>
            <form action="{{ route('matkul.update', $matkul->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group">
                    <label for="kode_matkul">Kode mata kuliah</label>
                    <input type="text" class="form-control" placeholder="Masukan kode mata kuliah.." name="kode_matkul" id="kode_matkul" value="{{ $matkul->kd_matkul }}">
                </div>
                <div class="form-group">
                    <label for="mata_kuliah">Nama mata kuliah</label>
                    <input type="text" class="form-control" placeholder="Masukan kode mata kuliah.." name="mata_kuliah" id="mata_kuliah" value="{{ $matkul->matakuliah }}">
                </div>
                <div class="form-group">
                    <label for="semester">Semester</label>
                    <select class="form-control" name="semester" id="semester">
                        <option value="" selected disabled>Pilih semester</option>
                        @foreach ($semesters as $semester)
                            <option value="{{ $semester->id }}" @if ($matkul->semester->id == $semester->id) selected @endif>Semester {{ $semester->semester }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="sks">Jumlah SKS</label>
                    <input type="text" class="form-control" placeholder="Masukan jumlah sks.." name="sks" id="sks" value="{{ $matkul->sks }}">
                </div>
                <div class="form-group">
                    <label for="kategori">Kategori</label>
                    <select name="kategori" id="kategori" class="form-control">
                        <option value="" selected disabled>Pilih kategori</option>
                        <option value="pilihan" @if ($matkul->kategori == 'pilihan') selected @endif>Pilihan</option>
                        <option value="wajib" @if ($matkul->kategori == 'wajib') selected @endif>Wajib</option>
                    </select>
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