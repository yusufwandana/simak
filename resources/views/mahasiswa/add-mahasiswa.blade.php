@extends('layouts.master')

@section('title', 'SIMAK | Tambah Mahasiswa')

@section('head', 'Tambah Data mahasiswa')

@section('content')
<div class="container-fluid mt--9">
    <!-- Table -->
    <div class="row justify-content-center">
        <div class="col-md-11">
        <div class="card shadow">
            <div class="card-header bg-transparent">
            <h3 class="mb-0">Form Tambah Mahasiswa <a href="{{URL::previous()}}" class="badge badge-primary float-right">kembali</a></h3>
            </div>
            <form action="{{route('mahasiswa.store')}}" method="post">
            @csrf
            <input type="hidden" name="tahun_masuk" id="tahun_masuk" value="{{ date('Y') }}">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nim">NIM</label>
                            <input type="number" class="form-control" name="nim" placeholder="Masukan nim.." id="nim" value="{{ old('nim') }}">
                            @if ($errors->has('nim'))
                                <small class="text-danger">{{ $errors->first('nim') }}</small>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nama">Nama lengkap</label>
                            <input type="text" class="form-control" name="nama" placeholder="Masukan nama.." id="nama" value="{{ old('nama') }}">
                            @if ($errors->has('nama'))
                                <small class="text-danger">{{ $errors->first('nama') }}</small>
                           @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" placeholder="Masukan email.." id="email" value="{{old('email')}}" required>
                            @if ($errors->has('email'))
                                <small class="text-danger">{{ $errors->first('email') }}</small>
                           @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="jk">Jenis Kelamin</label>
                            <select name="jk" id="jk" class="form-control" required>
                                <option value="" selected disabled>Pilih jenis kelamin..</option>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                            @if ($errors->has('jk'))
                                <small class="text-danger">{{ $errors->first('jk') }}</small>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="semester">Semester</label>
                            <select class="form-control" name="semester" id="semester" required>
                                <option value="">Pilih semester..</option>
                                @foreach ($semester as $s)
                                    <option value="{{ $s->id }}">Semester {{ $s->semester }}</option>
                                @endforeach
                            </select>
                            @if ($errors->first('semester'))
                                <small class="text-danger">{{ $errors->first('semester') }}</small>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="jurusan">Jurusan</label>
                            <select class="form-control" name="jurusan" id="jurusan" required>
                                <option value="">Pilih jurusan..</option>
                                @foreach ($jurusan as $s)
                                    <option value="{{ $s->id }}">{{ $s->jurusan }}</option>
                                @endforeach
                            </select>
                            @if ($errors->first('jurusan'))
                                <small class="text-danger">{{ $errors->first('jurusan') }}</small>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea name="alamat" id="alamat" cols="10" rows="5" class="form-control" placeholder="Masukkan alamat.." required>{{old('alamat')}}</textarea>
                            @if ($errors->first('alamat'))
                                <small class="text-danger">{{ $errors->first('alamat') }}</small>
                            @endif
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
    @include('layouts.includes._footer')
</div>
@endsection
