<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Absen extends Model
{
    protected $fillable = [
        'tanggal', 'dosen_id', 'mahasiswa_id', 'matkul_id', 'keterangan', 'created_at', 'updated_at'
    ];
}
