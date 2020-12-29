<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jurusan;

class JurusanController extends Controller
{
    public function index()
    {
        $jurusans = Jurusan::paginate(10);
        return view('jurusan.index', compact('jurusans'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'jurusan' => 'required|unique:jurusans|min:8'
        ]);

        Jurusan::create([
            'jurusan' => ucwords($request->jurusan)
        ]);

        return redirect()->route('jurusan.index')->with('success', 'Jurusan telah berhasil ditambahkan');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $jurusan = Jurusan::find($id);
        return view('jurusan.edit', compact('jurusan'));
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'jurusan' => 'required|min:8'
        ]);

        $jurusan = Jurusan::find($id);
        $jurusan->jurusan = ucwords($request->jurusan);
        $jurusan->save();

        return redirect()->route('jurusan.index')->with('success', 'Jurusan telah berhasil diupdate!');
    }


    public function destroy($id)
    {
        $jurusan = Jurusan::find($id);
        $jurusan->delete();

        return redirect()->route('jurusan.index')->with('success', 'Jurusan telah berhasil dihapus');
    }
}
