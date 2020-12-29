@extends('layouts.master')

@section('title', 'SIMAK | Edit Mahasiswa')

@section('head', 'Edit Mahasiswa')

@section('content')
<div class="container-fluid mt--9">
    <!-- Table -->
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card shadow mb-5">
                <div class="card-header bg-transparent">
                    <h3 class="mb-0">Edit Mahasiswa<a href="{{ route('mahasiswa.index') }}" class="badge badge-primary float-right">kembali</a></h3>
                </div>
                <form action="{{ route('mahasiswa.update', $mahasiswa->id) }}" method="post">
                @csrf
                @method('PUT')
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nim">NIM</label>
                                    <input type="text" class="form-control" placeholder="Masukan NIM.." name="nim" id="nim" value="{{ $mahasiswa->nim }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama">Nama mahasiswa</label>
                                    <input type="text" class="form-control" placeholder="Masukan nama.." name="nama" id="nama" value="{{ $mahasiswa->nama }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="jk">Jenis Kelamin</label>
                                    <select name="jk" id="jk" class="form-control" required>
                                        <option value="" selected disabled>Pilih jenis kelamin..</option>
                                        <option value="L" @if ($mahasiswa->jk == 'L') selected @endif>Laki-laki</option>
                                        <option value="P" @if ($mahasiswa->jk == 'P') selected @endif>Perempuan</option>
                                    </select>
                                    @if ($errors->has('jk'))
                                        <small class="text-danger">{{ $errors->first('jk') }}</small>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="semester">Semester</label>
                                    <select name="semester" id="semester" class="form-control" required>
                                        <option value="" selected disabled>Pilih semester..</option>
                                        @foreach ($semester as $s)
                                            <option value="{{ $s->id }}" @if ($s->id == $mahasiswa->semester_id) selected @endif>Semester {{ $s->semester }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="jurusan">Jurusan</label>
                                    <select name="jurusan" id="jurusan" class="form-control" required>
                                        <option value="" selected disabled>Pilih jurusan..</option>
                                        @foreach ($jurusan as $j)
                                            <option value="{{ $j->id }}" @if ($j->id == $mahasiswa->jurusan_id) selected @endif>{{ $j->jurusan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <textarea name="alamat" id="alamat" cols="10" rows="5" class="form-control" required>{{ $mahasiswa->alamat }}</textarea>
                                    @if ($errors->first('alamat'))
                                        <small class="text-danger">{{ $errors->first('alamat') }}</small>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Footer -->
    @include('layouts.includes._footer')
    </div>
@endsection
