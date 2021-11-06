<?php

namespace App\Http\Controllers;

use App\MitraSekolah;
use Alert;
use App\Dpl;
use App\GuruPamong;
use App\KepalaSekolah;
use App\Mahasiswa;
use App\User;
use App\UserRole;
use App\ZonasiSekolah;
use Auth;
use Carbon\Carbon;
// use Dotenv\Validator;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
// use PhpOffice\PhpSpreadsheet\Writer\Pdf;
use PDF;

class SekolahController extends Controller
{
    public function DataSekolah()
    {
        $no = 1;
        $list_mitra = MitraSekolah::get();
        return view(
            'data_sekolah',
            compact(
                'no',
                'list_mitra',
            )
        );
    }

    public function FormTambahDataSekolah()
    {
        return view('tambah_data_sekolah');
    }

    public function ProsesSimpanSekolah(Request $request)
    {
        DB::beginTransaction();
        try {

            $missage = [
                'nik.unique' => 'NIK/NIDN sudah digunakan',
                'kode_sekolah.unique' => 'Kode Sekolah sudah digunakan',
            ];
            $validator = Validator::make($request->all(), [
                'nik' => 'unique:kepala_sekolah',
                'kode_sekolah' => 'unique:mitra_sekolah',
            ],$missage);
            
            if ($validator->fails()) {
                return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
            }

            $sekolah = new MitraSekolah();
            $sekolah->kode_sekolah = $request->kode_sekolah;
            $sekolah->nama_sekolah = $request->nama_sekolah;
            $sekolah->alamat_sekolah = $request->alamat_sekolah;
            if ($request->plp_1 != null) {
                $sekolah->status_plp_1 = 1;
                $sekolah->kuota_plp_1 = $request->kuota_plp_1;
                $sekolah->jml_mhs_plp_1 = 0;
            }else{
                $sekolah->status_plp_1 = null;
                $sekolah->kuota_plp_1 = null;
                $sekolah->jml_mhs_plp_1 = null;
            }

            if ($request->plp_2 != null) {
                $sekolah->status_plp_2 = 1;
                $sekolah->kuota_plp_2 = $request->kuota_plp_2;
                $sekolah->jml_mhs_plp_2 = 0;
            }else{
                $sekolah->status_plp_2 = null;
                $sekolah->kuota_plp_2 = null;
                $sekolah->jml_mhs_plp_2 = null;
            }
            $sekolah->status_kepsek = 1;
            $sekolah->save();

            $kepala_sekolah = new KepalaSekolah();
            $kepala_sekolah->nik = $request->nik;
            $kepala_sekolah->nama_kepsek = $request->nama_kepsek;
            $kepala_sekolah->jenis_kelamin = $request->jenis_kelamin;
            $kepala_sekolah->alamat_kepsek = $request->alamat_kepsek;
            $kepala_sekolah->no_telpon_kepsek = $request->no_hp;
            $kepala_sekolah->kode_sekolah = $request->kode_sekolah;
            $kepala_sekolah->save();

            $user = new User();
            $user->nik = $request->nik;
            $user->password = Hash::make($request->nik);
            $user->created_at = date('Y-m-d H:i:s');
            $user->updated_at = date('Y-m-d H:i:s');
            $user->save();

            $role = new UserRole();
            $role->nik = $request->nik;
            $role->role = 3;
            $role->save();

            DB::commit();
            return redirect('data-sekolah')->with('toast_success', 'Data berhasil disimpan');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect('data-sekolah')->with('toast_error', 'Data gagal disimpan');
        }
    }

    public function FormEditDataSekolah($id_sekolah)
    {
        $get_data_sekolah = MitraSekolah::where('id_sekolah', $id_sekolah)->first();
        return view(
            'edit_data_sekolah',
                compact(
                    'get_data_sekolah',
                )
        );
    }

    public function ProsesEditSekolah(Request $request, $id_sekolah)
    {
        // dd($request->all());
        DB::beginTransaction();
        try {
            $sekolah = MitraSekolah::find($id_sekolah);
            $sekolah->kode_sekolah = $request->kode_sekolah;
            $sekolah->nama_sekolah = $request->nama_sekolah;
            $sekolah->alamat_sekolah = $request->alamat_sekolah;
            if ($request->plp_1 != null) {
                $sekolah->status_plp_1 = 1;
                $sekolah->kuota_plp_1 = $request->kuota_plp_1;
                $sekolah->jml_mhs_plp_1 = 0;
            }else{
                $sekolah->status_plp_1 = null;
                $sekolah->kuota_plp_1 = null;
                $sekolah->jml_mhs_plp_1 = null;
            }

            if ($request->plp_2 != null) {
                $sekolah->status_plp_2 = 1;
                $sekolah->kuota_plp_2 = $request->kuota_plp_2;
                $sekolah->jml_mhs_plp_2 = 0;
            }else{
                $sekolah->status_plp_2 = null;
                $sekolah->kuota_plp_2 = null;
                $sekolah->jml_mhs_plp_2 = null;
            }
            $sekolah->status_kepsek = 1;
            $sekolah->update();

            $get_id_kepsek = KepalaSekolah::where('kode_sekolah', $request->kode_sekolah)->first();
            $id_kepsek = $get_id_kepsek->id_kepsek;
            $kepala_sekolah = KepalaSekolah::find($id_kepsek);
            $kepala_sekolah->nik = $request->nik;
            $kepala_sekolah->nama_kepsek = $request->nama_kepsek;
            $kepala_sekolah->jenis_kelamin = $request->jenis_kelamin;
            $kepala_sekolah->alamat_kepsek = $request->alamat_kepsek;
            $kepala_sekolah->no_telpon_kepsek = $request->no_hp;
            $kepala_sekolah->kode_sekolah = $request->kode_sekolah;
            $kepala_sekolah->update();

            DB::commit();
            return redirect('data-sekolah')->with('toast_success', 'Data berhasil diedit');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect('data-sekolah')->with('toast_error', 'Data gagal diedit');
        }
    }

    public function HapusSekolah(Request $request)
    {
        $get_kode_sekolah = MitraSekolah::where('kode_sekolah', $request->kode_sekolah)->first();
        $kode_sekolah = $get_kode_sekolah->kode_sekolah;
        MitraSekolah::where('kode_sekolah', $kode_sekolah)->delete();
        return redirect('data-sekolah')->with('toast_success', 'Data berhasil dihapus');
    }

    // end admin

    // kepala sekolah

    public function DataGuruPamong()
    {
        $id_kepsek = FacadesAuth::user()->get_kepala_sekolah->id_kepsek;
        $list_guru_pamong = GuruPamong::where('id_kepsek', $id_kepsek)->get();
        $no = 1;
        return view(
            'data_guru_pamong',
                compact(
                    'no',
                    'list_guru_pamong',
                )
        );
    }

    public function FormAddGuruPamong()
    {
        return view('tambah_data_guru_pamong');
    }

    public function ProsesSimpanGuruPamong(Request $request)
    {
        DB::beginTransaction();
        try {
            if (!empty($request->id_gp)) {
                $id_kepsek = FacadesAuth::user()->get_kepala_sekolah->id_kepsek;
                $id = $request->id_gp;
                $gp = GuruPamong::find($id);
                $succes = "Data berhasi di ubah";
                $error = "Data gagal di ubah";
            } else {
                $missage = [
                    'nik.unique' => 'NIK sudah digunakan',
                ];
                $validator = Validator::make($request->all(), [
                    'nik' => 'unique:guru_pamong',
                ],$missage);
                
                if ($validator->fails()) {
                    return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
                }
        
                $id_kepsek = FacadesAuth::user()->get_kepala_sekolah->id_kepsek;
                $gp = new GuruPamong();
                $succes = "Data berhasi di simpan";
                $error = "Data gagal di simpan";

                $user = new User();
                $user->nik = $request->nik;
                $user->password = Hash::make($request->nik);
                $user->created_at = date('Y-m-d H:i:s');
                $user->updated_at = date('Y-m-d H:i:s');
                $user->save();

                $role = new UserRole();
                $role->nik = $request->nik;
                $role->role = 4;
                $role->save();
            }

                $gp->nik                    = $request->nik;
                $gp->nama_guru_pamong       = $request->nama_guru_pamong;
                $gp->jenis_kelamin          = $request->jenis_kelamin;
                $gp->alamat_guru_pamong     = $request->alamat;
                $gp->no_telpon_guru_pamong  = $request->no_hp;
                $gp->id_kepsek              = $id_kepsek;
                $gp->status_user            = $request->status_user;
                $gp->save();

            DB::commit();
            return redirect('data-guru-pamong')->with('toast_success', $succes);
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return redirect('data-guru-pamong')->with('toast_error', $error);
        }

        
    }


    public function FormEditGuruPamong($id)
    {
        $get_id_gp = GuruPamong::find($id);
        return view('form_edit_guru_pamong',
            compact(
                'get_id_gp'
                )
        );
    }

    public function HapusGuruPamong(Request $request)
    {
        $gp = GuruPamong::where('id_guru_pamong', $request->id_gp);
        if ($gp->delete()) {
            return redirect('data-guru-pamong')->with('toast_success', 'Data berhaasil di hapus');
        }else{
            return redirect('data-guru-pamong')->with('toast_error', 'Data gagal di hapus');
        }
        # code...
    }

    // end kepala sekolah


    public function MitraSekolah()
    {
        $list_sekolah = MitraSekolah::where('status_kepsek', null)->get();
        return response()->json($list_sekolah);
    }

    public function Zonasi()
    {
        return view('zonasi');
    }

    public function Pengumuman()
    {
        return view('pengumuman');
    }

    public function PengumumanCari(Request $request)
    {
        $data = $request->all();
        $get_mhs_zonasi = ZonasiSekolah::where('npm', $request->npm)->first();
        $get_mhs = Mahasiswa::where('npm', $get_mhs_zonasi->npm)->where('jenis_plp', $request->jenis_plp)->first();
        $get_guru_pamong = GuruPamong::where('id_guru_pamong', $get_mhs_zonasi->id_guru_pamong)->first();
        $get_dpl = Dpl::where('id_dpl',$get_mhs_zonasi->id_dpl )->first();
        $get_sekolah = MitraSekolah::where('kode_sekolah',$get_mhs_zonasi->kode_sekolah )->first();
        $get_kepsek = KepalaSekolah::where('kode_sekolah',$get_mhs_zonasi->kode_sekolah )->first();
        $list_prodi = User::MAP_PRODI;
        $list_fakultas = User::MAP_FAKULTAS;

        if ($get_mhs == null) {
            $get_mhs_zonasi = null;
            $get_guru_pamong = null;
            $get_dpl = null;
            $list_prodi = null;
            $list_fakultas = null;
            $get_sekolah = null;
            $get_kepsek = null;
        }
        
        $data = [
            'get_mhs_zonasi' => $get_mhs_zonasi,
            'get_mhs' => $get_mhs,
            'get_guru_pamong' => $get_guru_pamong,
            'get_dpl' => $get_dpl,
            'list_prodi' => $list_prodi,
            'list_fakultas' => $list_fakultas,
            'get_sekolah' => $get_sekolah,
            'get_kepsek' => $get_kepsek,
        ];
        return response()->json($data);
    }

    public function Jenis_plp(Request $request)
    {
        // $data = $request->all();
        $jenis_plp = $request->jenis_plp;
        $get_plp = MitraSekolah::where('status_kepsek', 1);
        if ($jenis_plp == 1) {
            $list_plp = $get_plp->where('status_plp_1', 1)
                            ->whereRaw('kuota_plp_1 <> jml_mhs_plp_1')
                            ->orderBy('id_sekolah')
                            ->get();
        }else{
            $list_plp = $get_plp->where('status_plp_2', 1)
                            ->whereRaw('kuota_plp_2 <> jml_mhs_plp_2')
                            ->orderBy('id_sekolah')
                            ->get();
        }
        return response()->json($list_plp);
    }

    public function ProsesAddZonasi(Request $request)
    {
        $missage = [
            'npm.unique' => 'NPM sudah digunakan',
        ];
        $validator = Validator::make($request->all(), [
            'npm' => 'unique:zonasi_sekolah',
        ],$missage);
        
        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
        }

        $get_mhs = Mahasiswa::where('npm', $request->npm)
            ->where('jenis_plp', $request->jenis_plp)
            ->first();

        if (empty($get_mhs)) {
            return redirect('zonasi-sekolah')->with('toast_error', 'Data tidak ditemukan');
        }

        $aray_data = [
            'npm' => $request->npm,
            'kode_sekolah' => $request->kode_sekolah,
            'created_at' => date('Y-m-d H:i:s'),
        ];
        $insert_data = ZonasiSekolah::insert($aray_data);
        if ($insert_data == true) {
            $jenis_plp = '';
            if ($request->jenis_plp === 1) {
                $jenis_plp = 'jml_mhs_plp_1';
            } else {
                $jenis_plp = 'jml_mhs_plp_2';
            }
            $get_mitra_sekolah = MitraSekolah::where('kode_sekolah', $request->kode_sekolah)->first();
            $sum_jumlah_plp = [
                $jenis_plp => $get_mitra_sekolah->$jenis_plp + 1,
            ];
            MitraSekolah::where('kode_sekolah', $request->kode_sekolah)->update($sum_jumlah_plp);
            return redirect('zonasi-sekolah')->with('toast_success', 'Data berhasil disimpan');
        }
    }

    public function PengumumanPdf($id)
    {
        $get_zonasi = ZonasiSekolah::where('id_zonasi', $id)->first();
        $npm = $get_zonasi->npm;
        $get_mhs = Mahasiswa::where('npm', $npm)->first();
        $list_prodi = User::MAP_PRODI;
        $list_fakultas = User::MAP_FAKULTAS;
        $get_sekolah = MitraSekolah::where('kode_sekolah',$get_zonasi->kode_sekolah )->first();
        $get_kepsek = KepalaSekolah::where('kode_sekolah',$get_zonasi->kode_sekolah )->first();
        $get_guru_pamong = GuruPamong::where('id_guru_pamong', $get_zonasi->id_guru_pamong)->first();
        $get_dpl = Dpl::where('id_dpl',$get_zonasi->id_dpl )->first();
        // dd($get_kepsek);
        $data = [
            'get_zonasi' => $get_zonasi,
            'get_mhs' => $get_mhs,
            'list_prodi' => $list_prodi,
            'list_fakultas' => $list_fakultas,
            'get_sekolah' => $get_sekolah,
            'get_kepsek' => $get_kepsek,
            'get_guru_pamong' => $get_guru_pamong,
            'get_dpl' => $get_dpl,

        ];
        $pdf = PDF::loadView('pdf/pengumuman_pdf', $data)
               ->setPaper('f4', 'potrait');
        $pdf->setOptions(
            [
                'dpi' => 150,
                'defaultFont' => 'arial',
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled' => true
            ]
        );
        return $pdf->stream('ZONAZI_' . Carbon::now() . '_' . $npm . '.pdf');
    }
}
