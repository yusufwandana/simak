@extends('layouts.master')

@section('head', 'Mahasiswa')

@section('title', 'SIMAK | Mahasiswa')

@section('content')
<div class="container-fluid mt--9 mb-5">
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header">
                @if ($errors->all())
                    <div class="alert alert-danger alert-sm alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h5 class="text-white">Terdapat kesalahan pada saat input, mohon cek kembali!</h5>
                    </div>
                    @endif
                    <h3 class="mb-0 float-left">Daftar Mahasiswa</h3>
                    <a href="{{route('mahasiswa.create')}}" class="btn btn-primary btn-sm float-right"><i class="ni ni-fat-add"></i>Tambah</a>
                </div>
                <div class="card-body">
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
                <div class="table-responsive">
                    <table class="table align-items-center table-flush" id="ini_table">
                    <thead class="thead-light">
                        <tr>
                        <th scope="col">No</th>
                        <th scope="col">NIM</th>
                        <th scope="col">Nama lengkap</th>
                        <th scope="col">Jurusan</th>
                        <th scope="col">Semester</th>
                        <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($mahasiswa as $key => $mhs)
                        <tr>
                            <th scope="row">
                            <div class="media align-items-center">
                                <div class="media-body">
                                <span class="mb-0 text-sm">{{ $mahasiswa->firstItem() + $key }}</span>
                                </div>
                            </div>
                            </th>
                            <th scope="row">
                            <div class="media align-items-center">
                                <div class="media-body">
                                <span class="mb-0 text-sm">{{ $mhs->nim }}</span>
                                </div>
                            </div>
                            </th>
                            <td scope="row">
                            <div class="media align-items-center">
                                <div class="media-body">
                                <span class="mb-0 text-sm">
                                    {{ $mhs->nama }}
                                </span>
                                </div>
                            </div>
                            </td>
                            <td scope="row">
                                <div class="media align-items-center">
                                <div class="media-body">
                                    <span class="mb-0 text-sm">{{ $mhs->jurusan->jurusan }}</span>
                                </div>
                                </div>
                            </td>
                            <td scope="row">
                                <div class="media align-items-center">
                                <div class="media-body">
                                    <span class="mb-0 text-sm">Semester {{ $mhs->semester->semester }}</span>
                                </div>
                                </div>
                            </td>
                            <td>
                                <a class="btn btn-sm" href="{{route('mahasiswa.profile', $mhs->id)}}"><i class="ni ni-circle-08 text-info"></i> Profil</a>
                                <a class="btn btn-sm" href="{{route('mahasiswa.edit', $mhs->id)}}"><i class="fa fa-cog text-dark"></i> Edit</a>
                                <a class="btn btn-sm" href="{{route('mahasiswa.destroy', $mhs->id)}}" onclick="return confirm('Anda yakin akan menghapus data ini?')"><i class="fa fa-trash text-red"></i> Hapus</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    </table>
                </div>
                </div>
                <div class="card-footer py-4">
                {{ $mahasiswa->links() }}
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
