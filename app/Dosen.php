<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    protected $table = 'dosens';
    protected $fillable = [
        'nip', 'nama', 'jk', 'alamat', 'user_id',
    ];

    public function User()
    {
        return $this->belongsTo('App\User');
    }

    public function matkul()
    {
        return $this->belongsToMany(Matkul::class)->withPivot(['id']);
    }
}
