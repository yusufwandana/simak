<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    protected $fillable = [
        'ruangan', 'jenis'
    ];

    public function jadwal()
    {
        return $this->hasMany('App\Jadwal');
    }
}
