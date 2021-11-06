@php
use App\GuruPamong;
@endphp
<div class="tab-pane fade" id="tab-2" role="tabpanel" aria-labelledby="tab-2-tab">
    <div class="table-responsive">
        <table id="zonasi_2" class="table table-bordered table-striped table-sm">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NPM</th>
                    <th>Nama Mahasiswa</th>
                    @if ($role === 3 || ($role === 4 || $role === 2))
                        <th>Program Studi</th>
                        <th>Fakultas</th>
                    @endif
                    @if ($role == 1)
                        <th>Sekolah</th>
                        <th>Kepala Sekolah</th>
                        <th>DPL</th>
                    @endif
                    @if ($role != 4 && $role != 2)
                        <th>Guru Pamong</th>
                        <th>Status</th>
                    @endif
                    @if ($role == 1)
                        <th>Action</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;
                @endphp
                @foreach ($list_zonasi_plp_2 as $key_plp_2 => $zonasi_plp_2)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $zonasi_plp_2->npm }}</td>
                        <td>{{ $zonasi_plp_2->JointoMhs->nama_mhs }}</td>
                        @if ($role === 3 || $role === 4 || $role === 2)
                            <td>{{ $list_prodi[$zonasi_plp_2->JointoMhs->program_studi] }}</td>
                            <td>{{ $list_fakultas[$zonasi_plp_2->JointoMhs->fakultas] }}</td>
                        @endif
                        @if ($role == 1)
                            <td>{{ $zonasi_plp_2->JointoMitraSekolah->nama_sekolah }}</td>
                            <td>{{ $zonasi_plp_2->JointoMitraSekolah->JointoKepsek->nama_kepsek }}</td>
                            <td>
                                @if (empty($zonasi_plp_2->JointoDpl->nama_dpl))
                                    {{-- select dpl --}}
                                    <div class="form-group">
                                        <select class="custom-select" name="dpl_plp_2" id="dpl_plp_2"
                                            data-npm_plp_2="{{ $zonasi_plp_2->npm }}" />
                                        <option value="" selected disabled>Pilih DPL</option>
                                        @foreach ($list_dpl as $key_dpl => $dpl)
                                            <option value="{{ $dpl->id_dpl }}">
                                                {{ $dpl->nik . ' - ' . $dpl->nama_dpl }}
                                            </option>
                                        @endforeach
                                        </select>
                                    </div>
                                @else
                                    {{ $zonasi_plp_2->JointoDpl->nama_dpl }}
                                @endif
                            </td>
                        @endif
                        @if ($role !== 4 && $role !== 2)
                            <td>
                                @if (empty($zonasi_plp_2->JointoGuruPamong->nama_guru_pamong))
                                    @php
                                        $get_id_kepsek = $zonasi_plp_2->JointoMitraSekolah->JointoKepsek->id_kepsek;
                                        $list_guru_pamong = GuruPamong::where('id_kepsek', $get_id_kepsek)->get();
                                    @endphp
                                    {{-- select guru pamong --}}
                                    <div class="form-group">
                                        <select class="custom-select" name="guru_pamong_plp_2" id="guru_pamong_plp_2"
                                            data-npm_plp_2="{{ $zonasi_plp_2->npm }}" />
                                        <option value="" selected disabled>Pilih Guru Pamong</option>
                                        @foreach ($list_guru_pamong as $key_gp => $guru_pamong)
                                            <option value="{{ $guru_pamong->id_guru_pamong }}">
                                                {{ $guru_pamong->nik . ' - ' . $guru_pamong->nama_guru_pamong }}
                                            </option>
                                        @endforeach
                                        </select>
                                    </div>
                                @else
                                    {{ $zonasi_plp_2->JointoGuruPamong->nama_guru_pamong }}
                                @endif
                            </td>
                        @endif
                        @if ($role == 1)
                            <td>
                                <div class="text-center">
                                    @if (!empty($zonasi_plp_2->id_dpl && !empty($zonasi_plp_2->id_guru_pamong)))
                                        <span class="badge bg-success">Selesai</span>
                                    @else
                                        <span class="badge bg-danger">Proses</span>
                                    @endif
                                </div>
                            </td>
                        @else
                            @if ($role != 4 && $role != 2)
                                <td>
                                    <div class="text-center">
                                        @if (!empty($zonasi_plp_2->id_guru_pamong))
                                            <span class="badge bg-success">Selesai</span>
                                        @else
                                            <span class="badge bg-danger">Proses</span>
                                        @endif
                                    </div>
                                </td>
                            @endif
                        @endif
                        @if ($role == 1)
                            <td>
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                    id="btn-hapus-plp-2" data-npm2="{{ $zonasi_plp_2->npm }}"
                                    data-target="#hapus-mhs">Hapus</button>
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
