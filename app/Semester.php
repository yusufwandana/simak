<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    protected $table = 'semesters';
    protected $fillable = [
        'semester'
    ];

    public function matkul()
    {
        return $this->hasMany('App\Matkul', 'id', 'semester_id');
    }

    public function mahasiswa()
    {
        return $this->hasOne('App\Mahasiswa');
    }

    public function jadwal()
    {
        return $this->hasMany('App/Jadwal');
    }

    public function materitugas()
    {
        return $this->hasMany('App\MateriTugas');
    }
}
