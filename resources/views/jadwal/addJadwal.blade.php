@extends('layouts.master')

@section('title', 'SIMAK | Tambah dosen')

@section('head', 'Tambah Data Dosen')

@section('content')
<div class="container-fluid mt--9">
    <!-- Table -->
    <div class="row justify-content-center">
        <div class="col-md-10">
        <div class="card shadow">
            <div class="card-header bg-transparent">
            <h3 class="mb-0">Form Tambah Dosen<a href="{{ route('dosen') }}" class="badge badge-primary float-right">kembali</a></h3>
            </div>
            <form action="{{ route('jadwal.store') }}" method="post">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="mulai">Mulai</label>
                                <input type="time" class="form-control" name="mulai" id="mulai" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="selesai">Selesai</label>
                                <input type="time" required class="form-control" name="selesai" id="selesai" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="date">Tanggal</label>
                                <input type="date" required class="form-control" name="date" id="date" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="semesterId">Pilih semester</label>
                                <select name="semesterId" id="semesterId" class="form-control" required>
                                    <option value="" selected disabled>Pilih semester..</option>
                                    @foreach ($semesters as $semester)
                                        <option value="{{ $semester->id }}">Semester {{ $semester->semester }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
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
                                <label for="dosen">Pilih Dosen</label>
                                <select name="dosenId" id="dosenId" class="form-control" required>
                                    <option value="" selected disabled>Pilih dosen..</option>
                                </select>
                            </div>
                        </div>
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
                    <div class="row">

                    </div>
                    <button type="submit" class="btn btn-primary btn-sm float-right my-4">Simpan</button>
                </div>
            </form>
        </div>
        </div>
    </div>
    <!-- Footer -->
    {{-- <footer class="footer">
        <div class="row align-items-center justify-content-xl-between">
            <div class="col-xl-6">
                <div class="copyright text-center text-xl-left text-muted">
                © {{ date('Y') }} <a href="" class="font-weight-bold ml-1" target="_blank">SIMAK Team</a>
                </div>
            </div>
        </div>
    </footer> --}}
    </div>
@endsection

@section('customjs')
    <script>
        $(document).ready(function(){
            $('#semesterId').on('change', function(e){
                var sId = $(this).val();

                $.ajax({
                    url : "{{ url('getmatkuls') }}/" + sId,
                    dataType : 'json',
                    type : 'get',
                    success : function(response){
                        $('#matkul').html('<option value="" selected disabled>Pilih mata kuliah..</option>');
                        $('#dosenId').html('<option value="" selected disabled>Pilih dosen..</option>');
                        $.each(response.results, function(e, i){
                            $('#matkul').append($("<option value="+ i.id +">" + i.matakuliah + "</option>"))
                        });
                    }
                });
            });

            $('#matkul').on('change', function(e){
                var mId = $(this).val();

                $.ajax({
                    url: "{{url('getdosens')}}/" + mId,
                    dataType: 'json',
                    type: 'get',
                    success: function(response){
                        $('#dosenId').html('<option value="" selected disabled>Pilih dosen..</option>');
                        $.each(response.results, function(e, i){
                            $('#dosenId').append($("<option value="+i.id+">"+i.nama+"</option>"))
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
