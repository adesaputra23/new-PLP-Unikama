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
                <h3 class="card-title">Penilaian PLP I</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <form action="{{ route('proses.simpan.penilaian.p1') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="mb-2">
                        <button class="btn btn-success btn-sm">Simpan</button>
                    </div>

                    <table class="table table-bordered table-sm mb-4">
                        <input type="hidden" class="form-control form-control-sm" value="{{ $data->id_penilaian }}"
                            name="id_pn" id="id_pn" readonly>
                        <tbody>
                            <tr>
                                <th style="width: 18%">
                                    Nama Mahasiswa
                                </th>
                                <th>
                                    <input type="text" class="form-control form-control-sm"
                                        value="{{ $data->JointoMhs->nama_mhs }}" name="nama" id="nama" readonly>
                                </th>
                            </tr>
                            <tr>
                                <th>
                                    NPM
                                </th>
                                <th>
                                    <input type="text" class="form-control form-control-sm" value="{{ $data->npm }}"
                                        name="npm" id="npm" readonly>
                                </th>
                            </tr>
                            <tr>
                                <th>
                                    Program Studi
                                </th>
                                <th>
                                    <input type="text" class="form-control form-control-sm"
                                        value="{{ $list_prodi[$data->JointoMhs->program_studi] }}" name="prodi" id="prodi"
                                        readonly>
                                </th>
                            </tr>
                        </tbody>
                    </table>

                    <table class="table table-bordered table-sm mb-4">
                        <tbody>
                            <tr>
                                <th colspan="2">
                                    Penilaian Keaktifan (N1)
                                </th>
                                <td class="text-center">Nilai</td>
                            </tr>
                            @foreach ($list_pn_indikator as $item_indikator => $pn_indikator)
                                @if ($pn_indikator->id_aspek_pn == 1)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $pn_indikator->nama_indikator }}</td>
                                        <td style="width: 15%">
                                            <div class="icheck-primary d-inline">
                                                <input type="radio" id="radioPrimary{{ $item_indikator }}" name="radio1"
                                                    data-nilai="{{ $pn_indikator->jumlah_nilai }}"
                                                    value="{{ $pn_indikator->nilai_indikator }}">
                                                <label
                                                    for="radioPrimary{{ $item_indikator }}">{{ $pn_indikator->nilai_indikator }}
                                                </label>
                                            </div>
                                        </td>
                                    </tr>
                                    <input type="hidden" name="id_aspek_pn_n1" id="id_aspek_pn_n1"
                                        value="{{ $pn_indikator->id_aspek_pn }}">
                                @endif
                            @endforeach
                            <tr>
                                <th colspan="2">
                                    Jumlah Nilai (N1)
                                </th>
                                <td>
                                    <input type="hidden" name="id_n1" id="id_n1">
                                    <input type="text" class="form-control form-control-sm" id="jml_nilai" name="jml_nilai"
                                        readonly>
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
                                $item_indikator = 0;
                            @endphp
                            @foreach ($list_pn_indikator as $item_indikator_n2 => $pn_indikator_n2)
                                @if ($pn_indikator_n2->id_aspek_pn == 2)
                                    <tr>
                                        <td>{{ $no_n2++ }}</td>
                                        <td>{{ $pn_indikator_n2->nama_indikator }}</td>
                                        <td style="width: 15%">
                                            <input type="hidden" name="id_n2[]" id="id_n2"
                                                value="{{ $pn_indikator_n2->id_indikator_pn }}">
                                            <input type="hidden" name="id_aspek_pn_n2" id="id_aspek_pn_n2"
                                                value="{{ $pn_indikator_n2->id_aspek_pn }}">
                                            <div class="form-n2">
                                                <input max="{{ $pn_indikator_n2->jumlah_nilai }}" min="0" type="number"
                                                    name="n2[]" id="n2{{ $item_indikator++ }}"
                                                    class="form-control n2 form-control-sm">
                                                <small class="text-danger">*Note: Nilai
                                                    Max:{{ $pn_indikator_n2->jumlah_nilai }}</small>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                            <tr>
                                <th colspan="2">
                                    Jumlah Nilai (N2)
                                </th>
                                <td>
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
                                    Kemampuan Personal-Sosial (N3)
                                    <button class="btn btn-info btn-sm float-right"
                                        style="padding: 0px 2px 0px 2px">Keriteria</button>
                                </th>
                                <td class="text-center">Nilai</td>
                            </tr>
                            @foreach ($list_pn_indikator as $item_indikator_n3 => $pn_indikator_n3)
                                @if ($pn_indikator_n3->id_aspek_pn == 3)
                                    <tr>
                                        <td>{{ $no_n3++ }}</td>
                                        <td>
                                            {{ $pn_indikator_n3->nama_indikator }}
                                        </td>
                                        <td style="width: 15%">
                                            <input type="hidden" name="id_n3[]" id="id_n3"
                                                value="{{ $pn_indikator_n3->id_indikator_pn }}">
                                            <input type="hidden" name="id_aspek_pn_n3" id="id_aspek_pn_n3"
                                                value="{{ $pn_indikator_n2->id_aspek_pn }}">
                                            <div class="form-n3">
                                                <input type="number" min="0" max="{{ $pn_indikator_n3->jumlah_nilai }}"
                                                    class="form-control n3 form-control-sm" name="n3[]" id="n3">
                                                <small class="text-danger">*Note: Nilai
                                                    Max:{{ $pn_indikator_n3->jumlah_nilai }}</small>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                            <tr>
                                <th colspan="2">
                                    Jumlah Nilai (N3)
                                </th>
                                <td>
                                    <input type="number" class="form-control form-control-sm" id="jml_nilai_n3"
                                        name="jml_nilai_n3" readonly>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </form>
        </div>
    </section>
    {{-- end section conten --}}

    <script>
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
                    totalSum += parseInt(totalVal) / parseInt(48);
                }
            });
            var total = totalSum * 100;
            var desimal = total.toFixed(0)
            $('#jml_nilai_n3').val(desimal);
        });


        $(document).ready(function() {
            $.ajax({
                type: "GET",
                url: "{{ url('ajax/get-indikator-keaktifan') }}",
                dataType: "json",
                success: function(response) {
                    console.log(response);
                    var data_n1 = response.list_pn_indikator_n1;
                    var data_n2 = response.list_pn_indikator_n2;
                    $.each(data_n1, function(index, value) {
                        // console.log(index);
                        $(document).on('change', '#radioPrimary' + index, function() {
                            if ($(this).is(':checked') === true) {
                                var nilai = $(this).data('nilai')
                                $('#jml_nilai').val(nilai);
                            };
                            // console.log();
                            $('#id_n1').val(value.id_indikator_pn);
                        });
                    });
                }
            });
        })
    </script>

@endsection
