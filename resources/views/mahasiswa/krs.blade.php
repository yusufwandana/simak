@extends('layouts.master')

@section('title', 'SIMAK2019 | Mata Kuliah')

@section('head', 'Mata Kuliah')

@section('content')
<div class="container-fluid mt--9 mb-5">
    <div class="col">
        <div class="card shadow">
            <div class="card-header border-0">
            </div>
            <div class="table-responsive">
                <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Kode</th>
                            <th scope="col">Matkul</th>
                            <th scope="col">KRS</th>
                            <th scope="col">Semester</th>
                            <th scope="col">Kategori</th>
                            <th scope="col">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        @foreach ($matkul as $m)
                        <tr>
                            <td scope="row">
                                <div class="media align-items-center">
                                    <div class="media-body">
                                        <span class="mb-0 text-sm">
                                            {{ $no }}
                                        </span>
                                    </div>
                                </div>
                            </td><td scope="row">
                                <div class="media align-items-center">
                                    <div class="media-body">
                                        <span class="mb-0 text-sm">
                                            {{ $m->kd_matkul }}
                                        </span>
                                    </div>
                                </div>
                            </td>
                            <td scope="row">
                                <div class="media align-items-center">
                                    <div class="media-body">
                                        <span class="mb-0 text-sm">
                                            {{ $m->matakuliah }}
                                        </span>
                                    </div>
                                </div>
                            </td>
                            <td scope="row">
                                <div class="media align-items-center">
                                    <div class="media-body">
                                        <span class="mb-0 text-sm">
                                            {{ $m->sks }}
                                        </span>
                                    </div>
                                </div>
                            </td>
                            <td scope="row">
                                <div class="media align-items-center">
                                    <div class="media-body">
                                        <span class="mb-0 text-sm">
                                            {{ $m->semester->semester }}
                                        </span>
                                    </div>
                                </div>
                            </td>
                            <td scope="row">
                                <div class="media align-items-center">
                                    <div class="media-body">
                                        <span class="mb-0 text-sm">
                                            {{ $m->kategori }}
                                        </span>
                                    </div>
                                </div>
                            <td scope="row">
                                <div class="media align-items-center">
                                    <div class="media-body">
                                        <span class="mb-0 text-sm">
                                            {{ $m->keterangan }}
                                        </span>
                                    </div>
                                </div>
                            </td>
                            
                        </tr>

                        <?php $no++ ?>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection