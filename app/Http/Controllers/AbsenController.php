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
        if ($request->tanggal == null) {
            $tgl = date('Y-m-d');
        } else {
            $tgl = $request->tanggal;
        }

        $cek = Absen::where([
            'tanggal' => $tgl,
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
                $stat = $data[1];

                if ($stat == 0) {
                    $ket = 'alfa';
                }elseif ($stat == 1) {
                    $ket = 'hadir';
                }elseif ($stat == 2) {
                    $ket = 'sakit';
                }elseif ($stat == 3) {
                    $ket = 'izin';
                }elseif ($stat == 4) {
                    $ket = 'kerja';
                }else{
                    $ket = 'tidak jelas';
                }

                $absen[] = [
                    'tanggal'  => $tgl,
                    'dosen_id' => $dosen->id,
                    'mahasiswa_id' => $mhs,
                    'matkul_id' => $request->matkul_id,
                    'semester_id' => $matkul->semester_id,
                    'status'        => $stat,
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
        }else{
            $matkul = Dosen::where('user_id', auth()->user()->id)->with('Matkul.Semester')->get();
            $user  = Dosen::where('user_id', auth()->user()->id)->first();
        }
        return view('absen/rekap', compact('matkul', 'user'));
    }

    public function rekapGet()
    {
        $request_from       = $_GET['from'];
        $request_to         = $_GET['to'];
        $request_matkul_id  = $_GET['matkul_id'];

        //DARI
        $dari = explode('-', $request_from);
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
        $sampai = explode('-', $request_to);
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
        $matkul = Matkul::find($request_matkul_id);

        if (auth()->user()->role == 'admin') {
            $absen = Absen::whereBetween('tanggal', [$request_from, $request_to])
                ->where([
                    'matkul_id'    => $request->matkul_id
                ])->orderBy('tanggal', 'desc')->get();


            $mahasiswa = Mahasiswa::where('semester_id', $matkul->semester_id)->get();
            $fix = [];
            foreach ($mahasiswa as $m) {
                $cek = Absen::whereBetween('tanggal', [$request_from, $request_to])
                        ->where(['mahasiswa_id'  =>  $m->id,
                                'matkul_id'     =>  $request_matkul_id,
                                'status'    =>  1 ])->get();
                $jml = $cek->count();
                $fix[] = [
                    'mahasiswa_id'  =>  $m->id,
                    'jumlah'        =>  $jml
                ];
            }

            $data = [
                'matkul_id' => $request_matkul_id,
                'dari' => $request_from,
                'sampai' => $request_to,
                'from' => $from,
                'to' => $to
            ];

        }elseif (auth()->user()->role == 'dosen') {
            $dosen = Dosen::where('user_id', auth()->user()->id)->first();
            $absen = Absen::whereBetween('tanggal', [$request_from, $request_to])
                ->where([
                    'matkul_id'    => $request_matkul_id,
                    'dosen_id'     => $dosen->id
                ])->orderBy('tanggal', 'desc')->get();

            $mahasiswa = Mahasiswa::orderBy('nim', 'asc')->where('semester_id', $matkul->semester_id)->with('Absen')->get();
            $fix = [];
            foreach ($mahasiswa as $m) {
                $cek = Absen::whereBetween('tanggal', [$request_from, $request_to])
                        ->where(['mahasiswa_id'  =>  $m->id,
                                'matkul_id'     =>  $request_matkul_id,
                                'dosen_id'      =>  $dosen->id,
                                'status'    =>  1 ])->get();
                $jml = $cek->count();
                $fix[] = [
                    'mahasiswa_id'  =>  $m->id,
                    'jumlah'        =>  $jml
                ];
            }

            $data = [
                'matkul_id' => $request_matkul_id,
                'dosen_id'  => $dosen->id,
                'dari' => $request_from,
                'sampai' => $request_to,
                'from' => $from,
                'to' => $to
            ];

        }

        $date = [
            'from'  =>  $request_from,
            'to'    =>  $request_to
        ];

        $encrypted = Crypt::encrypt($date);

        return view('absen.rekap-result', compact('absen', 'mahasiswa', 'matkul', 'data', 'fix', 'encrypted'));
    }

    public function absenDetail($encrypted, $mhsid, $mkid)
    {
        $decrypted = Crypt::decrypt($encrypted);
        $matkul = Matkul::find($mkid);

        if (auth()->user()->role == 'admin') {
            $absen = Absen::whereBetween('tanggal', [$decrypted['from'], $decrypted['to']])
                    ->where(['mahasiswa_id' => $mhsid,
                             'matkul_id'    => $mkid])->orderBy('id', 'DESC')->paginate(10);

            $hadir = Absen::whereBetween('tanggal', [$decrypted['from'], $decrypted['to']])
            ->where(['mahasiswa_id' => $mhsid,
                     'matkul_id'    => $mkid,
                     'status'       => 1])->orderBy('id', 'DESC')->count();

        }elseif(auth()->user()->role == 'dosen') {
            $dosen = Dosen::where('user_id', auth()->user()->id)->first();
            $absen = Absen::whereBetween('tanggal', [$decrypted['from'], $decrypted['to']])
                        ->where(['mahasiswa_id' => $mhsid,
                                 'dosen_id'     => $dosen->id,
                                 'matkul_id'    => $mkid])->orderBy('id', 'DESC')->paginate(10);

            $hadir = Absen::whereBetween('tanggal', [$decrypted['from'], $decrypted['to']])
                            ->where(['mahasiswa_id' => $mhsid,
                                     'dosen_id'     => $dosen->id,
                                     'matkul_id'    => $mkid,
                                     'status'       => 1])->orderBy('id', 'DESC')->count();
        }else{
            return redirect()->back();
        }

        $mahasiswa  = Mahasiswa::find($mhsid);

        return view('absen.rekap-detail', compact('absen', 'mahasiswa', 'hadir', 'matkul'));
    }

    public function export_absen($matkulId, $dari, $sampai)
    {
        $dosenId = Dosen::where('user_id', auth()->user()->id)->first();
        $matkul = Matkul::find($matkulId);
        $nama =  str_replace(' ', '', $matkul->matakuliah);
        $from = str_replace('-', '', $dari);
        $to = str_replace('-', '', $sampai);

        return Excel::download(new RekapAbsenExport($matkulId, $dari, $sampai),  $from . "_" . $to . "_" . $nama . ".xlsx");
    }
}
