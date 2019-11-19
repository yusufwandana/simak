<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    protected $table = 'dosens';
    protected $fillable = [
        'nip', 'nama', 'jk', 'user_id',
    ];

    public function User()
    {
        return $this->belongsTo('App\User');
    }

}
