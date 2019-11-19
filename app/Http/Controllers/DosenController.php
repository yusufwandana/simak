<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dosen;
use App\User;
use App\Matkul;

class DosenController extends Controller
{
    public function index()
    {
        $dosens = Dosen::paginate(5);
        $matakuliah = Matkul::all();
        return view('dosen.index', compact('dosens', 'matakuliah'));
    }

    public function create(Request $request)
    {
        //Input ke table user
        $user = new \App\User;
        $user->name = $request->nama;
        $user->email = $request->email;
        $user->password = bcrypt($request->nip);
        $user->avatar  = 'default.png';
        $user->role = 'dosen';
        $user->remember_token = str_random(60);
        $user->save();


        //Input ke table dosen
        $a = $user->id;
        Dosen::create([
            'nip'     => $request->nip,
            'nama'    => $request->nama,
            'jk'      => $request->jk,
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
        $dosen = Dosen::where('id', $id)->update([
            'nip'  => $request->nip,
            'nama' => $request->nama,
            'jk'   => $request->jk
        ]);

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
        
    }
}
