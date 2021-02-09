@extends('layouts/master')

@section('title', 'SIMAK | Dashboard')

@section('head', 'dashboard')

@section('dashboard')
    @if ($msg = Session::get('success'))
        <div class="container-fluid mt--3">
            <div class="row justify-content-center">
                <div class="col-md">
                    <div class="card mb-5">
                    <div class="card-body">
                            <h4 class="text-success">{{$msg}}.</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if ($msg = Session::get('failed'))
        <div class="container-fluid mt--3">
            <div class="row justify-content-center">
                <div class="col-md">
                    <div class="card mb-5">
                    <div class="card-body">
                            <h4 class="text-danger">{{$msg}}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection

@section('content')
    <div class="container-fluid mt--8 mb-5">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header">
                        <h3>Beranda
                            @if (auth()->user()->role != 'admin' || 'dosen')

                            @else
                                <a href="/simak/dosen/postgs" class="btn btn-primary btn-sm float-right">Posting Sesuatu..</a>
                            @endif
                        </h3>
                    </div>
                    <div class="card-body">
                        @foreach ($mt as $data)
                            <div class="row shadow" style="padding:20px; border-radius:10px;">
                                <div class="col-md-1">
                                    <img src="{{ asset('image/profile/' . $data->user->avatar) }}" style="width: 60px;" class="rounded-circle">
                                </div>
                                <div class="col-md-10">
                                    <b>{{ $data->user->name }}</b>@if ($data->user->role == 'admin') <i class="fas fa-check-circle mx-1"></i> @endif
                                    <br>
                                    <small><i>Diposting pada
                                        @php
                                            echo date("d F Y", strtotime($data->tanggal_post));
                                        @endphp</i></small><br><br>
                                    <div class="row">
                                        <div class="col-md" style="text-align:justify;">
                                            {{ $data->deskripsi }}
                                            <br><br>
                                        </div>
                                    </div>
                                    <h5><table>
                                        <tr>
                                            <td>Mata kuliah</td>
                                            <td>&nbsp;:&nbsp;&nbsp;&nbsp;</td>
                                            <td>{{ $data->matkul->matakuliah }} (Semester {{$data->semester->semester}})</td>
                                        </tr>
                                        <tr>
                                            <td>Tenggat</td>
                                            <td>&nbsp;:&nbsp;</td>
                                            @if ($data->jenis == 'Materi')
                                            <td>Tidak ada</td>
                                            @else
                                                <td>{{$data->tanggal_tenggat}} pada pukul {{$data->waktu_tenggat}}</td>
                                            @endif
                                        </tr>
                                    </table></h5>
                                    @if ($data->file == null)

                                    @else
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="card" style="border: solid 1px #f0f0ff;">
                                                    <div class="card-body">
                                                        <a href="{{asset('files/' . $data->file)}}" target="_blank" style="margin:15px;">
                                                            <i class="fas fa-file"></i>&nbsp;&nbsp;&nbsp;{{ $data->file }}
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <hr>
                        @endforeach
                    </div>
                    <hr>
                </div>
            </div>
        </div>
    </div>
@endsection
