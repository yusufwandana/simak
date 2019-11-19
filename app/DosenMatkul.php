<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DosenMatkul extends Model
{
    protected $table = 'dosen_matkul';

    protected $fillable = [
        'dosen_id', 'matkul_id'
    ];
}
