<?php

namespace App\Imports;

use App\Mahasiswa;
use Carbon\Carbon;
use DateInterval;
use DateTimeZone;
use Maatwebsite\Excel\Concerns\ToModel;

class MahasiswaImport implements ToModel
{
    public function model(array $row)
    {
        if ($row[0] == "NPM" || !isset($row[0])) {
            return null;
        }

        if ($row[1] == "NAMA MAHASISWA" || !isset($row[1])) {
            return null;
        }

        if ($row[2] == "JENIS PLP" || !isset($row[2])) {
            return null;
        }

        if ($row[3] == "PROGRAM STUDI" || !isset($row[3])) {
            return null;
        }

        if ($row[4] == "FAKULTAS" || !isset($row[4])) {
            return null;
        }

        if ($row[5] == "KELAS" || !isset($row[5])) {
            return null;
        }

        if ($row[6] == "ANGKATAN" || !isset($row[6])) {
            return null;
        }

        if ($row[7] == "IPK" || !isset($row[7])) {
            return null;
        }

        if ($row[8] == "JENIS KELAMIN" || !isset($row[8])) {
            return null;
        }

        if ($row[9] == "ALAMAT" || !isset($row[9])) {
            return null;
        }

        if ($row[10] == "NO HP" || !isset($row[10])) {
            return null;
        }

        if ($row[11] == "AGAMA" || !isset($row[11])) {
            return null;
        }

        if ($row[12] == "TANGGAL PENDAFTARAN" || !isset($row[12])) {
            return null;
        }

        if ($row[13] == "TANGGAL PEMBAYARAN" || !isset($row[13])) {
            return null;
        }

        if ($row[14] == "TANGGAL VERIFIKASI" || !isset($row[14])) {
            return null;
        }

        $npm = (string)$row[0];
        $nama_mhs = (string)$row[1];
        $jenis_plp = (string)$row[2];
        $program_studi = (string)$row[3];
        $fakultas = (string)$row[4];
        $kelas = (string)$row[5];
        $angkatan = (string)$row[6];
        $ipk = (float)$row[7];
        $jenis_kelamin = (string)$row[8];
        $alamat = (string)$row[9];
        $no_hp = (string)$row[10];
        $agama = (string)$row[11];
        $tgl_daftar = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[12])->format('Y-m-d H:i:s');
        $tgl_bayar = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[13])->format('Y-m-d H:i:s');
        $tgl_verif = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[14])->format('Y-m-d H:i:s');
        $mhs = Mahasiswa::where('npm', $npm)->count();
        if($mhs < 1){
            return new Mahasiswa([
                'npm' => $npm,
                'nama_mhs' => $nama_mhs,
                'jenis_plp' => $jenis_plp,
                'program_studi' => $program_studi,
                'fakultas' => $fakultas,
                'kelas' => $kelas,
                'angkatan' => $angkatan,
                'ipk' => $ipk,
                'jenis_kelamin' => $jenis_kelamin,
                'alamat' => $alamat,
                'no_hp' => $no_hp,
                'agama' => $agama,
                'tgl_pendaftaran' => $tgl_daftar,
                'tgl_pembayaran' => $tgl_bayar,
                'tgl_verifikasi' => $tgl_verif,
                'create_at' => date('Y-m-d H:i:s'),
            ]);
        }
        else{
            Mahasiswa::where('npm', $npm)
                ->update([
                    'npm' => $npm,
                    'nama_mhs' => $nama_mhs,
                    'jenis_plp' => $jenis_plp,
                    'program_studi' => $program_studi,
                    'fakultas' => $fakultas,
                    'kelas' => $kelas,
                    'angkatan' => $angkatan,
                    'ipk' => $ipk,
                    'jenis_kelamin' => $jenis_kelamin,
                    'alamat' => $alamat,
                    'no_hp' => $no_hp,
                    'agama' => $agama,
                    'tgl_pendaftaran' => $tgl_daftar,
                    'tgl_pembayaran' => $tgl_bayar,
                    'tgl_verifikasi' => $tgl_verif,
                    'create_at' => date('Y-m-d H:i:s'),
                ]);
            return null;
        }
        
    }
}
