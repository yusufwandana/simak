@extends('layouts.master')

@section('title', 'SIMAK2019 | Semester')

@section('head', 'Semester')

@section('content')
<div class="container-fluid mt--9 mb-5">
    <div class="col">
        <div class="card shadow">
            <div class="card-header border-0">
            @if ($message = Session::get('success'))
            <div class="alert alert-success alert-sm alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h5 class="text-white">{{ $message }}</h5>
            </div>
            @endif
            <h3 class="mb-0 float-left">Daftar Semester</h3>
            <a href="" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#exampleModal"><i class="ni ni-fat-add"></i>Tambah</a>
            </div>
            <div class="table-responsive">
            <table class="table align-items-center table-flush">
                <thead class="thead-light">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Semester</th>
                    <th scope="col">Aksi</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($semesters as $semester)
                <tr>
                    <th scope="row">
                        <div class="media align-items-center">
                        <div class="media-body">
                            <span class="mb-0 text-sm">{{ $semester->id }}</span>
                        </div>
                        </div>
                    </th>
                    <td scope="row">
                        <div class="media align-items-center">
                        <div class="media-body">
                            <span class="mb-0 text-sm">
                            Semester {{ $semester->semester }}
                            </span>
                        </div>
                        </div>
                    </td>
                    <td scope="row">
                        <form action="{{ route('semester.destroy', $semester->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <a class="btn btn-info btn-sm" href="{{ route('semester.edit', $semester->id) }}"><i class="fa fa-cog"></i></a>
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin akan menghapus data ini?')" href="{{ route('semester.destroy', $semester->id) }}"><i class="fa fa-trash"></i></button>
                        </form>
                    </td>
                </tr>    
                @endforeach
                </tbody>
            </table>
            </div>
            <div class="card-footer py-4">
                {{ $semesters->links() }}
            </div>
        </div>
    </div>
</div>


{{-- Modal --}}
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{ route('semester.store') }}" method="post">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="exampleModalLabel">
                            Tambah Semester
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            @if ($errors->has('semester'))
                                <label for="semester">Nama Semester</label>
                                <input type="text" class="form-control" placeholder="Masukan nama semester.." name="semester" id="semester" autofocus>
                                <small class="text-danger">{{ $errors->first('semester') }}</small>
                            @else
                                <label for="semester">Nama Semester</label>
                                <input type="text" class="form-control" placeholder="Masukan nama semester.." name="semester" id="semester" autofocus>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm float-right">Save changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection