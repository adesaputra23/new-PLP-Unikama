<div class="tab-pane fade show active" id="tab-1" role="tabpanel" aria-labelledby="tab-1-tab">
    <div class="table-responsive">
        <table id="example1" class="table table-bordered table-striped table-sm">
            <thead>
                <tr class="text-center">
                    <th>NPM</th>
                    <th>Nama</th>
                    <th>Prodi</th>
                    <th>Keaktifan <br>(N1)</th>
                    <th>Laporan Pelaksanaan <br>(N2)</th>
                    <th>Kemampuan <br> Personal-Sosial <br>(N3)</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($list_mhs_plp_1 as $item_plp_1 => $mhs_plp_1)
                    <tr>
                        <td>{{ $mhs_plp_1->npm }}</td>
                        <td>{{ $mhs_plp_1->JointoMhs->nama_mhs }}</td>
                        <td>{{ $list_prodi[$mhs_plp_1->JointoMhs->program_studi] }}</td>
                        <td class="text-center">
                            @if (empty($mhs_plp_1->JointoRkapAspek))
                                {{ '-' }}
                            @else
                                @foreach ($mhs_plp_1->JointoRkapAspekMany as $key_n1 => $value_n1)
                                    @if ($value_n1->id_pn_aspek == 1)
                                        {{ $value_n1->jumlah_nilai }}
                                    @endif
                                @endforeach
                            @endif
                        </td>
                        <td class="text-center">
                            @if (empty($mhs_plp_1->JointoRkapAspek))
                                {{ '-' }}
                            @else
                                @foreach ($mhs_plp_1->JointoRkapAspekMany as $key_n2 => $value_n2)
                                    @if ($value_n2->id_pn_aspek == 2)
                                        {{ $value_n2->jumlah_nilai }}
                                    @endif
                                @endforeach
                            @endif
                        </td>
                        <td class="text-center">
                            @if (empty($mhs_plp_1->JointoRkapAspek))
                                {{ '-' }}
                            @else
                                @foreach ($mhs_plp_1->JointoRkapAspekMany as $key_n3 => $value_n3)
                                    @if ($value_n3->id_pn_aspek == 3)
                                        {{ $value_n3->jumlah_nilai }}
                                    @endif
                                @endforeach
                            @endif
                        </td>
                        <td style="width: 8%;">
                            <div class="btn-group-vertical">
                                @if (empty($mhs_plp_1->JointoRkapAspek))
                                    <a href="{{ route('set.nilai', ['id' => $mhs_plp_1->id_penilaian]) }}"
                                        class="btn btn-success btn-sm">Set
                                        Nilai</a>
                                @else
                                    <a href="{{ route('edit.nilai', ['id' => $mhs_plp_1->id_penilaian]) }}"
                                        class="btn btn-warning btn-sm">Edit
                                        Nilai</a>
                                    <a href="{{ route('detail.penilaian.p1', ['id' => $mhs_plp_1->id_penilaian]) }}"
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
