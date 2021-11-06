<div class="tab-pane fade show active" id="custom-content-below-home" role="tabpanel"
    aria-labelledby="custom-content-below-home-tab">

    <div class="row mt-2">
        <div class="col-4 col-sm-3">
            <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
                <a class="nav-link active" id="vert-tabs-home-tab" data-toggle="pill" href="#vert-tabs-home" role="tab"
                    aria-controls="vert-tabs-home" aria-selected="true">Keaktifan (N1)</a>
                <a class="nav-link" id="vert-tabs-profile-tab" data-toggle="pill" href="#vert-tabs-profile"
                    role="tab" aria-controls="vert-tabs-profile" aria-selected="false">Laporan Pelaksanaan (N2)</a>
                <a class="nav-link" id="vert-tabs-messages-tab" data-toggle="pill" href="#vert-tabs-messages"
                    role="tab" aria-controls="vert-tabs-messages" aria-selected="false">Kemampuan Personal-Sosial
                    (N3)</a>
            </div>
        </div>
        <div class="col-8 col-sm-9">
            <div class="tab-content" id="vert-tabs-tabContent">
                <div class="tab-pane text-left fade show active" id="vert-tabs-home" role="tabpanel"
                    aria-labelledby="vert-tabs-home-tab">
                    <div class="mt-2 mb-2">
                        <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#modal-default"
                            id="tambah-indikator-n1-p1">Tambah
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
                            @foreach ($list_inidkator_n1_p1 as $item_n1_p1 => $inidkator_n1_p1)
                                <tr>
                                    <td>{{ $inidkator_n1_p1->nama_indikator }}</td>
                                    <th class="text-center">{{ $inidkator_n1_p1->jumlah_nilai }}</th>
                                    <td class="text-center">{{ $inidkator_n1_p1->created_at }}</td>
                                    <td class="text-center">{{ $inidkator_n1_p1->updted_at ?? '-' }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <button class="btn btn-warning btn-sm" data-toggle="modal"
                                                data-target="#modal-default"
                                                data-id_n1_p1="{{ $inidkator_n1_p1->id_indikator_pn }}"
                                                id="ubah-n1-p1">Ubah</button>
                                            @if (empty($inidkator_n1_p1->PnRkapIndikator))
                                                <button class="btn btn-danger btn-sm" data-toggle="modal"
                                                    data-target="#modal-default" id="hapus-n1-p1"
                                                    data-id_n1_p1="{{ $inidkator_n1_p1->id_indikator_pn }}">Hapus</button>
                                            @else
                                                <button class="btn btn-danger btn-sm" id="non-hapus-n1-p1"
                                                    data-toggle="modal" data-target="#modal-default">Hapus</button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="vert-tabs-profile" role="tabpanel"
                    aria-labelledby="vert-tabs-profile-tab">
                    <div class="mt-2 mb-2">
                        <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#modal-default"
                            id="tambah-indikator-n2-p1">Tambah
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
                            @foreach ($list_inidkator_n2_p1 as $item_n2_p1 => $inidkator_n2_p1)
                                <tr>
                                    <td>{{ $inidkator_n2_p1->nama_indikator }}</td>
                                    <th class="text-center">{{ $inidkator_n2_p1->jumlah_nilai }}</th>
                                    <td class="text-center">{{ $inidkator_n2_p1->created_at }}</td>
                                    <td class="text-center">{{ $inidkator_n2_p1->updted_at ?? '-' }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <button class="btn btn-warning btn-sm" data-toggle="modal"
                                                data-target="#modal-default"
                                                data-id_n2_p1="{{ $inidkator_n2_p1->id_indikator_pn }}"
                                                id="ubah-n1-p1">Ubah</button>
                                            @if (empty($inidkator_n2_p1->PnRkapIndikator))
                                                <button class="btn btn-danger btn-sm" data-toggle="modal"
                                                    data-target="#modal-default" id="hapus-n1-p1"
                                                    data-id_n2_p1="{{ $inidkator_n2_p1->id_indikator_pn }}">Hapus</button>
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
                <div class="tab-pane fade" id="vert-tabs-messages" role="tabpanel"
                    aria-labelledby="vert-tabs-messages-tab">
                    <div class="mt-2 mb-2">
                        <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#modal-default"
                            id="tambah-indikator-n3-p1">Tambah
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
                            @foreach ($list_inidkator_n3_p1 as $item_n3_p1 => $inidkator_n3_p1)
                                <tr>
                                    <td>{{ $inidkator_n3_p1->nama_indikator }}</td>
                                    <th class="text-center">{{ $inidkator_n3_p1->jumlah_nilai }}</th>
                                    <td class="text-center">{{ $inidkator_n3_p1->created_at }}</td>
                                    <td class="text-center">{{ $inidkator_n3_p1->updated_at ?? '-' }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <button class="btn btn-warning btn-sm" data-toggle="modal"
                                                data-target="#modal-default"
                                                data-id_n3_p1="{{ $inidkator_n3_p1->id_indikator_pn }}"
                                                id="ubah-n1-p1">Ubah</button>
                                            @if (empty($inidkator_n3_p1->PnRkapIndikator))
                                                <button class="btn btn-danger btn-sm" data-toggle="modal"
                                                    data-target="#modal-default" id="hapus-n1-p1"
                                                    data-id_n3_p1="{{ $inidkator_n3_p1->id_indikator_pn }}">Hapus</button>
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
