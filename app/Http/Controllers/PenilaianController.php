<?php

namespace App\Http\Controllers;

use App\MitraSekolah;
use App\Penilaian;
use App\PnAspek;
use App\PnIdikatorDpl;
use App\PnIndikator;
use App\RkapAspek;
use App\RkapIndikator;
use App\User;
use App\ZonasiSekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PenilaianController extends Controller
{
    public function DataPenilaian()
    {
        $gp = Auth::user()->get_guru_pamong;
        $kepsek = $gp->Kepsek;
        $sekolah = $kepsek->JointoMitraSekolah;
        $cek_plp_1 = $sekolah->status_plp_1;
        $cek_plp_2 = $sekolah->status_plp_2;
        $list_mhs = ZonasiSekolah::where('id_guru_pamong', $gp->id_guru_pamong)
            ->with('JointoMhs')
            ->where('status_penilaian', null)
            ->get();
        $list_mhs_plp_1 = Penilaian::WhereHas('JointoZonasi', function($query){
                    $gp = Auth::user()->get_guru_pamong;
                    $query->where('id_guru_pamong', $gp->id_guru_pamong);
                })
            ->WhereHas('JointoMhs', function($query){
                    $query->where('jenis_plp', 1);
                })
            ->get();
        $list_mhs_plp_2 = Penilaian::WhereHas('JointoZonasi', function($query){
                    $gp = Auth::user()->get_guru_pamong;
                    $query->where('id_guru_pamong', $gp->id_guru_pamong);
                })
            ->WhereHas('JointoMhs', function($query){
                    $query->where('jenis_plp', 2);
                })
            ->get();
        $list_prodi = User::MAP_PRODI;
        $list_fakultas = User::MAP_FAKULTAS;
        return view(
            'penilaian/data_penilaian',
                compact(
                    'list_prodi',
                    'list_fakultas',
                    'list_mhs_plp_1',
                    'list_mhs_plp_2',
                    'list_mhs',
                    'cek_plp_1',
                    'cek_plp_2',
                )
        );
        # code...
    }

    public function GetMhsPenilaian(Request $request)
    {
        $gp = Auth::user()->get_guru_pamong;
        if ($request->plp == 1) {
            $list_mhs = ZonasiSekolah::where('id_guru_pamong', $gp->id_guru_pamong)
            ->where('status_penilaian', null)
            ->WhereHas('JointoMhs', function($query){
                $query->where('jenis_plp', 1);
            })
            ->get();
            $plp = [];
            foreach ($list_mhs as $key_plp_1 => $mhs_plp_1) {
                $nestplp1['id_zonasi'] = $mhs_plp_1->id_zonasi;
                $nestplp1['npm'] = $mhs_plp_1->npm;
                $nestplp1['nama'] = $mhs_plp_1->JointoMhs->nama_mhs;
                $plp[] = $nestplp1;
            }
        } else {
             $list_mhs = ZonasiSekolah::where('id_guru_pamong', $gp->id_guru_pamong)
            ->where('status_penilaian', null)
            ->WhereHas('JointoMhs', function($query){
                $query->where('jenis_plp', 2);
            })
            ->get();
            $plp = [];
            foreach ($list_mhs as $key_plp_2 => $mhs_plp_2) {
                $nestplp2['id_zonasi'] = $mhs_plp_2->id_zonasi;
                $nestplp2['npm'] = $mhs_plp_2->npm;
                $nestplp2['nama'] = $mhs_plp_2->JointoMhs->nama_mhs;
                $plp[] = $nestplp2;
            }
        }
        return response()->json($plp);
    }

    public function SimpanPenilaian(Request $request)
    {

        $npm = $request->mhs;
        $zonasi = ZonasiSekolah::where('npm', $npm)->first();
        $id_zonasi = $zonasi->id_zonasi;

        DB::beginTransaction();
        try {
            
            $pnl = new Penilaian();
            $pnl->id_zonasi = $id_zonasi;
            $pnl->npm = $request->mhs;
            $pnl->created_at = date('Y-m-d H:i:s');
            $pnl->save();

            $zon = ZonasiSekolah::find($id_zonasi);
            $zon->status_penilaian = 1;
            $zon->update();

            DB::commit();
            return redirect('data-penilaian')->with('toast_success', 'Mahasiswa Berhasil Ditambahkan');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect('data-penilaian')->with('toast_error', 'Mahasiswa Gagal Ditambahkan');
            //throw $th;
        }
        # code...
    }

    // set penilaain Keaktifan N1
    public function SetNilai($id)
    {
        $data = Penilaian::where('id_penilaian', $id)->first();
        $list_pn_aspek = PnAspek::where('jenis_plp', 1)->get();
        $list_pn_indikator = PnIndikator::get();
        $no = 1;
        $no_n2 = 1;
        $no_n3 = 1; 
        $list_prodi = User::MAP_PRODI;
        return view(
            'penilaian/form_penilaian',
                compact(
                    'no',
                    'no_n2',
                    'no_n3',
                    'list_pn_aspek',
                    'list_pn_indikator',
                    'data',
                    'list_prodi'
                )
        );
    }

    public function EditNilai($id)
    {
        $data = Penilaian::where('id_penilaian', $id)->first();
        $list_prodi = User::MAP_PRODI;
        $list_pn_indikator = PnIndikator::get();
        $list_pn_rkap_indikator = RkapIndikator::with('PnIndikator')->where('id_penilaian', $id)->get();
        $list_pn_rkap_aspek = RkapAspek::where('id_penilaian', $id)->get();
        
        // n1
        // rkap aspek
        foreach ($list_pn_rkap_aspek as $key_pn_aspek_n1 => $rkap_pn_aspek_n1) {
            if ($rkap_pn_aspek_n1->id_pn_aspek == 1) {
                # code...
                $id_aspek_n1['id_aspek_n1'] = $rkap_pn_aspek_n1->id_rkap_aspek;
            }
            # code...
        }
        $get_id_aspek_pn_n1 = $id_aspek_n1['id_aspek_n1'];

        // rkap indikator
        foreach ($list_pn_rkap_indikator as $key => $value) {
            if ($value->PnIndikator->id_aspek_pn == 1) {
                $id_indikaor['id'] = $value->PnIndikator->id_indikator_pn;
                $id_indikaor['nilai'] = $value->PnIndikator->jumlah_nilai;
                $id_indikaor['id_rkap_indikator'] = $value->id_pn_rkap_indikator;
            }
        }
        $get_id_indikator_pn = $id_indikaor['id'];
        $get_nilai = $id_indikaor['nilai'];
        $get_id_rkap_aspek = $id_indikaor['id_rkap_indikator'];

        // n2
        // rkap aspek
        foreach ($list_pn_rkap_aspek as $key_pn_aspek_n2 => $rkap_pn_aspek_n2) {
            if ($rkap_pn_aspek_n2->id_pn_aspek == 2) {
                # code...
                $id_aspek_n2['id_aspek_n2'] = $rkap_pn_aspek_n2->id_rkap_aspek;
                $id_aspek_n2['nilai_aspek_n2'] = $rkap_pn_aspek_n2->jumlah_nilai;
            }
            # code...
        }
        $get_id_aspek_pn_n2 = $id_aspek_n2['id_aspek_n2'];
        $get_jumlah_nilai_pn_n2 = $id_aspek_n2['nilai_aspek_n2'];

        // n3
        foreach ($list_pn_rkap_aspek as $key_pn_aspek_n3 => $rkap_pn_aspek_n3) {
            if ($rkap_pn_aspek_n3->id_pn_aspek == 3) {
                # code...
                $id_aspek_n3['id_aspek_n3'] = $rkap_pn_aspek_n3->id_rkap_aspek;
                $id_aspek_n3['nilai_aspek_n3'] = $rkap_pn_aspek_n3->jumlah_nilai;
            }
            # code...
        }
        $get_id_aspek_pn_n3 = $id_aspek_n3['id_aspek_n3'];
        $get_jumlah_nilai_pn_n3 = $id_aspek_n3['nilai_aspek_n3'];

        // no
        $no_pn_1 = 1;
        $no_n3 = 1;

        return view(
            'penilaian/edit_penilaian',
                compact(
                    'data',
                    'list_prodi',
                    'get_id_indikator_pn',
                    'get_nilai',
                    'get_id_rkap_aspek',
                    'get_id_aspek_pn_n1',
                    'get_id_aspek_pn_n2',
                    'get_id_aspek_pn_n3',
                    'list_pn_indikator',
                    'list_pn_rkap_indikator',
                    'get_jumlah_nilai_pn_n2',
                    'get_jumlah_nilai_pn_n3',
                    'no_n3',
                    'no_pn_1'
                )
        );
        # code...
    }

    public function SimpantNilaiP1(Request $request)
    {
        // dd($request->all());
        $npm = $request->npm;
        $id_pn = $request->id_pn;
        // n1
        $nilai_indikator_n1 = $request->radio1;
        $id_indikator_pn_n1 = $request->id_n1;
        $id_aspek_pn_n1 = $request->id_aspek_pn_n1;
        $jumlah_nilai_n1 = $request->jml_nilai;
        $id_rkap_indikator_n1 = $request->id_rkap_indikator_pn_n1;
        $id_rkap_aspek_n1 = $request->id_rkap_aspek_pn_n1;

        // n2
        $nilai_indikator_n2 = $request->n2;
        $id_indikator_pn_n2 = $request->id_n2;
        $id_aspek_pn_n2 = $request->id_aspek_pn_n2;
        $jumlah_nilai_n2 = $request->jml_nilai_n2;
        $id_rkap_indikator_n2 = $request->id_rkap_indikator_n2;
        $id_rkap_aspek_n2 = $request->id_rkap_aspek_pn_n2;

        // n3
        $nilai_indikator_n3 = $request->n3;
        $id_indikator_pn_n3 = $request->id_n3;
        $id_aspek_pn_n3 = $request->id_aspek_pn_n3;
        $jumlah_nilai_n3 = $request->jml_nilai_n3;
        $id_rkap_indikator_n3 = $request->id_rkap_indikator_n3;
        $id_rkap_aspek_n3 = $request->id_rkap_aspek_pn_n3;

        $jumlah_na = $jumlah_nilai_n1*(10/100)+$jumlah_nilai_n2*(50/100)+$jumlah_nilai_n3*(40/100);
        $na = number_format($jumlah_na);
        
        // // =H16*(10/100)+I16*(50/100)+J16*(40/100)
        // // 91-100	A
        // // 84-90	A-
        // // 75-83	B+
        // // 71-76	B
        // // 66-70	B-
        // // 61-65	C+
        // // 55-60	C
        // // 41-54	D
        // // 0-40	E

        // Konfert Nilai
        if ($na >= 91 ) {
            $konfert_na = 'A';
        }elseif($na >= 84 ){
            $konfert_na = 'A-';
        }elseif($na >= 75 ){
            $konfert_na = 'B+';
        }elseif($na >= 71 ){
            $konfert_na = 'B';
        }elseif($na >= 66 ){
            $konfert_na = 'B-';
        }elseif($na >= 61 ){
            $konfert_na = 'C+';
        }elseif($na >= 55 ){
            $konfert_na = 'C';
        }elseif($na >= 41 ){
            $konfert_na = 'D';
        }elseif($na <= 40 ){
            $konfert_na = 'E';
        }

        DB::beginTransaction();
        try {

            if ($id_rkap_aspek_n1 != null) {
                $rkap_aspek_n1 = RkapAspek::find($id_rkap_aspek_n1);
                # code...
            } else {
                $rkap_aspek_n1 = new RkapAspek();
                $rkap_aspek_n1->id_pn_aspek = $id_aspek_pn_n1;
                $rkap_aspek_n1->id_penilaian = $id_pn;
                # code...
            }
            $rkap_aspek_n1->jumlah_nilai = $jumlah_nilai_n1;
            $rkap_aspek_n1->created_at = date('Y-m-d H:i:s');
            $rkap_aspek_n1->save();

            if ($id_rkap_indikator_n2 != null) {
                $rkap_aspek_n2 = RkapAspek::find($id_rkap_aspek_n2);
                # code...
            } else {
                $rkap_aspek_n2 = new RkapAspek();
                $rkap_aspek_n2->id_pn_aspek = $id_aspek_pn_n2;
                $rkap_aspek_n2->id_penilaian = $id_pn;
                # code...
            }
            
            $rkap_aspek_n2->jumlah_nilai = $jumlah_nilai_n2;
            $rkap_aspek_n2->created_at = date('Y-m-d H:i:s');
            $rkap_aspek_n2->save();

            if ($id_rkap_aspek_n3 != null) {
                $rkap_aspek_n3 = RkapAspek::find($id_rkap_aspek_n3);
                # code...
            } else {
                $rkap_aspek_n3 = new RkapAspek();
                $rkap_aspek_n3->id_pn_aspek = $id_aspek_pn_n3;
                $rkap_aspek_n3->id_penilaian = $id_pn;
                # code...
            }
            $rkap_aspek_n3->jumlah_nilai = $jumlah_nilai_n3;
            $rkap_aspek_n3->created_at = date('Y-m-d H:i:s');
            $rkap_aspek_n3->save();

            if ($id_rkap_indikator_n1 != null) {
                $rkap_indikator_n1 = RkapIndikator::find($id_rkap_indikator_n1);
            } else {
                $rkap_indikator_n1 = new RkapIndikator();
                $rkap_indikator_n1->id_indikator_pn = $id_indikator_pn_n1;
                $rkap_indikator_n1->id_penilaian = $id_pn;
            }
            $rkap_indikator_n1->jumlah_nilai_rkap = $jumlah_nilai_n1;
            $rkap_indikator_n1->created_at = date('Y-m-d H:i:s');
            $rkap_indikator_n1->save();

            if ($id_rkap_indikator_n2 != null) {
                // print_r($id_rkap_indikator_n2);
                foreach ($nilai_indikator_n2 as $key_update_n2=>$value_update_n2) {
                    $rkap_indikator_n2 = RkapIndikator::where('id_pn_rkap_indikator', $id_rkap_indikator_n2[$key_update_n2]);
                    $rkap_indikator_n2->update([
                        'jumlah_nilai_rkap' => $value_update_n2,
                        'created_at' => date('Y-m-d H:i:s')
                    ]);
                    # code...
                }
                // die;
                # code...
            } else {
                foreach ($id_indikator_pn_n2 as $key_pn2 => $value_pn2) {
                    $rkap_indikator_n2 = new RkapIndikator();
                    $rkap_indikator_n2->id_indikator_pn = $value_pn2;
                    $rkap_indikator_n2->id_penilaian = $id_pn;
                    $rkap_indikator_n2->jumlah_nilai_rkap = $nilai_indikator_n2[$key_pn2];
                    $rkap_indikator_n2->created_at = date('Y-m-d H:i:s');
                    $rkap_indikator_n2->save();
                }
                # code...
            }

            if ($id_rkap_indikator_n3 != null) {
                foreach ($nilai_indikator_n3 as $key_update_n3 => $value_update_n3) {
                    $rkap_indikator_n3 = RkapIndikator::where('id_pn_rkap_indikator', $id_rkap_indikator_n3[$key_update_n3]);
                    $rkap_indikator_n3->update([
                        'jumlah_nilai_rkap' => $value_update_n3,
                        'created_at' => date('Y-m-d H:i:s')
                    ]);
                    # code...
                }
                # code...
            }else{
                foreach ($id_indikator_pn_n3 as $key_pn3 => $value_pn3) {
                    $rkap_indikator_n3 = new RkapIndikator();
                    $rkap_indikator_n3->id_indikator_pn = $value_pn3;
                    $rkap_indikator_n3->id_penilaian = $id_pn;
                    $rkap_indikator_n3->jumlah_nilai_rkap = $nilai_indikator_n3[$key_pn3];
                    $rkap_indikator_n3->created_at = date('Y-m-d H:i:s');
                    $rkap_indikator_n3->save();
                }
            }

            $na_penilain = Penilaian::find($id_pn);
            $na_penilain->jumlah_na = $na;
            $na_penilain->huruf = $konfert_na;
            $na_penilain->update();

            DB::commit();
            return redirect('data-penilaian')->with('toast_success', 'Penilaian Berhasil di Buat');
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return redirect('data-penilaian')->with('toast_error', 'Penilaian Gagal di Buat');
        }
    }

    public function DetailPenilaianP1($id)
    {
        $data_mhs = Penilaian::where('id_penilaian', $id)->first();
        $list_prodi = User::MAP_PRODI;
        $rkap_indikators = RkapIndikator::where('id_penilaian', $id)->get();
        $rkap_aspeks = RkapAspek::where('id_penilaian', $id)->get();
        return view(
            'penilaian/detail_penilaian_p1',
                compact(
                    'data_mhs',
                    'list_prodi',
                    'rkap_indikators',
                    'rkap_aspeks'
                )
        );
        # code...
    }

    public function SetNilaiP2($id)
    {
        $penilaian = Penilaian::where('id_penilaian', $id)->first();
        $prodi = User::MAP_PRODI;
        $pn_indikator = new PnIndikator();
        $list_indikator_n1 = $pn_indikator->where('id_aspek_pn', 4)->get();
        $list_indikator_n2 = $pn_indikator->where('id_aspek_pn', 5)->get();
        $list_indikator_n3 = $pn_indikator->where('id_aspek_pn', 6)->get();
        $list_indikator_n4 = $pn_indikator->where('id_aspek_pn', 7)->get();
        // dd($penilaian);
        return view(
            'penilaian/set_nilai_p2',
                compact(
                    'penilaian',
                    'prodi',
                    'list_indikator_n1',
                    'list_indikator_n2',
                    'list_indikator_n3',
                    'list_indikator_n4'
                )
        );
    }

    public function EditNilaiP2($id)
    {
        $penilaian = Penilaian::where('id_penilaian', $id)->first();
        $prodi = User::MAP_PRODI;
        $pn_indikator = new PnIndikator();
        $list_indikator_n1 = $pn_indikator->where('id_aspek_pn', 4)->get();
        $list_indikator_n2 = $pn_indikator->where('id_aspek_pn', 5)->get();
        $list_indikator_n3 = $pn_indikator->where('id_aspek_pn', 6)->get();
        $list_indikator_n4 = $pn_indikator->where('id_aspek_pn', 7)->get();
        // $pn_aspek = RkapAspek::where('id_penilaian', $id);
        $rkap_aspek_n1 = RkapAspek::where('id_penilaian', $id)->where('id_pn_aspek', 4)->first();
        $rkap_aspek_n2 = RkapAspek::where('id_penilaian', $id)->where('id_pn_aspek', 5)->first();
        $rkap_aspek_n3 = RkapAspek::where('id_penilaian', $id)->where('id_pn_aspek', 6)->first();
        $rkap_aspek_n4 =RkapAspek::where('id_penilaian', $id)->where('id_pn_aspek', 7)->first();
        // dd($rkap_aspek_n3);
        return view(
            'penilaian/edit_nilai_p2',
                compact(
                    'penilaian',
                    'prodi',
                    'list_indikator_n1',
                    'list_indikator_n2',
                    'list_indikator_n3',
                    'list_indikator_n4',
                    'rkap_aspek_n1',
                    'rkap_aspek_n2',
                    'rkap_aspek_n3',
                    'rkap_aspek_n4'
                )
        );
    }

    public function SimpanNilaiP2(Request $request, $id)
    {
        // dd($request->all());
        // data n1
        $id_indikator_n1 = $request->id_indikator_n1;
        $nilai_indikator_n1 = $request->nilai_indikator_n1;
        $id_aspek_n1 = $request->id_aspek_n1;
        $jml_nilai_n1 = $request->jml_nilai_n1;

        // param edit n1
        $id_rkap_aspek_n1 = $request->id_rkap_aspek_n1;
        $id_rkap_indikator_n1 = $request->id_rkap_indikator_n1;

        // data n2
        $id_indikator_n2 = $request->id_indikator_n2;
        $nilai_indikator_n2 = $request->nilai_indikator_n2;
        $id_aspek_n2 = $request->id_aspek_n2;
        $jml_nilai_n2 = $request->jml_nilai_n2;

        // param edit n2
        $id_rkap_aspek_n2 = $request->id_rkap_aspek_n2;
        $id_rkap_indikator_n2 = $request->id_rkap_indikator_n2;

        // data n3
        $id_indikator_n3 = $request->id_indikator_n3;
        $nilai_indikator_n3 = $request->nilai_indikator_n3;
        $id_aspek_n3 = $request->id_aspek_n3;
        $jml_nilai_n3 = $request->jml_nilai_n3;

        // param edit n3
        $id_rkap_aspek_n3 = $request->id_rkap_aspek_n3;
        $id_rkap_indikator_n3 = $request->id_rkap_indikator_n3;

        // data n4
        $id_indikator_n4 = $request->id_indikator_n4;
        $nilai_indikator_n4 = $request->nilai_indikator_n4;
        $id_aspek_n4 = $request->id_aspek_n4;
        $jml_nilai_n4 = $request->jml_nilai_n4;

        // param edit n4
        $id_rkap_aspek_n4 = $request->id_rkap_aspek_n4;
        $id_rkap_indikator_n4 = $request->id_rkap_indikator_n4;

        // jumlah na
        // =(I18*0,15+J18*0,1+K18*0,15+L18*0,35)/0,75
        $jumlah_n1 = $jml_nilai_n1 * 0.15;
        $jumlah_n2 = $jml_nilai_n2 * 0.1;
        $jumlah_n3 = $jml_nilai_n3 * 0.15;
        $jumlah_n4 = $jml_nilai_n4 * 0.35;
        $frmt_nmbr_n1 = number_format($jumlah_n1);
        $frmt_nmbr_n2 = number_format($jumlah_n2);
        $frmt_nmbr_n3 = number_format($jumlah_n3);
        $frmt_nmbr_n4 = number_format($jumlah_n4);
        $jumlah_na = ($frmt_nmbr_n1 + $frmt_nmbr_n2 + $frmt_nmbr_n3 + $frmt_nmbr_n4) / 0.75;
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

        // dd($konfert_na);
        
        DB::beginTransaction();
        try {

            // save rkap aspek
            // n1
            if ($id_rkap_aspek_n1 != null) {
                $rkap_aspek_n1 = RkapAspek::find($id_rkap_aspek_n1);
            } else {
                # code...
                $rkap_aspek_n1 = new RkapAspek();
                $rkap_aspek_n1->id_pn_aspek = $id_aspek_n1;
                $rkap_aspek_n1->id_penilaian = $id;
            }
            $rkap_aspek_n1->jumlah_nilai = $jml_nilai_n1;
            $rkap_aspek_n1->created_at = date('Y-m-d H:i:s');
            $rkap_aspek_n1->save(); 

            // n2
            if ($id_rkap_aspek_n2 != null) {
                $rkap_aspek_n2 = RkapAspek::find($id_rkap_aspek_n2);
            } else {
                # code...
                $rkap_aspek_n2 = new RkapAspek();
                $rkap_aspek_n2->id_pn_aspek = $id_aspek_n2;
                $rkap_aspek_n2->id_penilaian = $id;
            }
            $rkap_aspek_n2->jumlah_nilai = $jml_nilai_n2;
            $rkap_aspek_n2->created_at = date('Y-m-d H:i:s');
            $rkap_aspek_n2->save(); 

            // n3
            if ($id_rkap_aspek_n3 != null) {
                $rkap_aspek_n3 = RkapAspek::find($id_rkap_aspek_n3);
            } else {
                # code...
                $rkap_aspek_n3 = new RkapAspek();
                $rkap_aspek_n3->id_pn_aspek = $id_aspek_n3;
                $rkap_aspek_n3->id_penilaian = $id;
            }
            $rkap_aspek_n3->jumlah_nilai = $jml_nilai_n3;
            $rkap_aspek_n3->created_at = date('Y-m-d H:i:s');
            $rkap_aspek_n3->save(); 

            // n4
            if ($id_rkap_aspek_n4 != null) {
                $rkap_aspek_n4 = RkapAspek::find($id_rkap_aspek_n4);
            } else {
                # code...
                $rkap_aspek_n4 = new RkapAspek();
                $rkap_aspek_n4->id_pn_aspek = $id_aspek_n4;
                $rkap_aspek_n4->id_penilaian = $id;
            }
            $rkap_aspek_n4->jumlah_nilai = $jml_nilai_n4;
            $rkap_aspek_n4->created_at = date('Y-m-d H:i:s');
            $rkap_aspek_n4->save(); 

            // save rkap indikator
            // n1
            if ($id_rkap_indikator_n1 != null) {
                foreach ($nilai_indikator_n1 as $key_update_n1 => $value_update_n1) {
                    $rkap_indikator_n1 = RkapIndikator::where('id_pn_rkap_indikator', $id_rkap_indikator_n1[$key_update_n1]);
                    $rkap_indikator_n1->update([
                        'jumlah_nilai_rkap' => $value_update_n1,
                        'created_at' => date('Y-m-d H:i:s')
                    ]);
                }
            } else {
                foreach ($id_indikator_n1 as $key_n1 => $indikator_n1) {
                    $rkap_indikator_n1 = new RkapIndikator();
                    $rkap_indikator_n1->id_indikator_pn = $indikator_n1;
                    $rkap_indikator_n1->id_penilaian = $id;
                    $rkap_indikator_n1->jumlah_nilai_rkap = $nilai_indikator_n1[$key_n1];
                    $rkap_indikator_n1->created_at = date('Y-m-d H:i:s');
                    $rkap_indikator_n1->save();
                }
            }
            
            // n2
            if ($id_rkap_indikator_n2 != null) {
                foreach ($nilai_indikator_n2 as $key_update_n2 => $value_update_n2) {
                    $rkap_indikator_n2 = RkapIndikator::where('id_pn_rkap_indikator', $id_rkap_indikator_n2[$key_update_n2]);
                    $rkap_indikator_n2->update([
                        'jumlah_nilai_rkap' => $value_update_n2,
                        'created_at' => date('Y-m-d H:i:s')
                    ]);
                }
            }else{
                foreach ($id_indikator_n2 as $key_n2 => $indikator_n2) {
                    $rkap_indikator_n2 = new RkapIndikator();
                    $rkap_indikator_n2->id_indikator_pn = $indikator_n2;
                    $rkap_indikator_n2->id_penilaian = $id;
                    $rkap_indikator_n2->jumlah_nilai_rkap = $nilai_indikator_n2[$key_n2];
                    $rkap_indikator_n2->created_at = date('Y-m-d H:i:s');
                    $rkap_indikator_n2->save();
                }
            }

            // n3
            if ($id_rkap_indikator_n3 != null) {
                 foreach ($nilai_indikator_n3 as $key_update_n3 => $value_update_n3) {
                    $rkap_indikator_n3 = RkapIndikator::where('id_pn_rkap_indikator', $id_rkap_indikator_n3[$key_update_n3]);
                    $rkap_indikator_n3->update([
                        'jumlah_nilai_rkap' => $value_update_n3,
                        'created_at' => date('Y-m-d H:i:s')
                    ]);
                }
            } else {
                foreach ($id_indikator_n3 as $key_n3 => $indikator_n3) {
                    $rkap_indikator_n3 = new RkapIndikator();
                    $rkap_indikator_n3->id_indikator_pn = $indikator_n3;
                    $rkap_indikator_n3->id_penilaian = $id;
                    $rkap_indikator_n3->jumlah_nilai_rkap = $nilai_indikator_n3[$key_n3];
                    $rkap_indikator_n3->created_at = date('Y-m-d H:i:s');
                    $rkap_indikator_n3->save();
                }
            }
            

            // n4
            if ($id_rkap_indikator_n4 != null) {
                foreach ($nilai_indikator_n4 as $key_update_n4 => $value_update_n4) {
                    $rkap_indikator_n4 = RkapIndikator::where('id_pn_rkap_indikator', $id_rkap_indikator_n4[$key_update_n4]);
                    $rkap_indikator_n4->update([
                        'jumlah_nilai_rkap' => $value_update_n4,
                        'created_at' => date('Y-m-d H:i:s')
                    ]);
                }
            } else {
                foreach ($id_indikator_n4 as $key_n4 => $indikator_n4) {
                    $rkap_indikator_n4 = new RkapIndikator();
                    $rkap_indikator_n4->id_indikator_pn = $indikator_n4;
                    $rkap_indikator_n4->id_penilaian = $id;
                    $rkap_indikator_n4->jumlah_nilai_rkap = $nilai_indikator_n4[$key_n4];
                    $rkap_indikator_n4->created_at = date('Y-m-d H:i:s');
                    $rkap_indikator_n4->save();
                }
            }
            
            $na_penilain = Penilaian::find($id);
            $na_penilain->jumlah_na = $na;
            $na_penilain->huruf = $konfert_na;
            $na_penilain->update();

            if ($id_rkap_aspek_n1 != null && $id_rkap_aspek_n2 && $id_rkap_aspek_n3 != null && $id_rkap_aspek_n4 != null) {
                $missage = 'Penilaian Berhasil di Edit';
            } else {
                $missage = 'Penilaian Berhasil di Buat';
            }
            

            DB::commit();
            return redirect('data-penilaian')->with('toast_success', $missage);
            //code...
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect('data-penilaian')->with('toast_error', $missage);
            //throw $th;
        }
        
    }

    public function DetailNilaiP2($id)
    {
       $penilaian = Penilaian::where('id_penilaian', $id)->first();
        $prodi = User::MAP_PRODI;
        $pn_indikator = new PnIndikator();
        $list_indikator_n1 = $pn_indikator->where('id_aspek_pn', 4)->get();
        $list_indikator_n2 = $pn_indikator->where('id_aspek_pn', 5)->get();
        $list_indikator_n3 = $pn_indikator->where('id_aspek_pn', 6)->get();
        $list_indikator_n4 = $pn_indikator->where('id_aspek_pn', 7)->get();
        // $pn_aspek = RkapAspek::where('id_penilaian', $id);
        $rkap_aspek_n1 = RkapAspek::where('id_penilaian', $id)->where('id_pn_aspek', 4)->first();
        $rkap_aspek_n2 = RkapAspek::where('id_penilaian', $id)->where('id_pn_aspek', 5)->first();
        $rkap_aspek_n3 = RkapAspek::where('id_penilaian', $id)->where('id_pn_aspek', 6)->first();
        $rkap_aspek_n4 =RkapAspek::where('id_penilaian', $id)->where('id_pn_aspek', 7)->first();
        // dd($rkap_aspek_n3);
        return view(
            'penilaian/detail_penilaian_p2',
                compact(
                    'penilaian',
                    'prodi',
                    'list_indikator_n1',
                    'list_indikator_n2',
                    'list_indikator_n3',
                    'list_indikator_n4',
                    'rkap_aspek_n1',
                    'rkap_aspek_n2',
                    'rkap_aspek_n3',
                    'rkap_aspek_n4'
                )
        );
    }

    public function GetIndikatorKeaktifan()
    {
        $list_pn_indikator_n1 = PnIndikator::where('id_aspek_pn', 1)->get();
        $data = [
            'list_pn_indikator_n1' => $list_pn_indikator_n1
            
        ];
        return response()->json($data);
    }

    public function LaporanPenilaian()
    {
        $user = Auth::user()->get_kepala_sekolah;
        $data_sekolah = MitraSekolah::where('kode_sekolah', $user->kode_sekolah)->first();
        $list_mhs_plp_1 = ZonasiSekolah::where('kode_sekolah', $user->kode_sekolah)->WhereHas('JointoMhs', function($query){
            return $query->where('jenis_plp', 1);
        })->get();
        $list_mhs_plp_2 = ZonasiSekolah::where('kode_sekolah', $user->kode_sekolah)->WhereHas('JointoMhs', function($query){
            return $query->where('jenis_plp', 2);
        })->get();
        $list_prodi = User::MAP_PRODI;
        $list_fakultas = User::MAP_FAKULTAS;
        // dd($list_mhs_plp_1);
        return view(
            'kepala_sekolah/laporan_penilaian',
                compact(
                    'data_sekolah',
                    'list_mhs_plp_1',
                    'list_mhs_plp_2',
                    'list_prodi',
                    'list_fakultas'
                )
        );
    }

    public function PenilaianKepsek()
    {
        $user = Auth::user()->get_kepala_sekolah;
        $data_sekolah = MitraSekolah::where('kode_sekolah', $user->kode_sekolah)->first();
        // $list_mhs_plp_1 = ZonasiSekolah::where('kode_sekolah', $user->kode_sekolah)->WhereHas('JointoMhs', function($query){
        //     return $query->where('jenis_plp', 1);
        // })->get();
        $list_mhs_plp_2 = ZonasiSekolah::where('kode_sekolah', $user->kode_sekolah)->WhereHas('JointoMhs', function($query){
            return $query->where('jenis_plp', 2);
        })->get();
        $list_prodi = User::MAP_PRODI;
        $list_fakultas = User::MAP_FAKULTAS;
        // dd($list_mhs_plp_2);
        return view(
            'kepala_sekolah/penilaian_kepsek',
                compact(
                    'data_sekolah',
                    // 'list_mhs_plp_1',
                    'list_mhs_plp_2',
                    'list_prodi',
                    'list_fakultas'
                )
        );
    }

    public function SimpanNilaiKepsek(Request $request)
    {
        $id = $request->id;
        $npm = $request->npm;
        $na = $request->nilai;

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

        if ($id != null) {
            $nilai = Penilaian::where('npm', $npm)->update([
                'nilai_kepsek' => $na,
                'grade_kepsek' => $konfert_na,
            ]);
            if ($nilai == true) {
                $missage = "Nilai Berhasil Diubah";
                return redirect('penilaian-kepsek')->with('toast_success', $missage);
            }else {
                $missage = "Nilai Gagal Diubah";
                return redirect('penilaian-kepsek')->with('toast_error', $missage);
            }
        } else {
            $nilai = Penilaian::where('npm', $npm)->update([
                'nilai_kepsek' => $na,
                'grade_kepsek' => $konfert_na,
            ]);
            if ($nilai == true) {
                $missage = "Nilai Berhasil Disimpan";
                return redirect('penilaian-kepsek')->with('toast_success', $missage);
            }else {
                $missage = "Nilai Gagal Disimpan";
                return redirect('penilaian-kepsek')->with('toast_error', $missage);
            }
        }
        
    }

    //Indikaor Penilaian Sekolah
    public function IndikatorPenilaianSekolah()
    {

        $indikator = new PnIndikator();

        // plp 1
        $list_inidkator_n1_p1 = $indikator->where('id_aspek_pn', 1)->get();
        $list_inidkator_n2_p1 = $indikator->where('id_aspek_pn', 2)->get();
        $list_inidkator_n3_p1 = $indikator->where('id_aspek_pn', 3)->get();
        

        // plp 2
        $list_inidkator_n1_p2 = $indikator->where('id_aspek_pn', 4)->get();
        $list_inidkator_n2_p2 = $indikator->where('id_aspek_pn', 5)->get();
        $list_inidkator_n3_p2 = $indikator->where('id_aspek_pn', 6)->get();
        $list_inidkator_n4_p2 = $indikator->where('id_aspek_pn', 7)->get();

        $list_data = [
            'list_inidkator_n1_p1' => $list_inidkator_n1_p1,
            'list_inidkator_n2_p1' => $list_inidkator_n2_p1,
            'list_inidkator_n3_p1' => $list_inidkator_n3_p1,
            'list_inidkator_n1_p2' => $list_inidkator_n1_p2,
            'list_inidkator_n2_p2' => $list_inidkator_n2_p2,
            'list_inidkator_n3_p2' => $list_inidkator_n3_p2,
            'list_inidkator_n4_p2' => $list_inidkator_n4_p2
        ];

        return view(
            'indikator_penilaian/sekolah/sekolah',
                $list_data
        );
    }

    public function SimpanIndikatorSekolahP1(Request $request)
    {
        // dd($request->all());
        $id_indikator = $request->id_indikator;
        if ($id_indikator == null) {
            $indikator_n1 = new PnIndikator();
            $indikator_n1->id_aspek_pn = $request->aspek;
            $indikator_n1->nama_indikator = $request->indikator;
            $indikator_n1->nilai_indikator = $request->grade_nilai;
            $indikator_n1->jumlah_nilai = $request->nilai;
            $indikator_n1->created_at = date('Y-m-d H:i:s');
            $indikator_n1->save();
            return redirect('indikator-sekolah')->with('toast_success', 'Data Berhasil Ditambah');
        } else {
            // dd($request->all());
            $indikator_n1 = PnIndikator::find($id_indikator);
            $indikator_n1->nama_indikator = $request->indikator;
            $indikator_n1->nilai_indikator = $request->grade_nilai;
            $indikator_n1->jumlah_nilai = $request->nilai;
            $indikator_n1->updted_at = date('Y-m-d H:i:s');
            $indikator_n1->save();
            return redirect('indikator-sekolah')->with('toast_success', 'Data Berhasil Diubah');
        }
        
    }

    public function HapusIndikatorSekolahP1(Request $request)
    {
        $id = $request->id_indikator;
        PnIndikator::find($id)->delete();
        return redirect('indikator-sekolah')->with('toast_success', 'Data Berhasil Dihapus');
    }

    public function GetIndikaatorAjax(Request $request)
    {
        $id = $request->id;
        $data = PnIndikator::where('id_indikator_pn', $id)->first();
        return response()->json($data);
    }


    public function IndikatorPenilaianDpl()
    {
        $indikator = new PnIdikatorDpl();

        // plp 1
        $list_inidkator_n1 = $indikator->where('id_aspek_dpl', 1)->get();
        $list_inidkator_n2 = $indikator->where('id_aspek_dpl', 2)->get();
        $list_data = [
            'list_inidkator_n1' => $list_inidkator_n1,
            'list_inidkator_n2' => $list_inidkator_n2,
        ];

        return view(
            'indikator_penilaian/dpl/dpl',
            $list_data
        );
    }

    public function SimpanIndikatorDpl(Request $request)
    {
        // dd($request->all());
        $id_indikator = $request->id_indikator_dpl;
        if ($id_indikator == null) {
            $indikator_dpl = new PnIdikatorDpl();
            $indikator_dpl->id_aspek_dpl = $request->aspek_dpl;
            $indikator_dpl->nama_indikator_dpl = $request->indikator_dpl;
            $indikator_dpl->jumlah_nilai = $request->nilai_dpl;
            $indikator_dpl->created_at = date('Y-m-d H:i:s');
            $indikator_dpl->save();
            return redirect('indikator-dpl')->with('toast_success', 'Data Berhasil Ditambah');
        } else {
            $indikator_dpl = PnIdikatorDpl::find($id_indikator);
            $indikator_dpl->nama_indikator_dpl = $request->indikator_dpl;
            $indikator_dpl->jumlah_nilai = $request->nilai_dpl;
            $indikator_dpl->updated_at = date('Y-m-d H:i:s');
            $indikator_dpl->save();
            return redirect('indikator-dpl')->with('toast_success', 'Data Berhasil Diubah');
        }
        
    }

    public function HapusIndikatorDpl(Request $request)
    {
        $id = $request->id_hapus_indikator;
        PnIdikatorDpl::find($id)->delete();
        return redirect('indikator-dpl')->with('toast_success', 'Data Berhasil Dihapus');
    }

    public function GetIndikaatorAjaxDpl(Request $request)
    {
        $id = $request->id;
        $data = PnIdikatorDpl::where('id_indikator_dpl', $id)->first();
        return response()->json($data);
    }
}
