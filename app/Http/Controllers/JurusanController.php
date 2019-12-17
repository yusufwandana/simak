<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jurusan;

class JurusanController extends Controller
{
    public function index()
    {
        $jurusans = Jurusan::paginate(5);
        return view('jurusan.index', compact('jurusans'));
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'jurusan' => 'required|unique:jurusans'
        ]);

        Jurusan::create([
            'jurusan' => $request->jurusan
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
            'jurusan' => 'required|unique:jurusans'
        ]);

        $jurusan = Jurusan::find($id);
        $jurusan->jurusan = $request->jurusan;
        $jurusan->save();

        return redirect()->route('jurusan.index');
    }


    public function destroy($id)
    {
        $jurusan = Jurusan::find($id);
        $jurusan->delete();

        return redirect()->route('jurusan.index')->with('success', 'Jurusan telah berhasil dihapus');
    }
}
