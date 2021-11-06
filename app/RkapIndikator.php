<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RkapIndikator extends Model
{
    public $incrementing = true;
    public $timestamps = false;
    protected $table = "pn_rkap_indikator";
    protected $primaryKey = 'id_pn_rkap_indikator';
    protected $keyType = 'bigint';

    public function GetIdPnIndikator()
    {
        return $this->hasMany('App\PnIndikator', 'id_indikator_pn', 'id_indikator_pn');
        # code...
    }

    public function PnIndikator()
    {
        return $this->belongsTo('App\PnIndikator', 'id_indikator_pn', 'id_indikator_pn');
    }

}
