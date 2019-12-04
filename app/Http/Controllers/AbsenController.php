<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Absen;
use App\Matkul;
use App\Dosen;
use App\Mahasiswa;
use App\Semester;

class AbsenController extends Controller
{
    public function index()
    {
        $dosen = Dosen::where('user_id', auth()->user()->id)->with('Matkul.Semester')->get();

        return view('absen.index', compact('dosen'));
    }

    public function daftarMhs(Request $request)
    {
        $matkul = Matkul::find($request->matkul_id);
        $semester = Semester::find($matkul->semester_id);
        $mahasiswa = Mahasiswa::where('semester_id', $semester->id)->get();
        $tahun = Mahasiswa::where('semester_id', $semester->id)->first();
        $thn = $tahun->tahun_masuk;
        $tgl = $request->tanggal;
        $no = 1;

        return view('absen.daftarmhs', compact('no', 'mahasiswa', 'thn', 'matkul', 'semester', 'tgl'));
    }

    public function postabsen(Request $request)
    {
        // dd($request->absen);
        $absen = [];

        $tgl = $request->tanggal;
        $dosen = Dosen::where('user_id', auth()->user()->id)->first();
        $now = date('Y-m-d H:i:s');

        if ($request->absen == null) {
            return redirect()->route('absen.index');
        } else {
            foreach ($request->absen as $val) {

                $data = explode("-", $val);
                $mhs = $data[0];
                $ket = $data[1];

                $absen[] = [
                    'tanggal'  => $tgl,
                    'dosen_id' => $dosen->id,
                    'mahasiswa_id' => $mhs,
                    'matkul_id' => $request->matkul_id,
                    'keterangan' => $ket,
                    'created_at' => $now,
                    'updated_at' => $now
                ];
            }

            Absen::insert($absen);
            return redirect()->route('absen.index')->with('success', 'Anda telah mengabsen hari ini! Selamat mengajar :)');
        }
    }
}
