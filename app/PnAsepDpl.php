<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PnAsepDpl extends Model
{
    public $incrementing = true;
    public $timestamps = false;
    protected $table = "pn_aspek_dpl";
    protected $primaryKey = 'id_aspek_dpl';
    protected $keyType = 'bigint';
}
