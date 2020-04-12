<table>
    <tr>
        <td colspan="3">Dosen : {{auth()->user()->name}}</td>
        <td></td>
    </tr>
    <tr>
        <td colspan="3">Mata kuliah : {{$matkul->matakuliah}}</td>
        <td></td>
    </tr>
    <tr>
        <td colspan="3">Dari : {{$dari}}</td>
        <td></td>
    </tr>
    <tr>
        <td colspan="3">Sampai : {{$sampai}}</td>
        <td></td>
    </tr>
</table>
<table>
    <thead>
        <tr>
            <th scope="col" rowspan="2" style="text-align:center;">No</th>
            <th scope="col" rowspan="2" style="text-align:center;">NIM</th>
            <th scope="col" rowspan="2" style="text-align:center;">Nama</th>
            <th scope="col" colspan="{{$absen->unique('tanggal')->count()}}">Tanggal</th>
        </tr>
        <tr>
            @foreach ($absen->unique('tanggal') as $a)
                @php
                    $x = explode('-', $a->tanggal);
                    
                @endphp
                    <th>{{$x[2]}}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @php $no = 1 @endphp
        @foreach ($mahasiswa as $item)
            <tr>
                <th scope="col">{{$no}}</th>
                <th scope="col">{{$item->nim}}</th>
                <th scope="col">{{$item->nama}}</th>
                @foreach ($item->absen as $z)
                    @php $j = 0 @endphp
                    @if ($z->status == 1)
                        <th scope="col">1</th>
                    @else
                        <th scope="col">0</th>
                    @endif
                @endforeach
            </tr>
            @php $no++; @endphp
        @endforeach
    </tbody>
</table>