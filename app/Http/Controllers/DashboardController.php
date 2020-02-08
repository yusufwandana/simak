<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Auth;
use App\Dosen;
use App\DosenMatkul;
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
        return view('dashboard.admin', compact('dosen', 'mahasiswa', 'matkul', 'jurusan'));
    }

    public function dosen()
    {
        $dosen = Dosen::where('user_id', auth()->user()->id)->first();
        $id = $dosen->id;
        $matkul = DosenMatkul::where('dosen_id', $id)->get();
        $jadwal = Jadwal::where('dosen_id', $id)->get();
        return view('dashboard.dosen', compact('matkul', 'jadwal'));
    }

    public function mahasiswa()
    {
        return view('dashboard.mahasiswa');
    }

    public function jadwalMahasiswa()
    {
        $id = auth()->user()->id;
        $mahasiswa = Mahasiswa::where('user_id', $id)->first();
        $jadwals   = Jadwal::where('semester_id', $mahasiswa->semester->id)->orderBy('tanggal', 'DESC')->paginate(10);

        return view('mahasiswa.jadwal', compact('jadwals'));
    }

    public function krsmatkul()
    {
        
    }
}
