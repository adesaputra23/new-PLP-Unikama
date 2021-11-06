<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RkapAspek extends Model
{
    public $incrementing = true;
    public $timestamps = false;
    protected $table = "pn_rkap_aspek";
    protected $primaryKey = 'id_rkap_aspek';
    protected $keyType = 'bigint';

    
    //
}
