<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dosen;
use App\User;
use App\Matkul;
use App\Jadwal;
use App\DosenMatkul;
use App\MateriTugas;
use File;

class DosenController extends Controller
{
    public function index()
    {
        $dosens = Dosen::orderBy('nip', 'asc')->paginate(20);
        $matakuliah = Matkul::all();
        return view('dosen.index', compact('dosens', 'matakuliah'));
    }

    public function create(Request $request)
    {
        //validity
        $this->validate($request, [
            'nip'    => 'required|numeric|digits:8|unique:dosens',
            'email'  => 'required|email|unique:users',
        ]);

        //Input ke table user
        $user = new \App\User;
        $user->name = ucwords($request->nama);
        $user->email = strtolower($request->email);
        $user->password = bcrypt($request->nip);
        $user->avatar  = 'default.png';
        $user->role = 'dosen';
        $user->remember_token = str_random(60);
        $user->save();


        //Input ke table dosen
        $a = $user->id;
        Dosen::create([
            'nip'     => $request->nip,
            'nama'    => ucwords($request->nama),
            'jk'      => $request->jk,
            'alamat'  => ucwords($request->alamat),
            'user_id' => $a
        ]);

        return redirect('dosen')->with('success', 'Dosen telah berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $dosen  = Dosen::where('id', $id)->first();
        $matakuliah = Matkul::all();

        return view('dosen.edit', compact('dosen', 'matakuliah'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nip'    => 'required|numeric|digits:8',
            'nama'   => 'required',
            'jk'     => 'required',
            'alamat' => 'required'
        ]);

        $dosen = Dosen::find($id);
        $dosen->nama   = ucwords($request->nama);
        $dosen->jk     = $request->jk;
        $dosen->alamat = ucwords($request->alamat);
        $dosen->save();

        $user = User::find($dosen->user_id);
        $user->name = ucwords($request->nama);
        $user->save();

        return redirect('dosen')->with('success', 'Dosen telah berhasil diupdate!');
    }

    public function delete($id)
    {
        $dosen = Dosen::with('User')->where('id', $id)->first();
        $user  = User::find($dosen->user->id);
        $user->delete();

        return redirect('dosen')->with('success', 'Dosen telah berhasil dihapus!');
    }

    public function profile($id)
    {
        $dosen = Dosen::with('User')->where('id', $id)->first();
        $user  = User::find($dosen->user->id);
        $matkul = Matkul::all();

        return view('dosen.profile', compact('dosen', 'user', 'matkul'));
    }

    public function addMatkul(Request $request)
    {
        $this->validate($request, [
            'dosen_id' => 'required',
            'matkul_id' => 'required'
        ]);

        $cek = DosenMatkul::where([
            'dosen_id' => $request->dosen_id,
            'matkul_id' => $request->matkul_id,
        ])->get();

        foreach ($cek as $c) {
            if ($c) {
                return back()->with('failed', 'Dosen telah mengajar matkul tersebut!');
            }
        }


        DosenMatkul::create([
            'dosen_id' => $request->dosen_id,
            'matkul_id' => $request->matkul_id
        ]);

        return redirect()->back()->with('success', 'Penambahan matkul dosen berhasil!');
    }

    public function deletematkul($id)
    {
        $dm = DosenMatkul::find($id);
        $dm->delete();

        return redirect()->back()->with('success', 'Matkul dosen telah dihapus!');
    }

    public function lihatJadwal()
    {
        $dosen  = Dosen::where('user_id', auth()->user()->id)->first();
        $jadwal = Jadwal::where('dosen_id', $dosen->id)->paginate(20);
        // dd($jadwal);
        return view('jadwal.dosen-lihat-jadwal', compact('jadwal'));
    }

    public function uploadfile(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|file'
        ]);
        $date      = date('ymdhis');
        $file      = $request->file('file');
        $finalName  = $date . uniqid() . '.' . $file->getClientOriginalExtension();
        $fullName = str_replace(' ', '', $finalName);
        $moveto    = 'public/filemateri';
        $file->move($moveto, $fullName);
        $matkul_id = Matkul::find($request->matkul_id);

        MateriTugas::create([
            'deskripsi' => $request->deskripsi,
            'tanggal_tenggat' => $request->tanggal,
            'waktu_tenggat' => $request->waktu,
            'matkul_id' => $request->matkul_id,
            'semester_id' => $matkul_id->semester_id,
            'user_id'  => auth()->user()->id,
            'jenis'     => $request->jenis,
            'file'      => $fullName,
            'tanggal_post' => date('Y-m-d')
        ]);

            return redirect()->route('dashboard.' . auth()->user()->role)->with('success', 'Berhasil');
    }

    public function posttugas()
    {
        if (auth()->user()->role == 'dosen') {
            $dosen  = Dosen::where('user_id', auth()->user()->id)->first();
            $matkul = DosenMatkul::where('dosen_id', $dosen->id)->get();
        }elseif (auth()->user()->role == 'admin') {
            $matkul = Matkul::all();
        }
        // dd($matkul);
        return view('dosen/post_tugas', compact('dosen', 'matkul'));
    }

    public function deletepost($id)
    {
        $data = MateriTugas::find($id);
        File::delete('public/filemateri/' . $data->file);
        $data->delete();
        return redirect()->route('dashboard.' . auth()->user()->role)->with('success', 'Berhasil');
    }
}
