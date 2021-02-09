<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Response;
use App\Mail\JadwalEmail;
use App\Jadwal;
use App\Dosen;
use App\Matkul;
use App\Ruangan;
use App\DosenMatkul;
use App\Semester;
use App\User;

class JadwalController extends Controller
{
    public function index()
    {
        $jadwals  = Jadwal::latest()->paginate(10);
        $ruangans = Ruangan::all();
        $semesters = Semester::all();

        return view('jadwal.index', compact('jadwals', 'ruangans', 'semesters'));
    }

    public function create()
    {
        $ruangans = Ruangan::all();
        $semesters = Semester::all();
        return view('jadwal.addJadwal', compact('ruangans','semesters'));
    }

    public function store(Request $request)
    {
        // dd($request->all());

        $mulai     = $request->mulai;
        $selesai   = $request->selesai;
        $date      = $request->date;
        $roomId    = $request->ruanganId;

        $roomTimeExist = Jadwal::where([
            'tanggal' => $date,
            'ruangan_id' => $request->ruanganId,
        ])->whereBetween('mulai', [$mulai, $selesai])->first();

        if ($roomTimeExist) {
            return redirect()->back()->with('failed', 'Jadwal tersebut sudah ada sebelumnya!');
        } else {
            Jadwal::create([
                'mulai'       => $request->mulai,
                'selesai'     => $request->selesai,
                'tanggal'     => $request->date,
                'dosen_id'    => $request->dosenId,
                'matkul_id'   => $request->matkulId,
                'semester_id' => $request->semesterId,
                'ruangan_id'  => $request->ruanganId
            ]);
        }

        $dosen     = Dosen::find($request->dosenId);
        $user      = User::find($dosen->user_id);
        $m         = Matkul::find($request->matkulId);
        $d = explode('-', $date);
        $tahun   = $d[0];
        $bulan   = $d[1];
        $tanggal = $d[2];

        switch ($bulan) {
            case '01':
                $bulan = 'Januari';
                break;
            case '02':
                $bulan = 'Februari';
                break;
            case '03':
                $bulan = 'Maret';
                break;
            case '04':
                $bulan = 'April';
                break;
            case '05':
                $bulan = 'Mei';
                break;
            case '06':
                $bulan = 'Juni';
                break;
            case '07':
                $bulan = 'Juli';
                break;
            case '08':
                $bulan = 'Agustus';
                break;
            case '09':
                $bulan = 'September';
                break;
            case '10':
                $bulan = 'Oktober';
                break;
            case '11':
                $bulan = 'November';
                break;
            case '12':
                $bulan = 'Desember';
                break;
            default:
                $bulan = 'False';
                break;
            }

        $event     = $tanggal . " " . $bulan . " " . $tahun;
        $email     = $user->email;
        $matkul    = $m->matakuliah;
        $semester  = $m->semester->semester;
        $room      = Ruangan::find($roomId);
        $ruangan   = $room->ruangan;

        $data = [
            'nama'      => $dosen->nama,
            'mulai'     => $mulai,
            'selesai'   => $selesai,
            'event'     => $event,
            'matkul'    => $matkul,
            'semester'  => $semester,
            'ruangan'   => $ruangan
        ];

        Mail::to($email)->send(new JadwalEmail($data));

        return redirect()->route('jadwal.index')->with('success', 'Jadwal telah berhasil diatur!');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {

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
        $matkul = Matkul::where('semester_id', $id)->orderBy('matakuliah', 'asc')->get();

        return response()->json([
            'results' => $matkul
        ]);
    }

    public function getDosens($id)
    {
        $dosenId = DosenMatkul::where('matkul_id', $id)->get();
        foreach ($dosenId as $d) {
            $dosen[] = Dosen::where('id', $d->dosen_id)->first();
        }

        return response()->json([
            'results' => $dosen
        ]);
    }
}
