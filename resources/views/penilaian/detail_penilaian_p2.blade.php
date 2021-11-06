@extends('template/template_admin')
@section('conten')
    {{-- secction header --}}
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Detail Penilaian</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        @if (Auth::user()->user_role->role === 4)
                            <li class="breadcrumb-item"><a href="{{ route('data.penilaian') }}">Penilaian</a></li>
                        @endif
                        @if (Auth::user()->user_role->role === 3)
                            <li class="breadcrumb-item"><a href="{{ route('laporan.penilaian') }}">Laporan Penilaian</a>
                            </li>
                        @endif
                        <li class="breadcrumb-item">Detail Penilaian</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    {{-- end section header --}}

    {{-- section conten --}}
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Detail Penilaian PLP II</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>

            <div class="card-body">

                <div class="card">
                    <div class="card-body">
                        <div class="btn-group">
                            <a href="" type="button" class="btn btn-success">
                                Cetak PDF
                            </a>
                            @if (Auth::user()->user_role->role === 4)
                                <a href="{{ route('edit.nilai.p2', ['id' => $penilaian->id_penilaian]) }}" type="button"
                                    class="btn btn-warning">
                                    Edit Data
                                </a>
                            @endif
                        </div>
                    </div>
                </div>

                <table class="table table-bordered table-sm mb-4">
                    {{-- <input type="hidden" class="form-control form-control-sm" value="" name="id_pn" id="id_pn" readonly> --}}
                    <tbody>
                        <tr>
                            <th style="width: 18%">
                                Nama Mahasiswa
                            </th>
                            <th>{{ $penilaian->JointoMhs->nama_mhs }}</th>
                        </tr>
                        <tr>
                            <th>
                                NPM
                            </th>
                            <th>{{ $penilaian->JointoMhs->npm }}</th>
                        </tr>
                        <tr>
                            <th>
                                Program Studi
                            </th>
                            <th>{{ $prodi[$penilaian->JointoMhs->program_studi] }}</th>
                        </tr>
                    </tbody>
                </table>

                <table class="table table-bordered table-sm mb-4">
                    <tbody>
                        <tr>
                            <th colspan="2">
                                Kpribadian dan Sosial (N1)
                                <button class="btn btn-info btn-sm float-right" type="button" data-toggle="modal"
                                    data-target="#modal-kriteria-n1" style="padding: 0px 2px 0px 2px">Keriteria</button>
                            </th>
                            <td class="text-center">Nilai</td>
                        </tr>
                        @php
                            $no_n1 = 1;
                        @endphp
                        @foreach ($list_indikator_n1 as $item_n1 => $indikator_n1)
                            <tr>
                                <td>{{ $no_n1++ }}</td>
                                <td>
                                    {{ $indikator_n1->nama_indikator }}
                                </td>
                                <td style="width: 8%" class="text-center">
                                    {{ $indikator_n1->PnRkapIndikator->jumlah_nilai_rkap }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <th colspan="2">
                                Jumlah Nilai (N1)
                            </th>
                            <th class="text-center">{{ $rkap_aspek_n1->jumlah_nilai }}</th>
                        </tr>
                    </tbody>
                </table>

                <table class="table table-bordered table-sm mb-4">
                    <tbody>
                        <tr>
                            <th colspan="2">
                                Laporan Pelaksanaan (N2)
                            </th>
                            <td class="text-center">Nilai</td>
                        </tr>
                        @php
                            $no_n2 = 1;
                        @endphp
                        @foreach ($list_indikator_n2 as $item_n2 => $indikator_n2)
                            <tr>
                                <td>{{ $no_n2++ }}</td>
                                <td>{{ $indikator_n2->nama_indikator }}</td>
                                <td style="width: 8%" class="text-center">
                                    {{ $indikator_n2->PnRkapIndikator->jumlah_nilai_rkap }}
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <th colspan="2">
                                Jumlah Nilai (N2)
                            </th>
                            <th class="text-center">
                                {{ $rkap_aspek_n2->jumlah_nilai }}
                            </th>
                        </tr>
                    </tbody>
                </table>

                <table class="table table-bordered table-sm mb-4">
                    <tbody>
                        <tr>
                            <th colspan="2">
                                RPP (N3)
                                <button class="btn btn-info btn-sm float-right" type="button" data-toggle="modal"
                                    data-target="#modal-kriteria-n3" style="padding: 0px 2px 0px 2px">Keriteria</button>
                            </th>
                            <td class="text-center">Nilai</td>
                        </tr>
                        @php
                            $no_n3 = 1;
                        @endphp
                        @foreach ($list_indikator_n3 as $item_n3 => $indikator_n3)
                            <tr>
                                <td>{{ $no_n3++ }}</td>
                                <td>{{ $indikator_n3->nama_indikator }}</td>
                                <td style="width: 8%" class="text-center">
                                    {{ $indikator_n3->PnRkapIndikator->jumlah_nilai_rkap }}
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <th colspan="2">
                                Jumlah Nilai (N3)
                            </th>
                            <th class="text-center">
                                {{ $rkap_aspek_n3->jumlah_nilai }}
                            </th>
                        </tr>
                    </tbody>
                </table>

                <table class="table table-bordered table-sm mb-4">
                    <tbody>
                        <tr>
                            <th colspan="2">
                                Pembelajaran dan Video (N4)
                                <button class="btn btn-info btn-sm float-right" type="button" data-toggle="modal"
                                    data-target="#modal-kriteria-n4" style="padding: 0px 2px 0px 2px">Keriteria</button>
                            </th>
                            <td class="text-center">Nilai</td>
                        </tr>
                        @php
                            $no_n4 = 1;
                        @endphp
                        @foreach ($list_indikator_n4 as $item_n4 => $indikator_n4)
                            <tr>
                                <td>{{ $no_n4++ }}</td>
                                <td>{{ $indikator_n4->nama_indikator }}</td>
                                <td style="width: 8%" class="text-center">
                                    {{ $indikator_n4->PnRkapIndikator->jumlah_nilai_rkap }}
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <th colspan="2">
                                Jumlah Nilai (N4)
                            </th>
                            <th class="text-center">
                                {{ $rkap_aspek_n4->jumlah_nilai }}
                            </th>
                        </tr>
                    </tbody>
                </table>

                <table class="table table-bordered table-sm mb-4">
                    <tbody>
                        <tr>
                            <th>Nila (NA)</th>
                            <th style="width: 18%" class="text-center">Nilai</th>
                            <th style="width: 18%" class="text-center">Konfert Nilai</th>
                        </tr>
                        <tr>
                            <th>Total Nilai Akhir</th>
                            <th style="width: 18%" class="text-center">{{ $penilaian->jumlah_na }}</th>
                            <th style="width: 18%" class="text-center">{{ $penilaian->huruf }}</th>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </section>
    {{-- end section conten --}}

    @include('penilaian/modal_kriteria_n1')
    @include('penilaian/modal_kriteria_n3')
    @include('penilaian/modal_kriteria_n4')

@endsection
