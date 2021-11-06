<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KepalaSekolah extends Model
{
    public $incrementing = true;
    public $timestamps = false;
    protected $table = "kepala_sekolah";
    protected $primaryKey = 'id_kepsek';
    protected $keyType = 'bigint';

    protected $fillable = [
         'id_kepsek',
         'nik',
         'nama_kepsek',
         'jenis_kelamin',
         'alamat_kepsek',
         'no_telpon_kepsek',
         'kode_sekolah',
    ];

    public function JointoMitraSekolah()
    {
        return $this->hasOne('App\MitraSekolah', 'kode_sekolah', 'kode_sekolah');
    }

    public function JointoZonasi()
    {
        return $this->hasOne('App\ZonasiSekolah', 'kode_sekolah', 'kode_sekolah');
    }
}
