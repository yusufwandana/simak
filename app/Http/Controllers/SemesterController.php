<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Semester;

class SemesterController extends Controller
{
    public function index()
    {
        $semesters = Semester::paginate(10);
        return view('semester.index', compact('semesters'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'semester' => 'required|numeric|digits:1|unique:semesters'
        ]);

        Semester::create([
            'semester' => $request->semester
        ]);

        return redirect()->route('semester.index')->with('success', 'Semester berhasil ditambahkan!');;
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $semester = Semester::find($id);
        return view('semester.edit', compact('semester'));
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'semester' => 'required|numeric|digits:1|unique:semesters'
        ]);
        
        $semester = Semester::find($id);
        $semester->semester = $request->semester;
        $semester->save();
        return redirect()->route('semester.index')->with('success', 'Semester berhasil diupdate!');;
    }

    public function destroy($id)
    {
        $semester = Semester::find($id);
        $semester->delete();
        return redirect()->route('semester.index')->with('success', 'Semester berhasil dihapus!');
    }
}
