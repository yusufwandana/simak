@extends('layouts.master')

@section('title', 'SIMAK | Rekap Absen')

@section('head', 'Absen Mahasiswa ')

@section('content')
    
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
                    <h3 class="mb-0 float-left">Rekap Absen Mahasiswa</h3>
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

                    <h4 class="mb-0 float-right"> @php echo $a; @endphp, {{ date('d/m/Y') }}</h4>
                </div>  
                <form action="{{ route('absen.rekapost') }}" method="post">
                    @csrf
                    <input type="hidden" name="dosen_id" value="{{ $user->id }}">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="matkul_id">Mata kuliah</label>
                                    <select name="matkul_id" id="matkul_id" class="form-control mb-3" required>
                                        <option value="" selected disabled>Pilih mata kuliah</option> 
                                        @foreach ($dosen as $d)
                                            @foreach ($d->Matkul as $m)                                                
                                                <option value="{{ $m->id }}">{{ $m->matakuliah }}</option>
                                            @endforeach
                                        @endforeach
                                    </select>
                                </div> 
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="from">Dari</label>
                                    <input type="date" class="form-control" name="from" id="from" required>
                                </div> 
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="to">Sampai</label>
                                    <input type="date" class="form-control" name="to" id="to" required>
                                </div>                                
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
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