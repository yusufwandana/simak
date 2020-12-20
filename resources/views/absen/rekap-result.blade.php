@extends('layouts.master')

@section('title', 'SIMAK | Absen Mahasiswa')

@section('head', 'Absen Mahasiswa')

@section('content')
@php
    if ($errors->has('matkul_id')){
        echo "<script>alert('Harap isi kolom dengan benar!');</script>";
    }   
@endphp
    
<div class="container-fluid mt--9">
    <div class="row">
        <div class="col-md">
            <div class="card shadow">
                <div class="card-header bg-transparent">
                    @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-sm alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h5 class="text-white">{{ $message }}</h5>
                    </div>
                    @endif
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
                            <h3 class="mb-0">Rekap Absen Mahasiswa</h3>
                        </div>
                        <div class="col-md-3">
                            <h4 class="mb-0">@php echo $a; @endphp, {{ date('d/m/Y') }}<a href="{{ route('absen.rekap') }}" class="badge badge-primary float-right">kembali</a></h4>
                        </div>
                    </div>                  
                    <table class="table-responsive mt-3">
                        @if (auth()->user()->role == 'dosen')
                            <tr>
                                <td>Dosen</td>
                                <td>:</td>
                                <td>{{ auth()->user()->name }}</td>
                            </tr>
                        @endif
                            <tr>
                                <td>Mata kuliah</td>
                                <td>:</td>
                                <td>{{ $matkul->matakuliah }} / {{ $matkul->sks }} sks</td>
                            </tr>
                            <tr>
                                <td>Semester </td>
                                <td>:</td>
                                <td>Semester {{ $matkul->semester->semester }}</td>
                            </tr>
                            <tr>
                                <td>Rentang Waktu &nbsp;</td>
                                <td>: &nbsp;</td>
                                <td>{{$data['from']}} - {{$data['to']}}</td>
                            </tr>
                        </table>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md">
                            @if (auth()->user()->role == 'dosen')
                                <a href="/absen/rekap/export/{{$data['matkul_id']}}/{{$data['dari']}}/{{$data['sampai']}}" class="btn btn-success btn-sm mb-3" title="Export" target="_blank"><i class="fas fa-file-export"></i> EXPORT ABSEN</a>
                            @else
                            
                            @endif
                        </div>
                    </div>    
                    <div class="row">
                        <div class="col-md">
                            <div class="table-responsive">
                                <table class="table align-items-center table-flush" id="data-table">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">NIM</th>
                                            <th scope="col">Nama</th>
                                            <th scope="col">Jumlah hadir</th>                                       
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $no = 1; @endphp
                                        @foreach($mahasiswa as $mhs)
                                        <tr>
                                            <td scope="row">
                                                <div class="media align-items-center">
                                                    <div class="media-body">
                                                        <span class="mb-0 text-sm">{{ $no++ }}</span>
                                                    </div>
                                                </div>
                                            </td>
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
                                                        @php $jumlah = 0; @endphp
                                                        @if (auth()->user()->role == 'admin')
                                                            @foreach ($mhs->absen as $item)
                                                                @if ($item->status == 1 && $item->matkul_id == $matkul->id && $item->tanggal >= $data['dari'] && $item->tanggal <= $data['sampai'])
                                                                    @php $jumlah++;@endphp
                                                                @endif
                                                            @endforeach
                                                        @elseif(auth()->user()->role == 'dosen')
                                                        @foreach ($mhs->absen as $item)
                                                            @if ($item->status == 1 && $item->dosen->user_id == auth()->user()->id && $item->tanggal >= $data['dari'] && $item->tanggal <= $data['sampai'])
                                                                @php $jumlah++;@endphp
                                                            @endif
                                                        @endforeach
                                                        @endif
                                                        <a href="/absen/rekap/detail/{{$encrypted}}/{{$mhs->id}}/{{$matkul->id}}"><span class="mb-0 text-sm">{{$jumlah}}</span></a>
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
                </div>
                <div class="card-footer mb-3">

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('customjs')
    <script>
      $(document).ready(function(){
        // $('#data-table').dataTable({
        //   paging:false,
        //   info:false
        // });

        $('#data-table_wrapper .row .col-sm-12').removeClass('col-md-6');
        $('#data-table_wrapper .row .col-sm-12 #data-table_filter label').addClass('pb-2');

      });
    </script>
@endsection