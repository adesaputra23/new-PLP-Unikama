<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PnAspek extends Model
{
    public $incrementing = true;
    public $timestamps = false;
    protected $table = "pn_aspek";
    protected $primaryKey = 'id_aspek';
    protected $keyType = 'bigint';
    //
}
