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
            <h3 class="mb-0">Form Edit Dosen<a href="{{ route('dosen') }}" class="badge badge-primary float-right">kembali</a></h3>
            </div>
            <form action="{{route('dosen.update', $dosen->id)}}" method="post">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nip">NIP</label>
                            <input type="text" class="form-control" name="nip" value="{{ $dosen->nip }}" placeholder="NIP" id="nip" readonly>
                            @if ($errors->has('nip'))
                                <small class="text-danger">{{ $errors->first('nip') }}</small>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" value="{{ $dosen->nama }}" name="nama" placeholder="Masukan nama.." id="nama" required>
                            @if ($errors->has('nama'))
                                <small class="text-danger">{{ $errors->first('nama') }}</small>
                           @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="gelar_id">Gelar</label>
                            <select name="gelar_id" id="gelar_id" class="form-control" required>
                                @forelse ($gelar as $item)
                                    <option value="{{$item->id}}" @if ($dosen->gelar_id == $item->id) selected @endif>{{$item->gelar}}</option>
                                @empty
                                    <option value="" selected disabled>Belum tersedia..</option>
                                @endforelse
                            </select>
                            @if ($errors->has('gelar_id'))
                                <small class="text-danger">{{ $errors->first('gelar_id') }}</small>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="jk">Jenis Kelamin</label>
                            <select name="jk" id="jk" class="form-control" required>
                                <option value="" selected disabled>Pilih jenis kelamin..</option>
                                <option value="L" @if ($dosen->jk == 'L') selected @endif>Laki-laki</option>
                                <option value="P" @if ($dosen->jk == 'P') selected @endif>Perempuan</option>
                            </select>
                            @if ($errors->has('jk'))
                                <small class="text-danger">{{ $errors->first('jk') }}</small>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea name="alamat" id="alamat" cols="10" rows="5" class="form-control" placeholder="Masukkan alamat.." required>{{ $dosen->alamat }}</textarea>
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
