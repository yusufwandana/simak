<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ruangan;

class RuanganController extends Controller
{
    public function index()
    {
        $ruangans = Ruangan::paginate(10);
        return view('ruangan.index', compact('ruangans'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'ruangan' => 'required',
            ]);

        Ruangan::create([
            'ruangan' => $request->ruangan,
            'jenis'   => $request->jenis
        ]);

        return redirect()->route('ruangan.index')->with('success', 'Ruangan berhasil ditambahkan');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $ruangan = Ruangan::find($id);
        return view('ruangan.edit', compact('ruangan'));
    }


    public function update(Request $request, $id)
    {
        $ruangan = Ruangan::find($id);
        $ruangan->ruangan = $request->ruangan;
        $ruangan->jenis   = $request->jenis;
        $ruangan->save();
        return redirect()->route('ruangan.index', compact('ruangan'))->with('success', 'Ruangan berhasil diupdate');
    }


    public function destroy($id)
    {
        $ruangan = Ruangan::find($id);
        $ruangan->delete();
        return redirect()->route('ruangan.index', 'ruangan')->with('success', 'Ruangan berhasil dihapus');
    }
}
