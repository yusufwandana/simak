<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('login');
});

Route::get('login', 'AuthController@login')->name('login');
Route::post('postlogin', 'AuthController@postlogin');

Route::group(['middleware' => 'auth'], function () {
    Route::post('changepp', 'AuthController@changepp')->name('changepp');
    Route::post('ubahpw', 'AuthController@changepw');
    Route::get('logout', 'AuthController@logout');
});

Route::group(['middleware' => ['auth', 'cekRole:admin']], function () {
    Route::get('dashboard/admin', 'DashboardController@index');

    //CRUD DOSEN
    Route::get('dosen', 'DosenController@index')->name('dosen');
    Route::post('dosen/create', 'DosenController@create');
    Route::get('dosen/{id}/edit', 'DosenController@edit');
    Route::post('dosen/{id}/update', 'DosenController@update');
    Route::get('dosen/{id}/delete', 'DosenController@delete');
    Route::get('dosen/{id}/profile', 'DosenController@profile')->name('profile');

    // DosenMatkul Relationshipx
    Route::get('dosenmatkul/{id}/delete', 'DosenController@deletematkul')->name('dosenmatkul.delete');
    Route::post('dosenmatkul/create', 'DosenController@addMatkul')->name('dosenmatkul.add');

    // CRUD MAHASISWA
    Route::resource('mahasiswa', 'MahasiswaController');

    // CRUD SEMESTER
    Route::resource('semester', 'SemesterController');

    // CRUD MATKUL
    Route::resource('matkul', 'MatkulController');

    // CRUD JADWAL
    Route::resource('jadwal', 'JadwalController');
    Route::get('getmatkuls/{id}', 'JadwalController@getmatkuls');

    // CRUD JURUSAN
    Route::resource('jurusan', 'JurusanController');

    //CRUD RUANGAN
    Route::resource('ruangan', 'RuanganController');
});


Route::group(['middleware' => ['auth', 'cekRole:admin,dosen']], function () {
    Route::get('dashboard/dosen', 'DashboardController@index');

    //ABSEN
    Route::get('absen', 'AbsenController@index')->name('absen.index');
    Route::post('postabsen', 'AbsenController@postabsen')->name('absen.postabsen');
    Route::post('absen/daftarmhs', 'AbsenController@daftarmhs')->name('absen.daftarmhs');
    Route::get('absen/rekap', 'AbsenController@rekapAbsen')->name('absen.rekap');
    Route::post('absen/rekap/result', 'AbsenController@rekapPost')->name('absen.rekapost');

    //Nilai
    Route::resource('nilai', 'NilaiController');
    Route::get('nilai/show/{mhsId}/{matkulId}', 'NilaiController@show');
    Route::post('nilai/addnilai', 'NilaiController@addnilai')->name('nilai.addnilai');
    Route::post('nilai/daftarmhs', 'NilaiController@daftarmhs')->name('nilai.daftarmhs');
});


Route::group(['middleware' => ['auth', 'cekRole:admin,mahasiswa']], function () {
    Route::get('dashboard/mahasiswa', 'DashboardController@index');
});
