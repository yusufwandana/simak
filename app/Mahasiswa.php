<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $fillable = [
        'nim', 'nama', 'jk', 'alamat', 'semester_id', 'jurusan_id', 'tahun_masuk', 'user_id'
    ];

    public function jurusan()
    {
        return $this->belongsTo('App\Jurusan');
    }

    public function semester()
    {
        return $this->belongsTo('App\Semester');
    }

    public function absen()
    {
        return $this->hasMany('App\Absen');
    }

    public function nilai()
    {
        return $this->hasMany('App\Nilai');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
