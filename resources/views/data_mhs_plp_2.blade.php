<div class="tab-pane fade" id="tab-2" role="tabpanel" aria-labelledby="tab-2-tab">
    <div class="table-responsive">
        <table id="example2" class="table table-bordered table-striped table-sm" style="width:100%">
            <thead>
                <tr>
                    <th width="10%">NPM</th>
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
                @foreach ($list_mhs_plp_2 as $plp_2 => $mhs_plp_2)
                    <tr>
                        <td>{{ $mhs_plp_2->npm }}</td>
                        <td>{{ $mhs_plp_2->nama_mhs }}</td>
                        <td>
                            {{ $list_prodi[$mhs_plp_2->program_studi] }}
                        </td>
                        <td>
                            {{ $list_fakultas[$mhs_plp_2->fakultas] }}
                        </td>
                        <td>
                            {{ $list_kelas[$mhs_plp_2->kelas] }}
                        </td>
                        <td>
                            <div class="text-center">
                                @if ($mhs_plp_2->tgl_pendaftaran != null)
                                    <span class="badge bg-success">Sudah Mendaftar</span>
                                @else
                                    <span class="badge bg-danger">Belum Mendaftar</span>
                                @endif
                            </div>
                        </td>
                        <td>
                            <div class="text-center">
                                @if ($mhs_plp_2->tgl_pembayaran != null)
                                    <span class="badge bg-success">Sudah Membayar</span>
                                @else
                                    <span class="badge bg-danger">Belum Membayar</span>
                                @endif
                            </div>
                        </td>
                        <td>
                            <div class="text-center">
                                @if ($mhs_plp_2->tgl_verifikasi != null)
                                    <span class="badge bg-success">Sudah Verifikasi</span>
                                @else
                                    <span class="badge bg-danger">Belum Virifikasi</span>
                                @endif
                            </div>
                        </td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('form.edit.data.mhs', $mhs_plp_2->npm) }}"
                                    class="btn btn-warning btn-sm">Edit</a>
                                <button type="button" data-toggle="modal" data-target="#hapus-mhs" id="btn-hapus-plp-2"
                                    data-npm="{{ $mhs_plp_2->npm }}" class="btn btn-danger btn-sm">Hapus</button>
                                <a href="{{ route('form.detail.data.mhs', $mhs_plp_2->npm) }}"
                                    class="btn btn-info btn-sm">Detail</a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
