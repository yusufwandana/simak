@extends('layouts.master')

@section('title', 'SIMAK2019 | Edit Ruangan')

@section('head', 'Edit Ruangan')

@section('content')
<div class="container-fluid mt--9">
    <!-- Table -->
    <div class="row justify-content-center">
        <div class="col-md-10">
        <div class="card shadow">
            <div class="card-header bg-transparent">
            <h3 class="mb-0">Edit Ruangan</h3>
            </div>
            <form action="{{ route('ruangan.update', $ruangan->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group">
                    <label for="nama">Nama Ruangan</label>
                    <input type="text" class="form-control" placeholder="Masukan nama ruangan.." name="ruangan" id="ruangan" value="{{ $ruangan->ruangan }}">
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