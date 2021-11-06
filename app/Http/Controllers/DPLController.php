<?php

namespace App\Http\Controllers;

use App\Dpl;
use App\PenilaianDPl;
use App\PnIdikatorDpl;
use App\PnRkapAspekDpl;
use App\PnRkapIndikatorDPl;
use App\User;
use App\UserRole;
use App\ZonasiSekolah;
// use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class DPLController extends Controller
{
    public function DataDpl()
    {
        $no = 1;
        $list_dpl = Dpl::get();
        $list_prodi = User::MAP_PRODI;
        $list_fakultas = User::MAP_FAKULTAS;
        return view(
            'data_dpl',
                compact(
                    'no',
                    'list_dpl',
                    'list_prodi',
                    'list_fakultas',
                )
        );
    }

    public function FormDataDpl()
    {
        $list_prodi = User::MAP_PRODI;
        $list_fakultas = User::MAP_FAKULTAS;
        return view(
            'tambah_data_dpl',
                compact(
                    'list_prodi',
                    'list_fakultas',
                )
        );
    }

    public function ProsesSimpanDpl(Request $request)
    {
        // dd($request->all());
        DB::beginTransaction();
        try {
            $missage = [
                'nik.unique' => 'NIK/NIDN sudah digunakan',
            ];
            $validator = Validator::make($request->all(), [
                'nik' => 'unique:dpl',
            ],$missage);
            
            if ($validator->fails()) {
                return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
            }

            $dpl = new Dpl();
            $dpl->nik = $request->nik;
            $dpl->nama_dpl = $request->nama_dpl;
            $dpl->jenis_kelamin = $request->jenis_kelamin;
            $dpl->program_studi = $request->prodi;
            $dpl->fakultas = $request->fakultas;
            $dpl->alamat = $request->alamat;
            $dpl->no_telpon = $request->no_hp;
            $dpl->save();

            $user = new User();
            $user->nik = $request->nik;
            $user->password = Hash::make($request->nik);
            $user->created_at = date('Y-m-d H:i:s');
            $user->updated_at = date('Y-m-d H:i:s');
            $user->save();

            $role = new UserRole();
            $role->nik = $request->nik;
            $role->role = 2;
            $role->save();

            DB::commit();
            return redirect('data-dpl')->with('toast_success', 'Data berhasil disimpan');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect('data-dpl')->with('toast_error', 'Data gagal disimpan');
        }
        
    }

    public function FormEditDpl(Request $request, $id_dpl)
    {
        $list_prodi = User::MAP_PRODI;
        $list_fakultas = User::MAP_FAKULTAS;
        $get_dpl = Dpl::where('id_dpl', $id_dpl)->first();
        return view(
            'edit_data_dpl',
                compact(
                    'get_dpl',
                    'list_prodi',
                    'list_fakultas',
                )
        );
    }

    public function ProsesEditDpl(Request $request, $id_dpl)
    {
        $dpl = Dpl::find($id_dpl);
        $dpl->nik = $request->nik;
        $dpl->nama_dpl = $request->nama_dpl;
        $dpl->jenis_kelamin = $request->jenis_kelamin;
        $dpl->program_studi = $request->prodi;
        $dpl->fakultas = $request->fakultas;
        $dpl->alamat = $request->alamat;
        $dpl->no_telpon = $request->no_hp;
        $dpl->update();
        return redirect('data-dpl')->with('toast_success', 'Data berhasil diedit');
    }

    public function HapusDpl(Request $request)
    {
        Dpl::where('id_dpl', $request->id_dpl)->delete();
        return redirect('data-dpl')->with('toast_success', 'Data berhasil dihapus');
    }

    public function PenilaianP1()
    {
        $user = Auth::user()->get_dpl->id_dpl;
            // $list_zonasi_plp_1 = ZonasiSekolah::where('id_dpl', $user)
            //     ->whereHas('JointoMhs', function($query){
            //         $query->where('jenis_plp', 1);
            //     })->get();
            $list_zonasi_plp_2 = ZonasiSekolah::where('id_dpl', $user)
                ->whereHas('JointoMhs', function($query){
                    $query->where('jenis_plp', 2);
                })->get();
        return view(
            'dpl/penilaian',
                compact(
                    'list_zonasi_plp_2'
                )
        );
    }

    public function SetPenilaianP2($id)
    {
        $list_indikator_dpl_n1 = PnIdikatorDpl::where('id_aspek_dpl', 1)->get();
        $list_indikator_dpl_n2 = PnIdikatorDpl::where('id_aspek_dpl', 2)->get();
        $list_indikator_dpl_n3 = PnIdikatorDpl::where('id_aspek_dpl', 3)->get();
        $data_mhs = ZonasiSekolah::where('id_zonasi', $id)->first();
        $list_prodi = User::MAP_PRODI;
        // dd($data_mhs->JointoMhs);
        return view(
            'dpl/form_penilaian_p2',
                compact(
                    'data_mhs',
                    'list_prodi',
                    'list_indikator_dpl_n1',
                    'list_indikator_dpl_n2',
                    'list_indikator_dpl_n3'

                )
        );
    }

    public function SimpanNilaiDplP2(Request $request, $id)
    {
        $npm = $request->npm;

        // var n1
        $id_indikator_dpl_n1 = $request->id_indikator_dpl_n1;
        $nilai_indikator_dpl_n1 = $request->indikator_dpl_n1;
        $id_pn_aspek_dpl_n1 = $request->id_pn_aspek_dpl_n1;
        $jml_nilai_indikator_dpl_n1 = $request->jml_nilai_indikator_dpl_n1;

        // var n2
        $id_indikator_dpl_n2 = $request->id_indikator_dpl_n2;
        $nilai_indikator_dpl_n2 = $request->indikator_dpl_n2;
        $id_pn_aspek_dpl_n2 = $request->id_pn_aspek_dpl_n2;
        $jml_nilai_indikator_dpl_n2 = $request->jml_nilai_indikator_dpl_n2;

        // var n3
        $id_indikator_dpl_n3 = $request->id_indikator_dpl_n3;
        $link_indikator_dpl_n3 = $request->indikator_dpl_n3;

        $jumlah_n1 = $jml_nilai_indikator_dpl_n1 * 0.1;
        $jumlah_n2 = $jml_nilai_indikator_dpl_n2 * 0.15;
        $format_number_n1 = number_format($jumlah_n1);
        $format_number_n2 = number_format($jumlah_n2);
        $jumlah_na = ($format_number_n1 + $format_number_n2) / 0.25;
        $na = number_format($jumlah_na);

        // confert nilai
        // Konfert Nilai
        if ($na >= 91 ) {
            // 91-100 A
            $konfert_na = 'A';
        }elseif($na >= 84 ){
            // 84-90 A-
            $konfert_na = 'A-';
        }elseif($na >= 75 ){
            // 75-83 B+
            $konfert_na = 'B+';
        }elseif($na >= 71 ){
            // 71-76 B
            $konfert_na = 'B';
        }elseif($na >= 66 ){
            // 66-70 B-
            $konfert_na = 'B-';
        }elseif($na >= 61 ){
            // 61-65 C+
            $konfert_na = 'C+';
        }elseif($na >= 55 ){
            // 55-60 C
            $konfert_na = 'C';
        }elseif($na >= 41 ){
            // 41-54 D
            $konfert_na = 'D';
        }elseif($na <= 40 ){
             // 0-40 E
            $konfert_na = 'E';
        }

        $penilaian_DPL = new PenilaianDPl();
        $penilaian_DPL->id_zonasi = $id;
        $penilaian_DPL->npm = $npm;
        $penilaian_DPL->created_at = date('Y-m-d H:i:s');

        if ($penilaian_DPL->save() == true) {
            $id_penilaian_dpl = $penilaian_DPL->id_penilaian_dpl;
           
            DB::beginTransaction();
            try {
                
                // save penilaian aspek dpl
                $rkap_aspek_dpl_n1 = new PnRkapAspekDpl();
                $rkap_aspek_dpl_n1->id_pn_aspek_dpl = $id_pn_aspek_dpl_n1;
                $rkap_aspek_dpl_n1->id_penilaian_dpl = $id_penilaian_dpl;
                $rkap_aspek_dpl_n1->jumlah_nilai = $jml_nilai_indikator_dpl_n1;
                $rkap_aspek_dpl_n1->save();

                $rkap_aspek_dpl_n2 = new PnRkapAspekDpl();
                $rkap_aspek_dpl_n2->id_pn_aspek_dpl = $id_pn_aspek_dpl_n2;
                $rkap_aspek_dpl_n2->id_penilaian_dpl = $id_penilaian_dpl;
                $rkap_aspek_dpl_n2->jumlah_nilai = $jml_nilai_indikator_dpl_n2;
                $rkap_aspek_dpl_n2->save();


                // save penilaian indikator dpl
                foreach ($id_indikator_dpl_n1 as $key_n1 => $value_n1) {
                    $rkap_indikator_dpl_n1 = new PnRkapIndikatorDPl();
                    $rkap_indikator_dpl_n1->id_indikator_dpl = $value_n1;
                    $rkap_indikator_dpl_n1->id_penilaian_dpl = $id_penilaian_dpl;
                    $rkap_indikator_dpl_n1->jumlah_nilai_rkap = $nilai_indikator_dpl_n1[$key_n1];
                    $rkap_indikator_dpl_n1->save();
                    
                }

                foreach ($id_indikator_dpl_n2 as $key_n2 => $value_n2) {
                    $rkap_indikator_dpl_n2 = new PnRkapIndikatorDPl();
                    $rkap_indikator_dpl_n2->id_indikator_dpl = $value_n2;
                    $rkap_indikator_dpl_n2->id_penilaian_dpl = $id_penilaian_dpl;
                    $rkap_indikator_dpl_n2->jumlah_nilai_rkap = $nilai_indikator_dpl_n2[$key_n2];
                    $rkap_indikator_dpl_n2->save();
                    
                }

                foreach ($id_indikator_dpl_n3 as $key_n3 => $value_n3) {
                    $rkap_indikator_dpl_n3 = new PnRkapIndikatorDPl();
                    $rkap_indikator_dpl_n3->id_indikator_dpl = $value_n3;
                    $rkap_indikator_dpl_n3->id_penilaian_dpl = $id_penilaian_dpl;
                    $rkap_indikator_dpl_n3->link_laporan = $link_indikator_dpl_n3[$key_n3];
                    $rkap_indikator_dpl_n3->save();
                    
                }

                $na_penilain_dpl = PenilaianDPl::find($id_penilaian_dpl);
                $na_penilain_dpl->jumlah_na = $na;
                $na_penilain_dpl->huruf = $konfert_na;
                $na_penilain_dpl->update();

                DB::commit();
                return redirect('penilaian-dpl-p1')->with('toast_success', 'Penilaiain berhasil disimpan');
            } catch (\Throwable $th) {

                DB::rollBack();
                return redirect('penilaian-dpl-p1')->with('toast_error', 'Penilaiain gagal disimpan');
            }

        } else {
            return redirect('penilaian-dpl-p1')->with('toast_error', 'Penilaiain gagal disimpan');
        }
        return redirect('penilaian-dpl-p1')->with('toast_error', 'Penilaiain gagal disimpan');
    }
    

    public function EditPenilaianP2($id)
    {
        $data_user = PenilaianDPl::where('id_zonasi', $id)->first();
        
        // indikator
        $list_indikator_dpl_n1 = PnRkapIndikatorDPl::where('id_penilaian_dpl', $data_user->id_penilaian_dpl)
        ->whereHas('GetPnIndikatorDPl', function($query){
            $query->where('id_aspek_dpl', 1);
        })->get();
        $list_indikator_dpl_n2 = PnRkapIndikatorDPl::where('id_penilaian_dpl', $data_user->id_penilaian_dpl)
        ->whereHas('GetPnIndikatorDPl', function($query){
            $query->where('id_aspek_dpl', 2);
        })->get();
        $list_indikator_dpl_n3 = PnRkapIndikatorDPl::where('id_penilaian_dpl', $data_user->id_penilaian_dpl)
        ->whereHas('GetPnIndikatorDPl', function($query){
            $query->where('id_aspek_dpl', 3);
        })->get();

        // aspek
        $rkap_aspek_dpl_n1 = PnRkapAspekDpl::where('id_penilaian_dpl', $data_user->id_penilaian_dpl)->where('id_pn_aspek_dpl', 1)->first();
        $rkap_aspek_dpl_n2 = PnRkapAspekDpl::where('id_penilaian_dpl', $data_user->id_penilaian_dpl)->where('id_pn_aspek_dpl', 2)->first();

        $data_mhs = ZonasiSekolah::where('id_zonasi', $id)->first();
        $list_prodi = User::MAP_PRODI;
        // dd($data_mhs->JointoMhs);
        return view(
            'dpl/form_edit_penilaian_p2',
                compact(
                    'data_mhs',
                    'list_prodi',
                    'list_indikator_dpl_n1',
                    'list_indikator_dpl_n2',
                    'list_indikator_dpl_n3',
                    'rkap_aspek_dpl_n1',
                    'rkap_aspek_dpl_n2'

                )
        );
    }

    public function ProsesEditNilaiDplP2(Request $request, $id)
    {
        // dd($request->all());
        // var n1
        // dd($id);
        $penilaian = PenilaianDPl::where('id_zonasi', $id)->first();
        $id_penilaian = $penilaian->id_penilaian_dpl;

        $id_rkap_indikator_dpl_n1 = $request->id_rkap_indikator_dpl_n1;
        $nilai_indikator_dpl_n1 = $request->indikator_dpl_n1;
        $id_rkap_aspek_dpl_n1 = $request->id_rkap_aspek_dpl_n1;
        $jml_nilai_indikator_dpl_n1 = $request->jml_nilai_indikator_dpl_n1;

        // var n2
        $id_rkap_indikator_dpl_n2 = $request->id_rkap_indikator_dpl_n2;
        $nilai_indikator_dpl_n2 = $request->indikator_dpl_n2;
        $id_rkap_aspek_dpl_n2 = $request->id_rkap_aspek_dpl_n2;
        $jml_nilai_indikator_dpl_n2 = $request->jml_nilai_indikator_dpl_n2;

        // var n3
        $id_rkap_indikator_dpl_n3 = $request->id_rkap_indikator_dpl_n3;
        $link_laporan = $request->indikator_dpl_n3;

        // rumus
        // =(G20*0,1+H20*0,15)/0,25
        $jumlah_n1 = $jml_nilai_indikator_dpl_n1 * 0.1;
        $jumlah_n2 = $jml_nilai_indikator_dpl_n2 * 0.15;
        $format_number_n1 = number_format($jumlah_n1);
        $format_number_n2 = number_format($jumlah_n2);
        $jumlah_na = ($format_number_n1 + $format_number_n2) / 0.25;
        $na = number_format($jumlah_na);

        // Konfert Nilai
        if ($na >= 91 ) {
            // 91-100 A
            $konfert_na = 'A';
        }elseif($na >= 84 ){
            // 84-90 A-
            $konfert_na = 'A-';
        }elseif($na >= 75 ){
            // 75-83 B+
            $konfert_na = 'B+';
        }elseif($na >= 71 ){
            // 71-76 B
            $konfert_na = 'B';
        }elseif($na >= 66 ){
            // 66-70 B-
            $konfert_na = 'B-';
        }elseif($na >= 61 ){
            // 61-65 C+
            $konfert_na = 'C+';
        }elseif($na >= 55 ){
            // 55-60 C
            $konfert_na = 'C';
        }elseif($na >= 41 ){
            // 41-54 D
            $konfert_na = 'D';
        }elseif($na <= 40 ){
             // 0-40 E
            $konfert_na = 'E';
        }

        DB::beginTransaction();
        try {

            // edit rkap aspek penilaian

            // n1
            $rkap_aspek_dpl_n1 = PnRkapAspekDpl::find($id_rkap_aspek_dpl_n1);
            $rkap_aspek_dpl_n1->jumlah_nilai = $jml_nilai_indikator_dpl_n1;
            $rkap_aspek_dpl_n1->created_at = date('Y-m-d H:i:s');
            $rkap_aspek_dpl_n1->save();

            // n2
            $rkap_aspek_dpl_n2 = PnRkapAspekDpl::find($id_rkap_aspek_dpl_n2);
            $rkap_aspek_dpl_n2->jumlah_nilai = $jml_nilai_indikator_dpl_n2;
            $rkap_aspek_dpl_n2->created_at = date('Y-m-d H:i:s');
            $rkap_aspek_dpl_n2->save();

            // edit rkap indikator penilaian

            // edit n1
            foreach ($id_rkap_indikator_dpl_n1 as $key_n1 => $value_n1) {
                $rkap_indikaator_dpl_n1 = PnRkapIndikatorDPl::where('id_pn_indikator_dpl', $value_n1);
                $rkap_indikaator_dpl_n1->update([
                    'jumlah_nilai_rkap' => $nilai_indikator_dpl_n1[$key_n1],
                    'created_at' => date('Y-m-d H:i:s')
                ]);
            }

            // edit n2
            foreach ($id_rkap_indikator_dpl_n2 as $key_n2 => $value_n2) {
                $rkap_indikaator_dpl_n2 = PnRkapIndikatorDPl::where('id_pn_indikator_dpl', $value_n2);
                $rkap_indikaator_dpl_n2->update([
                    'jumlah_nilai_rkap' => $nilai_indikator_dpl_n2[$key_n2],
                    'created_at' => date('Y-m-d H:i:s')
                ]);
            }

            // edit n3
            foreach ($id_rkap_indikator_dpl_n3 as $key_n3 => $value_n3) {
                $rkap_indikaator_dpl_n3 = PnRkapIndikatorDPl::where('id_pn_indikator_dpl', $value_n3);
                $rkap_indikaator_dpl_n3->update([
                    'link_laporan' => $link_laporan[$key_n3],
                    'created_at' => date('Y-m-d H:i:s')
                ]);
            }

            $na_penilain_dpl = PenilaianDPl::find($id_penilaian);
            $na_penilain_dpl->jumlah_na = $na;
            $na_penilain_dpl->huruf = $konfert_na;
            $na_penilain_dpl->update();

            DB::commit();
            return redirect('penilaian-dpl-p1')->with('toast_success', 'Penilaiain berhasil diubah');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect('penilaian-dpl-p1')->with('toast_error', 'Penilaiain gagal diubah');
        }

    }

    public function DetailPenilaianP2($id)
    {
        $data_user = PenilaianDPl::where('id_zonasi', $id)->first();
        
        // indikator
        $list_indikator_dpl_n1 = PnRkapIndikatorDPl::where('id_penilaian_dpl', $data_user->id_penilaian_dpl)
        ->whereHas('GetPnIndikatorDPl', function($query){
            $query->where('id_aspek_dpl', 1);
        })->get();
        $list_indikator_dpl_n2 = PnRkapIndikatorDPl::where('id_penilaian_dpl', $data_user->id_penilaian_dpl)
        ->whereHas('GetPnIndikatorDPl', function($query){
            $query->where('id_aspek_dpl', 2);
        })->get();
        $list_indikator_dpl_n3 = PnRkapIndikatorDPl::where('id_penilaian_dpl', $data_user->id_penilaian_dpl)
        ->whereHas('GetPnIndikatorDPl', function($query){
            $query->where('id_aspek_dpl', 3);
        })->get();

        // aspek
        $rkap_aspek_dpl_n1 = PnRkapAspekDpl::where('id_penilaian_dpl', $data_user->id_penilaian_dpl)->where('id_pn_aspek_dpl', 1)->first();
        $rkap_aspek_dpl_n2 = PnRkapAspekDpl::where('id_penilaian_dpl', $data_user->id_penilaian_dpl)->where('id_pn_aspek_dpl', 2)->first();

        $data_mhs = ZonasiSekolah::where('id_zonasi', $id)->first();
        $list_prodi = User::MAP_PRODI;
        // dd($data_mhs->JointoMhs);
        return view(
            'dpl/detail_nilai_p2',
                compact(
                    'data_mhs',
                    'list_prodi',
                    'list_indikator_dpl_n1',
                    'list_indikator_dpl_n2',
                    'list_indikator_dpl_n3',
                    'rkap_aspek_dpl_n1',
                    'rkap_aspek_dpl_n2'

                )
        );
    }

    public function SetVIdeoTerbaik($id)
    {
        $get_laporan_terbaik = PenilaianDPl::where('status_laporan_terbaik', 1)->first();
        if (empty($get_laporan_terbaik)) {
            $laporan_terbaik = PenilaianDPl::find($id);
            $laporan_terbaik->status_laporan_terbaik = 1;
            $laporan_terbaik->update();
            return redirect('penilaian-dpl-p1')->with('toast_success', 'Berhasil Seting video dan laporan terbaik');
            # code...
        } else {
            DB::beginTransaction();
            try {
                
                $id_old = $get_laporan_terbaik->id_penilaian_dpl;
                $laporan_terbaik = PenilaianDPl::find($id_old);
                $laporan_terbaik->status_laporan_terbaik = null;
                $laporan_terbaik->update();

                $laporan_terbaik = PenilaianDPl::find($id);
                $laporan_terbaik->status_laporan_terbaik = 1;
                $laporan_terbaik->update();

                DB::commit();
                return redirect('penilaian-dpl-p1')->with('toast_success', 'Berhasil Seting video dan laporan terbaik');
            } catch (\Throwable $th) {
                DB::rollBack();
                return redirect('penilaian-dpl-p1')->with('toast_error', 'Gagal Seting video dan laporan terbaik');
            }
        }
        

        # code...
    }
}
