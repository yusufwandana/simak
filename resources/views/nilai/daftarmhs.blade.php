@extends('layouts.master')

@section('title', 'SIMAK2019 | Input Nilai Mahasiswa')

@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('head', 'Input Nilai Mahasiswa')

@section('content')
<div class="container-fluid mt--9">
    <div class="row">
        <div class="col-md">
            <div class="card shadow">
                <div class="card-header bg-transparent">
                    @php
                        $a = date('D');
                        switch ($a) {
                        case 'Sun':
                            $a = 'Minggu';
                            break;
                        case 'Mon':
                            $a = 'Senin';
                            break;
                        case 'Tue':
                            $a = 'Selasa';
                            break;
                        case 'Wed':
                            $a = 'Rabu';
                            break;
                        case 'Thu':
                            $a = 'Kamis';
                            break;
                        case 'Fri':
                            $a = 'Jumat';
                            break;
                        case 'Sat':
                            $a = 'Sabtu';
                            break;
                        default:
                            $a = 'False';
                            break;
                        }
                    @endphp
                    <div class="row">
                        <div class="col-md-9">
                            <h3 class="mb-0 float-left">Daftar Mahasiswa</h3>
                        </div>
                        <div class="col-md-3">
                            <h4 class="mb-0 float-left">@php echo $a; @endphp, {{ date('d/m/Y') }}</h4>
                            <a href="{{ route('nilai.index') }}" class="badge badge-warning float-right">kembali</a>
                        </div>
                    </div>
                    <br>
                    <table>
                        <tr>
                            <td>Dosen</td>
                            <td>:</td>
                            <td>{{ auth()->user()->name }}</td>
                        </tr>
                        <tr>
                            <td>Mata kuliah</td>
                            <td>:</td>
                            <td>{{ $matkul->matakuliah }} / {{ $matkul->sks }} sks</td>
                        </tr>
                        <tr>
                            <td>Semester </td>
                            <td>: &nbsp; </td>
                            <td>Semester {{ $semester->semester }}</td>
                        </tr>
                    </table>
                </div>  
                <div class="card-body">
                    <div class="row">
                        <div class="col-md">
                            <a href="" class="btn btn-success btn-sm mb-3" data-toggle="modal" data-target="#exampleModal" title="Export" target="_blank"><i class="fas fa-file-export"></i> EXPORT NILAI</a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush" id="ini">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">NIM</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Jenis Kelamin</th>
                                {{-- <th scope="col">UTS</th>
                                <th scope="col">UKK</th> --}}
                                <th scope="col">Detail</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($mahasiswa as $mhs)
                            <tr>
                                <th scope="row">
                                    <div class="media align-items-center">
                                    <div class="media-body">
                                        <span class="mb-0 text-sm">{{ $no++ }}</span>
                                    </div>
                                    </div>
                                </th>
                                <td scope="row">
                                    <div class="media align-items-center">
                                    <div class="media-body">
                                        <span class="mb-0 text-sm">
                                        {{ $mhs->nim }}
                                        </span>
                                    </div>
                                    </div>
                                </td>
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
                                            @else
                                                Perempuan
                                            @endif
                                        </span>
                                    </div>
                                    </div>
                                </td>
                                {{-- <td scope="row">
                                    <div class="media align-items-center">
                                    <div class="media-body" id="uts">
                                        @foreach ($mhs->nilai as $a)
                                            @if ($a->jenis_nilai == 'UTS')
                                                <span class="badge badge-dot ada"><i class="bg-success"></i></span>
                                            @endif
                                        @endforeach
                                        <span class="badge badge-dot gaada"><i class="bg-danger"></i></span>
                                    </div>
                                    </div>
                                </td> --}}
                                {{-- <td scope="row">
                                    <div class="media align-items-center">
                                    <div class="media-body" id="ukk">
                                        @foreach ($mhs->nilai as $a)
                                            @if ($a->jenis_nilai == 'UKK')
                                                <span class="badge badge-dot ada"><i class="bg-success"></i></span>
                                            @endif
                                        @endforeach
                                        <span class="badge badge-dot gaada"><i class="bg-danger"></i></span>
                                    </div>
                                    </div>
                                </td> --}}
                                <td scope="row">
                                    <a class="btn btn-primary btn-sm btn-danger" title="Tambah nilai" href="javascript:void(0)" id="tambah-data" data-id="{{ $mhs->id }}"><i class="fa fa-plus"></i></a>
                                    <a class="btn btn-primary btn-sm btn-primary" title="Detail nilai" href="/simak/nilai/show/{{$mhs->id}}/{{$matkul->id}}"><i class="fas fa-eye"></i></a>
                                </td>
                            </tr>    
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    </div>
                    <div class="card-footer">
                        
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="/simak/nilai/export/{{$matkul->id}}/{{$semester->id}}" method="post">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">
                        Export Nilai Berdasar Jenis
                    </h4>
                    <button type="button" id="closing" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="jenis">Jenis nilai</label>
                        <select name="jenis" id="jenis" class="form-control">
                            <option value="UTS">Pilih jenis..</option>
                            <option value="UTS">UTS</option>
                            <option value="UKK">UKK</option>
                        </select>
                    </div>
                    <button type="submit" id="export" class="btn btn-primary btn-sm float-right">Export now!</button>
                </div>
            </div>
        </form>
    </div>
</div>

<form id="tambahForm" name="tambahForm" class="form-horizontal">
    <div class="modal fade" id="ajax-crud-modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">
                        Tambah Nilai
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="mypoint">
                    <div class="form-group">
                        <input type="hidden" name="mahasiswa_id" id="mahasiswa_id">
                        <input type="hidden" name="matkul_id" id="matkul_id" value="{{ $matkul->id }}">
                        <label for="jenis">Jenis nilai</label>
                        <select class="form-control" name="jenis" id="jenis" required>
                            <option value="" selected disabled>Pilih jenis nilai</option>
                            <option value="UTS">UTS</option>
                            <option value="UKK">UKK</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="matkul">Masukkan nilai</label>
                        <input class="form-control" type="number" name="nilai" id="nilai" placeholder="Masukan nilai..">
                        <small id="error"></small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-sm float-right" id="btn-save" value="create">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@section('customjs')
    <script>

        $(document).ready(function(){

            var a = $('.ada').next().remove();
            // console.log(a);

            $.ajaxSetup({
                headers : {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#ini').DataTable({
                paging: false,
                info: false
            });

            $('#export').on('click', function(){
                $('.modal').modal('hide');
            });

            $('body').on('click', '#tambah-data', function(){
                var thisId = $(this).data('id');
                $('#ajax-crud-modal').modal('show');
                $('#mahasiswa_id').val(thisId);
            });

            $('#ini_wrapper .row .col-md-6').removeClass('col-md-6');
            $('#ini_wrapper .row .col-sm-12, #ini_filter, label, input').addClass('pb-1');

            $('#btn-save').on('click', function(e){
                e.preventDefault();
                $(this).html('sending..');
                setInterval(() => {
                    $(this).html('Save changes')
                }, 3000);

                $.ajax({
                    data: $('#tambahForm').serialize(),
                    url : "{{ route('nilai.store') }}",
                    type: "post",
                    dataType: 'json',
                    success : function(data){
                        if(data == "failed"){
                            alert("Nilai sudah ditambahkan sebelumnya!");
                            $(this).html('save changes');
                        }else{
                            alert('Nilai berhasil ditambahkan!');
                            $('#ajax-crud-modal').modal('hide');
                            $('#tambahForm').trigger("reset");
                            // location.reload();
                        }
                    },  
                    error : function(data, error) {                        
                        
                        var err = JSON.parse(data.responseText);           
                        $.each(err.errors, function(i) {
                            $.each(err.errors[i], function (key, val){
                                $('#error').html(val);
                                $('#error').addClass('text-danger');
                            })
                        });
                        $('#btn-save').html('Save changes');
                    }
                });
            });

        });

    </script>
@endsection