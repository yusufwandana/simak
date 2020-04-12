<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MateriTugas extends Model
{
    protected $table = 'materitugas';
    protected $fillable = [
        'jenis', 'deskripsi', 'file', 'tanggal_tenggat', 'waktu_tenggat', 'semester_id' ,'user_id', 'matkul_id', 'tanggal_post', 'created_at', 'updated_at'
    ];

    public function matkul()
    {
        return $this->belongsTo('App\Matkul');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function semester()
    {
        return $this->belongsTo('App\Semester');
    }
}
