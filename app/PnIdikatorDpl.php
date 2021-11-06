<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PnIdikatorDpl extends Model
{
    public $incrementing = true;
    public $timestamps = false;
    protected $table = "pn_indikator_dpl";
    protected $primaryKey = 'id_indikator_dpl';
    protected $keyType = 'bigint';

    public function GetRkapIdPnIndikatorDPl()
    {
        return $this->hasMany('App\PnRkapIndikatorDpl', 'id_indikator_dpl', 'id_indikator_dpl');
        # code...
    }

    public function RkapIdPnIndikatorDPl()
    {
        return $this->belongsTo('App\PnRkapIndikatorDpl', 'id_indikator_dpl', 'id_indikator_dpl');
        # code...
    }
}
