@extends('layouts.master')

@section('title', 'SIMAK2019 | Absen Mahasiswa')

@section('head', 'Absen Mahasiswa')

@section('content')
<div class="container-fluid mt--9">
    <div class="row">
        <div class="col-md">
            <div class="card shadow">
                <div class="card-header bg-transparent">
                    <div class="row">
                        <div class="col-md-9">
                            <h3 class="mb-0 float-left">Absen Mahasiswa</h3>
                        </div>
                        <div class="col-md-3">
                            <h4 class="mb-0 float-left">{{ $tgl }}</h4>
                            <a href="{{ route('absen.index') }}" class="badge badge-warning float-right">kembali</a>
                        </div>
                    </div>
                    <br>
                    <br>
                    <table>
                        <tr>
                            <td>Dosen</td>
                            <td>:</td>
                            <td>{{ auth()->user()->name }}</td>
                        </tr>
                        <tr>
                            <td>Tahun masuk &nbsp;</td>
                            <td>:</td>
                            <td>{{ $thn }}</td>
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
                    <form action="{{ route('absen.postabsen') }}" method="post">
                        @csrf          
                        <input type="hidden" name="tanggal" value="{{ $tgl }}">
                        <input type="hidden" name="semester_id" value="{{ $semester->id }}">
                        <input type="hidden" name="matkul_id" value="{{ $matkul->id }}">
                        <div class="row">
                            <div class="col-md">
                                <div class="table-responsive">
                                    <table class="table align-items-center table-flush">
                                    <thead class="thead-light">
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">NIM</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Jenis Kelamin</th>
                                        <th class="text-center" scope="col">Keterangan</th>
                                        <th></th>
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
                                        <td scope="row">
                                            {{-- <div class="custom-control custom-control-alternative custom-checkbox"> --}}
                                                <select class="form-control form-control-sm check-class" name="absen[]" id="check-{{ $mhs->id }}">
                                                    <option value="{{$mhs->id}}-1">Hadir</option>
                                                    <option value="{{$mhs->id}}-0">Tidak Hadir</option>
                                                </select>
                                                {{-- <input class="custom-control-input check-class" id="check-{{ $mhs->id }}" type="checkbox" name="absen[]" value="{{ $mhs->id }}">
                                                <label class="custom-control-label" for="check-{{ $mhs->id }}">
                                                    <span class="text-muted">Hadir</span>
                                                </label> --}}
                                            {{-- </div> --}}
                                        </td>
                                    </tr>    
                                    @endforeach
                                    </tbody>
                                </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-sm">Selesai</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('customjs')

    <script>

        $(document).ready(function(){

            $('#check-').on('change', function(){
                var check = $(this).attr('checked');
                var val   = $(this) .val();
                $('#check-absen1').hide();
            });

        });

    </script>
    
@endsection