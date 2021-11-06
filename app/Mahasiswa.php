<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    public $incrementing = true;
    public $timestamps = false;
    protected $table = "mahasiswa";
    protected $primaryKey = 'id_mhs';
    protected $keyType = 'bigint';

    protected $fillable = [
        'id_mhs', 
        'npm', 
        'nama_mhs',
        'program_studi',
        'fakultas',
        'angkatan',
        'ipk',
        'kelas',
        'agama',
        'jenis_kelamin',
        'alamat',
        'jenis_plp',
        'no_hp',
        'tgl_pendaftaran',
        'tgl_pembayaran',
        'tgl_verifikasi',
        'file_pembayaran',
        'create_at',
    ];
}
