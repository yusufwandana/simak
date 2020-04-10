@extends('layouts.master')

@section('head', 'dosen')

@section('title', 'SIMAK | Dosen')

@section('content')
<div class="container-fluid mt--9 mb-5">
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
          <a href="" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#exampleModal"><i class="ni ni-fat-add"></i>Tambah</a>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table align-items-center table-flush" id="data-table">
              <thead class="thead-light">
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">NIP</th>
                  <th scope="col">Nama lengkap</th>
                  <th scope="col">Jenis kelamin</th>
                  <th scope="col">Alamat</th>
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
                            {{ $dosen->nama }}
                          </span>
                        </div>
                      </div>
                    </td>
                    <td scope="row">
                      <div class="media align-items-center">
                        <div class="media-body">
                          <span class="mb-0 text-sm">
                            @if ($dosen->jk == 'L')
                                Laki-laki
                            @elseif($dosen->jk == 'P')
                                Perempuan
                            @endif
                          </span>
                        </div>
                      </div>
                    </td>
                    <td scope="row">
                      <div class="media align-items-center">
                        <div class="media-body">
                          <span class="mb-0 text-sm">{{ $dosen->alamat }}</span>
                        </div>
                      </div>
                    </td>
                    <td class="text-right">
                      <div class="dropdown">
                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <i class="fas fa-ellipsis-v"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(32px, 32px, 0px);">
                          <form action="" method="post">
                            @csrf
                            {{-- @method('delete') --}}
                            <a class="dropdown-item btn-sm" href="{{route('profile', $dosen->id)}}"><i class="ni ni-books text-info"></i>Mata kuliah</a>
                            <a class="dropdown-item btn-sm" href="{{route('dosen.edit', $dosen->id)}}"><i class="fa fa-cog text-dark"></i>Edit</a>
                            <a class="dropdown-item btn-sm" onclick="return confirm('Anda yakin akan menghapus data ini?')" href="{{ route('dosen.delete', $dosen->id) }}"><i class="fa fa-trash text-red"></i>Hapus</a>
                          </form>
                        </div>
                      </div>
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

  {{-- Modal --}}
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="/simak/dosen/create" method="post">
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
