@extends('layouts.master')

@section('title', 'SIMAK | Posting Materi & Tugas')

@section('head', 'Form Posting')

@section('content')
<div class="container-fluid mt--8 mb-5">
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header">
                    <h3> Posting Materi dan Penugasan</h3>
                </div>
                <div class="card-body">
                    <form action="{{route('uploadfile')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="jenis">Jenis Posting</label>
                                    <select name="jenis" id="jenis" class="form-control" required>
                                        @if (old('jenis') == null)
                                            <option value="">Pilih jenis postingan..</option>
                                        @else
                                            <option value="{{old('jenis')}}" selected>{{old('jenis')}}</option>
                                        @endif
                                        <option value="Materi">Materi</option>
                                        <option value="Tugas">Tugas</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="matkul_id">Mata Kuliah</label>
                                    <select class="form-control" name="matkul_id" id="matkul_id" required>
                                        <option value="">Pilih mata kuliah..</option>
                                        @if (auth()->user()->role == 'dosen')
                                            @foreach ($matkul as $m)
                                                <option value="{{$m->matkul->id}}">{{$m->matkul->matakuliah}}</option>
                                            @endforeach
                                        @elseif(auth()->user()->role == 'admin')
                                            @foreach ($matkul as $m)
                                                <option value="{{$m->id}}">{{$m->matakuliah}}</option>
                                            @endforeach

                                        @endif
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="deskripsi">Deskripsi</label>
                                    <textarea class="form-control" name="deskripsi" id="deskripsi" cols="30" rows="5" placeholder="Tambahkan deskripsi..." required>{{old('deskripsi')}}</textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div id="tenggat">
                                    <label for="tanggal">Tenggat Waktu</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="date" name="tanggal" id="tanggal" class="form-control" value="{{old('tanggal')}}">
                                                <small class="text-danger">{{$errors->first('tanggal')}}</small>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="time" name="waktu" id="waktu" class="form-control" value="{{old('waktu')}}">
                                                <small class="text-danger">{{$errors->first('waktu')}}</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="deskripsi">Tambahkan file? <small>(optional)</small></label>
                                    <input class="form-control" type="file" name="file" id="fileu">
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

@section('customjs')
    <script type="text/javascript">
        $(document).ready(function(){
            $('body').on('change','#jenis', function(){
                if ($(this).val() == 'Materi') {
                    $('#tenggat').hide();
                    $('#tanggal').removeAttr('required','required');
                    $('#waktu').removeAttr('required','required');
                }else{
                    $('#tenggat').show();
                    $('#tanggal').attr('required','required');
                    $('#waktu').attr('required','required');
                }
            });
        });
    </script>
@endsection
