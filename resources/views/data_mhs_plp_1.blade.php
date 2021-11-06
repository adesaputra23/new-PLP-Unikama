<div class="tab-pane fade show active" id="tab-1" role="tabpanel" aria-labelledby="tab-1-tab">
    <div class="table-responsive">
        <table id="example1" class="table table-bordered table-striped table-sm">
            <thead>
                <tr>
                    <th>NPM</th>
                    <th>Nama</th>
                    <th>Prodi</th>
                    <th>Fakultas</th>
                    <th>Kelas</th>
                    <th>Status Pendaftaran</th>
                    <th>Status Pembayaran</th>
                    <th>Status Verifikasi</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($list_mhs_plp_1 as $item => $mhs_plp_1)
                    <tr>
                        <td>{{ $mhs_plp_1->npm }}</td>
                        <td>{{ $mhs_plp_1->nama_mhs }}</td>
                        <td>
                            {{ $list_prodi[$mhs_plp_1->program_studi] }}
                        </td>
                        <td>
                            {{ $list_fakultas[$mhs_plp_1->fakultas] }}
                        </td>
                        <td>
                            {{ $list_kelas[$mhs_plp_1->kelas] }}
                        </td>
                        <td>
                            <div class="text-center">
                                @if ($mhs_plp_1->tgl_pendaftaran != null)
                                    <span class="badge bg-success">Sudah Mendaftar</span>
                                @else
                                    <span class="badge bg-danger">Belum Mendaftar</span>
                                @endif
                            </div>
                        </td>
                        <td>
                            <div class="text-center">
                                @if ($mhs_plp_1->tgl_pembayaran != null)
                                    <span class="badge bg-success">Sudah Membayar</span>
                                @else
                                    <span class="badge bg-danger">Belum Membayar</span>
                                @endif
                            </div>
                        </td>
                        <td>
                            <div class="text-center">
                                @if ($mhs_plp_1->tgl_verifikasi != null)
                                    <span class="badge bg-success">Sudah Verifikasi</span>
                                @else
                                    <span class="badge bg-danger">Belum Virifikasi</span>
                                @endif
                            </div>
                        </td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('form.edit.data.mhs', $mhs_plp_1->npm) }}"
                                    class="btn btn-warning btn-sm">Edit</a>
                                <button type="button" data-toggle="modal" data-target="#hapus-mhs" id="btn-hapus-plp-1"
                                    data-npm="{{ $mhs_plp_1->npm }}" class="btn btn-danger btn-sm">Hapus</button>
                                <a href="{{ route('form.detail.data.mhs', $mhs_plp_1->npm) }}"
                                    class="btn btn-info btn-sm">Detail</a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
