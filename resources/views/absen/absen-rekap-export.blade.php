{{-- <table>
    <tr>
        <td>Dosen : {{$dosen->nama}}</td>
    </tr>
    <tr>
        <td>Mata kuliah : {{$matkul->matakuliah}}</td>
    </tr>
    <tr>
        <td>Semester : {{$matkul->semester->semester}}</td>
    </tr>
    <tr>
        <td>Dari : {{$dari}}</td>
    </tr>
    <tr>
        <td>Sampai : {{$sampai}}</td>
    </tr>
</table> --}}
<table>
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Tanggal</th>
            <th scope="col">NIM</th>
            <th scope="col">Nama</th>
            <th scope="col">Keterangan</th>
        </tr>
        @php $no = 1; @endphp
        @foreach ($absen as $a)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $a->tanggal }}</td>
                <td>{{ $a->mahasiswa->nim }}</td>
                <td>{{ $a->mahasiswa->nama }}</td>
                <td>{{ $a->keterangan }}</td>
            </tr>
        @endforeach
    </thead>
</table>