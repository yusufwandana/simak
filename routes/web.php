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
    return view('welcome');
});

Route::get('login', 'AuthController@login')->name('login');
Route::post('postlogin', 'AuthController@postlogin');

Route::group(['middleware' => 'auth'], function(){
    Route::post('changepp', 'AuthController@changepp')->name('changepp');
    Route::post('ubahpw', 'AuthController@changepw');
    Route::get('logout', 'AuthController@logout');
});

Route::group(['middleware' => ['auth', 'cekRole:admin']], function () {
    Route::get('dashboard/admin', 'DashboardController@index');

    //CRUD DOSEN
    Route::get('dosen', 'DosenController@index');
    Route::post('dosen/create', 'DosenController@create');
    Route::get('dosen/{id}/edit', 'DosenController@edit');
    Route::post('dosen/{id}/update', 'DosenController@update');
    Route::get('dosen/{id}/delete', 'DosenController@delete');
    Route::get('dosen/{id}/profile', 'DosenController@profile')->name('profile');
    
    Route::get('dosenmatkul/{id}/delete', 'DosenController@deletematkul')->name('dosenmatkul.delete');
    Route::post('dosenmatkul/create', 'DosenController@addMatkul')->name('dosenmatkul.add');

    //CRUD MAHASISWA
    Route::resource('mahasiswa', 'MahasiswaController');

    //CRUD SEMESTER
    Route::resource('semester', 'SemesterController');

    //CRUD MATKUL
    Route::resource('matkul','MatkulController');

    // CRUD JURUSAN
    Route::resource('jurusan', 'JurusanController');

    //CRUD RUANGAN
    Route::resource('ruangan', 'RuanganController');

});


Route::group(['middleware' => ['auth', 'cekRole:admin,dosen']], function () {
    Route::get('dashboard/dosen', 'DashboardController@index');

    //ABSEN
    Route::get('absen', 'AbsenController@index')->name('absen.index');
    Route::post('absen/daftarmhs', 'AbsenController@daftarmhs')->name('absen.daftarmhs');
    Route::post('postabsen', 'AbsenController@postabsen')->name('absen.postabsen');

    //Nilai
    Route::resource('nilai', 'NilaiController');
    Route::post('nilai/addnilai', 'NilaiController@addnilai')->name('nilai.addnilai');
});


Route::group(['middleware' => ['auth', 'cekRole:admin,mahasiswa']], function () {
    Route::get('dashboard/mahasiswa', 'DashboardController@index');
});
