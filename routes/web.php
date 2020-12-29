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

// Login
Route::get('login', 'AuthController@login')->name('login');
Route::post('postlogin', 'AuthController@postlogin')->name('postlogin');

Route::group(['middleware' => 'auth'], function () {
    Route::post('changepp', 'AuthController@changepp')->name('changepp');
    Route::post('ubahpw', 'AuthController@changepw')->name('ubahpw');
    Route::get('logout', 'AuthController@logout')->name('logout');
});

Route::group(['middleware' => ['auth', 'cekRole:admin']], function () {
    Route::get('dashboard/admin', 'DashboardController@admin')->name('dashboard.admin');

    //CRUD DOSEN
    Route::get('dosen', 'DosenController@index')->name('dosen');
    Route::get('dosen/add-dosen', 'DosenController@addDosen')->name('addDosen');
    Route::post('dosen/create', 'DosenController@create')->name('dosen.create');
    Route::get('dosen/{id}/edit', 'DosenController@edit')->name('dosen.edit');
    Route::post('dosen/{id}/update', 'DosenController@update')->name('dosen.update');
    Route::get('dosen/{id}/delete', 'DosenController@delete')->name('dosen.delete');
    Route::get('dosen/{id}/profile', 'DosenController@profile')->name('profile');

    // DosenMatkul Relationshipx
    Route::get('dosenmatkul/{id}/delete', 'DosenController@deletematkul')->name('dosenmatkul.delete');
    Route::post('dosenmatkul/create', 'DosenController@addMatkul')->name('dosenmatkul.add');

    // CRUD MAHASISWA
    Route::resource('mahasiswa', 'MahasiswaController')->except(
        'show','destroy'
    );
    Route::get('mahasiswa/delete/{id}', 'MahasiswaController@destroy')->name('mahasiswa.destroy');
    Route::get('profil-mahasiswa/{id}', 'MahasiswaController@showProfile')->name('mahasiswa.profile');

    // CRUD SEMESTER
    Route::resource('semester', 'SemesterController');

    // CRUD MATKUL
    Route::resource('matkul', 'MatkulController');

    // CRUD JADWAL
    Route::resource('jadwal', 'JadwalController')->except(
        'show'
    );
    Route::get('jadwal/mailing', 'JadwalController@mailing')->name('jadwal.mailing');
    Route::get('getmatkuls/{id}', 'JadwalController@getmatkuls');
    Route::get('getdosens/{id}', 'JadwalController@getdosens');

    // CRUD JURUSAN
    Route::resource('jurusan', 'JurusanController');

    //CRUD RUANGAN
    Route::resource('ruangan', 'RuanganController');

    //Posting
    Route::get('admin/posting', 'DosenController@posttugas');

    //Nilai admin
    Route::get('admin/nilai', 'NilaiController@adminNilaiIndex')->name('admin.awal');
    Route::get('admin/nilai/{slug}', 'NilaiController@adminNilai')->name('admin.nilai');
    Route::get('admin/nilai/detail/{nim}', 'NilaiController@adminNilaiDetail')->name('nilai.detail');
});


Route::group(['middleware' => ['auth', 'cekRole:admin,dosen']], function () {
    Route::get('dashboard/dosen', 'DashboardController@dosen')->name('dashboard.dosen');

    //ABSEN
    Route::get('absen', 'AbsenController@index')->name('absen.index');
    Route::post('postabsen', 'AbsenController@postabsen')->name('absen.postabsen');
    Route::post('absen/daftarmhs', 'AbsenController@daftarmhs')->name('absen.daftarmhs');
    Route::get('absen/rekap', 'AbsenController@rekapAbsen')->name('absen.rekap');
    Route::get('absen/rekap/result', 'AbsenController@rekapGet')->name('absen.rekapget');
    Route::get('absen/rekap/detail/{encrypted}/{mhsid}/{mkid}', 'AbsenController@absenDetail')->name('absen.detail');

    //Jadwal
    Route::get('dosen/lihat-jadwal', 'DosenController@lihatJadwal')->name('dosen.jadwal');

    //Nilai
    Route::resource('nilai', 'NilaiController')->except(
        'show'
    );
    Route::get('nilai/show/{mhsId}/{matkulId}', 'NilaiController@show')->name('show.nilai');
    Route::post('nilai/addnilai', 'NilaiController@addnilai')->name('nilai.addnilai');
    Route::get('nilai/{slug}', 'NilaiController@daftarmhs')->name('nilai.daftarmhs');
    Route::post('nilai/update/{id}', 'NilaiController@nilaiUpdate')->name('update.nilai ');

    // Posting
    // Route::get('dosen/postmt', 'DosenController@postmateri')->name('postmateri');
    Route::get('dosen/posting', 'DosenController@posttugas')->name('posttugas');
    Route::get('dosen/post/{id}', 'DosenController@deletepost')->name('deletepost');
    Route::post('dosen/uploadfile', 'DosenController@uploadFile')->name('uploadfile');

    //Export
    Route::post('nilai/export/{matkulId}/{semesterId}', 'NilaiController@export_nilai');
    Route::get('absen/rekap/export/{matkulId}/{dari}/{sampai}', 'AbsenController@export_absen')->name('absen.export');
});


Route::group(['middleware' => ['auth', 'cekRole:admin,mahasiswa']], function () {
    Route::get('dashboard/mahasiswa', 'DashboardController@mahasiswa')->name('dashboard.mahasiswa');
    Route::get('kehadiran-mahasiswa', 'MahasiswaController@kehadiran')->name('kehadiran');
    Route::get('krs-mahasiswa', 'MahasiswaController@krs')->name('krs');
    Route::get('krs-mahasiswa/export/{id}', 'MahasiswaController@exportpdf')->name('exportpdf');
    Route::get('nilai-mahasiswa', 'MahasiswaController@Nilai')->name('nilai.mahasiswa');
    Route::get('jadwal/mahasiswa', 'DashboardController@jadwalMahasiswa')->name('jadwal.mahasiswa');
    Route::get('krsmatkul/{id}', 'MahasiswaController@krsmatkul')->name('krs.matkul');
    Route::get('khs-mahasiswa', 'MahasiswaController@khsMahasiswa')->name('khs');
    Route::get('khs-mahasiswa/print', 'MahasiswaController@printKhs')->name('khs.print');
});
