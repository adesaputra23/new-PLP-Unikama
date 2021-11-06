<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    public $incrementing = true;
    public $timestamps = false;
    protected $table = "pegawai";
    protected $primaryKey = 'id_peg';
    protected $keyType = 'bigint';
}
