<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gelar extends Model
{
    protected $fillable = ['gelar','singkatan'];
    public function dosen()
    {
        return $this->hasMany('App\Dosen');
    }
}
