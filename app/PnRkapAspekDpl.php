<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PnRkapAspekDpl extends Model
{
    public $incrementing = true;
    public $timestamps = false;
    protected $table = "pn_rkap_aspek_dpl";
    protected $primaryKey = 'id_rkap_aspek_dpl';
    protected $keyType = 'bigint';
}
