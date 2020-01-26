@extends('layouts.master')

@section('title', 'SIMAK | Ruangan')

@section('head', 'Ruangan')

@section('content')
<div class="container-fluid mt--9 mb-5">
<div class="col">
    <div class="card shadow">
        <div class="card-header">
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
        <h3 class="mb-0 float-left">Daftar Ruangan</h3>
        <a href="" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#exampleModal"><i class="ni ni-fat-add"></i>Tambah</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
            <table class="table align-items-center table-flush">
                <thead class="thead-light">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Ruangan</th>
                    <th scope="col">Jenis</th>
                    <th scope="col">Aksi</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($ruangans as $ruangan)
                <tr>
                    <th scope="row">
                        <div class="media align-items-center">
                        <div class="media-body">
                            <span class="mb-0 text-sm">{{ $ruangan->id }}</span>
                        </div>
                        </div>
                    </th>
                    <td scope="row">
                        <div class="media align-items-center">
                        <div class="media-body">
                            <span class="mb-0 text-sm">
                            {{ $ruangan->ruangan }}
                            </span>
                        </div>
                        </div>
                    </td>
                    <td scope="row">
                        <div class="media align-items-center">
                        <div class="media-body">
                            <span class="mb-0 text-sm">
                            {{ $ruangan->jenis }}
                            </span>
                        </div>
                        </div>
                    </td>
                    <td scope="row">
                        <form action="{{ route('ruangan.destroy', $ruangan->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <a class="btn btn-info btn-sm" href="{{ route('ruangan.edit', $ruangan->id) }}"><i class="fa fa-cog"></i></a>
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin akan menghapus data ini?')" href="{{ route('ruangan.destroy', $ruangan->id) }}"><i class="fa fa-trash"></i></button>
                        </form>
                    </td>
                </tr>    
                @endforeach
                </tbody>
            </table>
            </div>
        </div>
        <div class="card-footer py-4">
            {{ $ruangans->links() }}
        </div>
    </div>
    </div>
</div>


{{-- Modal --}}
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{ route('ruangan.store') }}" method="post">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">
                        Tambah Ruangan
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        @if ($errors->has('ruangan'))
                            <label for="ruangan">Nama Ruangan</label>
                            <input type="text" class="form-control" placeholder="Masukan nama ruangan.." name="ruangan" id="ruangan" required>
                            <small class="text-danger">{{ $errors->first('ruangan') }}</small>
                        @else
                            <label for="ruangan">Nama Ruangan</label>
                            <input type="text" class="form-control" placeholder="Masukan nama ruangan.." name="ruangan" id="ruangan">
                        @endif
                    </div>
                    <div class="form-group">
                        @if ($errors->has('jenis'))
                            <label for="jenis">Jenis Ruangan</label>
                            <select name="jenis" id="jenis" class="form-control">
                                <option value="" selected disabled>Pilih jenis ruangan..</option>
                                <option value="Kelas">Kelas</option>
                                <option value="Lab.Komputer">Lab.Komputer</option>
                                <small class="text-danger">{{ $errors->first('jenis') }}</small>
                            </select>
                        @else
                            <label for="jenis">jenis</label>
                            <select name="jenis" id="jenis" class="form-control" required>
                                <option value="" selected disabled>Pilih jenis ruangan..</option>
                                <option value="Kelas">Ruang Kelas</option>
                                <option value="Lab.Komputer">Ruang Praktik</option>
                            </select>
                        @endif
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm float-right">Save changes</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection