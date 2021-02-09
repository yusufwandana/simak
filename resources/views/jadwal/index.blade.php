@extends('layouts.master')

@section('title', 'SIMAK | Jadwal')

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
                @if ($message = Session::get('failed'))
                <div class="alert alert-danger alert-sm alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h5 class="text-white">{{ $message }}</h5>
                </div>
                @endif
                <h3 class="mb-0 float-left">Jadwal Kuliah</h3>
                <a href="{{route('jadwal.create')}}" class="btn btn-primary btn-sm float-right"><i class="ni ni-fat-add"></i>Tambah</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush" id="data-table">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Waktu</th>
                                <th scope="col">Mata kuliah</th>
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
                                            @php
                                                $a = $jadwal->tanggal;
                                                $b = explode('-', $a);
                                                $year  = $b[0];
                                                $month = $b[1];
                                                $date  = $b[2];
                                                echo $date . "/" . $month . "/" . $year;
                                            @endphp

                                        </span>
                                    </div>
                                    </div>
                                </td>
                                <td scope="row">
                                    <div class="media align-items-center">
                                    <div class="media-body">
                                        <span class="mb-0 text-sm">
                                            {{ substr($jadwal->mulai,0,5) }} sd. {{ substr($jadwal->selesai,0,5) }}
                                        </span>
                                    </div>
                                    </div>
                                </td>
                                <td scope="row">
                                    <div class="media align-items-center">
                                        <div class="media-body">
                                            <span class="mb-0 text-sm">
                                                {{ $jadwal->matkul->matakuliah }} - Semester {{ $jadwal->semester->semester }}
                                            </span>
                                        </div>
                                    </div>
                                </td>
                                <td scope="row">
                                    <div class="media align-items-center">
                                    <div class="media-body">
                                        <span class="mb-0 text-sm">
                                            {{ $jadwal->dosen->nama }}
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
                                        {{-- <a class="btn btn-info btn-sm" href="{{ route('jadwal.edit', $jadwal->id) }}"><i class="fa fa-cog"></i></a> --}}
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
</div>
@endsection

@section('customjs')
    <script>
        $(document).ready(function(){
            // $('#semesterId').on('change', function(e){
            //     var sId = $(this).val();

            //     $.ajax({
            //         url : "{{ url('getmatkuls') }}/" + sId,
            //         dataType : 'json',
            //         type : 'get',
            //         success : function(response){
            //             $('#matkul').html('<option value="" selected disabled>Pilih mata kuliah..</option>');
            //             $('#dosenId').html('<option value="" selected disabled>Pilih dosen..</option>');
            //             $.each(response.results, function(e, i){
            //                 $('#matkul').append($("<option value="+ i.id +">" + i.matakuliah + "</option>"))
            //             });
            //         }
            //     });
            // });

            // $('#matkul').on('change', function(e){
            //     var mId = $(this).val();

            //     $.ajax({
            //         url: "{{url('getdosens')}}/" + mId,
            //         dataType: 'json',
            //         type: 'get',
            //         success: function(response){
            //             $('#dosenId').html('<option value="" selected disabled>Pilih dosen..</option>');
            //             $.each(response.results, function(e, i){
            //                 $('#dosenId').append($("<option value="+i.id+">"+i.nama+"</option>"))
            //             });
            //         }
            //     });
            // });

            $('#data-table').dataTable({
                paging: false,
                info: true
            });

            $('#data-table_wrapper .row .col-sm-12').removeClass('col-md-6');
            $('#data-table_wrapper .row .col-sm-12 #data-table_filter label').addClass('pb-2');


        });
    </script>
@endsection
