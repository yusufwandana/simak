<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Auth;
use App\Dosen;
use App\Jurusan;
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
        return view('dashboard.dosen');
    }

    public function mahasiswa()
    {
        return view('dashboard.mahasiswa');
    }
}
