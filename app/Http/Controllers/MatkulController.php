<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Matkul;
use App\Semester;

class MatkulController extends Controller
{
    public function index()
    {
        $matkuls = Matkul::orderBy('kd_matkul', 'asc')->paginate(10);
        $semesters = Semester::all();
        return view('matkul.index', compact('matkuls', 'semesters'));
    }

    public function create()
    {
        $matkul = Matkul::orderBy('kd_matkul', 'asc')->paginate(10);
        $semester = Semester::all();

        return view('matkul.create',compact('matkul','semester'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'kd_matkul'   => 'required|string|min:8|max:8|unique:matkuls',
            'matakuliah'  => 'required|unique:matkuls',
            'semester'    => 'required',
            'kategori'    => 'required',
            'sks'         => 'required|numeric|min:1|max:4'
        ]);

        $test  = strtolower($request->matakuliah);
        $slug1 = str_replace(' ', '-', $test);
        $slug  = $slug1 . '-' . $request->semester;
        
        $a = Matkul::create([
            'kd_matkul'   => strtoupper($request->kd_matkul),
            'matakuliah'  => ucwords($request->matakuliah),
            'semester_id' => $request->semester,
            'sks'         => $request->sks,
            'slug'        => $slug,
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
        $this->validate($request, [
            'matakuliah'  => 'required',
            'sks'         => 'required|numeric|min:1|max:4'
        ]);

        $test  = strtolower($request->matakuliah);
        $slug1 = str_replace(' ', '-', $test);
        $slug  = $slug1 . '-' . $request->semester;

        $matkul = Matkul::find($id);
        $matkul->kd_matkul   = strtoupper($request->kd_matkul);
        $matkul->matakuliah  = ucwords($request->matakuliah);
        $matkul->semester_id = $request->semester;
        $matkul->sks         = $request->sks;
        $matkul->slug        = $slug;
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
