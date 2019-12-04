<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Matkul extends Model
{
    protected $table = 'matkuls';
    protected $fillable = [
        'kd_matkul', 'matakuliah', 'semester_id', 'sks', 'kategori'
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
}
