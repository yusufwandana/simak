@extends('layouts.master')

@section('title', 'SIMAK | Detail')

@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('head', 'Input Nilai')

@section('content')
<div class="container-fluid mt--8 mb-5">
    <div class="row">
        <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
        <div class="card card-profile shadow">
            <div class="row justify-content-center">
            <div class="col-lg-3 order-lg-2">
                <div class="card-profile-image">
                <a href="#"><img src="{{ asset('image/profile/' . $user->avatar) }}" class="rounded-circle"></a>
                </div>
            </div>
            </div>
            <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">

            </div>
            <div class="card-body pt-0 pt-md-4">
            <div class="row">
                <div class="col">
                <div class="card-profile-stats d-flex justify-content-center mt-md-5">

                </div>
                </div>
            </div>
            <div class="text-center">
                <h3>
                {{ $mahasiswa->nama }}<span class="font-weight-light"></span>
                </h3>
                <div class="h4 font-weight-300">
                <i class="ni location_pin mr-2"></i>{{ $mahasiswa->nim }}
                </div>
                <div class="h4 font-weight-300">
                <i class="ni location_pin mr-2"></i>
                @if ($mahasiswa->jk == 'L')
                    Laki-laki
                @elseif($mahasiswa->jk == 'P')
                    Perempuan
                @else
                    !!EROR!!
                @endif
                </div>
                <div class="h5 mt-4">
                <i class="ni business_briefcase-24 mr-2"></i>{{$mahasiswa->jurusan->jurusan}} - Semester {{$mahasiswa->semester->semester}}
                </div>
            </div>
            </div>
        </div>
        </div>
        <div class="col-xl-8 order-xl-1">
        <div class="card bg-secondary shadow">
            <div class="card-header bg-white border-0">
                <div class="row align-items-center">
                    <div class="col-md-9">
                        <h3 class="mb-0">{{ $user->name }} | Daftar Nilai</h3>
                    </div>
                    <div class="col-md-3">
                        <a href="{{URL::previous()}}" class="badge badge-primary float-right">kembali</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <h6 class="heading-small text-muted mb-4">User information</h6>
                <div class="px-lg-0">
                <div class="row">
                    <div class="col-lg-6">
                    <div class="form-group">
                        <label class="form-control-label" for="input-email">Email address</label>
                        <input type="email" id="input-email" class="form-control form-control-alternative" value="{{ $user->email }}" readonly>
                    </div>
                    </div>
                    <div class="col-lg-6">
                    <div class="form-group">
                        <label class="form-control-label" for="nim">NIM</label>
                        <input type="text" id="nim" class="form-control form-control-alternative" value="{{ $mahasiswa->nim }}" readonly>
                    </div>
                    </div>
                </div>
                <hr class="my-4">
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
                @if ($message = $errors->has('nilai'))
                <div class="alert alert-danger alert-sm alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h5 class="text-white">{{ $errors->first('nilai') }}</h5>
                </div>
                @endif
                <h6 class="heading-small text-muted mb-4">Daftar nilai</h6>
                <div class="row mt-4">
                    <div class="col-lg">
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                    <th scope="col">Jenis Nilai</th>
                                    <th scope="col">Semester</th>
                                    <th scope="col">Matkul</th>
                                    <th scope="col">Nilai</th>
                                    <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($nilaimhs as $m)
                                    <tr>
                                        <td scope="row">
                                        <div class="media align-items-center">
                                            <div class="media-body">
                                            <span class="mb-0 text-sm">{{ $m->jenis_nilai }}</span>
                                            </div>
                                        </div>
                                        </td>
                                        <td scope="row">
                                        <div class="media align-items-center">
                                            <div class="media-body">
                                            <span class="mb-0 text-sm">Semester {{ $m->matkul->semester->semester }}</span>
                                            </div>
                                        </div>
                                        </td>
                                        <td scope="row">
                                        <div class="media align-items-center">
                                            <div class="media-body">
                                            <span class="mb-0 text-sm">{{ $m->matkul->matakuliah }}</span>
                                            </div>
                                        </div>
                                        </td>
                                        <td scope="row">
                                        <div class="media align-items-center">
                                            <div class="media-body">
                                            <span class="mb-0 text-sm"><a class="b{{$m->id}}" href="javascript:void(0)" id="edit-data" data-id="{{ $m->id }}">{{ $m->nilai }}</a></span>
                                        </div>
                                        </div>
                                        </td>
                                        <td scope="row">
                                            <form action="{{ route('nilai.destroy', $m->id) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin akan menghapus data ini?')"><i class="fa fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
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

    <form id="updateForm" action="post" name="updateForm" class="form-horizontal">
        <div class="modal fade" id="ajax-crud-modal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="updateCrudModal"></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="my_id" id="my_id">
                        <div class="form-group">
                            <label for="nilai" class="control-label">Nilai</label>
                            <input type="text" class="form-control" id="score" name="score" placeholder="Enter nilai" maxlength="50" required="">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="btn-update" value="update">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

@endsection

@section('customjs')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers : {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('body').on('click', '#edit-data', function(){
                var thisId = $(this).data('id');
                $.get('/nilai/' + thisId + '/edit', function(data){
                    $('#userCrudModal').html("Edit Nilai Mahasiswa");
                    $('#btn-save').val("edit-user");
                    $('.modal-title').html('Edit nilai mahasiswa');
                    $('#ajax-crud-modal').modal('show');
                    $('#my_id').val(data.id);
                    $('#score').val(data.nilai);
                });
            });

            $('body').on('click', '#btn-update', function(){
                var myId = $('#my_id').val();
                $.ajax({
                    data: $('#updateForm').serialize(),
                    url: "/nilai/update" +"/"+myId,
                    type: "post",
                    dataType: 'json',
                    success: function(data){
                        var score = $('#score').val();
                        $('.b'+myId).html(score);
                        $('#updateForm').trigger("reset");
                        $('#ajax-crud-modal').modal('hide');
                    },
                    error: function(data, error){
                        alert('Error', error);
                    }
                });
            });

        });
    </script>
@endsection
