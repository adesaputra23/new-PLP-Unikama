<div class="tab-pane fade show" id="tab-2" role="tabpanel" aria-labelledby="tab-2-tab">
    <div class="table-responsive">
        <table id="example2" class="table table-bordered table-striped table-sm">
            <thead>
                <tr class="text-center">
                    <th>NPM</th>
                    <th>Nama</th>
                    <th>Prodi</th>
                    <th>Kepribadian dan Sosial <br>(N1)</th>
                    <th>Laporan Pelaksanaan <br>(N2)</th>
                    <th>RPP <br>(N3)</th>
                    <th>Pembelajaran dan Video <br>(N4)</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($list_mhs_plp_2 as $item_plp_2 => $mhs_plp_2)
                    <tr>
                        <td>{{ $mhs_plp_2->npm }}</td>
                        <td>{{ $mhs_plp_2->JointoMhs->nama_mhs }}</td>
                        <td>{{ $list_prodi[$mhs_plp_2->JointoMhs->program_studi] }}</td>
                        <td class="text-center">
                            @if (empty($mhs_plp_2->JointoRkapAspek))
                                {{ '-' }}
                            @else
                                @foreach ($mhs_plp_2->JointoRkapAspekMany as $key_n1 => $value_n1)
                                    @if ($value_n1->id_pn_aspek == 4)
                                        {{ $value_n1->jumlah_nilai }}
                                    @endif
                                @endforeach
                            @endif
                        </td>
                        <td class="text-center">
                            @if (empty($mhs_plp_2->JointoRkapAspek))
                                {{ '-' }}
                            @else
                                @foreach ($mhs_plp_2->JointoRkapAspekMany as $key_n2 => $value_n2)
                                    @if ($value_n2->id_pn_aspek == 5)
                                        {{ $value_n2->jumlah_nilai }}
                                    @endif
                                @endforeach
                            @endif
                        </td>
                        <td class="text-center">
                            @if (empty($mhs_plp_2->JointoRkapAspek))
                                {{ '-' }}
                            @else
                                @foreach ($mhs_plp_2->JointoRkapAspekMany as $key_n3 => $value_n3)
                                    @if ($value_n3->id_pn_aspek == 6)
                                        {{ $value_n3->jumlah_nilai }}
                                    @endif
                                @endforeach
                            @endif
                        </td>
                        <td class="text-center">
                            @if (empty($mhs_plp_2->JointoRkapAspek))
                                {{ '-' }}
                            @else
                                @foreach ($mhs_plp_2->JointoRkapAspekMany as $key_n4 => $value_n4)
                                    @if ($value_n4->id_pn_aspek == 7)
                                        {{ $value_n4->jumlah_nilai }}
                                    @endif
                                @endforeach
                            @endif
                        </td>
                        <td style="width: 8%">
                            <div class="btn-group-vertical">
                                @if (empty($mhs_plp_2->JointoRkapAspek))
                                    <a href="{{ route('set.nilai.p2', ['id' => $mhs_plp_2->id_penilaian]) }}"
                                        class="btn btn-success btn-sm">Set
                                        Nilai</a>
                                @else
                                    <a href="{{ route('edit.nilai.p2', ['id' => $mhs_plp_2->id_penilaian]) }}"
                                        class="btn btn-warning btn-sm">Edit
                                        Nilai</a>
                                    <a href="{{ route('detail.nilai.p2', ['id' => $mhs_plp_2->id_penilaian]) }}"
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
