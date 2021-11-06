<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GuruPamong extends Model
{
    public $incrementing = true;
    public $timestamps = false;
    protected $table = "guru_pamong";
    protected $primaryKey = 'id_guru_pamong';
    protected $keyType = 'bigint';

    public function JointoKepsek()
    {
        return $this->hasOne('App\KepalaSekolah', 'kode_sekolah', 'kode_sekolah');
    }

    public function Kepsek()
    {
        return $this->hasOne('App\KepalaSekolah', 'id_kepsek', 'id_kepsek');
    }

    public function JointoZonasi()
    {
        return $this->hasOne('App\ZonasiSekolah', 'id_guru_pamong', 'id_guru_pamong');
    }
}
