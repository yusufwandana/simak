<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $fillable = [
        'nama', 'jk', 'alamat', 'semester', 'jurusan_id'
    ];
}
