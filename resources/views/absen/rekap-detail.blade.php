@extends('layouts.master')

@section('head', 'Kehadiran')

@section('title', 'SIMAK2019 | Mahasiswa')

@section('content')
<div class="container-fluid mt--9 mb-5">
    <div class="row">
        <div class="col">
            <div class="card shadow">
              <div class="card-header border-0">
                <h3 class="mb-0">Detail Kehadiran</h3>
              </div>
              <div class="table-responsive">
                <table class="table align-items-center table-flush">
                  <thead class="thead-light">
                    <tr>
                      <th scope="col">No</th>
                      <th scope="col">Tanggal</th>
                      <th scope="col">Matkul</th>
                      {{-- <th scope="col">Dosen</th> --}}
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
                          {{-- <td scope="row">
                            <div class="media align-items-center">
                                <div class="media-body">
                                    <span class="mb-0 text-sm">
                                        {{$item->dosen->nama}}
                                    </span>
                                </div>
                            </div>
                          </td> --}}
                          <td scope="row">
                            <div class="media align-items-center">
                                <div class="media-body">
                                  @if ($item->keterangan == 1)
                                    <span class="mb-0 text-sm text-green">
                                          Hadir
                                    </span>
                                  @else 
                                    <span class="mb-0 text-sm text-red">
                                          Tidak Hadir
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

              </div>
            </div>
          </div>
    </div>
</div>

@endsection