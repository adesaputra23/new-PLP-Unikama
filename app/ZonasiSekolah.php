<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ZonasiSekolah extends Model
{
    public $incrementing = true;
    public $timestamps = false;
    protected $table = "zonasi_sekolah";
    protected $primaryKey = 'id_zonasi';
    protected $keyType = 'bigint';

    public function JointoMhs()
    {
        return $this->hasOne('App\Mahasiswa', 'npm', 'npm');
    }

    public function JointoMitraSekolah()
    {
        return $this->hasOne('App\MitraSekolah', 'kode_sekolah', 'kode_sekolah');
    }

    public function JointoDpl()
    {
        return $this->hasOne('App\Dpl', 'id_dpl', 'id_dpl');
    }

    public function JointoGuruPamong()
    {
        return $this->hasOne('App\GuruPamong', 'id_guru_pamong', 'id_guru_pamong');
    }

    public function JointoPenilaian()
    {
        return $this->hasOne('App\Penilaian', 'id_zonasi', 'id_zonasi');
    }

    public function JointoPenilaianDPl()
    {
        return $this->hasOne('App\PenilaianDpl', 'id_zonasi', 'id_zonasi');
    }
}
