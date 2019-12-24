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
    { }

    public function store(Request $request)
    {
        $this->validate($request, [
            'kd_matkul'   => 'required|min:8|max:8|unique:matkuls',
            'matakuliah'  => 'required|unique:matkuls',
            'slug'        => 'unique:matkuls',
            'sks'         => 'required|numeric|digits:1'
        ]);

        $test = strtolower($request->slug);
        $slug = str_replace(' ', '-', $test);
        
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
            'sks'         => 'required|numeric|digits:1'
        ]);

        $test = strtolower($request->slug);
        $slug = str_replace(' ', '-', $test);

        $matkul = Matkul::find($id);
        $matkul->kd_matkul   = strtoupper($request->kd_matkul);
        $matkul->matakuliah  = ucwords($request->mata_kuliah);
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
