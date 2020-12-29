<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <table border="1">
        <thead>
            <tr>
                <th rowspan="3" style="vertical-align: middle">NO</th>
                <th rowspan="3">NIM</th>
                <th rowspan="3">NAMA MAHASISWA</th>
                <th colspan="8" style="text-align:center;">KOMPONEN NILAI</th>
                <th rowspan="3">ANGKA MUTU</th>
                <th rowspan="3">HURUF MUTU</th>
            </tr>
            <tr>
                {{-- <th></th>
                <th></th>
                <th></th> --}}
                <th>Absen</th>
                <th>Tugas</th>
                <th>UTS</th>
                <th>UAS</th>
                <th>Absen</th>
                <th>Tugas</th>
                <th>UTS</th>
                <th>UAS</th>
                <th></th>
            </tr>
            <tr>
                {{-- <th></th>
                <th></th>
                <th></th> --}}
                <th>0 - 14</th>
                <th>0 - 100</th>
                <th>0 - 100</th>
                <th>0 - 100</th>
                <th>10%</th>
                <th>20%</th>
                <th>30%</th>
                <th>40%</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @php $no = 0; @endphp
            @foreach ($x as $y)
            @php $no++; @endphp
                <tr>
                    <td>{{ $no }}</td>
                    <td>{{ $y->nim }}</td>
                    <td>{{ $y->nama }}</td>
                    <td>
                        @php $jumlah = 0; @endphp
                        @foreach ($y->absen as $a)
                            @if ($a->status == 1)
                                @php $jumlah++ @endphp
                            @endif
                        @endforeach
                        {{$jumlah}}
                    </td>
                    <td>
                        @foreach ($y->nilai as $n)
                            @if ($n->jenis_nilai == "Tugas" && $n->matkul_id == $mid)
                                {{$n->nilai}}
                            @endif
                        @endforeach
                    </td>
                    <td>
                        @foreach ($y->nilai as $n)
                            @if ($n->jenis_nilai == "UTS" && $n->matkul_id == $mid)
                                {{$n->nilai}}
                            @endif
                        @endforeach
                    </td>
                    <td>
                        @foreach ($y->nilai as $n)
                            @if ($n->jenis_nilai == "UAS" && $n->matkul_id == $mid)
                                {{$n->nilai}}
                            @endif
                        @endforeach
                    </td>
                    <td>
                        @php $jumlah = 0; @endphp
                        @foreach ($y->absen as $a)
                            @if ($a->status == 1)
                                @php $jumlah++ @endphp
                            @endif
                        @endforeach
                       @php $absen = ($jumlah*10)/100 @endphp
                       {{$absen}}
                    </td>
                    <td>
                        @foreach ($y->nilai as $n)
                            @if ($n->jenis_nilai == "Tugas" && $n->matkul_id == $mid)
                                @php $tugas = ($n->nilai*20)/100 @endphp
                                {{$tugas}}
                            @endif
                        @endforeach
                    </td>
                    <td>
                        @foreach ($y->nilai as $n)
                            @if ($n->jenis_nilai == "UTS" && $n->matkul_id == $mid)
                                @php $uts = ($n->nilai*30)/100 @endphp
                                {{$uts}}
                            @endif
                        @endforeach
                    </td>
                    <td>
                        @foreach ($y->nilai as $n)
                            @if ($n->jenis_nilai == "UAS" && $n->matkul_id == $mid)
                                @php $uas = ($n->nilai*40)/100 @endphp
                                {{$uas}}
                            @endif
                        @endforeach
                    </td>
                    @php $angka_mutu = $absen+$tugas+$uts+$uas; @endphp
                    <td>{{$angka_mutu}}</td>
                    <td style="">
                        @if ($angka_mutu > 80)
                            A
                        @elseif($angka_mutu > 68)
                            B
                        @elseif($angka_mutu > 56)
                            C
                        @elseif($angka_mutu > 45)
                            D
                        @else
                            E
                        @endif
                    </td>
                    @php $absen=0; $tugas=0; $uts=0; $uas=0; @endphp
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
