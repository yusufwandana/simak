<table>
    <thead>
        <tr>
            <th>No</th>
            <th>NIM</th>
            <th>Nama</th>
            <th>Matakuliah</th>
            <th>Semester</th>
            <th>Jenis Nilai</th>
            <th>Nilai</th>
        </tr>
        @php $no = 0; @endphp
        @foreach ($x as $y)
        @php $no++; @endphp
            <tr>
                <td>{{ $no }}</td>
                <td>{{ $y->nim }}</td>
                <td>{{ $y->nama }}</td>
                <td>{{ $y->matakuliah }}</td>
                <td>{{ $y->semester }}</td>
                <td>{{ $y->jenis_nilai }}</td>
                <td>{{ $y->nilai }}</td>
            </tr>
        @endforeach
    </thead>
</table>