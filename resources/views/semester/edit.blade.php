@extends('layouts.master')

@section('title', 'SIMAK | Edit Semester')

@section('head', 'Edit semester')

@section('content')
<div class="container-fluid mt--9">
    <!-- Table -->
    <div class="row justify-content-center">
        <div class="col-md-10">
        <div class="card shadow">
            <div class="card-header bg-transparent">
            <h3 class="mb-0">Edit Semester</h3>
            </div>
            <form action="{{ route('semester.update', $semester->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group">
                    <label for="semester">Semester</label>
                    <input type="text" class="form-control" placeholder="Masukan nama semester.." name="semester" id="semester" value="{{ $semester->semester }}">
                    @if ($errors->has('semester'))
                        <small class="text-danger">{{ $errors->first('semester') }}</small>
                    @endif
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