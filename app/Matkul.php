<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Matkul extends Model
{
    protected $table = 'matkuls';
    protected $fillable = [
        'kd_matkul', 'matakuliah', 'semester_id', 'sks', 'kategori', 'slug'
    ];

    public function semester()
    {
        return $this->belongsTo('App\Semester', 'semester_id');
    }

    public function dosen()
    {
        return $this->belongsToMany(Dosen::class)->withPivot(['id']);
    }

    public function nilai()
    {
        return $this->hasOne('App\Nilai');
    }

    public function jadwal()
    {
        return $this->hasMany('App\Jadwal');
    }

    public function absen()
    {
        return $this->hasMany('App\Absen');
    }

    public function materitugas()
    {
        return $this->hasMany('App\MateriTugas');
    }

}
