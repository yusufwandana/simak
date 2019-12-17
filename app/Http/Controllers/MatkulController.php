<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Matkul;
use App\Semester;

class MatkulController extends Controller
{
    public function index()
    {
        $matkuls = Matkul::paginate(5);
        $semesters = Semester::all();
        return view('matkul.index', compact('matkuls', 'semesters'));
    }

    public function create()
    { }

    public function store(Request $request)
    {
        $this->validate($request, [
            'kd_matkul'   => 'required|min:8|max:8|unique:matkuls',
            'matakuliah'  => 'required|unique:matkuls',
            'sks'         => 'required|numeric|digits:1'
        ]);
        $a = Matkul::create([
            'kd_matkul'   => $request->kd_matkul,
            'matakuliah'  => $request->matakuliah,
            'semester_id' => $request->semester,
            'sks'         => $request->sks,
            'kategori'    => $request->kategori
        ]);

        // dd($a);
        return redirect()->route('matkul.index')->with('success', 'Mata kuliah berhasil ditambahkan!');
    }


    public function show($id)
    { }


    public function edit($id)
    {
        $matkul = Matkul::find($id);
        $semesters = Semester::all();
        return view('matkul.edit', compact('matkul', 'semesters'));
    }


    public function update(Request $request, $id)
    {
        $matkul = Matkul::find($id);
        $matkul->kd_matkul   = $request->kode_matkul;
        $matkul->matakuliah  = $request->mata_kuliah;
        $matkul->semester_id = $request->semester;
        $matkul->sks         = $request->sks;
        $matkul->kategori    = $request->kategori;
        $matkul->save();

        return redirect()->route('matkul.index')->with('success', 'Mata kuliah berhasil diupdate!');
    }


    public function destroy($id)
    {
        $matkul = Matkul::find($id);
        $matkul->delete();

        return redirect()->route('matkul.index')->with('success', 'Mata kuliah berhasil dihapus!');
    }
}
