<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Nilai;
use App\Dosen;
use App\Matkul;
use App\Semester;
use App\Mahasiswa;
use App\User;

class NilaiController extends Controller
{
    public function index()
    {
        $dosen = Dosen::where('user_id', auth()->user()->id)->with('Matkul.Semester')->get();
        // dd($dosen);
        return view('nilai.index', compact('dosen'));
    }

    public function store(Request $request)
    {
        $matkul    = Matkul::find($request->matkul_id);
        $semester  = Semester::find($matkul->semester_id);
        $mahasiswa = Mahasiswa::where('semester_id', $semester->id)->get();
        $no = 1;

        return view('nilai.daftarmhs', compact('matkul', 'semester', 'mahasiswa', 'no'));
    }


    public function show($id)
    {
        $dosen     = Dosen::where('user_id', auth()->user()->id)->with('Matkul.Semester')->get();
        $mahasiswa = Mahasiswa::find($id);
        $user      = User::find($mahasiswa->user_id);
        $nilaimhs  =  Nilai::where('mahasiswa_id', $mahasiswa->id)->get();

        return view('nilai.addnilai', compact('user', 'mahasiswa', 'dosen', 'nilaimhs'));
    }


    public function edit($id)
    { }


    public function update(Request $request, $id)
    { }


    public function destroy($id)
    { 
        $nilai = Nilai::find($id);
        $nilai->delete();

        return back()->with('success', 'Nilai berhasil dihapus!');
    }

    public function addnilai(Request $request)
    {
        // dd($request->all());
        Nilai::create([
            'jenis_nilai'  => $request->jenis,
            'mahasiswa_id' => $request->mahasiswa_id,
            'matkul_id'    => $request->matkul_id,
            'nilai'        => $request->nilai
        ]);

        return back()->with('success', 'Nilai berhasil ditambahkan!');
    }
}
