<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jadwal;
use App\Dosen;
use App\Matkul;
use App\Ruangan;
use App\DosenMatkul;

class JadwalController extends Controller
{
    public function index()
    {
        $jadwals  = Jadwal::paginate(5);
        $dosens   = Dosen::paginate(5);
        $matkuls  = Matkul::paginate(5);
        $ruangans = Ruangan::all();
        
        // dd($jadwals);
        return view('jadwal.index', compact('jadwals', 'dosens', 'matkuls', 'ruangans'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        Jadwal::create([
            'waktu'      => $request->time,
            'tanggal'    => $request->date,
            'dosen_id'   => $request->dosenId,
            'matkul_id'  => $request->matkulId,
            'ruangan_id' => $request->ruanganId
        ]);

        return redirect()->route('jadwal.index')->with('success', 'Jadwal telah berhasil diatur!');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        $jadwal = Jadwal::find($id);
        $jadwal->delete();

        return redirect()->route('jadwal.index')->with('success', 'Data telah berhasil dihapus!');
    }

    public function getMatkuls($id)
    {
        $dsn =  DosenMatkul::where('dosen_id', $id)->orderBy('id', 'asc')->get();
        foreach ($dsn as $a) {
            $results[] = Matkul::where('id', $a->matkul_id)->first();
        }

        return response()->json([
            'results' => $results
        ]);
    }
}
