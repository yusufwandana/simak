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
    {
        
    }

    public function store(Request $request)
    {
        Matkul::create([
            'matakuliah' => $request->matakuliah,
            'semester_id' => $request->semester
        ]);
        return redirect()->route('matkul.index')->with('success', 'Mata kuliah berhasil ditambahkan!');
    }

    
    public function show($id)
    {
        
    }

    
    public function edit($id)
    {
        $matkul = Matkul::find($id);
        $semesters = Semester::all();
        return view('matkul.edit', compact('matkul', 'semesters'));
    }

    
    public function update(Request $request, $id)
    {
        $matkul = Matkul::find($id);
        $matkul->matakuliah = $request->matakuliah;
        $matkul->semester_id = $request->semester;
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
