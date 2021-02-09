<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use Carbon\Carbon;
use \App\User;

class AuthController extends Controller
{
    public function login()
    {
        $user = User::all()->count();
        if ($user == 0) {
            User::create([
                'name' => 'Administrator',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('admin'),
                'avatar' => 'default.png',
                'role' => 'admin'
            ]);
        }

        $a = auth()->user();
        if ($a) {
            return redirect()->back();
        } else {
            return view('auth.login');
        }
    }

    public function postlogin(Request $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            if (auth()->user()->role == 'admin') {
                return redirect('dashboard/admin')->with('success', 'Berhasil login.');
            } elseif (auth()->user()->role == 'dosen') {
                return redirect('dashboard/dosen')->with('success', 'Berhasil login');
            } elseif (auth()->user()->role == 'mahasiswa') {
                return redirect('dashboard/mahasiswa')->with('success', 'Berhasil login');
            }
        } else {
            return redirect('login')->with('failed', 'Email atau password salah!');
        }
    }

    public function changepw(Request $request)
    {
        $id = auth()->user()->id;
        $user = User::find($id);
        $hashed = $user->password;
        if (Hash::check($request->password_lama, $hashed)) {
            if ($request->password_baru === $request->konfirm_password) {
                $new = Hash::make($request->password_baru);
                $user->password = $new;
                $user->save();

                if (auth()->user()->role == 'admin') {
                    return redirect('dashboard/admin')->with('success', 'Password berhasil diubah');
                } elseif (auth()->user()->role == 'dosen') {
                    return redirect('dashboard/dosen')->with('success', 'Password berhasil diubah');
                } else {
                    return redirect('dashboard/mahasiswa')->with('success', 'Password berhasil diubah');
                }
            } else {

                if (auth()->user()->role == 'admin') {
                    return redirect('dashboard/admin')->with('failed', 'Gagal, kolom konfirmasi password tidak cocok!');
                } elseif (auth()->user()->role == 'dosen') {
                    return redirect('dashboard/dosen')->with('failed', 'Gagal, kolom konfirmasi password tidak cocok!');
                } else {
                    return redirect('dashboard/mahasiswa')->with('failed', 'Gagal, kolom konfirmasi password tidak cocok!');
                }
            }
        } else {

            if (auth()->user()->role == 'admin') {
                return redirect('dashboard/admin')->with('failed', 'Gagal, password saat ini tidak cocok!');
            } elseif (auth()->user()->role == 'dosen') {
                return redirect('dashboard/dosen')->with('failed', 'Gagal, Password saat ini tidak cocok!');
            } else {
                return redirect('dashboard/mahasiswa')->with('failed', 'Gagal, Password saat ini tidak cocok!');
            }
        }
    }

    public function changepp(Request $request)
    {
        $id = $request->id;
        $user = User::find($id);

        $new_pict = $request->file('gambar');
        $old_pict = $user->avatar;

        if (empty($new_pict)) {
            $new_pict = $old_pict;
            $new_name = $new_pict;
        } else {
            $new_name = Carbon::now()->timestamp . '_' . uniqid() . '.' . $request->file('gambar')->getClientOriginalExtension();
            $request->file('gambar')->move('image/profile/',  $new_name);;
            if ($old_pict == 'default.png') {
                //do nothing
            } else {
                // unlink(public_path('\image\profile\\' . $old_pict));
            }
        }

        User::where('id', $id)->update([
            'avatar' => $new_name
        ]);

        if (auth()->user()->role == 'admin') {
            return redirect('dashboard/admin');
        } elseif (auth()->user()->role == 'dosen') {
            return redirect('dashboard/dosen');
        } else {
            return redirect('dashboard/mahasiswa');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('login');
    }
}
