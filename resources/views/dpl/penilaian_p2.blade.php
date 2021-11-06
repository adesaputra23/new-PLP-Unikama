<div class="tab-pane fade show active" id="tab-2" role="tabpanel" aria-labelledby="tab-2-tab">
    <div class="table-responsive">
        <table id="example2" class="table table-bordered table-striped table-sm">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NPM</th>
                    <th>Nama</th>
                    <th>RPP (N1)</th>
                    <th>Video (N2)</th>
                    <th>Laporan dan Video Terbaik (N3)</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no_p2 = 1;
                @endphp
                @foreach ($list_zonasi_plp_2 as $item_plp_2 => $mhs_plp_2)
                    <tr>
                        <td>{{ $no_p2++ }}</td>
                        <td>{{ $mhs_plp_2->JointoMhs->npm }}</td>
                        <td>{{ $mhs_plp_2->JointoMhs->nama_mhs }}</td>
                        <th class="text-center">
                            @if (empty($mhs_plp_2->JointoPenilaianDPl))
                                {{ '-' }}
                            @else
                                @foreach ($mhs_plp_2->JointoPenilaianDPl->JointoRkapAspekDpl as $item_n1 => $value_n1)
                                    @if ($value_n1->id_pn_aspek_dpl == 1)
                                        {{ $value_n1->jumlah_nilai }}
                                    @endif
                                @endforeach
                            @endif
                        </th>
                        <th class="text-center">
                            @if (empty($mhs_plp_2->JointoPenilaianDPl))
                                {{ '-' }}
                            @else
                                @foreach ($mhs_plp_2->JointoPenilaianDPl->JointoRkapAspekDpl as $item_n1 => $value_n1)
                                    @if ($value_n1->id_pn_aspek_dpl == 2)
                                        {{ $value_n1->jumlah_nilai }}
                                    @endif
                                @endforeach
                            @endif
                        </th>
                        <td class="text-center">
                            @if (empty($mhs_plp_2->JointoPenilaianDPl))
                                {{ '-' }}
                            @else
                                @if ($mhs_plp_2->JointoPenilaianDPl->status_laporan_terbaik == 1)
                                    {{ 'Terbaik' }}
                                @else
                                    <small><a
                                            href="{{ route('video.terbaik', ['id' => $mhs_plp_2->JointoPenilaianDPl->id_penilaian_dpl]) }}"
                                            class="text-danger">Set video dan laporan terbaik</a></small>
                                @endif
                            @endif
                        </td>
                        <td>
                            <div class="btn-group">
                                @if (empty($mhs_plp_2->JointoPenilaianDPl))
                                    <a href="{{ route('set.nilai.dpl.p2', ['id' => $mhs_plp_2->id_zonasi]) }}"
                                        class="btn btn-success btn-sm">Set Nilai</a>
                                @else
                                    <a href="{{ route('edit.nilai.dpl.p2', ['id' => $mhs_plp_2->id_zonasi]) }}"
                                        class="btn btn-warning btn-sm">Edit Nilai</a>
                                    <a href="{{ route('detail.nilai.dpl.p2', ['id' => $mhs_plp_2->id_zonasi]) }}"
                                        class="btn btn-info btn-sm">Detail</a>
                                @endif

                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
