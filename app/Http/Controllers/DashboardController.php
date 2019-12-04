<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Auth;
use App\Dosen;
use App\Mahasiswa;

class DashboardController extends Controller
{
    public function index()
    {
        $dosen = Dosen::all();
        $mahasiswa = Mahasiswa::all();
        return view('dashboard.index', compact('dosen', 'mahasiswa'));
    }
}
