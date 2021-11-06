@extends('template/template_admin')
@section('conten')
    {{-- secction header --}}
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Rekapan Penilaian</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item">Rekapan Penilaian</li>
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
                <h3 class="card-title">Rekapan Penilaian</h3>

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

                <div class="mt-2">
                    <div class="tab-content mt-4" id="custom-content-above-tabContent">
                        {{-- plp 1 --}}
                        <div class="tab-pane fade show active" id="tab-1" role="tabpanel" aria-labelledby="tab-1-tab">
                            <div class="table-responsive">
                                <table id="tabel1" class="table table-bordered table-striped table-sm">
                                    <thead class="text-center">
                                        <tr>
                                            <th>No</th>
                                            <th>NPM</th>
                                            <th>Nama Mahasiswa</th>
                                            <th>Prodi</th>
                                            <th>Nilai PLP I</th>
                                            <th>Grade</th>
                                            <th>Status</th>
                                            <th>Aaction</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no_plp_1 = 1;
                                        @endphp
                                        @foreach ($list_mhs_plp_1 as $item_plp_1 => $mhs_plp_1)
                                            <tr>
                                                <td class="text-center">{{ $no_plp_1++ }}</td>
                                                <td>{{ $mhs_plp_1->JointoMhs->npm }}</td>
                                                <td>{{ $mhs_plp_1->JointoMhs->nama_mhs }}</td>
                                                <td>{{ $list_prodi[$mhs_plp_1->JointoMhs->program_studi] }}</td>
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
                                                <td class="text-center">
                                                    @if (empty($mhs_plp_1->JointoPenilaian))
                                                        {{ 'Tidak Lulus' }}
                                                    @else
                                                        @if ($mhs_plp_1->JointoPenilaian->huruf == null)
                                                            {{ 'Tidak Lulus' }}
                                                        @else
                                                            @if ($mhs_plp_1->JointoPenilaian->huruf = 'A' || $mhs_plp_1->JointoPenilaian->huruf = 'A-' || $mhs_plp_1->JointoPenilaian->huruf = 'B+' || $mhs_plp_1->JointoPenilaian->huruf = 'B' || $mhs_plp_1->JointoPenilaian->huruf = 'B-' || $mhs_plp_1->JointoPenilaian->huruf = 'C+' || $mhs_plp_1->JointoPenilaian->huruf = 'C' || $mhs_plp_1->JointoPenilaian->huruf = 'C-')
                                                                {{'Lulus'}}
                                                            @else
                                                                {{'Tidak Lulus'}}
                                                            @endif
                                                        @endif
                                                    @endif
                                                </td>
                                                <td>
                                                    @if (empty($mhs_plp_1->JointoPenilaian))
                                                        <a href="" class="btn btn-info btn-sm">PDF</a>
                                                    @else
                                                        <a href="" class="btn btn-info btn-sm">PDF</a>
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
                                            <th>NPM</th>
                                            <th>Nama Mahasiswa</th>
                                            <th>Prodi</th>
                                            <th>Nilai GP</th>
                                            <th>Nilai Kepsek</th>
                                            <th>Nilai DPL</th>
                                            <th>Nilai Akhir</th>
                                            <th>Grade</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no_plp_2 = 1;
                                        @endphp
                                        @foreach ($list_mhs_plp_2 as $item_plp_2 => $mhs_plp_2)
                                            <tr>
                                                <td class="text-center">{{ $no_plp_2++ }}</td>
                                                <td>{{ $mhs_plp_2->JointoMhs->npm }}</td>
                                                <td>{{ $mhs_plp_2->JointoMhs->nama_mhs }}</td>
                                                <td>{{ $list_prodi[$mhs_plp_2->JointoMhs->program_studi] }}</td>
                                                <th class="text-center">
                                                    @if (empty($mhs_plp_2->JointoPenilaian))
                                                        {{ '-' }}
                                                        @php
                                                            $gp = 0;
                                                        @endphp
                                                    @else
                                                        @if ($mhs_plp_2->JointoPenilaian->jumlah_na == null)
                                                            {{ '-' }}
                                                            @php
                                                                $gp = 0;
                                                            @endphp
                                                        @else
                                                            {{ $mhs_plp_2->JointoPenilaian->jumlah_na }}
                                                            @php
                                                                $gp = $mhs_plp_2->JointoPenilaian->jumlah_na;
                                                            @endphp
                                                        @endif
                                                    @endif
                                                </th>
                                                <th class="text-center">
                                                    @if (empty($mhs_plp_2->JointoPenilaian))
                                                        {{ '-' }}
                                                        @php
                                                            $kpsk = 0;
                                                        @endphp
                                                    @else
                                                        @if ($mhs_plp_2->JointoPenilaian->nilai_kepsek == null)
                                                            {{ '-' }}
                                                            @php
                                                                $kpsk = 0;
                                                            @endphp
                                                        @else
                                                            {{ $mhs_plp_2->JointoPenilaian->nilai_kepsek }}
                                                            @php
                                                                $kpsk = $mhs_plp_2->JointoPenilaian->nilai_kepsek;
                                                            @endphp
                                                        @endif
                                                    @endif
                                                </th>
                                                <th class="text-center">
                                                    @if (empty($mhs_plp_2->JointoPenilaianDpl))
                                                        {{ '-' }}
                                                        @php
                                                            $dpl = 0;
                                                        @endphp
                                                    @else
                                                        @if ($mhs_plp_2->JointoPenilaianDpl->jumlah_na == null)
                                                            {{ '-' }}
                                                            @php
                                                                $dpl = 0;
                                                            @endphp
                                                        @else
                                                            {{ $mhs_plp_2->JointoPenilaianDpl->jumlah_na }}
                                                            @php
                                                                $dpl = $mhs_plp_2->JointoPenilaianDpl->jumlah_na;
                                                            @endphp
                                                        @endif
                                                    @endif
                                                </th>
                                                <th class="text-center">
                                                    @if ($gp == 0 && $kpsk == 0 && $dpl == 0)
                                                        {{'-'}}
                                                    @else
                                                        {{-- rumus = $mhs_plp_2->JointoPenilaianDpl->jumlah_na =(F390+(3*E390)+G390)/5 --}}
                                                        @php
                                                            $nilai_total = ($gp + ($kpsk * 3) + $dpl)/5;
                                                        @endphp
                                                        {{$nilai_total}}
                                                    @endif
                                                </th>
                                                <th class="text-center">
                                                    @php
                                                        // Konfert Nilai
                                                            if ($nilai_total >= 91 ) {
                                                                // 91-100 A
                                                                $konfert_na = 'A';
                                                            }elseif($nilai_total >= 84 ){
                                                                // 84-90 A-
                                                                $konfert_na = 'A-';
                                                            }elseif($nilai_total >= 75 ){
                                                                // 75-83 B+
                                                                $konfert_na = 'B+';
                                                            }elseif($nilai_total >= 71 ){
                                                                // 71-76 B
                                                                $konfert_na = 'B';
                                                            }elseif($nilai_total >= 66 ){
                                                                // 66-70 B-
                                                                $konfert_na = 'B-';
                                                            }elseif($nilai_total >= 61 ){
                                                                // 61-65 C+
                                                                $konfert_na = 'C+';
                                                            }elseif($nilai_total >= 55 ){
                                                                // 55-60 C
                                                                $konfert_na = 'C';
                                                            }elseif($nilai_total >= 41 ){
                                                                // 41-54 D
                                                                $konfert_na = 'D';
                                                            }elseif($nilai_total <= 40 ){
                                                                // 0-40 E
                                                                $konfert_na = 'E';
                                                            }
                                                    @endphp
                                                    {{$konfert_na}}
                                                </th>
                                                <td class="text-center">
                                                    @if ($konfert_na == 'A' || $konfert_na == 'A-' || $konfert_na == 'B+' || $konfert_na == 'B' || $konfert_na == 'B-' || $konfert_na == 'C+' || $konfert_na == 'C' || $konfert_na == 'C-')
                                                        {{'Lulus'}}
                                                    @else
                                                        {{'Tidak Lulus'}}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if (empty($mhs_plp_1->JointoPenilaian) && empty($mhs_plp_1->JointoPenilaianDpl))
                                                        <a href="" class="btn btn-info btn-sm">PDF</a>
                                                    @else
                                                        <a href="" class="btn btn-info btn-sm">PDF</a>
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
