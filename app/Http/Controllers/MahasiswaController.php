<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Mahasiswa;
use App\Semester;
use App\Jurusan;
use App\User;
use App\Absen;
use App\Matkul;
use App\Nilai;
use PDF;

class MahasiswaController extends Controller
{
    public function index()
    {
        $mahasiswa = Mahasiswa::orderBy('nim', 'asc')->paginate(10);
        $semester  = Semester::all();
        $jurusan   = Jurusan::all();

        return view('mahasiswa.index', compact('mahasiswa', 'semester', 'jurusan'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nim' => 'required',
            'nama' => 'required',
            'jk' => 'required',
            'email' => 'required',
            'alamat' => 'required'
        ]);

        $mahasiswa = Mahasiswa::where('nim', $request->nim)->first();
        $exist     = User::where('email', $request->email)->first();

        if ($exist) {
            return redirect()->back()->with('failed', 'Email Anda telah terdaftar sebelumnya!');
        }elseif($mahasiswa){
            return redirect()->back()->with('failed', 'NIM sudah ada!');
        }else{
            $user = new \App\User;
            $user->name = ucwords($request->nama);
            $user->email = strtolower($request->email);
            $user->password = bcrypt($request->nim);
            $user->avatar = 'default.png';
            $user->role = 'mahasiswa';
            $user->remember_token = str_random(60);
    
            $user->save();
            $id = $user->id;
            Mahasiswa::create([
                'tahun_masuk' => $request->tahun_masuk,
                'nim' => $request->nim,
                'nama' => ucwords($request->nama),
                'jk' => $request->jk,
                'alamat' => ucwords($request->alamat),
                'semester_id' => $request->semester,
                'jurusan_id' => $request->jurusan,
                'user_id' => $id
            ]);
        }

        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil ditambahkan!');

    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $mahasiswa = Mahasiswa::find($id);
        $semester  = Semester::all();
        $jurusan   = Jurusan::all();
        return view('mahasiswa.edit', compact('mahasiswa', 'semester', 'jurusan'));
    }

    public function update(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::find($id);
        $mahasiswa->nama = ucwords($request->nama);
        $mahasiswa->jk   = $request->jk;
        $mahasiswa->semester_id = $request->semester;
        $mahasiswa->jurusan_id  = $request->jurusan;
        $mahasiswa->alamat      = ucwords($request->alamat);
        $mahasiswa->save();

        $user = User::find($mahasiswa->user_id);
        $user->name = ucwords($request->nama);
        $user->save();

        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil diupdate!');
    }


    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::find($id);
        $user = User::find($mahasiswa->user_id);
        $mahasiswa->delete();
        $user->delete();
        return redirect()->back()->with('success', 'Mahasiwa telah berhasil dihapus');
    }

    public function kehadirano()
    {
        $mahasiswa = Mahasiswa::where('user_id', auth()->user()->id)->first();
        $hadir = Absen::where([
            'mahasiswa_id' => $mahasiswa->id,
            'status' => 1,
        ])->get();
        $tglhdrs = $hadir;
        $hadir = count($hadir);

        $tdkhadir = Absen::where([
            ['mahasiswa_id', '=', $mahasiswa->id],
            ['status', '!=', 1]
        ])->get();
        $tglhdr = $tdkhadir;
        $absen = count($tdkhadir);
        
        return view('mahasiswa.tdkhadir', compact('absen', 'hadir','tglhdrs','tglhdr','mahasiswa'));
    }

    public function kehadirans()
    {
        $mahasiswa = Mahasiswa::where('user_id', auth()->user()->id)->first();
        $hadir = Absen::where([
            'mahasiswa_id' => $mahasiswa->id,
            'status' => '1',
        ])->get();
        $tglhdr = $hadir;
        $hadir = count($hadir);

        $tdkhadir = Absen::where([
            ['mahasiswa_id', '=', $mahasiswa->id],
            ['status', '!=', 1]
        ])->get();
        $absen = count($tdkhadir);

        return view('mahasiswa.kehadiran', compact('absen', 'hadir','tglhdr','mahasiswa'));
    }
    public function kehadiran()
    {
        $mahasiswas = Mahasiswa::all();
        $mahasiswa = Mahasiswa::where('user_id', auth()->user()->id)->first();
        $hadir = Absen::where([
            'mahasiswa_id' => $mahasiswa->id,
            'status' => '1',
        ])->get();
        $hadir = count($hadir);

        $tdkhadir = Absen::where([
            ['mahasiswa_id', '=', $mahasiswa->id],
            ['status', '!=', 1]
        ])->get();
        $absen = count($tdkhadir);



        return view('mahasiswa.absen', compact('absen', 'hadir','mahasiswa'));
    }

    public function krs()
    {
        $mahasiswa = Mahasiswa::where('user_id', auth()->user()->id)->first();

        $semester = Semester::orderBy('semester', 'asc')->get();

        $matkul = Matkul::where('semester_id', $mahasiswa->semester_id)->get();

        return view('mahasiswa.Krs', ['matkul' => $matkul, 'semester' => $semester, 'mahasiswa' => $mahasiswa]);
    }

    public function krsmatkul($id)
    {
        $matkul = Matkul::where('semester_id', $id)->orderBy('matakuliah', 'asc')->get();

        return response()->json([
            'results' => $matkul
        ]);
    }

    public function exportpdf($id)
    {
        $data = Matkul::where('semester_id', $id)->orderBy('matakuliah', 'asc')->get();
        $mhs  = Mahasiswa::where('user_id', auth()->user()->id)->first();
        return view('mahasiswa.export-krs', compact('data', 'mhs'));
        $pdf  = PDF::loadView('mahasiswa.export-krs', compact('data'));
        return $pdf->stream('export_krs.pdf');
    }

    public function Nilai()
    {
        $user = Auth::user();
        $mahasiswa = Mahasiswa::where('user_id', $user->id)->first();

        $nilai = Nilai::where('mahasiswa_id', $mahasiswa->id)->get();
        return view('mahasiswa.nilai', ['nilai' => $nilai, 'mahasiswa' => $mahasiswa]);
    }

    public function khsMahasiswa()
    {
        $mahasiswa = Mahasiswa::where('user_id', auth()->user()->id)->with('Nilai.Matkul')->first();
        $matkul = Matkul::orderBy('id', 'asc')->where('semester_id', $mahasiswa->semester_id)->with(['Absen','Nilai'])->get();
        $jumlah_absen=0; $tugas=0; $uts=0; $uas=0;

        foreach ($matkul as $m) {
            $jumlah_absen=0; $tugas=0; $uts=0; $uas=0;
            foreach ($m->absen as $absen) {
                if ($absen->mahasiswa_id == $mahasiswa->id && $absen->status == 1) {
                    $jumlah_absen = $jumlah_absen + 1;
                }
            }

            $n = Nilai::orderBy('matkul_id', 'ASC')->where(['matkul_id'    => $m->id,
                               'mahasiswa_id' => $mahasiswa->id])->get();
            foreach ($n as $val) {
                if ($val->jenis_nilai == 'Tugas') {
                    $tugas = ($val->nilai*20)/100;
                }elseif($val->jenis_nilai == 'UTS'){
                    $uts = ($val->nilai*30)/100;
                }elseif($val->jenis_nilai == 'UAS'){
                    $uas = ($val->nilai*40)/100;
                }
                $jumlah = ($jumlah_absen*10)/100;
                $na = $jumlah+$tugas+$uts+$uas;
            }

            $nilai[] = [
                'matkul' => $m->matakuliah,
                'nilai'  => $na
            ];

            $na = 0;
            
        }

        return view('mahasiswa.khs', compact('mahasiswa', 'matkul', 'nilai'));
    }

    public function printKhs()
    {
        $mahasiswa = Mahasiswa::where('user_id', auth()->user()->id)->with('Nilai.Matkul')->first();
        $matkul = Matkul::orderBy('id', 'asc')->where('semester_id', $mahasiswa->semester_id)->with(['Absen','Nilai'])->get();
        $jumlah_absen=0; $tugas=0; $uts=0; $uas=0;

        foreach ($matkul as $m) {
            $jumlah_absen=0; $tugas=0; $uts=0; $uas=0;
            foreach ($m->absen as $absen) {
                if ($absen->mahasiswa_id == $mahasiswa->id && $absen->status == 1) {
                    $jumlah_absen = $jumlah_absen + 1;
                }
            }

            $n = Nilai::orderBy('matkul_id', 'ASC')->where(['matkul_id'    => $m->id,
                               'mahasiswa_id' => $mahasiswa->id])->get();
            foreach ($n as $val) {
                if ($val->jenis_nilai == 'Tugas') {
                    $tugas = ($val->nilai*20)/100;
                }elseif($val->jenis_nilai == 'UTS'){
                    $uts = ($val->nilai*30)/100;
                }elseif($val->jenis_nilai == 'UAS'){
                    $uas = ($val->nilai*40)/100;
                }
                $jumlah = ($jumlah_absen*10)/100;
                $na = $jumlah+$tugas+$uts+$uas;
            }

            $nilai[] = [
                'matkul' => $m->matakuliah,
                'nilai'  => $na
            ];

            $na = 0;
            
        }

        return view('mahasiswa.print-khs', compact('mahasiswa', 'matkul', 'nilai'));   
    }
}
