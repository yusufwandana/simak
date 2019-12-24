<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mahasiswa;
use App\Semester;
use App\Jurusan;
use App\User;

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

        return redirect()->back();
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
}
