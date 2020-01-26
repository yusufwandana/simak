@extends('layouts.master')

@section('head', 'Mahasiswa')

@section('title', 'SIMAK | Mahasiswa')

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
          
          <h3 class="mb-0 float-left">Daftar Mahasiswa</h3>
          <a href="" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#exampleModal"><i class="ni ni-fat-add"></i>Tambah</a>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table align-items-center table-flush" id="ini_table">
              <thead class="thead-light">
                <tr>
                  <th scope="col">Tahun Masuk</th>
                  <th scope="col">NIM</th>
                  <th scope="col">Nama lengkap</th>
                  <th scope="col">Jenis kelamin</th>
                  <th scope="col">Jurusan</th>
                  <th scope="col">Semester</th>
                  <th scope="col">Alamat</th>
                  <th scope="col">Aksi</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($mahasiswa as $mhs)
                  <tr>
                    <th scope="row">
                      <div class="media align-items-center">
                        <div class="media-body">
                          <span class="mb-0 text-sm">{{ $mhs->tahun_masuk }}</span>
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
                          <span class="mb-0 text-sm">
                            @if ($mhs->jk == 'L')
                                Laki-laki
                            @elseif($mhs->jk == 'P')
                                Perempuan
                            @endif
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
                    <td scope="row">
                        <div class="media align-items-center">
                          <div class="media-body">
                            <span class="mb-0 text-sm">{{ $mhs->alamat }}</span>
                          </div>
                        </div>
                      </td>
                   <td class="text-right">
                      <div class="dropdown">
                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <i class="fas fa-ellipsis-v"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(32px, 32px, 0px);">
                          <form action="{{ route('mahasiswa.destroy', $mhs->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <a class="dropdown-item btn-sm" href="{{route('mahasiswa.edit', $mhs->id)}}"><i class="fa fa-cog text-dark"></i>Edit</a>
                            <button type="submit" class="dropdown-item btn-sm" onclick="return confirm('Anda yakin akan menghapus data ini?')" href=""><i class="fa fa-trash text-red"></i>Hapus</button>
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
           {{ $mahasiswa->links() }}
        </div>
      </div>
    </div>
</div>

  {{-- Modal --}}
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{ route('mahasiswa.store') }}" method="post">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="exampleModalLabel">
                            Tambah Mahasiswa
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="tahun_masuk" id="tahun_masuk" value="{{ date('Y') }}">
                        <div class="form-group">
                            @if ($errors->first('nim'))
                                <label for="nim">NIM</label>
                                <input type="text" class="form-control" name="nim" placeholder="Masukan nim.." id="nim">
                                <small class="text-danger">{{ $errors->first('nim') }}</small>
                            @else
                                <label for="nim">NIM</label>
                                <input type="text" class="form-control" placeholder="Masukan NIM.." name="nim" id="nim">
                            @endif
                        </div>
                        <div class="form-group">
                            @if ($errors->first('nama'))
                                <label for="nama">Nama lengkap</label>
                                <input type="text" class="form-control" name="nama" placeholder="Masukan nama.." id="nama">
                                <small class="text-danger">{{ $errors->first('nama') }}</small>
                            @else
                                <label for="nama">Nama lengkap</label>
                                <input type="text" class="form-control" placeholder="Masukan nama.." name="nama" id="nama">
                            @endif
                        </div>
                        <div class="form-group">
                            @if ($errors->has('jk'))
                              <label for="jk">Jenis kelamin</label>
                              <select name="jk" id="jk" class="form-control" required>
                                  <option value="" selected disabled>Pilih jenis kelamin..</option>
                                  <option value="L">Laki-laki</option>
                                  <option value="P">Perempuan</option>
                                  <small class="text-danger">{{ $errors->first('jk') }}</small>
                              </select>
                            @else
                              <label for="jk">Jenis kelamin</label>
                              <select name="jk" id="jk" class="form-control" required>
                                  <option value="" selected disabled>Pilih jenis kelamin..</option>
                                  <option value="L">Laki-laki</option>
                                  <option value="P">Perempuan</option>
                              </select>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="jurusan">Jurusan</label>
                            <select class="form-control" name="jurusan" id="jurusan" required>
                                <option value="">Pilih jurusan..</option>
                                @foreach ($jurusan as $j)
                                    <option value="{{ $j->id }}">{{ $j->jurusan }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="semester">Semester</label>
                            <select class="form-control" name="semester" id="semester" required>
                                <option value="">Pilih semester..</option>
                                @foreach ($semester as $s)
                                    <option value="{{ $s->id }}">{{ $s->semester }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                          @if ($errors->has('email'))
                            <label for="signin-email" class="control-label">Email</label>
                            <input type="email" name="email" class="form-control" id="signin-email" placeholder="Masukan Email..">
                            <small class="text-danger">{{ $errors->first('email') }}</small>
                          @else
                            <label for="signin-email" class="control-label">Email</label>
                            <input type="email" name="email" class="form-control" id="signin-email" placeholder="Masukan Email..">
                          @endif
                        </div>
                        <div class="form-group">
                          @if ($errors->has('alamat'))
                            <label for="alamat" class="control-label">Alamat</label>
                            <textarea name="alamat" class="form-control" placeholder="Masukan alamat.."></textarea>
                            <small class="text-danger">{{ $errors->first('alamat') }}</small>
                          @else
                            <label for="signin-alamat" class="control-label">Alamat</label>
                            <textarea name="alamat" class="form-control" placeholder="Masukan alamat.."></textarea>
                          @endif
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm float-right">Save changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
      
@endsection

@section('customjs')
    <script>
      $('#ini_table').dataTable({
        paging:false,
        info: false
      });
        $('#ini_table_wrapper .row  .col-sm-12').removeClass('col-md-6');
        $('#ini_table_wrapper .row  .col-sm-12 #ini_table_filter label').addClass('pb-2');
    </script>
@endsection