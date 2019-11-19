@extends('layouts/master')

@section('title', 'SIMAK2019 | Dashboard')

@section('head', 'dashboard')

@section('content')
    <div class="container-fluid mt--9 mb-5">
        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-sm alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            <h4 class="text-white">{{ $message }}</h4>
        </div>
        @endif
        @if ($message = Session::get('failed'))
        <div class="alert alert-danger alert-sm alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            <h4 class="text-white">{{ $message }}</h4>
        </div>
        @endif
    </div>
@endsection