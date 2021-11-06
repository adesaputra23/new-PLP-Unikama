<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PnIndikator extends Model
{
    public $incrementing = true;
    public $timestamps = false;
    protected $table = "pn_indikator";
    protected $primaryKey = 'id_indikator_pn';
    protected $keyType = 'bigint';
    //

    public function GetRkapIdPnIndikator()
    {
        return $this->hasMany('App\RkapIndikator', 'id_indikator_pn', 'id_indikator_pn');
        # code...
    }

    public function PnRkapIndikator()
    {
        return $this->belongsTo('App\RkapIndikator', 'id_indikator_pn', 'id_indikator_pn');
    }

    public function PnRkapIndikatorOne()
    {
        return $this->hasOne('App\RkapIndikator', 'id_indikator_pn', 'id_indikator_pn');
    }
}
