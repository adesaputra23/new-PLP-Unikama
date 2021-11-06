<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PnRkapIndikatorDPl extends Model
{
    public $incrementing = true;
    public $timestamps = false;
    protected $table = "pn_rkap_indikator_dpl";
    protected $primaryKey = 'id_rkap_indikator_dpl';
    protected $keyType = 'bigint';

    public function GetPnIndikatorDPl()
    {
        return $this->hasOne('App\PnIdikatorDpl', 'id_indikator_dpl', 'id_indikator_dpl');
        # code...
    }

    public function PnIndikatorDPl()
    {
        return $this->belongsTo('App\PnIdikatorDpl', 'id_indikator_dpl', 'id_indikator_dpl');
        # code...
    }

}
