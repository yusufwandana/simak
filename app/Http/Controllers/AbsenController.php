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
        $this->validate($request, [
            'matkul_id' => 'required'
        ]);
        $matkul = Matkul::find($request->matkul_id);
        $semester = Semester::find($matkul->semester_id);
        $mahasiswa = Mahasiswa::where('semester_id', $semester->id)->get();
        $tahun = Mahasiswa::where('semester_id', $semester->id)->first();
        $thn = $tahun->tahun_masuk;
        $no = 1;
        if ($request->tanggal == null) {
            $tgl = date('Y-m-d');
        } else {
            $tgl = $request->tanggal;
        }

        return view('absen.daftarmhs', compact('no', 'mahasiswa', 'thn', 'matkul', 'semester', 'tgl'));
    }

    public function postabsen(Request $request)
    {
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

    public function rekapAbsen()
    {
        $dosen = Dosen::where('user_id', auth()->user()->id)->with('Matkul.Semester')->get();
        $user  = Dosen::where('user_id', auth()->user()->id)->first();
        return view('absen.rekap', compact('dosen', 'user'));
    }

    public function rekapPost(Request $request)
    {
        $matkul = Matkul::find($request->matkul_id);
        $semester = Semester::find($matkul->semester_id);
        $mahasiswa = Mahasiswa::where('semester_id', $semester->id)->get();
        $a = explode('-', $request->tanggal);
        $tahun = $a[0];
        $bulan = $a[1];
        $tanggal = $a[2];

        $matkul = Matkul::find($request->matkul_id);
        $mahasiswa = Mahasiswa::with('absen')->where('semester_id', $matkul->semester_id)->orderBy('id', 'asc')->get();
        // foreach ($mahasiswa as $m) {
        //     dd($m->absen);
        // }

        $absen = Absen::where([
            'dosen_id'     => $request->dosen_id,
            'matkul_id'    => $request->matkul_id
        ])->whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun)->orderBy('tanggal', 'asc')->get();
        
        // foreach ($mahasiswa as $m) {
        //     foreach ($m->absen as $l) {
        //         dd($l->keterangan);
        //     }
        // }
            // foreach ($mahasiswa as $m) {
            // }
        // $absen = DB::table('absens')->where([
        //     'dosen_id'  => $request->dosen_id,
        //     'matkul_id' => $request->matkul_id
        // ])->whereMonth('tanggal', $bulan)->whereYear('tanggal', 2019)->get();
        // dd($absen);

        // foreach ($absen as $a) {
        //     $b[] = explode('-', $a->tanggal);
        // }
        // dd($b);

        return view('absen.rekap-result', compact('absen', 'mahasiswa', 'matkul', 'semester'));
    }
}
