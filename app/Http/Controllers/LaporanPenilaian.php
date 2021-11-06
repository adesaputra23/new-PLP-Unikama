<?php

namespace App\Http\Controllers;

use App\User;
use App\ZonasiSekolah;
use Illuminate\Http\Request;

class LaporanPenilaian extends Controller
{
    public function LaporanPenilaianSekolah()
    {
        $list_mhs_plp_1 = ZonasiSekolah::whereHas('JointoMhs', function($query){
            $query->where('jenis_plp', 1);
        })->get();
        $list_mhs_plp_2 = ZonasiSekolah::whereHas('JointoMhs', function($query){
            $query->where('jenis_plp', 2);
        })->get();
        // dd($list_mhs_plp_1);
        return view(
            'laporan_penilaian/laporan_penilaian_sekolah',
                compact(
                    'list_mhs_plp_1',
                    'list_mhs_plp_2',
                )
        );
    }

    public function LaporanPenilaianDpl()
    {
        $list_mhs_plp_2 = ZonasiSekolah::whereHas('JointoMhs', function($query){
            $query->where('jenis_plp', 2);
        })->get();
        $list_prodi = User::MAP_PRODI;
        return view(
            'laporan_penilaian/laporan_penilaian_dpl',
                compact(
                        'list_mhs_plp_2',
                        'list_prodi'
                    )
        );
    }

    public function RekapNilai()
    {
        $list_mhs_plp_1 = ZonasiSekolah::whereHas('JointoMhs', function($query){
            $query->where('jenis_plp', 1);
        })->get();
        $list_mhs_plp_2 = ZonasiSekolah::whereHas('JointoMhs', function($query){
            $query->where('jenis_plp', 2);
        })->get();
        $list_prodi = User::MAP_PRODI;
        return view(
            'laporan_penilaian/rekap_nilai',
                compact(
                        'list_mhs_plp_1',
                        'list_mhs_plp_2',
                        'list_prodi'
                    )
        );
        # code...
    }
}
