<?php

namespace App\Http\Controllers;

use App\Exports\MahasiswaExport;
use App\Imports\MahasiswaImport;
use App\Mahasiswa;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class MahasiswaController extends Controller
{
    public function DataMhs()
    {
        $list_mhs_plp_1 = Mahasiswa::where('jenis_plp', 1)->orderBy('create_at', 'desc')->get();
        $list_mhs_plp_2 = Mahasiswa::where('jenis_plp', 2)->orderBy('create_at', 'desc')->get();
        $list_prodi = User::MAP_PRODI;
        $list_fakultas = User::MAP_FAKULTAS;
        $list_kelas = [
            1 => 'Reguler',
            2 => 'Karyawan',
        ];
        return view(
            'data_mhs', 
                compact(
                    'list_mhs_plp_1', 
                    'list_mhs_plp_2',
                    'list_prodi',
                    'list_fakultas',
                    'list_kelas'
                )
            );
    }

    public function FormTambahDataMhs()
    {
        $list_prodi = User::MAP_PRODI;
        $list_fakultas = User::MAP_FAKULTAS;
        return view('tambah_data_mhs', compact('list_prodi', 'list_fakultas'));
    }

    public function ProsesTambahMhs(Request $request)
    {
        $missage = [
            'npm.unique' => 'NPM Sudah Digunakan',
        ];
        $validator = Validator::make($request->all(), [
            'npm' => 'unique:mahasiswa',
        ],$missage);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
        }

        $array_data = [
            'npm' => $request->npm,
            'nama_mhs' => $request->nama,
            'jenis_plp' => $request->jenis_plp,
            'program_studi' => $request->prodi,
            'fakultas' => $request->fakultas,
            'angkatan' => $request->angkatan,
            'ipk' => $request->ipk,
            'kelas' => $request->kelas,
            'agama' => $request->agama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'create_at' => date('Y-m-d H:i:s'),
        ];
        Mahasiswa::create($array_data);
        return redirect('data-mhs')->with('toast_success', 'Data Berhasil Disimpan');
    }

    public function FormEditDataMhs($npm)
    {   
        $list_prodi = User::MAP_PRODI;
        $list_fakultas = User::MAP_FAKULTAS;
        $get_mhs = Mahasiswa::where('npm', $npm)->first();
        return view('edit_data_mhs', 
            compact(
                'list_prodi',
                'list_fakultas',
                'get_mhs',
            )
        );
    }

    public function ProsesEditMhs(Request $request)
    {
        $array_data = [
            'nama_mhs' => $request->nama,
            'jenis_plp' => $request->jenis_plp,
            'program_studi' => $request->prodi,
            'fakultas' => $request->fakultas,
            'angkatan' => $request->angkatan,
            'ipk' => $request->ipk,
            'kelas' => $request->kelas,
            'agama' => $request->agama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'create_at' => date('Y-m-d H:i:s'),
        ];
        Mahasiswa::where('npm', $request->npm)->update($array_data);
        return redirect('data-mhs')->with('toast_success', 'Data Berhasil Diedit');
    }

    public function ProsesHapusMhs(Request $request)
    {
        Mahasiswa::where('npm', $request->npm)->delete();
        return redirect('data-mhs')->with('toast_success', 'Data Berhasil Dihapus');
    }

    public function FormDetailDataMhs(Request $request, $npm)
    {
        $list_plp = [
            1 => 'PLP I',
            2 => 'PLP II',
        ];
        $list_kelas = [
            1 => 'Reguler',
            2 => 'Karyawan',
        ];
        $list_jenis_kelamin = [
            1 => 'Laki-Laki',
            2 => 'Perempuan'
        ];
        $get_mhs = Mahasiswa::where('npm', $npm)->first();
        $list_prodi = User::MAP_PRODI;
        $list_fakultas = User::MAP_FAKULTAS;
        return view('detail_data_mhs', 
            compact(
                'get_mhs',
                'list_prodi',
                'list_fakultas',
                'list_plp',
                'list_kelas',
                'list_jenis_kelamin',
            )
        );
    }

    public function ProsesPendaftaranMhs(Request $request)
    {
        if ($request->tgl_pendaftran == null) {
            $array_data = [
                'tgl_pendaftaran' => null,
                'create_at'       => date('Y-m-d H:i:s'),
            ];
        }else{
            $array_data = [
                'tgl_pendaftaran' => $request->tgl_pendaftran.' '.date('H:i:s'),
                'create_at'       => date('Y-m-d H:i:s'),
            ];
        }
        Mahasiswa::where('npm', $request->npm)->update($array_data);
        return redirect('form-detail-data-mhs/'.$request->npm)->with('toast_success', 'Status Pendaftaran Berhasil Disimpan');
    }

    public function ProsesPembayaranMhs(Request $request)
    {
        $missage = [
            'bukti_bayar.mimes' => 'File bukan jpeg,png,jpg',
            'bukti_bayar.max' => 'File lebih dari 2MB',
        ];
        $validator = Validator::make($request->all(), [
            'bukti_bayar' => 'mimes:jpeg,png,jpg|max:2048',
        ], $missage);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
        }

        if ($request->tgl_pembayaran == null) {
            $array_data = [
                'file_pembayaran' => null,
                'tgl_pembayaran'  => null,
                'create_at'       => date('Y-m-d H:i:s'),
            ];
        }else{
            $file = $request->file('bukti_bayar');
            $extension = $file->getClientOriginalExtension();
            $name = $request->npm.'-'.$request->nama.'.'.$extension;
            $tujuan_upload = 'file_bukti_pembayaran';
            $file->move($tujuan_upload,$name);
            $array_data = [
                'file_pembayaran' => $name,
                'tgl_pembayaran'  => $request->tgl_pembayaran.' '.date('H:i:s'),
                'create_at'       => date('Y-m-d H:i:s'),
            ];
        }
        Mahasiswa::where('npm', $request->npm)->update($array_data);
        return redirect('form-detail-data-mhs/'.$request->npm)->with('toast_success', 'Status Pembayaran Berhasil Disimpan');
    }

    public function ProsesVerifikasiMhs(Request $request)
    {
        if ($request->tgl_verif == null) {
            $array_data = [
                'tgl_verifikasi' => null,
                'create_at'      => date('Y-m-d H:i:s'),
            ];
        } else {
            $array_data = [
                'tgl_verifikasi' => $request->tgl_verif.' '.date('H:i:s'),
                'create_at'      => date('Y-m-d H:i:s'),
            ];
        }
        
        Mahasiswa::where('npm', $request->npm)->update($array_data);
        return redirect('form-detail-data-mhs/'.$request->npm)->with('toast_success', 'Status Verifikasi Berhasil Disimpan');
    }

    public function ImportMhs(Request $request) 
	{
        $missage = [
            'file_import.mimes' => 'File yang anda import bukan type xlsx',
        ];
        $validator = Validator::make($request->all(), [
            'file_import' => 'mimes:xlsx',
        ],$missage);
        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all()[0])->withInput();
        }
		Excel::import(new MahasiswaImport, request()->file('file_import'));       
        return redirect('data-mhs')->with('toast_success', 'Data Berhasil di Import');

	}

    public function ExportMhs()
    {
        $list_plp = [
            1 => 'PLP I',
            2 => 'PLP II',
        ];
        $list_kelas = [
            1 => 'Reguler',
            2 => 'Karyawan',
        ];
        $list_jenis_kelamin = [
            1 => 'Laki-Laki',
            2 => 'Perempuan'
        ];
        $mhs = Mahasiswa::all();
        $list_prodi = User::MAP_PRODI;
        $list_fakultas = User::MAP_FAKULTAS;
        return Excel::download(
            new MahasiswaExport(
                $mhs,
                $list_prodi,
                $list_fakultas,
                $list_plp,
                $list_kelas,
                $list_jenis_kelamin,
            ),
            'export_data_mhs' . time() . '.xlsx'
        );
    }
}
