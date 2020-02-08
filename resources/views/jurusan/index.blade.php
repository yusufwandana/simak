@extends('layouts.master')

@section('title', 'SIMAK | Jurusan')

@section('head', 'Jurusan')

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
            <h3 class="mb-0 float-left">Daftar Jurusan</h3>
            <a href="" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#exampleModal"><i class="ni ni-fat-add"></i>Tambah</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                <table class="table align-items-center table-flush" id="ini_table">
                    <thead class="thead-light">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Jurusan</th>
                        <th scope="col">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($jurusans as $key => $jurusan)
                    <tr>
                        <th scope="row">
                            <div class="media align-items-center">
                            <div class="media-body">
                                <span class="mb-0 text-sm">{{ $jurusans->firstItem() + $key }}</span>
                            </div>
                            </div>
                        </th>
                        <td scope="row">
                            <div class="media align-items-center">
                            <div class="media-body">
                                <span class="mb-0 text-sm">
                                {{ $jurusan->jurusan }}
                                </span>
                            </div>
                            </div>
                        </td>
                        <td scope="row">
                            <form action="{{ route('jurusan.destroy', $jurusan->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <a class="btn btn-info btn-sm" href="{{ route('jurusan.edit', $jurusan->id) }}"><i class="fa fa-cog"></i></a>
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin akan menghapus data ini?')" href="/simak2019/jurusan/{{ $jurusan->id }}/delete"><i class="fa fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>    
                    @endforeach
                    </tbody>
                </table>
                </div>
            </div>
            <div class="card-footer py-4">
                {{ $jurusans->links() }}
            </div>
        </div>
    </div>
</div>


{{-- Modal --}}
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{ route('jurusan.store') }}" method="post">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">
                        Tambah Jurusan
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="jurusan">Nama jurusan</label>
                        <input type="text" class="form-control" placeholder="Masukan nama jurusan.." name="jurusan" id="jurusan" value="{{ old('jurusan') }}">
                        @if ($errors->has('jurusan'))
                        <small class="text-danger">{{ $errors->first('jurusan') }}</small>
                        @endif
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
      $('#ini_table').dataTable({
        paging:false,
        info: false
      });
        $('#ini_table_wrapper .row  .col-sm-12').removeClass('col-md-6');
        $('#ini_table_wrapper .row  .col-sm-12 #ini_table_filter label').addClass('pb-2');

      $('#edit').on('click', function(){
        var idJurusan = $(this).data('id');
        var jurusan = $(this).data('jurusan');
        $('#jurusan-id').val(idJurusan);
        $('#jurusan-edit').val(jurusan);
        console.log(idJurusan);
      })
    </script>
@endsection