@extends('template/template_admin')
@section('conten')
    {{-- secction header --}}
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Detail Data Mahasiswa</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('data.mhs') }}">Data Mahasiswa</a></li>
                        <li class="breadcrumb-item">Detail Data Mahasiswa</li>
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
                <h3 class="card-title">Detail Data Mahasiswa</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>

            <div class="card-body">
                <div class="info-box bg-light">
                    <div class="info-box-content">
                        <div class="row" style="margin-left: 2%">
                            <div class="col-md-4">
                                <p>NPM</p>
                                <p>Nama Mahasiswa</p>
                                <p>Program Studi</p>
                                <p>Fakultas</p>
                                <p>Jenis PLP</p>
                                <p>Status Pendaftaran</p>
                                <p>Status Pembayaran</p>
                                <p>Jenis Verifikasi</p>
                                <p>Angkatan</p>
                                <p>IPK</p>
                                <p>Kelas</p>
                                <p>Jenis Kelamin</p>
                                <p>Alamat</p>
                                <p>No Hp</p>
                            </div>
                            <div class="col-md-8">
                                <p>: {{ $get_mhs->npm }}</p>
                                <p>: {{ $get_mhs->nama_mhs }}</p>
                                <p>: {{ $list_prodi[$get_mhs->program_studi] }}</p>
                                <p>: {{ $list_fakultas[$get_mhs->fakultas] }}</p>
                                <p>: {{ $list_plp[$get_mhs->jenis_plp] }}</p>
                                <p>:
                                    @if ($get_mhs->tgl_pendaftaran != null)
                                        <span class="badge bg-success">Sudah Mendaftar</span>
                                        <button class="text-danger text-sm text-center" data-toggle="modal"
                                            data-target="#set-pendaftran" id="btn-dftr"
                                            data-npm_dftr="{{ $get_mhs->npm }}"
                                            data-nama_dftr="{{ $get_mhs->nama_mhs }}"
                                            data-prodi_dftr="{{ $list_prodi[$get_mhs->program_studi] }}"
                                            data-fakultas_dftr="{{ $list_fakultas[$get_mhs->fakultas] }}"
                                            data-jenis_plp_dftr="{{ $list_plp[$get_mhs->jenis_plp] }}"
                                            style="background-color: Transparent; border: none;">&nbsp;&nbsp;
                                            <i class="fas fa-cog"></i> Set Pendaftaran</button>
                                    @else
                                        <span class="badge bg-danger">Belum Mendaftar</span>
                                        <button class="text-danger text-sm text-center" data-toggle="modal"
                                            data-target="#set-pendaftran" id="btn-dftr"
                                            data-npm_dftr="{{ $get_mhs->npm }}"
                                            data-nama_dftr="{{ $get_mhs->nama_mhs }}"
                                            data-prodi_dftr="{{ $list_prodi[$get_mhs->program_studi] }}"
                                            data-fakultas_dftr="{{ $list_fakultas[$get_mhs->fakultas] }}"
                                            data-jenis_plp_dftr="{{ $list_plp[$get_mhs->jenis_plp] }}"
                                            style="background-color: Transparent; border: none;">&nbsp;&nbsp;
                                            <i class="fas fa-cog"></i> Set Pendaftaran</button>
                                    @endif
                                </p>
                                <p>:
                                    @if ($get_mhs->tgl_pembayaran != null)
                                        <span class="badge bg-success">Sudah Membayar</span>
                                        <button class="text-danger text-sm text-center" data-toggle="modal"
                                            data-target="#set-pembayaran" id="btn-pmyrn"
                                            data-npm_pmyrn="{{ $get_mhs->npm }}"
                                            data-nama_pmyrn="{{ $get_mhs->nama_mhs }}"
                                            data-prodi_pmyrn="{{ $list_prodi[$get_mhs->program_studi] }}"
                                            data-fakultas_pmyrn="{{ $list_fakultas[$get_mhs->fakultas] }}"
                                            data-jenis_plp_pmyrn="{{ $list_plp[$get_mhs->jenis_plp] }}"
                                            style="background-color: Transparent; border: none;">&nbsp;&nbsp;<i
                                                class="fas fa-cog"></i> Set Pembayaran</button>
                                    @else
                                        <span class="badge bg-danger">Belum Membayar</span>
                                        <button class="text-danger text-sm text-center" data-toggle="modal"
                                            data-target="#set-pembayaran" id="btn-pmyrn"
                                            data-npm_pmyrn="{{ $get_mhs->npm }}"
                                            data-nama_pmyrn="{{ $get_mhs->nama_mhs }}"
                                            data-prodi_pmyrn="{{ $list_prodi[$get_mhs->program_studi] }}"
                                            data-fakultas_pmyrn="{{ $list_fakultas[$get_mhs->fakultas] }}"
                                            data-jenis_plp_pmyrn="{{ $list_plp[$get_mhs->jenis_plp] }}"
                                            style="background-color: Transparent; border: none;">&nbsp;&nbsp;<i
                                                class="fas fa-cog"></i> Set Pembayaran</button>
                                    @endif
                                </p>
                                <p>:
                                    @if ($get_mhs->tgl_verifikasi != null)
                                        <span class="badge bg-success">Sudah Verifikasi</span>
                                        <button class="text-danger text-sm text-center" data-toggle="modal"
                                            data-target="#set-verifikasi" id="btn-verif"
                                            data-npm_verif="{{ $get_mhs->npm }}"
                                            data-nama_verif="{{ $get_mhs->nama_mhs }}"
                                            data-prodi_verif="{{ $list_prodi[$get_mhs->program_studi] }}"
                                            data-fakultas_verif="{{ $list_fakultas[$get_mhs->fakultas] }}"
                                            data-jenis_plp_verif="{{ $list_plp[$get_mhs->jenis_plp] }}"
                                            style="background-color: Transparent; border: none;">&nbsp;&nbsp;<i
                                                class="fas fa-cog"></i> Set Verifikasi</button>
                                    @else
                                        <span class="badge bg-danger">Belum Verifikasi</span>
                                        <button class="text-danger text-sm text-center" data-toggle="modal"
                                            data-target="#set-verifikasi" id="btn-verif"
                                            data-npm_verif="{{ $get_mhs->npm }}"
                                            data-nama_verif="{{ $get_mhs->nama_mhs }}"
                                            data-prodi_verif="{{ $list_prodi[$get_mhs->program_studi] }}"
                                            data-fakultas_verif="{{ $list_fakultas[$get_mhs->fakultas] }}"
                                            data-jenis_plp_verif="{{ $list_plp[$get_mhs->jenis_plp] }}"
                                            style="background-color: Transparent; border: none;">&nbsp;&nbsp;<i
                                                class="fas fa-cog"></i> Set Verifikasi</button>
                                    @endif
                                </p>
                                <p>: {{ $get_mhs->angkatan }}</p>
                                <p>: {{ $get_mhs->ipk }}</p>
                                <p>: {{ $list_kelas[$get_mhs->kelas] }}</p>
                                <p>: {{ $list_jenis_kelamin[$get_mhs->jenis_kelamin] }}</p>
                                <p>: {{ $get_mhs->alamat }}</p>
                                <p>: {{ $get_mhs->no_hp }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- end section conten --}}

    {{-- modal seting pendaftaran data mahasiswa --}}
    <div class="modal fade" id="set-pendaftran">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fas fa-cog"></i> Seting Pendaftaran</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('proses.set.pendaftrana.mhs') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        {{-- NPM --}}
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-4 col-form-label">NPM*</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control form-control-sm" id="npm_dftr" name="npm"
                                    readonly />
                            </div>
                        </div>

                        {{-- Nama --}}
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-4 col-form-label">Nama Mahasiswa*</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control form-control-sm" id="nama_dftr" name="nama"
                                    readonly />
                            </div>
                        </div>

                        {{-- Program Studi --}}
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-4 col-form-label">Program Studi*</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control form-control-sm" id="prodi_dftr" name="prodi"
                                    readonly />
                            </div>
                        </div>

                        {{-- Fakultas --}}
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-4 col-form-label">Fakultas*</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control form-control-sm" id="fakultas_dftr" name="fakultas"
                                    readonly />
                            </div>
                        </div>

                        {{-- Janis PLP --}}
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-4 col-form-label">Jenis PLP*</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control form-control-sm" id="jenis_plp_dftr" name="jenis_plp"
                                    readonly />
                            </div>
                        </div>

                        {{-- Tanggal Pendaftaran --}}
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-4 col-form-label">Tanggal*</label>
                            <div class="col-sm-8">
                                <input type="date" class="form-control form-control-sm" id="tgl_pendaftran"
                                    name="tgl_pendaftran" value="" />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Simpan</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- modal seting pembayaran data mahasiswa --}}
    <div class="modal fade" id="set-pembayaran">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fas fa-cog"></i> Seting Pembayaran</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('proses.set.pembayaran.mhs') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        {{-- NPM --}}
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-4 col-form-label">NPM*</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control form-control-sm" id="npm_pmyrn" name="npm"
                                    readonly />
                            </div>
                        </div>

                        {{-- Nama --}}
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-4 col-form-label">Nama Mahasiswa*</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control form-control-sm" id="nama_pmyrn" name="nama"
                                    readonly />
                            </div>
                        </div>

                        {{-- Program Studi --}}
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-4 col-form-label">Program Studi*</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control form-control-sm" id="prodi_pmyrn" name="prodi"
                                    readonly />
                            </div>
                        </div>

                        {{-- Fakultas --}}
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-4 col-form-label">Fakultas*</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control form-control-sm" id="fakultas_pmyrn" name="fakultas"
                                    readonly />
                            </div>
                        </div>

                        {{-- Janis PLP --}}
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-4 col-form-label">Jenis PLP*</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control form-control-sm" id="jenis_plp_pmyrn"
                                    name="jenis_plp" readonly />
                            </div>
                        </div>

                        {{-- file upload --}}
                        <div class="form-group row">
                            <label for="exampleInputFile" class="col-sm-4 col-form-label">Bukti Pembayaran*</label>
                            <div class="input-group col-sm-8">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="bukti_bayar" name="bukti_bayar" />
                                    <label class="custom-file-label" for="exampleInputFile">Browse</label>
                                </div>
                            </div>
                            <small style="margin-left: 35%">
                                <p><span class="badge bg-info">Node* : type file (<i>jpeg, jpg, png</i>) max : 2 mb</span>
                                </p>
                            </small>
                            <br>
                            <small style="margin-left: 35%; margin-top: -4%">
                                <p class="name_file"></p>
                            </small>
                        </div>

                        {{-- tanggal pembyaran --}}
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-4 col-form-label">Tanggal*</label>
                            <div class="col-sm-8">
                                <input type="date" class="form-control form-control-sm" id="tgl_pembayaran"
                                    name="tgl_pembayaran" value="" />
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Simpan</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- modal seting verifikasi data mahasiswa --}}
    <div class="modal fade" id="set-verifikasi">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fas fa-cog"></i> Seting Verifikasi</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('proses.set.verifikasi.mhs') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        {{-- NPM --}}
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-4 col-form-label">NPM*</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control form-control-sm" id="npm_verif" name="npm"
                                    readonly />
                            </div>
                        </div>

                        {{-- Nama --}}
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-4 col-form-label">Nama Mahasiswa*</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control form-control-sm" id="nama_verif" name="nama"
                                    readonly />
                            </div>
                        </div>

                        {{-- Program Studi --}}
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-4 col-form-label">Program Studi*</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control form-control-sm" id="prodi_verif" name="prodi"
                                    readonly />
                            </div>
                        </div>

                        {{-- Fakultas --}}
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-4 col-form-label">Fakultas*</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control form-control-sm" id="fakultas_verif" name="fakultas"
                                    readonly />
                            </div>
                        </div>

                        {{-- Janis PLP --}}
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-4 col-form-label">Jenis PLP*</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control form-control-sm" id="jenis_plp_verif"
                                    name="jenis_plp" readonly />
                            </div>
                        </div>

                        {{-- Tanggal Pendaftaran --}}
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-4 col-form-label">Tanggal*</label>
                            <div class="col-sm-8">
                                <input type="date" class="form-control form-control-sm" id="tgl_verif" name="tgl_verif"
                                    value="" />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Simpan</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).on('click', '#btn-dftr', function() {
            var npm_dftr = $(this).data('npm_dftr');
            var nama_dftr = $(this).data('nama_dftr');
            var prodi_dftr = $(this).data('prodi_dftr');
            var fakultas_dftr = $(this).data('fakultas_dftr');
            var jenis_plp_dftr = $(this).data('jenis_plp_dftr');
            $('#npm_dftr').val(npm_dftr);
            $('#nama_dftr').val(nama_dftr);
            $('#prodi_dftr').val(prodi_dftr);
            $('#fakultas_dftr').val(fakultas_dftr);
            $('#jenis_plp_dftr').val(jenis_plp_dftr);
        });

        $(document).on('click', '#btn-pmyrn', function() {
            var npm_pmyrn = $(this).data('npm_pmyrn');
            var nama_pmyrn = $(this).data('nama_pmyrn');
            var prodi_pmyrn = $(this).data('prodi_pmyrn');
            var fakultas_pmyrn = $(this).data('fakultas_pmyrn');
            var jenis_plp_pmyrn = $(this).data('jenis_plp_pmyrn');
            $('#npm_pmyrn').val(npm_pmyrn);
            $('#nama_pmyrn').val(nama_pmyrn);
            $('#prodi_pmyrn').val(prodi_pmyrn);
            $('#fakultas_pmyrn').val(fakultas_pmyrn);
            $('#jenis_plp_pmyrn').val(jenis_plp_pmyrn);

            $(document).on('change', '#bukti_bayar', function() {
                var bukti_bayar = $('#bukti_bayar').prop('files')[0];
                $('.name_file').html('<span class="badge bg-warning">' + bukti_bayar.name + '</span>');
            })
        });

        $(document).on('click', '#btn-verif', function() {
            var npm_verif = $(this).data('npm_verif');
            var nama_verif = $(this).data('nama_verif');
            var prodi_verif = $(this).data('prodi_verif');
            var fakultas_verif = $(this).data('fakultas_verif');
            var jenis_plp_verif = $(this).data('jenis_plp_verif');
            $('#npm_verif').val(npm_verif);
            $('#nama_verif').val(nama_verif);
            $('#prodi_verif').val(prodi_verif);
            $('#fakultas_verif').val(fakultas_verif);
            $('#jenis_plp_verif').val(jenis_plp_verif);
        });
    </script>

@endsection
