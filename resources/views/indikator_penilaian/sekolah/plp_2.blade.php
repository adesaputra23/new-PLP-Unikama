<div class="tab-pane fade" id="custom-content-below-profile" role="tabpanel"
    aria-labelledby="custom-content-below-profile-tab">
    <div class="row mt-2">
        <div class="col-5 col-sm-3">
            <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
                <a class="nav-link active" id="vert-tabs-1-tab" data-toggle="pill" href="#vert-tabs-1" role="tab"
                    aria-controls="vert-tabs-1" aria-selected="true">Kepribadian dan Sosial (N1)</a>
                <a class="nav-link" id="vert-tabs-2-tab" data-toggle="pill" href="#vert-tabs-2" role="tab"
                    aria-controls="vert-tabs-2" aria-selected="false">Laporan Pelaksanaan (N2)</a>
                <a class="nav-link" id="vert-tabs-3-tab" data-toggle="pill" href="#vert-tabs-3" role="tab"
                    aria-controls="vert-tabs-3" aria-selected="false">RPP (N3)</a>
                <a class="nav-link" id="vert-tabs-4-tab" data-toggle="pill" href="#vert-tabs-4" role="tab"
                    aria-controls="vert-tabs-4" aria-selected="false">Pembelajaran dan Video (N4)</a>
            </div>
        </div>
        <div class="col-7 col-sm-9">
            <div class="tab-content" id="vert-tabs-tabContent">
                <div class="tab-pane text-left fade show active" id="vert-tabs-1" role="tabpanel"
                    aria-labelledby="vert-tabs-1-tab">
                    <div class="mt-2 mb-2">
                        <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#modal-default"
                            id="tambah-indikator-n1-p2">Tambah
                            Indikator</button>
                    </div>
                    <table class="table table-bordered table-striped table-sm">
                        <thead class="text-center">
                            <tr>
                                <th>INDIKATOR</th>
                                <th>NILAI</th>
                                <th>CREATED</th>
                                <th>UPDATED</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($list_inidkator_n1_p2 as $item_n1_p2 => $indikator_n1_p2)
                                <tr>
                                    <td>{{ $indikator_n1_p2->nama_indikator }}</td>
                                    <th class="text-center">{{ $indikator_n1_p2->jumlah_nilai }}</th>
                                    <td class="text-center">{{ $indikator_n1_p2->created_at }}</td>
                                    <td class="text-center">{{ $indikator_n1_p2->updted_at ?? '-' }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <button class="btn btn-warning btn-sm" data-toggle="modal"
                                                data-target="#modal-default"
                                                data-id_n3_p1="{{ $indikator_n1_p2->id_indikator_pn }}"
                                                id="ubah-n1-p1">Ubah</button>
                                            @if (empty($indikator_n1_p2->PnRkapIndikator))
                                                <button class="btn btn-danger btn-sm" data-toggle="modal"
                                                    data-target="#modal-default" id="hapus-n1-p1"
                                                    data-id_n3_p1="{{ $indikator_n1_p2->id_indikator_pn }}">Hapus</button>
                                            @else
                                                <button class="btn btn-danger btn-sm" data-toggle="modal"
                                                    data-target="#modal-default" id="non-hapus-n1-p1">Hapus</button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="vert-tabs-2" role="tabpanel" aria-labelledby="vert-tabs-2-tab">
                    <div class="mt-2 mb-2">
                        <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#modal-default"
                            id="tambah-indikator-n2-p2">Tambah
                            Indikator</button>
                    </div>
                    <table class="table table-bordered table-striped table-sm">
                        <thead class="text-center">
                            <tr>
                                <th>INDIKATOR</th>
                                <th>NILAI</th>
                                <th>CREATED</th>
                                <th>UPDATED</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($list_inidkator_n2_p2 as $item_n2_p2 => $indikator_n2_p2)
                                <tr>
                                    <td>{{ $indikator_n2_p2->nama_indikator }}</td>
                                    <th class="text-center">{{ $indikator_n2_p2->jumlah_nilai }}</th>
                                    <td class="text-center">{{ $indikator_n2_p2->created_at }}</td>
                                    <td class="text-center">{{ $indikator_n2_p2->updted_at ?? '-' }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <button class="btn btn-warning btn-sm" data-toggle="modal"
                                                data-target="#modal-default"
                                                data-id_n3_p1="{{ $indikator_n2_p2->id_indikator_pn }}"
                                                id="ubah-n1-p1">Ubah</button>
                                            @if (empty($indikator_n2_p2->PnRkapIndikator))
                                                <button class="btn btn-danger btn-sm" data-toggle="modal"
                                                    data-target="#modal-default" id="hapus-n1-p1"
                                                    data-id_n3_p1="{{ $indikator_n2_p2->id_indikator_pn }}">Hapus</button>
                                            @else
                                                <button class="btn btn-danger btn-sm" data-toggle="modal"
                                                    data-target="#modal-default" id="non-hapus-n1-p1">Hapus</button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="vert-tabs-3" role="tabpanel" aria-labelledby="vert-tabs-3-tab">
                    <div class="mt-2 mb-2">
                        <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#modal-default"
                            id="tambah-indikator-n3-p2">Tambah
                            Indikator</button>
                    </div>
                    <table class="table table-bordered table-striped table-sm">
                        <thead class="text-center">
                            <tr>
                                <th>INDIKATOR</th>
                                <th>NILAI</th>
                                <th>CREATED</th>
                                <th>UPDATED</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($list_inidkator_n3_p2 as $item_n3_p2 => $indikator_n3_p2)
                                <tr>
                                    <td>{{ $indikator_n3_p2->nama_indikator }}</td>
                                    <th class="text-center">{{ $indikator_n3_p2->jumlah_nilai }}</th>
                                    <td class="text-center">{{ $indikator_n3_p2->created_at }}</td>
                                    <td class="text-center">{{ $indikator_n3_p2->updted_at ?? '-' }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <button class="btn btn-warning btn-sm" data-toggle="modal"
                                                data-target="#modal-default"
                                                data-id_n3_p1="{{ $indikator_n3_p2->id_indikator_pn }}"
                                                id="ubah-n1-p1">Ubah</button>
                                            @if (empty($indikator_n3_p2->PnRkapIndikator))
                                                <button class="btn btn-danger btn-sm" data-toggle="modal"
                                                    data-target="#modal-default" id="hapus-n1-p1"
                                                    data-id_n3_p1="{{ $indikator_n3_p2->id_indikator_pn }}">Hapus</button>
                                            @else
                                                <button class="btn btn-danger btn-sm" data-toggle="modal"
                                                    data-target="#modal-default" id="non-hapus-n1-p1">Hapus</button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="vert-tabs-4" role="tabpanel" aria-labelledby="vert-tabs-4-tab">
                    <div class="mt-2 mb-2">
                        <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#modal-default"
                            id="tambah-indikator-n4-p2">Tambah
                            Indikator</button>
                    </div>
                    <table class="table table-bordered table-striped table-sm">
                        <thead class="text-center">
                            <tr>
                                <th>INDIKATOR</th>
                                <th>NILAI</th>
                                <th>CREATED</th>
                                <th>UPDATED</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($list_inidkator_n4_p2 as $item_n4_p2 => $indikator_n4_p2)
                                <tr>
                                    <td>{{ $indikator_n4_p2->nama_indikator }}</td>
                                    <th class="text-center">{{ $indikator_n4_p2->jumlah_nilai }}</th>
                                    <td class="text-center">{{ $indikator_n4_p2->created_at }}</td>
                                    <td class="text-center">{{ $indikator_n4_p2->updted_at ?? '-' }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <button class="btn btn-warning btn-sm" data-toggle="modal"
                                                data-target="#modal-default"
                                                data-id_n3_p1="{{ $indikator_n4_p2->id_indikator_pn }}"
                                                id="ubah-n1-p1">Ubah</button>
                                            @if (empty($indikator_n4_p2->PnRkapIndikator))
                                                <button class="btn btn-danger btn-sm" data-toggle="modal"
                                                    data-target="#modal-default" id="hapus-n1-p1"
                                                    data-id_n3_p1="{{ $indikator_n4_p2->id_indikator_pn }}">Hapus</button>
                                            @else
                                                <button class="btn btn-danger btn-sm" data-toggle="modal"
                                                    data-target="#modal-default" id="non-hapus-n1-p1">Hapus</button>
                                            @endif
                                        </div>
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
