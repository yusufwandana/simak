<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dosen;
use App\User;
use App\Matkul;
use App\DosenMatkul;

class DosenController extends Controller
{
    public function index()
    {
        $dosens = Dosen::orderBy('nip', 'asc')->paginate(5);
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
            'alamat'  => $request->alamat,
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

        $dosen = Dosen::where('id', $id)->update([
            'nip'    => $request->nip,
            'nama'   => $request->nama,
            'alamat' => $request->alamat,
            'jk'     => $request->jk
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
}
