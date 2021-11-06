@extends('template/template_admin')
@section('conten')
    {{-- secction header --}}
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Laporan Penilaian Sekolah</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item">Laporan Penilaian Sekolah</li>
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
                <h3 class="card-title">Laporan Penilaian Sekolah</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

            </div>

            <div class="card-body">

                <div class="mt-2">
                    <ul class="nav nav-tabs" id="custom-content-above-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="tab-1-tab" data-toggle="pill" href="#tab-1" role="tab"
                                aria-controls="tab-1" aria-selected="true">PLP I</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="tab-2-tab" data-toggle="pill" href="#tab-2" role="tab"
                                aria-controls="tab-2" aria-selected="false">PLP II</a>
                        </li>
                    </ul>
                    <div class="tab-content mt-4" id="custom-content-above-tabContent">
                        {{-- plp 1 --}}
                        <div class="tab-pane fade show active" id="tab-1" role="tabpanel" aria-labelledby="tab-1-tab">
                            <div class="table-responsive">
                                <table id="tabel1" class="table table-bordered table-striped table-sm">
                                    <thead class="text-center">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Sekolah</th>
                                            <th>NIK / Nama Kpala Sekolah</th>
                                            <th>NPM / Nama Mahasiswa</th>
                                            <th>Nilai Akhir (NA)</th>
                                            <th>Konvert (NA)</th>
                                            <th>Created At</th>
                                            <th>Aaction</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no_plp_1 = 1;
                                        @endphp
                                        @foreach ($list_mhs_plp_1 as $item_plp_1 => $mhs_plp_1)
                                            <tr>
                                                <td>{{ $no_plp_1++ }}</td>
                                                <td>{{ $mhs_plp_1->JointoMitraSekolah->nama_sekolah }}</td>
                                                <td>
                                                    ({{ $mhs_plp_1->JointoMitraSekolah->JointoKepsek->nik }}) -
                                                    {{ $mhs_plp_1->JointoMitraSekolah->JointoKepsek->nama_kepsek }}
                                                </td>
                                                <td>
                                                    ({{ $mhs_plp_1->JointoMhs->npm }}) -
                                                    {{ $mhs_plp_1->JointoMhs->nama_mhs }}
                                                </td>
                                                <th class="text-center">
                                                    @if (empty($mhs_plp_1->JointoPenilaian))
                                                        {{ '-' }}
                                                    @else
                                                        @if ($mhs_plp_1->JointoPenilaian->jumlah_na == null)
                                                            {{ '-' }}
                                                        @else
                                                            {{ $mhs_plp_1->JointoPenilaian->jumlah_na }}
                                                        @endif
                                                    @endif
                                                </th>
                                                <th class="text-center">
                                                    @if (empty($mhs_plp_1->JointoPenilaian))
                                                        {{ '-' }}
                                                    @else
                                                        @if ($mhs_plp_1->JointoPenilaian->huruf == null)
                                                            {{ '-' }}
                                                        @else
                                                            {{ $mhs_plp_1->JointoPenilaian->huruf }}
                                                        @endif
                                                    @endif
                                                </th>
                                                <td>
                                                    @if (empty($mhs_plp_1->JointoPenilaian))
                                                        {{ '-' }}
                                                    @else
                                                        @if ($mhs_plp_1->JointoPenilaian->huruf == null)
                                                            {{ '-' }}
                                                        @else
                                                            {{ $mhs_plp_1->JointoPenilaian->created_at }}
                                                        @endif
                                                    @endif
                                                </td>
                                                <td>
                                                    @if (empty($mhs_plp_1->JointoPenilaian))
                                                        <button class="btn btn-info btn-sm" data-toggle="modal"
                                                            data-target="#not-detail">Detail</button>
                                                    @else
                                                        @if ($mhs_plp_1->JointoPenilaian->huruf == null)
                                                            <button class="btn btn-info btn-sm" data-toggle="modal"
                                                                data-target="#not-detail">Detail</button>
                                                        @else
                                                            <a href="{{ route('detail.penilaian.p1', ['id' => $mhs_plp_1->JointoPenilaian->id_penilaian]) }}"
                                                                class="btn btn-info btn-sm">Detail</a>
                                                        @endif
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        {{-- plp 2 --}}
                        <div class="tab-pane fade" id="tab-2" role="tabpanel" aria-labelledby="tab-2-tab">
                            <div class="table-responsive">
                                <table id="tabel2" class="table table-bordered table-striped table-sm">
                                    <thead class="text-center">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Sekolah</th>
                                            <th>NIK / Nama Kpala Sekolah</th>
                                            <th>NPM / Nama Mahasiswa</th>
                                            <th>Nilai Akhir (NA)</th>
                                            <th>Konvert (NA)</th>
                                            <th>Created At</th>
                                            <th>Aaction</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no_plp_2 = 1;
                                        @endphp
                                        @foreach ($list_mhs_plp_2 as $item_plp_2 => $mhs_plp_2)
                                            <tr>
                                                <td>{{ $no_plp_2++ }}</td>
                                                <td>{{ $mhs_plp_2->JointoMitraSekolah->nama_sekolah }}</td>
                                                <td>
                                                    ({{ $mhs_plp_2->JointoMitraSekolah->JointoKepsek->nik }}) -
                                                    {{ $mhs_plp_2->JointoMitraSekolah->JointoKepsek->nama_kepsek }}
                                                </td>
                                                <td>
                                                    ({{ $mhs_plp_2->JointoMhs->npm }}) -
                                                    {{ $mhs_plp_2->JointoMhs->nama_mhs }}
                                                </td>
                                                <th class="text-center">
                                                    @if (empty($mhs_plp_2->JointoPenilaian))
                                                        {{ '-' }}
                                                    @else
                                                        @if ($mhs_plp_2->JointoPenilaian->jumlah_na == null)
                                                            {{ '-' }}
                                                        @else
                                                            {{ $mhs_plp_2->JointoPenilaian->jumlah_na }}
                                                        @endif
                                                    @endif
                                                </th>
                                                <th class="text-center">
                                                    @if (empty($mhs_plp_2->JointoPenilaian))
                                                        {{ '-' }}
                                                    @else
                                                        @if ($mhs_plp_2->JointoPenilaian->huruf == null)
                                                            {{ '-' }}
                                                        @else
                                                            {{ $mhs_plp_2->JointoPenilaian->huruf }}
                                                        @endif
                                                    @endif
                                                </th>
                                                <td>
                                                    @if (empty($mhs_plp_2->JointoPenilaian))
                                                        {{ '-' }}
                                                    @else
                                                        @if ($mhs_plp_2->JointoPenilaian->huruf == null)
                                                            {{ '-' }}
                                                        @else
                                                            {{ $mhs_plp_2->JointoPenilaian->created_at }}
                                                        @endif
                                                    @endif
                                                </td>
                                                <td>
                                                    @if (empty($mhs_plp_2->JointoPenilaian))
                                                        <button class="btn btn-info btn-sm" data-toggle="modal"
                                                            data-target="#not-detail">Detail</button>
                                                    @else
                                                        @if ($mhs_plp_2->JointoPenilaian->huruf == null)
                                                            <button class="btn btn-info btn-sm" data-toggle="modal"
                                                                data-target="#not-detail">Detail</button>
                                                        @else
                                                            <a href="{{ route('detail.nilai.p2', ['id' => $mhs_plp_2->JointoPenilaian->id_penilaian]) }}"
                                                                class="btn btn-info btn-sm">Detail</a>
                                                        @endif
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </section>
    {{-- end section conten --}}

    {{-- Modal --}}

    <div class="modal fade" id="not-detail">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Detail Data Penilaian</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="text-center">Penilaian belum di seting.</p>
                </div>
                <div class="modal-footer">
                    {{-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> --}}
                    <button type="button" class="btn btn-info" data-dismiss="modal">Keluar</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->


    {{-- end modal --}}

    <script>
        $('#tabel1').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": false,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
        $('#tabel2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": false,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    </script>

@endsection
