@extends('layouts.master')

@section('title', 'SIMAK2019 | Absen Mahasiswa')

@section('head', 'Absen Mahasiswa')

@section('content')
@php
if ($errors->has('matkul_id')){
    echo "<script>alert('Harap isi kolom dengan benar!');</script>";
}else{

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
                            <h4 class="mb-0">@php echo $a; @endphp, {{ date('d/m/Y') }}</h4>
                        </div>
                    </div>                    
                    <table class="table-responsive mt-3">
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
                            <div class="table-responsive">
                                <table class="table align-items-center table-flush">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">NIM</th>
                                            <th scope="col">Nama</th>
                                            @foreach ($absen->unique('tanggal') as $a)
                                                @php
                                                    $b = explode('-', $a->tanggal);
                                                    $c = $b[2].'/'.$b[1];
                                                @endphp
                                                <th scope="col">{{$c}}</th>
                                            @endforeach                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 1;
                                        @endphp
                                        @foreach($mahasiswa as $m)
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
                                                        {{ $m->nim }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td scope="row">
                                                <div class="media align-items-center">
                                                    <div class="media-body">
                                                        <span class="mb-0 text-sm">
                                                        {{ $m->nama }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </td>                                            
                                            @foreach ($m->absen as $a)
                                                <td scope="row">
                                                    <div class="media align-items-center">
                                                        <div class="media-body">
                                                            <span class="mb-0 text-sm">
                                                            {{ $a->keterangan }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </td>                                                                                            
                                            @endforeach
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