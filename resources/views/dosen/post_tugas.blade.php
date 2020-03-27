@extends('layouts.master')

@section('title', 'SIMAK | Post Tugas')
    
@section('head', 'Posting Tugas')

@section('content')
<div class="container-fluid mt--8 mb-5">
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header">
                    <h3> Posting Materi atau Tugas</h3>
                </div>
                <div class="card-body">
                    <form action="/simak/dosen/uploadfile" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="jenis">Jenis Posting</label>
                                    <select name="jenis" id="jenis" class="form-control" required>
                                        <option value="">Pilih jenis postingan..</option>
                                        <option value="materi">Materi</option>
                                        <option value="tugas">Tugas</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="matkul_id">Mata Kuliah</label>
                                    <select class="form-control" name="matkul_id" id="matkul_id" required>
                                        <option value="">Pilih mata kuliah..</option>
                                        @foreach ($matkul as $m)
                                            <option value="{{$m->matkul->id}}">{{$m->matkul->matakuliah}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="deskripsi">Deskripsi</label>
                                    <textarea class="form-control" name="deskripsi" id="deskripsi" cols="30" rows="5" placeholder="Tambahkan deskripsi..." required></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="tanggal">Tenggat Waktu</label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="date" name="tanggal" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="time" name="waktu" class="form-control" required>
                                        </div>
                                    </div>                            
                                </div>
                                <div class="form-group">
                                    <label for="deskripsi">Tambahkan file?</label> 
                                    <input class="form-control" type="file" name="file" id="fileu" required>
                                    @if ($msg = $errors->first('file'))
                                        <small class="text-red">{{$msg}}</small>
                                    @endif
                                </div>
                                <div class="row">
                                    <div class="col-md">
                                        <button type="submit" class="btn btn-primary float-right">Posting</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection