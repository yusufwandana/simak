<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Semester;

class SemesterController extends Controller
{
    public function index()
    {
        $semesters = Semester::orderBy('semester', 'asc')->paginate(10);
        return view('semester.index', compact('semesters'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'semester' => 'required|numeric|digits:1|unique:semesters|min:1'
        ]);

        Semester::create([
            'semester' => $request->semester
        ]);

        return redirect()->route('semester.index')->with('success', 'Semester berhasil ditambahkan!');;
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
