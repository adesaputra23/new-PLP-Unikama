<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dpl extends Model
{
    public $incrementing = true;
    public $timestamps = false;
    protected $table = "dpl";
    protected $primaryKey = 'id_dpl';
    protected $keyType = 'bigint';

    public function JointoZonasi()
    {
        return $this->hasOne('App\ZonasiSekolah', 'id_dpl', 'id_dpl');
    }
}
