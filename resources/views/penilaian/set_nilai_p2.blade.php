@extends('template/template_admin')
@section('conten')
    {{-- secction header --}}
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Penilaian</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="#">Penilaian</a></li>
                        <li class="breadcrumb-item">Penilaian</li>
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
                <h3 class="card-title">Penilaian PLP II</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <form action="{{ route('simpan.nilai.p2', ['id' => $penilaian->id_penilaian]) }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="mb-2">
                        <button class="btn btn-success btn-sm">Simpan</button>
                    </div>

                    <table class="table table-bordered table-sm mb-4">
                        {{-- <input type="hidden" class="form-control form-control-sm" value="" name="id_pn" id="id_pn" readonly> --}}
                        <tbody>
                            <tr>
                                <th style="width: 18%">
                                    Nama Mahasiswa
                                </th>
                                <th>
                                    <input type="text" class="form-control form-control-sm"
                                        value="{{ $penilaian->JointoMhs->nama_mhs }}" name="nama" id="nama" readonly>
                                </th>
                            </tr>
                            <tr>
                                <th>
                                    NPM
                                </th>
                                <th>
                                    <input type="text" class="form-control form-control-sm"
                                        value="{{ $penilaian->JointoMhs->npm }}" name="npm" id="npm" readonly>
                                </th>
                            </tr>
                            <tr>
                                <th>
                                    Program Studi
                                </th>
                                <th>
                                    <input type="text" class="form-control form-control-sm"
                                        value="{{ $prodi[$penilaian->JointoMhs->program_studi] }}" name="prodi" id="prodi"
                                        readonly>
                                </th>
                            </tr>
                        </tbody>
                    </table>

                    <table class="table table-bordered table-sm mb-4">
                        <tbody>
                            <tr>
                                <th colspan="2">
                                    Kpribadian dan Sosil (N1)
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
                                    <td>{{ $indikator_n1->nama_indikator }}</td>
                                    <td style="width: 14%">
                                        <div class="form-n1">
                                            <input type="number" class="form-control n1 form-control-sm"
                                                id="nilai_indikator_n1" name="nilai_indikator_n1[]"
                                                max="{{ $indikator_n1->jumlah_nilai }}" min="{{ 0 }}"
                                                required>
                                            <span class="text-danger">
                                                <small>*note: nilai max:{{ $indikator_n1->jumlah_nilai }}</small>
                                            </span>
                                            <input type="hidden" name="id_indikator_n1[]"
                                                value="{{ $indikator_n1->id_indikator_pn }}">
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <th colspan="2">
                                    Jumlah Nilai (N1)
                                </th>
                                <td>
                                    <input type="hidden" name="id_aspek_n1" value="{{ $indikator_n1->id_aspek_pn }}">
                                    <input type="number" class="form-control form-control-sm" id="jml_nilai_n1"
                                        name="jml_nilai_n1" readonly>
                                </td>
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
                                    <td style="width: 14%">
                                        <div class="form-n2">
                                            <input type="number" class="form-control n2 form-control-sm"
                                                id="nilai_indikator_n2" name="nilai_indikator_n2[]"
                                                max="{{ $indikator_n2->jumlah_nilai }}" min="{{ 0 }}"
                                                required>
                                            <span class="text-danger">
                                                <small>*note: nilai max:{{ $indikator_n2->jumlah_nilai }}</small>
                                            </span>
                                            <input type="hidden" name="id_indikator_n2[]"
                                                value="{{ $indikator_n2->id_indikator_pn }}">
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <th colspan="2">
                                    Jumlah Nilai (N2)
                                </th>
                                <td>
                                    <input type="hidden" name="id_aspek_n2" value="{{ $indikator_n2->id_aspek_pn }}">
                                    <input type="text" class="form-control form-control-sm" name="jml_nilai_n2"
                                        id="jml_nilai_n2" readonly>
                                </td>
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
                                    <td style="width: 14%">
                                        <div class="form-n3">
                                            <input type="number" class="form-control n3 form-control-sm"
                                                id="nilai_indikator_n3" name="nilai_indikator_n3[]"
                                                max="{{ $indikator_n3->jumlah_nilai }}" min="{{ 0 }}"
                                                required>
                                            <span class="text-danger">
                                                <small>*note: nilai max:{{ $indikator_n3->jumlah_nilai }}</small>
                                            </span>
                                            <input type="hidden" name="id_indikator_n3[]"
                                                value="{{ $indikator_n3->id_indikator_pn }}">
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <th colspan="2">
                                    Jumlah Nilai (N3)
                                </th>
                                <td>
                                    <input type="hidden" name="id_aspek_n3" value="{{ $indikator_n3->id_aspek_pn }}">
                                    <input type="text" class="form-control form-control-sm" name="jml_nilai_n3"
                                        id="jml_nilai_n3" readonly>
                                </td>
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
                                    <td style="width: 14%">
                                        <div class="form-n4">
                                            <input type="number" class="form-control n4 form-control-sm"
                                                id="nilai_indikator_n4" name="nilai_indikator_n4[]"
                                                max="{{ $indikator_n4->jumlah_nilai }}" min="{{ 0 }}"
                                                required>
                                            <span class="text-danger">
                                                <small>*note: nilai max:{{ $indikator_n4->jumlah_nilai }}</small>
                                            </span>
                                            <input type="hidden" name="id_indikator_n4[]"
                                                value="{{ $indikator_n4->id_indikator_pn }}">
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <th colspan="2">
                                    Jumlah Nilai (N4)
                                </th>
                                <td>
                                    <input type="hidden" name="id_aspek_n4" value="{{ $indikator_n4->id_aspek_pn }}">
                                    <input type="number" class="form-control form-control-sm" id="jml_nilai_n4"
                                        name="jml_nilai_n4" readonly>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </form>
        </div>
    </section>
    {{-- end section conten --}}

    @include('penilaian/modal_kriteria_n1')
    @include('penilaian/modal_kriteria_n3')
    @include('penilaian/modal_kriteria_n4')

    <script>
        $('.form-n1').on('input', '.n1', function() {
            var totalSum = 0;
            $('.form-n1 .n1').each(function() {
                var totalVal = $(this).val();
                if ($.isNumeric(totalVal)) {
                    totalSum += parseFloat(totalVal) / parseInt(48) * parseInt(100);
                }
            });
            var desimal = totalSum.toFixed(0)
            $('#jml_nilai_n1').val(desimal);
        });

        $('.form-n2').on('input', '.n2', function() {
            var totalSum = 0;
            $('.form-n2 .n2').each(function() {
                var totalVal = $(this).val();
                if ($.isNumeric(totalVal)) {
                    totalSum += parseFloat(totalVal);
                }
            });
            $('#jml_nilai_n2').val(totalSum);
        });

        $('.form-n3').on('input', '.n3', function() {
            var totalSum = 0;
            $('.form-n3 .n3').each(function() {
                var totalVal = $(this).val();
                if ($.isNumeric(totalVal)) {
                    totalSum += parseFloat(totalVal) / parseInt(60) * parseInt(100);
                }
            });
            var desimal = totalSum.toFixed(0)
            $('#jml_nilai_n3').val(desimal);
        });

        $('.form-n4').on('input', '.n4', function() {
            var totalSum = 0;
            $('.form-n4 .n4').each(function() {
                var totalVal = $(this).val();
                if ($.isNumeric(totalVal)) {
                    totalSum += parseFloat(totalVal) / parseInt(120) * parseInt(100);
                }
            });
            var desimal = totalSum.toFixed(0)
            $('#jml_nilai_n4').val(desimal);
        });
    </script>

@endsection
