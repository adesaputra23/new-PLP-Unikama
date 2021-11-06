<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>PDF</title>
    <style>
        @page {
            margin: 180px 70px;
            counter-reset: number;
        }

        @page: right {
            @bottom-right {
                content: counter(page);
            }
        }

        @media screen {
            body {
                font-family: Arial, Helvetica, sans-serif;
                /* position: absolute; */
                margin-top: -25px;
                counter-reset: page;
            }

            .page-number:before {
                counter-increment: page;
                content: "Page "counter(page);
            }

            /* table {
                break-after: page !important;
                border: 1px solid grey;
                border-collapse: collapse;
            } */

            .templateTable {
                display: table;
            }
        }

        @media print {
            body {
                font-family: Arial, Helvetica, sans-serif;
                /* position: absolute; */
                margin-top: -25px;
                counter-reset: number;
            }

            .page-number:before {
                counter-increment: page;
                content: "Page "counter(page);
            }

            /* table {
                break-after: page !important;
                border: 1px solid grey;
                border-collapse: collapse;
            } */

            .templateTable {
                display: table;
            }
        }

        /* .page-number {

            counter-increment: number;
        }

        .page-number::before {
            content: "Page "counter(number) ".";
        }

        .page-break {
            page-break-after: always;
        } */

        #header {
            position: fixed;
            left: 0px;
            top: -150px;
            right: 0px;
            text-align: center;
            overflow: auto;
        }

        #header img {
            margin-left: -65px;
        }

        /* #header .judul {
            text-align: center;
            margin-top: -115px;
        } */

        #header h4 {
            margin-bottom: -35px;
        }

        footer {
            position: fixed;
            bottom: 65px;
            left: -80px;
            right: 0px;
            height: 50px;

            /** Extra personal styles **/
            /* background-color: #03a9f4;
            color: white;
            text-align: center;
            line-height: 35px; */
        }

        /* #header::after {
            display: block;
            content: '';
            border-bottom: 2px solid black;
        } */

        /* table,
        th,
        td {
            border: 2px solid black;
            border-collapse: collapse;
            vertical-align: top;
        }

        th {
            padding: 0px;
        }

        td {
            padding: 0px;
        } */

        #customers {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #customers td,
        #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #customers tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #customers tr:hover {
            background-color: #ddd;
        }

        #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #04AA6D;
            color: white;
        }

    </style>
</head>

<body>

    <div id="header">
        <img src="{{ asset('assets/img/Unikama.png') }}" height="150px" style="margin-right: 850px;margin-top: 20px"
            alt="">
        <div class="judul">
            <h4 style="margin-top: -140px;">
                LEMBAGA PENGEMBANGAN PEMBELAJARAN
            </h4>
            <h4>
                DAN PRAKTIK LAPANGAN (LP3L)
            </h4>
            <h3>
                UNIVERSITAS PGRI KANJURUHAN MALANG
            </h3>
            <p style="font-size: 0.8rem; margin-top: -24px;">Jl. S. Supriadi 48 Malang, Telp. 801488 ext. 107 – Gedung A
                Lt. 2</p>
            <p style="font-size: 0.8rem; margin-top: -20px;">Website: lp3l.unikama.ac.id email: lp3l@unikama.ac.id</p>
        </div>
    </div>

    <div style="margin-top: 110px;">
        <p style="font-size: 0.9rem">Tanggal Cetak : {{ date('Y-m-d H:i:s') }}</p>
        <table class="table" id=" customers">
            <tr>
                <td style="width: 30%;"><b>NPM</b></td>
                <td>{{ $get_mhs->npm }}</td>
            </tr>
            <tr>
                <td><b>Nama Mahasiswa</b></td>
                <td>{{ $get_mhs->nama_mhs }}</td>
            </tr>
            <tr>
                <td><b>Program Studi</b></td>
                <td>{{ $list_prodi[$get_mhs->program_studi] }}</td>
            </tr>
            <tr>
                <td><b>Fakultas</b></td>
                <td>{{ $list_fakultas[$get_mhs->fakultas] }}</td>
            </tr>
            <tr>
                <td><b>Jenis PLP</b></td>
                <td>
                    @if ($get_mhs->jenis_plp === 1)
                        {{ 'PLP I' }}
                    @else
                        {{ 'PLP II' }}
                    @endif
                </td>
            </tr>
            <tr>
                <td><b>Penempatan Sekolah</b></td>
                <td>{{ $get_sekolah->nama_sekolah }}</td>
            </tr>
            <tr>
                <td><b>NIK/NIDN Kepala Sekolah</b></td>
                <td>{{ $get_kepsek->nik }}</td>
            </tr>
            <tr>
                <td><b>Nama Kepala Sekolah</b></td>
                <td>{{ $get_kepsek->nama_kepsek }}</td>
            </tr>
            <tr>
                <td><b>NIK/NIDN Guru Pamong</b></td>
                <td>{{ $get_guru_pamong->nik }}</td>
            </tr>
            <tr>
                <td><b>Nama Guru Pamong</b></td>
                <td>{{ $get_guru_pamong->nama_guru_pamong }}</td>
            </tr>
            <tr>
                <td><b>NIK/NIDN DPL</b></td>
                <td>{{ $get_dpl->nik }}</td>
            </tr>
            <tr>
                <td><b>Nama DPL</b></td>
                <td>{{ $get_dpl->nama_dpl }}</td>
            </tr>
            <tr>
                <td><b>Program Studi DPL</b></td>
                <td>{{ $list_prodi[$get_dpl->program_studi] }}</td>
            </tr>
            <tr>
                <td><b>Created At</b></td>
                <td>{{ $get_zonasi->created_at }}</td>
            </tr>
        </table>
    </div>

    <div style="margin-top: 30px; font-size: 0.8rem; margin-left: 850px;">
        <p>Menyetujui Kepala LP3L</p>
        <div style="margin-top: -30px">
            <img src="{{ asset('images/ttd_pak_djoko_01.png') }}" height="160px"
                style="margin-right: 850px;margin-top: 20px" alt="">
        </div>
        {{-- <div style="margin-top: -280px; z-index: 0;">
            <img src="{{ asset('images/stempel_lp3l.png') }}" height="190px"
                style="margin-right: 850px;margin-top: 20px" alt="">
        </div> --}}
        <div style="margin-top: -30px">
            <p><u>Hary Wijaya M.Pd</u></p>
            <p style="margin-top: -20px;">NIK : 342324234</p>
        </div>
    </div>

</body>

</html>
