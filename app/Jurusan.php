<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    protected $fillable = [
        'jurusan'
    ];

    public function mahasiswa()
    {
        return $this->hasOne('App\Mahasiswa');
    }
}
