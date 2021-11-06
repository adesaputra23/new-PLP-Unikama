<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    public $incrementing = true;
    public $timestamps = false;
    protected $table = "role";
    protected $primaryKey = 'id_role';
    protected $keyType = 'bigint';
    protected $fillable = [
        'id_role','email','role', 'nik',
    ];

    const ADMIN           = 1;
    const DPL             = 2;
    const KEPALA_SEKOLAH  = 3;
    const GURU_PAMONG     = 4;

    const MAP_ROLE = [
        1 => 'Admin',
        2 => 'DPL',
        3 => 'Kepala Sekolah',
        4 => 'Guru Pamong',
    ];

}
