@extends('layouts.master')

@section('head', 'Kehadiran')

@section('title', 'SIMAK2019 | Kehadiran')

@section('content')
<div class="container-fluid mt--9 mb-5">
    <div class="row">
        <div class="col-md-6">
            <div class="card card-stats mb-4 mb-xl-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">Jumlah Hadir</h5>
                            <span class="h2 font-weight-bold mb-0">{{ $hadir }}</span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                <i class="fas fa-user-check"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card card-stats mb-4 mb-xl-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">Jumlah Tidak Hadir</h5>
                            <span class="h2 font-weight-bold mb-0">
                                {{ $absen }}
                            </span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                <i class="fas fa-user-alt-slash"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md">
            <div class="card shadow col-md">
                <div class="card-header">
                    @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-sm alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h5 class="text-white">{{ $message }}</h5>
                    </div>
                    @endif
                <h3 class="mb-0">Kehadiran</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md">
                            <div class="table-responsive">
                                <table class="table align-items-center table-flush" id="ini_table">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Tanggal</th>
                                            <th scope="col">Dosen</th>
                                            <th scope="col">Mata kuliah</th>
                                            <th scope="col">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1; ?>
                                        @forelse ($kehadiran as $item)
                                            <tr>
                                                <td scope="row">
                                                    <div class="media align-items-center">
                                                        <div class="media-body">
                                                            <span class="mb-0 text-sm">
                                                                {{$no}}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td scope="row">
                                                    <div class="media align-items-center">
                                                        <div class="media-body">
                                                            <span class="mb-0 text-sm">
                                                                {{$item->tanggal}}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td scope="row">
                                                    <div class="media align-items-center">
                                                        <div class="media-body">
                                                            <span class="mb-0 text-sm">{{$item->dosen->nama}} {{$item->dosen->gelar->singkatan}}</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td scope="row">
                                                    <div class="media align-items-center">
                                                        <div class="media-body">
                                                            <span class="mb-0 text-sm">{{$item->matkul->matakuliah}}</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td scope="row">
                                                    <div class="media align-items-center">
                                                        <div class="media-body">
                                                            @if ($item->status == '1')
                                                                <span class="mb-0 text-sm text-success">Hadir</span>
                                                            @elseif($item->status == '2')
                                                                <span class="mb-0 text-sm text-danger">Sakit</span>
                                                            @elseif($item->status == '3')
                                                                <span class="mb-0 text-sm text-danger">Izin</span>
                                                            @elseif($item->status == '4')
                                                                <span class="mb-0 text-sm text-danger">Kerja</span>
                                                            @else
                                                                <span class="mb-0 text-sm text-danger">Alfa</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php $no++ ?>
                                        @empty

                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('customjs')
    <script>
      $('#ini_table').dataTable({
        paging:false,
        info: true
      });
        $('#ini_table_wrapper .row  .col-sm-12').removeClass('col-md-6');
        $('#ini_table_wrapper .row  .col-sm-12 #ini_table_filter label').addClass('pb-2');
    </script>
@endsection
