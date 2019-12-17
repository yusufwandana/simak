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

        foreach ($dosen as $d) {
            foreach ($d->Matkul as $value) {
                foreach ($value->Semester as $v) { }
            }
        }

        return view('nilai.index', compact('dosen'));
    }

    public function daftarMhs(Request $request)
    {
        $matkul    = Matkul::find($request->matkul_id);
        $semester  = Semester::find($matkul->semester_id);
        $mahasiswa = Mahasiswa::where('semester_id', $semester->id)->get();
        $no = 1;

        return view('nilai.daftarmhs', compact('matkul', 'semester', 'mahasiswa', 'no'));
    }


    public function show($mhsId, $matkulId)
    {
        $dosen     = Dosen::where('user_id', auth()->user()->id)->with('Matkul.Semester')->get();
        $matkul    = Matkul::find($matkulId);
        $mahasiswa = Mahasiswa::find($mhsId);
        $user      = User::find($mahasiswa->user_id);
        $nilaimhs  = Nilai::where('mahasiswa_id', $mahasiswa->id)->get();

        return view('nilai.addnilai', compact('user', 'mahasiswa', 'dosen', 'nilaimhs', 'matkul'));
    }


    public function edit($id)
    {
        $nilai = Nilai::find($id);
        return response()->json($nilai);
    }


    public function update(Request $request, $id)
    {
        $nilai = Nilai::find($id);
        $nilai->nilai = $request->score;
        $nilai->save();

        return redirect()->back()->with('success', 'Nilai telah diperbarui!');
    }


    public function destroy($id)
    {
        $nilai = Nilai::find($id);
        $nilai->delete();

        return back()->with('success', 'Nilai berhasil dihapus!');
    }

    public function addnilai(Request $request)
    {
        $this->validate($request, [
            'nilai' => 'required|numeric|max:100'
        ]);

        $a = Nilai::where([
            'mahasiswa_id' => $request->mahasiswa_id,
            'matkul_id'    => $request->matkul_id,
            'jenis_nilai'  => $request->jenis
        ])->first();

        if ($a) {
            return redirect()->back();
        }

        Nilai::create([
            'jenis_nilai'  => $request->jenis,
            'mahasiswa_id' => $request->mahasiswa_id,
            'matkul_id'    => $request->matkul_id,
            'nilai'        => $request->nilai
        ]);

        return redirect()->back();
    }

    public function store(Request $request)
    {
        $a = Nilai::create([
            'jenis_nilai' => $request->jenis,
            'mahasiswa_id' => $request->mahasiswa_id,
            'matkul_id' => $request->matkul_id,
            'nilai' => $request->nilai
        ]);

        return ["success"];
    }
}
