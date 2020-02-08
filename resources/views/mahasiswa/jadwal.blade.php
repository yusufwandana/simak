@extends('layouts.master')

@section('title', 'SIMAK | Jadwal')

@section('head', 'Jadwal Mahasiswa')

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
                <h3 class="mb-0 float-left">Jadwal Mahasiswa</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Mulai</th>
                            <th scope="col">Selesai</th>
                            <th scope="col">Mata Kuliah</th>
                            <th scope="col">Dosen</th>
                            <th scope="col">Ruangan</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($jadwals as $key => $item)
                        <tr>
                            <th scope="row">
                                <div class="media align-items-center">
                                <div class="media-body">
                                    <span class="mb-0 text-sm">{{ $jadwals->firstItem() + $key }}</span>
                                </div>
                                </div>
                            </th>
                            <td scope="row">
                                <div class="media align-items-center">
                                    <div class="media-body">
                                        <span class="mb-0 text-sm">
                                        @php
                                            $a = explode('-', $item->tanggal);
                                            echo "$a[2]/$a[1]/$a[0]";
                                        @endphp
                                        </span>
                                    </div>
                                </div>
                            </td>
                            <td scope="row">{{ $item->waktu }}</td>
                            <td scope="row">END</td>
                            <td scope="row">{{ $item->matkul->matakuliah }}</td>
                            <td scope="row">{{ $item->dosen->nama }}</td>
                            <td scope="row">{{ $item->ruangan->ruangan }}</td>
                        </tr>   
                        @endforeach 
                        </tbody>
                    </table>
                    </div>
                </div>
                <div class="card-footer py-4">
                    
                </div>
            </div>
        </div>
    </div>
@endsection
