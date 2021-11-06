<?php

namespace App\Http\Controllers;

use App\Dpl;
use App\User;
use App\ZonasiSekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ZonasiController extends Controller
{
    public function DataZonasi()
    {
        $role = Auth::user()->user_role->role;
        if ($role == 3) {
            $sekolah = Auth::user()->get_kepala_sekolah->kode_sekolah;
            $cek_plp_1 = Auth::user()->get_kepala_sekolah->JointoMitraSekolah->status_plp_1;
            $cek_plp_2 = Auth::user()->get_kepala_sekolah->JointoMitraSekolah->status_plp_2;
            $list_zonasi_plp_1 = ZonasiSekolah::where('kode_sekolah', $sekolah)
                ->whereHas('JointoMhs', function($query){
                    $query->where('jenis_plp', 1);
                })->get();
            $list_zonasi_plp_2 = ZonasiSekolah::where('kode_sekolah', $sekolah)
            ->whereHas('JointoMhs', function($query){
                $query->where('jenis_plp', 2);
            })->get();
        }elseif($role == 4){
            $gp = Auth::user()->get_guru_pamong;
            $kepsek = $gp->Kepsek;
            $sekolah = $kepsek->JointoMitraSekolah;
            $cek_plp_1 = $sekolah->status_plp_1;
            $cek_plp_2 = $sekolah->status_plp_2;
            $list_zonasi_plp_1 = ZonasiSekolah::where('id_guru_pamong', $gp->id_guru_pamong)
                ->whereHas('JointoMhs', function($query){
                    $query->where('jenis_plp', 1);
                })->get();
            $list_zonasi_plp_2 = ZonasiSekolah::where('id_guru_pamong', $gp->id_guru_pamong)
                ->whereHas('JointoMhs', function($query){
                    $query->where('jenis_plp', 2);
                })->get();
        }elseif($role == 1) {
            $cek_plp_1 = '';
            $cek_plp_2 = '';
            $list_zonasi_plp_1 = ZonasiSekolah::whereHas('JointoMhs', function($query){
                $query->where('jenis_plp', 1);
            })->get(); 
            $list_zonasi_plp_2 = ZonasiSekolah::whereHas('JointoMhs', function($query){
                $query->where('jenis_plp', 2);
            })->get();
            # code...
        }elseif($role == 2){
            $cek_plp_1 = 1;
            $cek_plp_2 = 1;
            $user = Auth::user()->get_dpl->id_dpl;
            $list_zonasi_plp_1 = ZonasiSekolah::where('id_dpl', $user)
                ->whereHas('JointoMhs', function($query){
                    $query->where('jenis_plp', 1);
                })->get();
            $list_zonasi_plp_2 = ZonasiSekolah::where('id_dpl', $user)
                ->whereHas('JointoMhs', function($query){
                    $query->where('jenis_plp', 2);
                })->get();
        }

        $list_dpl = Dpl::all();
        $list_prodi = User::MAP_PRODI;
        $list_fakultas = User::MAP_FAKULTAS;
        return view(
            'data_zonasi',
                compact(
                    'list_zonasi_plp_1',
                    'list_zonasi_plp_2',
                    'cek_plp_1',
                    'cek_plp_2',
                    'list_dpl',
                    'list_prodi',
                    'list_fakultas',
                    'role'
                )
        );
    }

    public function AddDpl_1(Request $request, $npm)
    {
        $array = [
            'id_dpl' => $request->id_dpl,
        ];
        $add_dpl = ZonasiSekolah::where('npm', $npm)->update($array);
        $missage = '';
        if ($add_dpl == true) {
            $missage = 'success';
        }else{
            $missage = 'error';
        }
        return response()->json($missage);
    }

    public function AddGuruPamong_1(Request $request, $npm)
    {
        $array = [
            'id_guru_pamong' => $request->id_guru_pamong,
        ];
        $add_guru_pamong = ZonasiSekolah::where('npm', $npm)->update($array);
        $missage = '';
        if ($add_guru_pamong == true) {
            $missage = 'success';
        }else{
            $missage = 'error';
        }
        return response()->json($missage);
    }

    public function AddDpl_2(Request $request, $npm)
    {
        $array = [
            'id_dpl' => $request->id_dpl,
        ];
        $add_dpl = ZonasiSekolah::where('npm', $npm)->update($array);
        $missage = '';
        if ($add_dpl == true) {
            $missage = 'success';
        }else{
            $missage = 'error';
        }
        return response()->json($missage);
    }

    public function AddGuruPamong_2(Request $request, $npm)
    {
        $array = [
            'id_guru_pamong' => $request->id_guru_pamong,
        ];
        $add_guru_pamong = ZonasiSekolah::where('npm', $npm)->update($array);
        $missage = '';
        if ($add_guru_pamong == true) {
            $missage = 'success';
        }else{
            $missage = 'error';
        }
        return response()->json($missage);
    }

    public function HaspusDataZonasi(Request $request)
    {
        ZonasiSekolah::where('npm', $request->npm)->delete();
        return redirect('data-zonasi')->with('toast_success', 'Data Berhasil Dihapus');
    }
}
