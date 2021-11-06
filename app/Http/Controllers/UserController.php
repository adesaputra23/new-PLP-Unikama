<?php

namespace App\Http\Controllers;

use App\Dpl;
use App\GuruPamong;
use App\KepalaSekolah;
use App\MitraSekolah;
use Illuminate\Http\Request;
use App\User;
use App\UserRole;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function ShowLogin()
    {
        // return view('template/login_template');
        return view('login');
    }

    public function UserRole()
    {
        $list_role = [
            1 => 'ADMIN',
            2 => 'DPL',
            3 => 'KEPALA SEKOLAH',
            4 => 'GURU PAMONG',
        ];
        $list_user = User::with('user_role','get_pegawai','get_dpl','get_kepala_sekolah','get_guru_pamong')
            ->get();
        return view('user_role', compact('list_user','list_role'));
    }

    public function AddUser()
    {
        $list_role = UserRole::MAP_ROLE;
        return view('form_add_user',['list_role' => $list_role]);
    }
    

    public function ProsesAddUser(Request $request)
    {
        dd($request->all());
    }

    public function Prodi()
    {
        $list_prodi = User::MAP_PRODI;
        $list_fakultas = User::MAP_FAKULTAS;
        $data = [
            'prodi' => $list_prodi,
            'fakultas' => $list_fakultas,
        ];
        return response()->json($data);
    }

    public function Kepsek()
    {
        $list_kepsek = KepalaSekolah::get();
        return response()->json($list_kepsek);
    }

    public function HapusUser(Request $request)
    {
        // dd($request->all());

        $nik_dpl = $request->nik_dpl;
        if ($nik_dpl != null) {
            $user = User::where('nik', $nik_dpl);
            $dpl = Dpl::where('nik', $nik_dpl);
            $role = UserRole::where('nik', $nik_dpl);
            if ($user->delete() && $dpl->delete() && $role->delete()) {
                return redirect('user-role')->with('toast_success', 'Berhasil hapus user');
            } else {
                return redirect('user-role')->with('toast_error', 'Gagal hapus user');
            }
        }

        $nik_gp = $request->nik_gp;
        if ($nik_gp != null) {
            $gp = GuruPamong::where('nik', $nik_gp);
            $user = User::where('nik', $nik_gp);
            $role = UserRole::where('nik', $nik_gp);
            if ($user->delete() && $gp->delete() && $role->delete()) {
                return redirect('user-role')->with('toast_success', 'Berhasil hapus user');
            } else {
                return redirect('user-role')->with('toast_error', 'Gagal hapus user');
            }
        }

        $nik_kepsek = $request->nik_kepsek;
        if ($nik_kepsek != null) {
            $user = User::where('nik', $nik_kepsek);
            $kepsek = KepalaSekolah::where('nik', $nik_kepsek);
            $kode_sekolah = KepalaSekolah::where('nik', $nik_kepsek)->first();
            $sekolah = MitraSekolah::where('kode_sekolah', $kode_sekolah->kode_sekolah);
            $role = UserRole::where('nik', $nik_gp);
            if ($user->delete() && $kepsek->delete() && $sekolah->delete() && $role->delete()) {
                return redirect('user-role')->with('toast_success', 'Berhasil hapus user');
            } else {
                return redirect('user-role')->with('toast_error', 'Gagal hapus user');
            }
        }


        
    }
}
