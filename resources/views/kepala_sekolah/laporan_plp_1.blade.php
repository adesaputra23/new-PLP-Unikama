<div class="tab-pane fade show active" id="tab-1" role="tabpanel" aria-labelledby="tab-1-tab">
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-sm">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NPM</th>
                    <th>Nama Mahasiswa</th>
                    <th>Prodi</th>
                    <th>Guru Pamong</th>
                    <th>Nilai Akhir</th>
                    <th>Grade</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no_plp_1 = 1;
                @endphp
                @foreach ($list_mhs_plp_1 as $item_plp_1 => $mhs_plp_1)
                    <tr>
                        <td>{{ $no_plp_1++ }}</td>
                        <td>{{ $mhs_plp_1->JointoMhs->npm }}</td>
                        <td>{{ $mhs_plp_1->JointoMhs->nama_mhs }}</td>
                        <td>{{ $list_prodi[$mhs_plp_1->JointoMhs->program_studi] }}</td>
                        <td>
                            @if (empty($mhs_plp_1->JointoGuruPamong))
                                {{ '-' }}
                            @else
                                {{ $mhs_plp_1->JointoGuruPamong->nama_guru_pamong }}
                            @endif
                        </td>
                        <th class="text-center">
                            @if ($mhs_plp_1->JointoPenilaian)
                                @if ($mhs_plp_1->JointoPenilaian->jumlah_na)
                                    {{ $mhs_plp_1->JointoPenilaian->jumlah_na }}
                                @else
                                    {{ '-' }}
                                @endif
                            @else
                                {{ '-' }}
                            @endif
                        </th>
                        <th class="text-center">
                            @if ($mhs_plp_1->JointoPenilaian)
                                @if ($mhs_plp_1->JointoPenilaian->huruf)
                                    {{ $mhs_plp_1->JointoPenilaian->huruf }}
                                @else
                                    {{ '-' }}
                                @endif
                            @else
                                {{ '-' }}
                            @endif
                        </th>
                        <td>
                            @if ($mhs_plp_1->JointoPenilaian)
                                @if ($mhs_plp_1->JointoPenilaian->huruf)
                                    <a href="{{ route('detail.penilaian.p1', ['id' => $mhs_plp_1->JointoPenilaian->id_penilaian]) }}"
                                        class="btn btn-info btn-sm">Detail</a>
                                @else
                                    <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#non-detail-p1"
                                        type="button">Detail</a>
                                @endif
                            @else
                                <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#non-detail-p1"
                                    type="button">Detail</a>
                            @endif

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="non-detail-p1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Laporan Penilaian PLP I</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="text-center">Tidak ada nilai yang di seting!</p>
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
