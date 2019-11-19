@extends('layouts.master')

@section('title', 'SIMAK2019 | Mata Kuliah')

@section('head', 'Mata Kuliah')

@section('content')
<div class="container-fluid mt--9 mb-5">
<div class="col">
    <div class="card shadow">
        <div class="card-header border-0">
        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-sm alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            <h4 class="text-white">{{ $message }}</h4>
        </div>
        @endif
        <h3 class="mb-0 float-left">Daftar Mata Kuliah</h3>
        <a href="" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#exampleModal"><i class="ni ni-fat-add"></i>Tambah</a>
        </div>
        <div class="table-responsive">
        <table class="table align-items-center table-flush">
            <thead class="thead-light">
            <tr>
                <th scope="col">No</th>
                <th scope="col">Mata Kuliah</th>
                <th scope="col">Semester</th>
                <th scope="col">Aksi</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($matkuls as $matkul)
            <tr>
                <th scope="row">
                    <div class="media align-items-center">
                    <div class="media-body">
                        <span class="mb-0 text-sm">{{ $matkul->id }}</span>
                    </div>
                    </div>
                </th>
                <td scope="row">
                    <div class="media align-items-center">
                    <div class="media-body">
                        <span class="mb-0 text-sm">
                        {{ $matkul->matakuliah }}
                        </span>
                    </div>
                    </div>
                </td>
                <td scope="row">
                    Semester {{ $matkul->semester->semester }}
                </td>
                <td scope="row">
                    <form action="{{ route('matkul.destroy', $matkul->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <a class="btn btn-info btn-sm" href="{{ route('matkul.edit', $matkul->id) }}"><i class="fa fa-cog"></i></a>
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin akan menghapus data ini?')" href="{{ route('matkul.destroy', $matkul->id) }}"><i class="fa fa-trash"></i></button>
                    </form>
                </td>
            </tr>    
            @endforeach
            </tbody>
        </table>
        </div>
        <div class="card-footer py-4">
            {{ $matkuls->links() }}
        </div>
    </div>
    </div>
</div>


{{-- Modal --}}
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{ route('matkul.store') }}" method="post">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">
                        Tambah Mata Kuliah
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="matkul">Nama mata kuliah</label>
                        <input type="text" class="form-control" placeholder="Masukan nama mata kuliah.." name="matakuliah" id="matakuliah">
                    </div>
                    <div class="form-group">
                        <label for="semester">Semester</label>
                        <select class="form-control" name="semester" id="semester">
                            <option value="" selected disabled>Pilih semester</option>
                            @foreach ($semesters as $semester)
                                <option value="{{ $semester->id }}">Semester {{ $semester->semester }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm float-right">Save changes</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection