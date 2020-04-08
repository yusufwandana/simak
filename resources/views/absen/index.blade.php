@extends('layouts.master')

@section('title', 'SIMAK | Absen Mahasiswa')

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
                    @if ($message = Session::get('failed'))
                    <div class="alert alert-danger alert-sm alert-dismissible fade show" role="alert">
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
                            <h3 class="mb-0">Absen Mahasiswa</h3>
                        </div>
                        <div class="col-md-3">
                            <h4 class="mb-0">@php echo $a; @endphp, {{ date('d/m/Y') }}</h4>
                        </div>
                    </div>
                </div>  
                <form action="{{ route('absen.daftarmhs') }}" method="post">
                    @csrf          
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="matkul_id">Mata kuliah</label>
                                    <select name="matkul_id" id="matkul_id" class="form-control mb-3" required>
                                        <option value="" selected disabled>Pilih mata kuliah</option>                                            
                                        @if (auth()->user()->role == 'admin')
                                            @foreach ($dosen as $mm)
                                                <option value="{{ $mm->id }}">{{ $mm->matakuliah }}</option>
                                            @endforeach
                                        @elseif(auth()->user()->role == 'dosen')
                                            @foreach ($dosen as $m)
                                                @foreach ($m->Matkul as $mm)
                                                    <option value="{{ $mm->id }}">{{ $mm->matakuliah }}</option>
                                                @endforeach
                                            @endforeach
                                        @else
                                            @php die(); @endphp
                                        @endif
                                    </select>
                                </div> 
                            </div>
                            <div class="col-md-2"></div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="tanggal">Tanggal absen</label>
                                    @if (auth()->user()->role == 'admin')
                                        <input type="date" class="form-control" name="tanggal" id="tanggal">
                                    @else
                                        <select name="tanggal" id="tanggal" class="form-control">
                                            <option value="Pilih tanggal absen.." selected disabled>Pilih tanggal absen..</option>
                                            @foreach ($jadwal as $item)
                                                <option value="{{$item->tanggal}}">{{$item->tanggal}}</option>
                                            @endforeach
                                        </select>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md">
                                <button type="submit" class="btn btn-primary btn-sm">Tampilkan</button>
                            </div>
                        </div>
                    </div>       
                </form>
            </div>
        </div>
    </div>
</div>
@endsection