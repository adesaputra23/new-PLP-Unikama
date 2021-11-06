<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    public $incrementing = true;
    public $timestamps = false;
    protected $table = "penilaian";
    protected $primaryKey = 'id_penilaian';
    protected $keyType = 'bigint';

    public function JointoRkapAspek()
    {
        return $this->hasOne('App\RkapAspek', 'id_penilaian', 'id_penilaian');
    }

    public function JointoRkapAspekMany()
    {
        return $this->hasMany('App\RkapAspek', 'id_penilaian', 'id_penilaian');
    }

    public function JointoMhs()
    {
        return $this->hasOne('App\Mahasiswa', 'npm', 'npm');
    }

    public function JointoZonasi()
    {
        return $this->hasOne('App\ZonasiSekolah', 'id_zonasi', 'id_zonasi');
    }  
    
}
