<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Absen extends Model
{
    protected $fillable = [
        'tanggal', 'dosen_id', 'mahasiswa_id', 'matkul_id', 'semester_id', 'keterangan', 'created_at', 'updated_at'
    ];

    public function mahasiswa()
    {
        return $this->belongsTo('App\Mahasiswa');
    }

    public function dosen()
    {
        return $this->belongsTo('App\Dosen');
    }

    public function matkul()
    {
        return $this->belongsTo('App\Matkul');
    }
}
