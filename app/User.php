<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nik', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    const MAP_PRODI = [
        1   => 'BIMBINGAN & KONSELING',
        2   => 'BAHASA & SASTRA INDONESIA',
        3   => 'EKONOMI',
        4   => 'BAHASA INGGRIS',
        5   => 'FISIKA',
        6   => 'GEOGRAFI',
        7   => 'GURU PAUD',
        8   => 'MATEMATIKA',
        9   => 'PGSD',
        10  => 'PPKN',
    ];

    const MAP_FAKULTAS = [
        1 => 'BAHASA & SASTRA',
        2 => 'EKONOMI & BISNIS',
        3 => 'ILMU PENDIDIKAN',
        4 => 'SAINS & TEKNOLOGI',
    ];

    const ROLE_FAKULTAS = [
        1 => [2,4],
        2 => [3],
        3 => [1,5,6,7,8,9,10],
        4 => [],
    ];

    const ROLE_PRODI = [
        1   => 3,
        2   => 1,
        3   => 2,
        4   => 1,
        5   => 3,
        6   => 3,
        7   => 3,
        8   => 3,
        9   => 3,
        10  => 3,
    ];

    public function user_role()
    {
        return $this->hasOne('App\UserRole', 'nik', 'nik');
    }

    public function get_pegawai()
    {
        return $this->hasOne('App\Pegawai', 'nik', 'nik');
    }

    public function get_dpl()
    {
        return $this->hasOne('App\Dpl', 'nik', 'nik');
    }

    public function get_kepala_sekolah()
    {
        return $this->hasOne('App\KepalaSekolah', 'nik', 'nik');
    }

    public function get_guru_pamong()
    {
        return $this->hasOne('App\GuruPamong', 'nik', 'nik');
    }


}
