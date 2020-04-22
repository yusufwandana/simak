@extends('layouts.master')

@section('head', 'Kehadiran')

@section('title', 'SIMAK2019 | Mahasiswa')

@section('content')
<div class="container-fluid mt--9 mb-5">
    <div class="row">
        <div class="col">
            <div class="card shadow">
              <div class="card-header border-0">
                <div class="row">
                  <div class="col-md">
                    <h3 class="mb-0">Detail Kehadiran</h3>
                  </div>
                </div>
                <br>
                <div class="row">
                  <div class="col-md">
                    <table>
                      <tr>
                        <td>Nama Mahasiswa</td>
                        <td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;</td>
                        <td>{{$mahasiswa->nama}}</td>
                      </tr>
                      <tr>
                        <td>Semester</td>
                        <td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;</td>
                        <td>Semester {{$mahasiswa->semester->semester}}</td>
                      </tr>
                      <tr>
                        <td>Jumlah masuk</td>
                        <td>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;</td>
                        <td>{{$hadir}} dari 14</td>
                      </tr>
                    </table>
                  </div>
                </div>
              </div>
              <div class="table-responsive">
                <table class="table align-items-center table-flush">
                  <thead class="thead-light">
                    <tr>
                      <th scope="col">No</th>
                      <th scope="col">Tanggal</th>
                      <th scope="col">Matkul</th>
                      @if (auth()->user()->role == 'admin') <th scope="col">Dosen</th> @endif
                      <th scope="col">Keterangan</th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach ($absen as $key => $item)
                        <tr>
                          <td><b>{{$absen->firstItem() + $key}}</b></td>
                          <td scope="row">
                            <div class="media align-items-center">
                                <div class="media-body">
                                    <span class="mb-0 text-sm">
                                        {{$item->tanggal}}
                                    </span>
                                </div>
                            </div>
                          </td>
                          <td scope="row">
                            <div class="media align-items-center">
                                <div class="media-body">
                                    <span class="mb-0 text-sm">
                                        {{$item->matkul->matakuliah}}
                                    </span>
                                </div>
                            </div>
                          </td>
                          @if (auth()->user()->role == 'admin')
                          <td scope="row">
                              <div class="media align-items-center">
                                  <div class="media-body">
                                      <span class="mb-0 text-sm">
                                          {{$item->dosen->nama}}
                                      </span>
                                  </div>
                              </div>
                            </td>
                            @else
                                
                            @endif
                          <td scope="row">
                            <div class="media align-items-center">
                                <div class="media-body">
                                  @if ($item->status == 1)
                                    <span class="mb-0 text-sm text-green">
                                        Hadir
                                    </span>
                                  @elseif($item->status == 2)
                                  <span class="mb-0 text-sm text-orange">
                                        Sakit
                                  </span>
                                  @elseif($item->status == 3)
                                  <span class="mb-0 text-sm text-purple">
                                        Izin
                                  </span>
                                  @elseif($item->status == 4)
                                  <span class="mb-0 text-sm text-primary">
                                        Kerja
                                  </span>
                                  @else 
                                    <span class="mb-0 text-sm text-red">
                                          Alfa
                                    </span>
                                  @endif
                                </div>
                            </div>
                          </td>
                        </tr>
                        @endforeach
                  </tbody>
                </table>
              </div>
              <div class="card-footer py-4">
                  {{$absen->links()}}
              </div>
            </div>
          </div>
    </div>
</div>

@endsection