<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $fillable = [
        'waktu', 'tanggal', 'dosen_id', 'matkul_id', 'ruangan_id'
    ];

    public function ruangan()
    {
        return $this->belongsTo('App\Ruangan');
    }

    public function matkul()
    {
        return $this->belongsTo('App\Matkul');
    }
}
