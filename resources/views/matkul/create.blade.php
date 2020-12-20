@extends('layouts.master')

@section('title', 'SIMAK | Mata Kuliah')

@section('head', 'Mata Kuliah')

@section('content')
<div class="container-fluid mt--9 mb-5">
<div class="col">
    <form action="{{ route('matkul.store') }}" method="post">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">
                        Tambah Mata Kuliah
                    </h4>
                    <a href="{{URL::previous()}}" class="badge badge-primary">Kembali</a>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md">
                            @if ($errors->all())
                            <div class="alert alert-danger alert-sm alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                <h5 class="text-white">Terdapat kesalahan pada saat input, mohon cek kembali!</h5>
                            </div>
                            @endif
                        
                            @if ($message = Session::get('success'))
                            <div class="alert alert-success alert-sm alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                <h5 class="text-white">{{ $message }}</h5>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="kd_matkul">Kode mata kuliah</label>
                                <input type="text" class="form-control" placeholder="Masukan kode mata kuliah.." name="kd_matkul" id="kd_matkul" value="{{ old('kd_matkul') }}">
                                @if ($errors->has('kd_matkul'))<small class="text-danger">{{ $errors->first('kd_matkul') }}</small>@endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="matakuliah">Nama mata kuliah</label>
                                <input type="text" class="form-control" placeholder="Masukan nama mata kuliah.." name="matakuliah" id="matakuliah" value="{{ old('matakuliah') }}">
                                @if ($errors->has('matakuliah'))<small class="text-danger">{{ $errors->first('matakuliah') }}</small>@endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="semester">Semester</label>
                                <select class="form-control" name="semester" id="semester">
                                    <option value="" selected disabled>Pilih semester</option>
                                    @foreach ($semester as $item)
                                        <option value="{{ $item->id }}">Semester {{ $item->semester }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('semester'))<small class="text-danger">{{ $errors->first('semester') }}</small>@endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="kategori">Kategori</label>
                                <select name="kategori" id="kategori" class="form-control">
                                    <option value="" selected disabled>Pilih kategori</option>
                                    <option value="pilihan">Pilihan</option>
                                    <option value="wajib">Wajib</option>
                                </select>
                                @if ($errors->has('kategori'))<small class="text-danger">{{ $errors->first('kategori') }}</small>@endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="sks">Jumlah SKS</label>
                                <input type="text" class="form-control" placeholder="Masukan jumlah SKS.." name="sks" id="sks" value="{{ old('sks') }}">
                                @if ($errors->has('sks'))<small class="text-danger">{{ $errors->first('sks') }}</small>@endif
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary float-left">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>


{{-- Modal --}}
{{-- <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        
    </div>
</div> --}}
@endsection

@section('customjs')
    <script>
        $('#ini_table').dataTable({
            paging: false,
            info: false
        });

        $('#ini_table_wrapper .row  .col-sm-12').removeClass('col-md-6');
        $('#ini_table_wrapper .row  .col-sm-12 #ini_table_filter label').addClass('pb-2');
    </script>
@endsection