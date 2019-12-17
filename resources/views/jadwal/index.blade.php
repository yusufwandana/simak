@extends('layouts.master')

@section('title', 'SIMAK2019 | Jadwal')

@section('head', 'Jadwal')

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
                <h3 class="mb-0 float-left">Jadwal Kuliah</h3>
                <a href="" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#exampleModal"><i class="ni ni-fat-add"></i>Tambah</a>
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
                                <th scope="col">Dosen</th>
                                <th scope="col">Ruangan</th>
                                <th scope="col">Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($jadwals as $key => $jadwal)
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
                                            {{ $jadwal->tanggal }}
                                        </span>
                                    </div>
                                    </div>
                                </td>
                                <td scope="row">
                                    <div class="media align-items-center">
                                    <div class="media-body">
                                        <span class="mb-0 text-sm">
                                            {{ $jadwal->waktu }}
                                        </span>
                                    </div>
                                    </div>
                                </td>
                                <td scope="row">
                                    <div class="media align-items-center">
                                        <div class="media-body">
                                            <span class="mb-0 text-sm">
                                                {{ $jadwal->matkul->kd_matkul }}
                                            </span>
                                        </div>
                                    </div>
                                </td>
                                <td scope="row">
                                    <div class="media align-items-center">
                                    <div class="media-body">
                                        <span class="mb-0 text-sm">
                                            {{ $jadwal->dosen_id }}
                                        </span>
                                    </div>
                                    </div>
                                </td>
                                <td scope="row">
                                    <div class="media align-items-center">
                                    <div class="media-body">
                                        <span class="mb-0 text-sm">
                                            {{ $jadwal->ruangan->ruangan }}
                                        </span>
                                    </div>
                                    </div>
                                </td>
                                <td scope="row">
                                    <form action="{{ route('jadwal.destroy', $jadwal->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <a class="btn btn-info btn-sm" href="{{ route('jadwal.edit', $jadwal->id) }}"><i class="fa fa-cog"></i></a>
                                        <button class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin akan menghapus data ini?')" href="{{ route('jadwal.destroy', $jadwal->id) }}"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>    
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card-footer py-4">
                    {{ $jadwals->links() }}
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-5">
            <div class="card shadow">
                <div class="card-header">
                    <h4 class="mb-0 float-left">Daftar Dosen</h4>
                </div>
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Kode Dosen</th>
                                <th scope="col">Nama Dosen</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dosens as $key => $dosen)
                            <tr>
                                <td scope="row">
                                    <div class="media align-items-center">
                                        <div class="media-body">
                                            <span class="mb-0 text-sm">
                                                {{ 1 + $key }}
                                            </span>
                                        </div>
                                    </div>
                                </td>
                                <td scope="row">
                                    <div class="media align-items-center">
                                        <div class="media-body">
                                            <span class="mb-0 text-sm">
                                                {{ $dosen->id }}
                                            </span>
                                        </div>
                                    </div>
                                </td>
                                <td scope="row">
                                    <div class="media align-items-center">
                                        <div class="media-body">
                                            <span class="mb-0 text-sm">
                                                {{ $dosen->nama }}
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
        <div class="col-md-7">
            <div class="card shadow">
                <div class="card-header">
                    <h4 class="mb-0 float-left">Daftar Matkul</h4>
                </div>
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Kode Matkul</th>
                                <th scope="col">Mata Kuliah</th>
                                <th scope="col">Semester</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($matkuls as $key => $matkul)
                            <tr>
                                <td scope="row">
                                    <div class="media align-items-center">
                                        <div class="media-body">
                                            <span class="mb-0 text-sm">
                                                {{ $matkuls->firstItem() + $key }}
                                            </span>
                                        </div>
                                    </div>
                                </td>
                                <td scope="row">
                                    <div class="media align-items-center">
                                        <div class="media-body">
                                            <span class="mb-0 text-sm">
                                                {{ $matkul->kd_matkul }}
                                            </span>
                                        </div>
                                    </div>
                                </td>
                                <td scope="row">
                                    <div class="media align-items-center">
                                        <div class="media-body">
                                            <span class="mb-0 text-sm">
                                                {{ $matkul->matakuliah }}
                                            </span>
                                        </div>
                                    </div>
                                </td>
                                <td scope="row">
                                    <div class="media align-items-center">
                                        <div class="media-body">
                                            <span class="mb-0 text-sm">
                                                Semester {{ $matkul->semester->semester }}
                                            </span>
                                        </div>
                                    </div>
                                </td>
                            </tr>    
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    {{ $matkuls->links() }}
                </div>
            </div>
        </div>
    </div>
</div>


{{-- Modal --}}
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{ route('jadwal.store') }}" method="post">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">
                        Tambah jadwal
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="time">Waktu</label>
                                <input type="time" class="form-control" name="time" id="time" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="date">Tanggal</label>
                                <input type="date" required class="form-control" name="date" id="date">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="dosen">Pilih Dosen</label>
                                <select name="dosenId" id="dosenId" class="form-control" required>
                                    <option value="" selected disabled>Pilih dosen</option>
                                    @foreach ($dosens as $dosen)
                                        <option value="{{ $dosen->id }}">{{ $dosen->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="matkul">Pilih matkul</label>
                                <select name="matkulId" id="matkul" class="form-control" required>
                                    <option value="" selected disabled>Pilih mata kuliah..</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="ruangan">Pilih ruangan</label>
                                <select name="ruanganId" id="ruangan" class="form-control" required>
                                    <option value="" selected disabled>Pilih ruangan..</option>
                                    @foreach ($ruangans as $ruangan)
                                        <option value="{{ $ruangan->id }}">{{ $ruangan->ruangan }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-sm float-right">Save changes</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('customjs')
    <script>
        $(document).ready(function(){
            $('#dosenId').on('change', function(e){
                var thisId = $(this).val();

                $.ajax({
                    url : "{{ url('getmatkuls') }}/" + thisId,
                    dataType : 'json',
                    type : 'get',
                    success : function(response){
                        $('#matkul').html('<option value="">Pilih mata kuliah..</option>');
                        $.each(response.results, function(e,i){
                            $('#matkul').append($("<option value="+ i.id +">"+ i.matakuliah +"</option>"))
                        });
                    }
                });
            });

            $('#data-table').dataTable({
                paging: false,
                info: false
            });

            $('#data-table_wrapper .row .col-sm-12').removeClass('col-md-6');
            $('#data-table_wrapper .row .col-sm-12 #data-table_filter label').addClass('pb-2');
            

        });
    </script>
@endsection