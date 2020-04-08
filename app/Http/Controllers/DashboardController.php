<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Auth;
use App\Dosen;
use App\User;
use App\DosenMatkul;
use App\MateriTugas;
use App\Jurusan;
use App\Jadwal;
use App\Mahasiswa;
use App\Matkul;

class DashboardController extends Controller
{
    public function admin()
    {
        $dosen = Dosen::all();
        $mahasiswa = Mahasiswa::all();
        $matkul = Matkul::all();
        $jurusan = Jurusan::all();
        $mt = MateriTugas::orderBy('id', 'DESC')->get();
        return view('dashboard.admin', compact('dosen', 'mahasiswa', 'matkul', 'jurusan', 'mt'));
    }

    public function dosen()
    {
        $mt = MateriTugas::orderBy('id', 'DESC')->get();
        return view('dashboard.dosen', compact('mt'));
    }

    public function mahasiswa()
    {        
        $smstr = Mahasiswa::where('user_id', auth()->user()->id)->first();
        $mt = MateriTugas::where('semester_id', $smstr->semester->id)->orderBy('id', 'DESC')->get();
        return view('dashboard.mahasiswa', compact('mt'));
    }

    public function jadwalMahasiswa()
    {
        $date = date('Y-m-d');
        $time = date('H:i:s');
        // dd($date);
        // $b = explode('-', $a);
        // $c = (int)$b[2];
        // $plus = $c +
        $id = auth()->user()->id;
        $mahasiswa = Mahasiswa::where('user_id', $id)->first();
        $jadwals   = Jadwal::where([
            ['semester_id', "=",  $mahasiswa->semester->id],
            ['tanggal',     ">=", $date],
            ['selesai',     "<",  $time]
            ])->orderBy('tanggal', 'ASC')->paginate(10);

        return view('mahasiswa.jadwal', compact('jadwals'));
    }

}
