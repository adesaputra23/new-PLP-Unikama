<?php

namespace App\Exports;

use App\Mahasiswa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class MahasiswaExport implements FromView, WithStyles, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $mhs;
    protected $list_prodi;
    protected $list_fakultas;
    protected $list_plp;
    protected $list_kelas;
    protected $list_jenis_kelamin;
    public function __construct($mhs,$list_prodi,$list_fakultas,$list_plp,$list_kelas,$list_jenis_kelamin)
    {
        $this->mhs = $mhs;
        $this->prodi = $list_prodi;
        $this->fakultas = $list_fakultas;
        $this->plp = $list_plp;
        $this->kelas = $list_kelas;
        $this->jenis_kelamin = $list_jenis_kelamin;
    }

    public function view(): View
    {
        return view('export_mhs', [
            'mhs' => $this->mhs,
            'list_prodi' => $this->prodi,
            'list_fakultas' => $this->fakultas,
            'list_plp' => $this->plp,
            'list_kelas' => $this->kelas,
            'list_jenis_kelamin' => $this->jenis_kelamin,
        ]);
    }

    public function styles(Worksheet $sheet)
    {
        $count_mhs = count($this->mhs);
        $sheet->getStyle('A1:P'.($count_mhs+2))->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['argb' => '000000'],
                        ],
                    ],
        ]);
        return [
            '1'  => ['font' => ['bold' => true]],
        ];
    }
}
