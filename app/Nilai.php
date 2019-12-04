<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    protected $fillable = [
        'jenis_nilai', 'mahasiswa_id', 'matkul_id', 'nilai', 'created_at', 'updated_at'
    ];

    public function matkul()
    {
        return $this->belongsTo('App\Matkul');
    }
    
}
