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
                <h3 class="mb-0 float-left">KRS Mahasiswa</h3>
                <input id="link" type="hidden" value="">
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
                <a id="exp" class="btn btn-sm btn-success float-right text-white" target="_blank">Export KRS</a>
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
                $('#link').val('/simak/krs/mahasiswa/export/' + smId);
                var link = $('#link').val();
                $('#exp').attr('href', link);

                $.ajax({
                    url: "{{ url('krsmatkul') }}" + "/" + smId,
                    dataType: 'json',
                    type: 'get',
                    success: function(response){
                        if(response.results != 0){
                            $('.ada-data').remove();
                            $.each(response.results, function(e, i){
                                $('#no-data').hide();
                                $('#data-table tbody').append($('<tr class="ada-data"><td>1</td><td>'+i.kd_matkul+'</td><td>'+i.matakuliah+'</td><td>'+i.sks+'</td><td>'+i.kategori+'</td></tr>'));
                            });
                        }else{
                            $('#no-data').show();
                            $('.ada-data').hide();
                        }
                    }
                });

                
            });

            var link = $('#link').val();
            console.log(link);
            // $('#exp').attr("href", "/simak/krs/mahasiswa/export/");


            // $('#data-table').dataTable({
            //     paging: false,
            //     info: false
            // });

            // $('#data-table_wrapper .row .col-sm-12').removeClass('col-md-6');
            // $('#data-table_wrapper .row .col-sm-12 #data-table_filter label').addClass('pb-2');
        });
    </script>
@endsection