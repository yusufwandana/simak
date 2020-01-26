@extends('layouts.master')

@section('title', 'SIMAK | Lihat Jadwal')

@section('head', 'Lihat Jadwal')

@section('content')
<div class="container-fluid mt--9 mb-5">
    <div class="row mb-3">
        <div class="col">
            <div class="card shadow">
                <div class="card-header">
                @if ($message = Session::get('success'))
                <div class="alert alert-success alert-sm alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h5 class="text-white">{{ $message }}</h5>
                </div>
                @endif
                @if ($message = Session::get('failed'))
                <div class="alert alert-danger alert-sm alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h5 class="text-white">{{ $message }}</h5>
                </div>
                @endif
                <h3 class="mb-0 float-left">Jadwal Kuliah</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush" id="data-table">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Waktu</th>
                                    <th scope="col">Matkul</th>
                                    <th scope="col">Semester</th>
                                    <th scope="col">Ruangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($jadwal as $key => $j)
                                    <tr>
                                        <td scope="row">
                                            <div class="media align-items-center">
                                                <div class="media-body">
                                                <span class="mb-0 text-sm">{{ $jadwal->firstItem() + $key }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td scope="row">
                                            <div class="media align-items-center">
                                                <div class="media-body">
                                                <span class="mb-0 text-sm">
                                                    {{ $j->tanggal }}
                                                </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td scope="row">
                                            <div class="media align-items-center">
                                                <div class="media-body">
                                                <span class="mb-0 text-sm">
                                                    {{ $j->waktu }}
                                                </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td scope="row">
                                            <div class="media align-items-center">
                                                <div class="media-body">
                                                <span class="mb-0 text-sm">
                                                    {{ $j->matkul->matakuliah }}
                                                </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td scope="row">
                                            <div class="media align-items-center">
                                                <div class="media-body">
                                                    <span class="mb-0 text-sm">
                                                        Semester {{ $j->semester->semester }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td scope="row">
                                            <div class="media align-items-center">
                                                <div class="media-body">
                                                    <span class="mb-0 text-sm">
                                                        {{ $j->ruangan->ruangan }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('customjs')
    <script>
      $(document).ready(function(){
        $('#data-table').dataTable({
          paging:false,
          info:false
        });

        $('#data-table_wrapper .row .col-sm-12').removeClass('col-md-6');
        $('#data-table_wrapper .row .col-sm-12 #data-table_filter label').addClass('pb-2');
      });
    </script>
@endsection