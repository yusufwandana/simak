<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Matkul extends Model
{
    protected $table = 'matkuls';
    protected $fillable = [
        'matakuliah', 'semester_id'
    ];
    // public function dosen()
    // {
    //     return $this->belongsToMany(Dosen::class);
    // }

    public function semester()
    {
        return $this->belongsTo('App\Semester', 'semester_id');
    }

    public function dosen()
    {
        return $this->belongsToMany(Dosen::class);
    }
}
