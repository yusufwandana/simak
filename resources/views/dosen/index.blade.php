@extends('layouts.master')

@section('head', 'dosen')

@section('title', 'SIMAK | Dosen')

@section('content')
<div class="container-fluid mt--9 mb-5">
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-sm alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h5 class="text-white">{{ $message }}</h5>
                    </div>
                @endif
                @if ($errors->all())
                    <div class="alert alert-danger alert-sm alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h5 class="text-white">Terdapat kesalahan pada saat input, mohon cek kembali!</h5>
                    </div>
                @endif
                <h3 class="mb-0 float-left">Daftar Dosen</h3>
                <a href="{{route('addDosen')}}" class="btn btn-primary btn-sm float-right"><i class="ni ni-fat-add"></i>Tambah</a>
                </div>
                <div class="card-body">
                <div class="table-responsive">
                    <table class="table align-items-center table-flush" id="data-table">
                    <thead class="thead-light">
                        <tr>
                        <th scope="col">No</th>
                        <th scope="col">NIP</th>
                        <th scope="col">Nama lengkap</th>
                        <th scope="col">Email</th>
                        <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dosens as $key => $dosen)
                        <tr>
                            <td scope="row">
                            <div class="media align-items-center">
                                <div class="media-body">
                                <span class="mb-0 text-sm">{{ $dosens->firstItem() + $key }}</span>
                                </div>
                            </div>
                            </td>
                            <th scope="row">
                            <div class="media align-items-center">
                                <div class="media-body">
                                <span class="mb-0 text-sm">{{ $dosen->nip }}</span>
                                </div>
                            </div>
                            </th>
                            <td scope="row">
                            <div class="media align-items-center">
                                <div class="media-body">
                                <span class="mb-0 text-sm">
                                    {{ $dosen->nama }} {{$dosen->gelar->singkatan}}
                                </span>
                                </div>
                            </div>
                            </td>
                            <td scope="row">
                                <div class="media align-items-center">
                                <div class="media-body">
                                    <span class="mb-0 text-sm">
                                    {{ $dosen->user->email }}
                                    </span>
                                </div>
                                </div>
                            </td>
                            <td>
                                <form action="" method="post">
                                    @csrf
                                    {{-- @method('delete') --}}
                                    <a class="btn btn-sm" href="{{route('profile', $dosen->id)}}"><i class="ni ni-circle-08 text-info"></i> Profil</a>
                                    <a class="btn btn-sm" href="{{route('dosen.edit', $dosen->id)}}"><i class="fa fa-cog text-dark"></i> Edit</a>
                                    <a class="btn btn-sm" onclick="return confirm('Anda yakin akan menghapus data ini?')" href="{{ route('dosen.delete', $dosen->id) }}"><i class="fa fa-trash text-red"></i> Hapus</a>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    </table>
                </div>
                </div>
                <div class="card-footer py-4">
                {{ $dosens->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

  {{-- Modal --}}
    {{-- <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{route('dosen.create')}}" method="post">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="exampleModalLabel">
                            Tambah Dosen
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="avatar" value="default.png">
                        <div class="form-group">
                            @if ($errors->first('nip'))
                                <label for="nip">NIP</label>
                                <input type="number" class="form-control" name="nip" placeholder="Masukan NIP.." id="nip" value="{{ old('nip') }}">
                                <small class="text-danger">{{ $errors->first('nip') }}</small>
                            @else
                                <label for="nip">NIP</label>
                                <input type="number" class="form-control" placeholder="Masukan NIP.." name="nip" id="nip" value="{{ old('nip') }}">
                            @endif
                        </div>
                        <div class="form-group">
                            @if ($errors->first('nama'))
                                <label for="nama">Nama lengkap</label>
                                <input type="text" class="form-control" name="nama" placeholder="Masukan nama.." id="nama" value="{{ old('nama') }}">
                                <small class="text-danger">{{ $errors->first('nama') }}</small>
                            @else
                                <label for="nama">Nama lengkap</label>
                                <input type="text" class="form-control" placeholder="Masukan nama.." name="nama" id="nama" value="{{ old('nama') }}" required>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="gelar_id">Gelar</label>
                            <select name="gelar_id" id="gelar_id" class="form-control" required>
                                <option value="" selected disabled>Pilih gelar</option>
                                @forelse ($gelar as $item)
                                    <option value="{{$item->id}}">{{$item->gelar}}</option>
                                @empty
                                    <option value="" selected disabled>Belum tersedia..</option>
                                @endforelse
                            </select>
                            @if ($errors->has('gelar_id'))
                                <small class="text-danger">{{ $errors->first('gelar_id') }}</small>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="jk">Jenis kelamin</label>
                            <select name="jk" id="jk" class="form-control" required>
                                <option value="" selected disabled>Pilih jenis kelamin..</option>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                                <small class="text-danger">{{ $errors->first('jk') }}</small>
                            </select>
                        </div>
                        <div class="form-group">
                          @if ($errors->has('email'))
                            <label for="signin-email" class="control-label">Email</label>
                            <input type="email" name="email" class="form-control" id="signin-email" value="{{ old('email') }}" placeholder="Masukan Email..">
                            <small class="text-danger">{{ $errors->first('email') }}</small>
                          @else
                            <label for="signin-email" class="control-label">Email</label>
                            <input type="email" name="email" class="form-control" id="signin-email" value="{{ old('email') }}" placeholder="Masukan Email..">
                          @endif
                        </div>
                        <div class="form-group">
                            <label for="signin-alamat" class="control-label">Alamat</label>
                            <textarea name="alamat" class="form-control" placeholder="Masukan alamat.." required>{{ old('alamat') }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm float-right">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div> --}}
@endsection

@section('customjs')
    <script>
      $(document).ready(function(){
        $('#data-table').dataTable({
          paging:false,
          info:true
        });

        $('#data-table_wrapper .row .col-sm-12').removeClass('col-md-6');
        $('#data-table_wrapper .row .col-sm-12 #data-table_filter label').addClass('pb-2');
      });
    </script>
@endsection
