<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MitraSekolah extends Model
{
    public $incrementing = true;
    public $timestamps = false;
    protected $table = "mitra_sekolah";
    protected $primaryKey = 'id_sekolah';
    protected $keyType = 'bigint';

     protected $fillable = [
         'id_sekolah',
         'kode_sekolah',
         'nama_sekolah',
         'alamat_sekolah',
         'status_kepsek',
         'status_plp_1',
         'status_plp_2',
         'kuota_plp_1',
         'kuota_plp_2',
         'jml_mhs_plp_1',
         'jml_mhs_plp_2',
    ];

    public function JointoKepsek()
    {
        return $this->hasOne('App\KepalaSekolah', 'kode_sekolah', 'kode_sekolah');
    }

    public function JointoZonasi()
    {
        return $this->hasOne('App\ZonasiSekolah', 'kode_sekolah', 'kode_sekolah');
    }
}
