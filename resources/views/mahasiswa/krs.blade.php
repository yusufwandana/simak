@extends('layouts.master')

@section('title', 'SIMAK2019 | KRS')

@section('head', 'KRS Mahasiswa')

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
                <h3 class="mb-0 float-left">Kartu Rencana Studi</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="semester">Semester</label>
                            <select name="semester" id="semesterId" class="form-control">
                                <option value="0">Pilih semester..</option>
                                @foreach ($semester as $item)
                                    <option value="{{$item->id}}">Semester {{$item->semester}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <hr>
                <h3 class="mb-3 float-left">Daftar Mata Kuliah</h3>
                <a id="exp" class="btn btn-sm btn-success float-right text-white" target="_blank"><i class="fas fa-file-export"></i> Export</a>
                <br>
                <div class="table-responsive">
                    <table class="table align-items-center table-flush" id="data-table">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Kode</th>
                                <th scope="col">mata kuliah</th>
                                <th scope="col">SKS</th>
                                <th scope="col">Kategori</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('customjs')
    <script>
        $(document).ready(function(){
            $('#data-table tbody').append('<tr id="no-data"><td class="text-center" colspan="5"><h5>No data available!</h5></td></tr>');
            $('#semesterId').on('change', function(e){
                var smId = $(this).val();
                $('#exp').attr('href', '/krs-mahasiswa/export/' + smId);

                $.ajax({
                    url:      "{{ url('krsmatkul') }}" + "/" + smId,
                    dataType: 'json',
                    type:     'get',
                    success: function(response){
                        var no = 1;
                        if(response.results != 0){
                            $('.ada-data').remove();
                            $.each(response.results, function(e, i){
                                $('#no-data').hide();
                                $('#data-table tbody').append($('<tr class="ada-data"><td>'+no+'</td><td>'+i.kd_matkul+'</td><td>'+i.matakuliah+'</td><td>'+i.sks+'</td><td>'+i.kategori+'</td></tr>'));
                                no++;
                            });
                        }else{
                            $('#no-data').show();
                            $('.ada-data').hide();
                        }
                    }
                });
            });
        });
    </script>
@endsection
