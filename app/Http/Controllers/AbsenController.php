<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\RekapAbsenExport;
use App\Absen;
use App\Matkul;
use App\Dosen;
use App\Jadwal;
use App\Mahasiswa;
use App\Semester;
use App\User;

class AbsenController extends Controller
{
    public function index()
    {
        if (auth()->user()->role == 'admin') {
            $dosen  = Matkul::all();
            $jadwal = [];
        }else{
            $dosen  = Dosen::where('user_id', auth()->user()->id)->with('Matkul.Semester')->get();
            $user   = Dosen::where('user_id', auth()->user()->id)->first();
            $jadwal = Jadwal::where('dosen_id', $user->id)->latest()->get();
        }

        return view('absen.index', compact('dosen', 'jadwal'));
    }

    public function daftarMhs(Request $request)
    {
        $cek = Absen::where([
            'tanggal' => $request->tanggal,
            'matkul_id' => $request->matkul_id
        ])->first();

        if ($cek) {
            return back()->with('failed', 'Anda telah mengabsen pada mata kuliah dan tanggal tersebut!');
        } else {
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
    }

    public function postabsen(Request $request)
    {
        $absen = [];

        // $cek = Absen::

        $tgl = $request->tanggal;
        $dosen = Dosen::where('user_id', auth()->user()->id)->first();
        $now = date('Y-m-d H:i:s');
        $matkul = Matkul::find($request->matkul_id);
        // dd($matkul->semester_id);

        if ($request->absen == null) {
            return redirect()->route('absen.index')->with('failed', 'Anda telah mengabsen pada tanggal tersebut!');
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
                    'semester_id' => $matkul->semester_id,
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
        if (auth()->user()->role == 'admin') {
            $matkul = Matkul::all();
            $user  = Dosen::where('user_id', 42)->first();
        }else{
            $matkul = Dosen::where('user_id', auth()->user()->id)->with('Matkul.Semester')->get();
            $user  = Dosen::where('user_id', auth()->user()->id)->first();
        }
        return view('absen/rekap', compact('matkul', 'user'));
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
        $dosen = Dosen::where('user_id', auth()->user()->id)->first();
        $absen = Absen::whereBetween('tanggal', [$request->from, $request->to])
            ->where([
                'dosen_id'     => $request->dosen_id,
                'matkul_id'    => $request->matkul_id,
                'dosen_id'     => $dosen->id
            ])->orderBy('tanggal', 'desc')->get();

        $mahasiswa = Mahasiswa::where('semester_id', $matkul->semester_id)->get();
        $fix = [];
        foreach ($mahasiswa as $m) {
            $cek = Absen::whereBetween('tanggal', [$request->from, $request->to])
                   ->where(['mahasiswa_id'  =>  $m->id,
                            'dosen_id'      =>  $request->dosen_id,
                            'matkul_id'     =>  $request->matkul_id,
                            'dosen_id'      =>  $dosen->id,
                            'keterangan'    =>  1 ])->get();
            $jml = $cek->count();
            $fix[] = [
                'mahasiswa_id'  =>  $m->id,
                'jumlah'        =>  $jml
            ];
        }

        $data = [
            'matkul_id' => $request->matkul_id,
            'dosen_id'  => $request->dosen_id,
            'dari' => $request->from,
            'sampai' => $request->to,
            'from' => $from,
            'to' => $to
        ];

        $date = [
            'from'  =>  $request->from,
            'to'    =>  $request->to
        ];

        $encrypted = Crypt::encrypt($date);

        return view('absen.rekap-result', compact('absen', 'mahasiswa', 'matkul', 'data', 'fix', 'encrypted'));
    }

    public function absenDetail($encrypted, $mhsid, $dsnid)
    {
        $decrypted = Crypt::decrypt($encrypted);

        $dosen = Dosen::find($dsnid);
        $absen = Absen::whereBetween('tanggal', [$decrypted['from'], $decrypted['to']])
                    ->where(['mahasiswa_id' => $mhsid,
                             'dosen_id'     => $dosen->id])->orderBy('id', 'DESC')->paginate(10);
        return view('absen.rekap-detail', compact('absen'));
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
