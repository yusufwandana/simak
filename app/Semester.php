<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    protected $table = 'semesters';
    protected $fillable = [
        'semester'
    ];

    public function matkul()
    {
        return $this->hasMany('App\Matkul', 'id', 'semester_id');
    }
}
