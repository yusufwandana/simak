<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\NilaiExport;
use App\ExportNilai;
use App\Nilai;
use App\Dosen;
use App\Matkul;
use App\Semester;
use App\Mahasiswa;
use App\User;

class NilaiController extends Controller
{
    public function index()
    {
        $dosen = Dosen::where('user_id', auth()->user()->id)->with('Matkul.Semester')->get();
        // foreach ($dosen as $d) {
        //     foreach ($d->Matkul as $value) {
        //         foreach ($value->Semester as $v) {

        //          }
        //     }
        // }

        return view('nilai.index', compact('dosen'));
    }

    public function daftarMhs($id, $slug)
    {
        $matkul    = Matkul::find($id);
        $semester  = Semester::find($matkul->semester_id);
        $mahasiswa = Mahasiswa::where('semester_id', $semester->id)->get();
        $no = 1;

        return view('nilai.daftarmhs', compact('matkul', 'semester', 'mahasiswa', 'no'));
    }


    public function show($mhsId, $matkulId)
    {
        $dosen     = Dosen::where('user_id', auth()->user()->id)->with('Matkul.Semester')->get();
        $matkul    = Matkul::find($matkulId);
        $mahasiswa = Mahasiswa::find($mhsId);
        $user      = User::find($mahasiswa->user_id);
        $nilaimhs  = Nilai::where([
            'mahasiswa_id' => $mahasiswa->id,
            'matkul_id'    => $matkul->id
        ])->get();

        return view('nilai.addnilai', compact('user', 'mahasiswa', 'dosen', 'nilaimhs', 'matkul'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nilai' => 'max:100|numeric'
        ]);

        $exist = Nilai::where([
            'jenis_nilai' => $request->jenis,
            'mahasiswa_id' => $request->mahasiswa_id,
            'matkul_id'   => $request->matkul_id
        ])->first();

        if ($exist) {
            return ['failed'];
        } else {
            $a = Nilai::create([
                'jenis_nilai' => $request->jenis,
                'mahasiswa_id' => $request->mahasiswa_id,
                'matkul_id' => $request->matkul_id,
                'nilai' => $request->nilai
            ]);

            return ["success"];
        }
    }

    public function nilaiUpdate(Request $request, $id)
    {
        $form_data = [
            'nilai' => $request->score
        ];

        $a = Nilai::where('id', $request->my_id)->update($form_data);

        return response()->json(['success' => 'Data sukses diupdate!']);
    }


    public function edit($id)
    {
        $nilai = Nilai::find($id);
        return response()->json($nilai);
    }

    public function destroy($id)
    {
        $nilai = Nilai::find($id);
        $nilai->delete();

        return back()->with('success', 'Nilai berhasil dihapus!');
    }

    public function export_nilai(Request $request, $matkulId, $semesterId)
    {
        return Excel::download(new NilaiExport($request->jenis, $matkulId, $semesterId), 'export_nilai' . '_' . $request->jenis . '.xlsx');
    }
}
