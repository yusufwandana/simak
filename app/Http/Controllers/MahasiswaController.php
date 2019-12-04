<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mahasiswa;
use App\Semester;
use App\Jurusan;

class MahasiswaController extends Controller
{
    public function index()
    {
        $mahasiswa = Mahasiswa::orderBy('nim', 'asc')->paginate(5);
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
        $user->name = $request->nama;
        $user->email = $request->email;
        $user->password = bcrypt($request->nim);
        $user->avatar = 'default.png';
        $user->role = 'mahasiswa';
        $user->remember_token = str_random(60);

        $user->save();
        $id = $user->id;

        Mahasiswa::create([
            'tahun_masuk' => $request->tahun_masuk,
            'nim' => $request->nim,
            'nama' => $request->nama,
            'jk' => $request->jk,
            'alamat' => $request->alamat,
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
        //
    }

    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
