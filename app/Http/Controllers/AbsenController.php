<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\RekapAbsenExport;
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
        if ($mahasiswa->count() === 0) {
            return back()->with('failed', 'Tidak ada mahasiswa yang mengemban mapel ini!');
        } else {
            $thn = $tahun->tahun_masuk;
        }
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
        //DARI
        $dari = explode('-', $request->from);
        $month = $dari[1];
        switch ($month) {
            case '01':
                $month = "Januari";
                break;

            case '02':
                $month = "Februari";
                break;

            case '03':
                $month = "Maret";
                break;

            case '04':
                $month = "April";
                break;

            case '05':
                $month = "Mei";
                break;

            case '06':
                $month = "Juni";
                break;

            case '07':
                $month = "Juli";
                break;

            case '08':
                $month = "Agustus";
                break;

            case '09':
                $month = "September";
                break;
            case '10':
                $month = "Oktober";
                break;

            case '11':
                $month = "November";
                break;

            case '12':
                $month = "Desember";
                break;

            default:
                $month = false;
                break;
        }

        $from = $dari[2] . ' ' . $month . ' ' . $dari[0];


        //SAMPAI
        $sampai = explode('-', $request->to);
        $bulan = $sampai[1];
        switch ($bulan) {
            case '01':
                $bulan = "Januari";
                break;

            case '02':
                $bulan = "Februari";
                break;

            case '03':
                $bulan = "Maret";
                break;

            case '04':
                $bulan = "April";
                break;

            case '05':
                $bulan = "Mei";
                break;

            case '06':
                $bulan = "Juni";
                break;

            case '07':
                $bulan = "Juli";
                break;

            case '08':
                $bulan = "Agustus";
                break;

            case '09':
                $bulan = "September";
                break;
            case '10':
                $bulan = "Oktober";
                break;

            case '11':
                $bulan = "November";
                break;

            case '12':
                $bulan = "Desember";
                break;

            default:
                $bulan = false;
                break;
        }

        $to = $sampai[2] . ' ' . $bulan . ' ' . $sampai[0];

        $matkul = Matkul::find($request->matkul_id);
        // $mahasiswa = Mahasiswa::with('absen')->where('semester_id', $matkul->semester_id)->orderBy('id', 'asc')->get(); 
        $absen = Absen::whereBetween('tanggal', [$request->from, $request->to])
            ->where([
                'dosen_id'     => $request->dosen_id,
                'matkul_id'    => $request->matkul_id
            ])->orderBy('tanggal', 'asc')->get();

        $data = [
            'matkul_id' => $request->matkul_id,
            'dosen_id'  => $request->dosen_id,
            'dari' => $request->from,
            'sampai' => $request->to,
            'from' => $from,
            'to' => $to
        ];

        return view('absen.rekap-result', compact('absen', 'mahasiswa', 'matkul', 'data'));
    }

    public function export_absen($matkulId, $dosenId, $dari, $sampai)
    {
        $matkul = Matkul::find($matkulId);
        $nama =  str_replace(' ', '', $matkul->matakuliah);
        $from = str_replace('-', '', $dari);
        $to = str_replace('-', '', $sampai);

        return Excel::download(new RekapAbsenExport($matkulId, $dosenId, $dari, $sampai),  $from . "_" . $to . "_" . $nama . ".xlsx");
    }
}
