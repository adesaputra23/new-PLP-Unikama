@extends('template/template_admin')
@section('conten')
    {{-- secction header --}}
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Mitra Sekolah</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="#">Data Mitra Sekolah</a></li>
                        <li class="breadcrumb-item">Tambah Data Mitra Sekolah</li>
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
                <h3 class="card-title">Tamabah Data Mitra Sekolah</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>

            <form action="{{ route('proses.simpan.sekolah') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="row">

                        {{-- Data Sekolah --}}
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Data Mitra Sekolah</h3>
                                </div>
                                <div class="card-body">

                                    {{-- Kode Sekolah --}}
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-4 col-form-label">Kode Sekolah*</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="kode_sekolah" name="kode_sekolah"
                                                placeholder="Kode Sekolah" required value="{{ old('kode_sekolah') }}"
                                                oninvalid="this.setCustomValidity('Kode Sekolah Tidak Boleh Kosong')"
                                                oninput="this.setCustomValidity('')" />
                                        </div>
                                    </div>

                                    {{-- Nama Sekolah --}}
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-4 col-form-label">Nama Sekolah*</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="nama_sekolah" name="nama_sekolah"
                                                placeholder="Nama Sekolah" value="{{ old('nama_sekolah') }}" required
                                                oninvalid="this.setCustomValidity('Nama Sekolah Tidak Boleh Kosong')"
                                                oninput="this.setCustomValidity('')" />
                                        </div>
                                    </div>

                                    {{-- alamat Sekolah --}}
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-4 col-form-label">Alamat</label>
                                        <div class="col-sm-8">
                                            <textarea class="form-control" id="alamat_sekolah" name="alamat_sekolah"
                                                placeholder="Alamat Sekolah">{{ old('alamat_sekolah') }}</textarea>
                                        </div>
                                    </div>

                                    {{-- status plp --}}
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-4 col-form-label">Jenis PLP</label>
                                        <div class="col-sm-8">
                                            <div class="icheck-primary d-inline">
                                                <input type="checkbox" id="checkboxPrimary1" name="plp_1">
                                                <label for="checkboxPrimary1"></label>PLP I
                                            </div>
                                            <div class="icheck-primary d-inline" style="margin-left: 10%;">
                                                <input type="checkbox" id="checkboxPrimary2" name="plp_2">
                                                <label for="checkboxPrimary2"></label>PLP II
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Kuota PLP 1 --}}
                                    <div class="input-plp-1" style="display: none;">
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-4 col-form-label">Kuota PLP I</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="kuota_plp_1"
                                                    name="kuota_plp_1" placeholder="Kuota PLP I" />
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Kuota PLP 2 --}}
                                    <div class="input-plp-2" style="display: none;">
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-4 col-form-label">Kuota PLP II</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="kuota_plp_2"
                                                    name="kuota_plp_2" placeholder="Kuota PLP II" />
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        {{-- Data Kepala Sekolah --}}
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Data Kepala Sekolah</h3>
                                </div>
                                <div class="card-body">

                                    {{-- NIK/NIDN Kepala Sekolah --}}
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-4 col-form-label">NIK/NIDN*</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="nik" name="nik"
                                                placeholder="NIK/NIDN Kepala Sekolah" required
                                                oninvalid="this.setCustomValidity('NIK/NIDN Kepala Sekolah Tidak Boleh Kosong')"
                                                oninput="this.setCustomValidity('')" value="{{ old('nik') }}" />
                                        </div>
                                    </div>

                                    {{-- Nama Kepala Sekolah --}}
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-4 col-form-label">Nama Kepsek*</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="nama_kepsek" name="nama_kepsek"
                                                placeholder="Nama Kepala Sekolah" required
                                                oninvalid="this.setCustomValidity('Nama Kepala Sekolah Tidak Boleh Kosong')"
                                                oninput="this.setCustomValidity('')" value="{{ old('nama_kepsek') }}" />
                                        </div>
                                    </div>

                                    {{-- jenis Kelamin --}}
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-4 col-form-label">Jenis Kelamin*</label>
                                        <div class="col-sm-8">
                                            <select class="custom-select" name="jenis_kelamin" id="jenis_kelamin" required
                                                oninvalid="this.setCustomValidity('Jenis Kelamin Tidak Boleh Kosong')"
                                                oninput="this.setCustomValidity('')" />
                                            <option value="" selected disabled>Pilih Jenis Kelamin</option>
                                            <option value="1">Laki-Laki</option>
                                            <option value="2">Perempuan</option>
                                            </select>
                                        </div>
                                    </div>

                                    {{-- alamat kepala sekolah --}}
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-4 col-form-label">Alamat</label>
                                        <div class="col-sm-8">
                                            <textarea class="form-control" id="alamat_kepsek" name="alamat_kepsek"
                                                placeholder="Alamat Kepala Sekolah">{{ old('alamat_kepsek') }}</textarea>
                                        </div>
                                    </div>

                                    {{-- No telpon kepala sekolah --}}
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-4 col-form-label">No Hp</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="no_hp" name="no_hp"
                                                placeholder="No Hp Kepala Sekolah" value="{{ old('no_hp') }}" />
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="btn-group float-right">
                        <div style="margin-right: 10px">
                            <button id="add" type="submit" class="btn btn-success">Simpan</button>
                        </div>
                        <div>
                            <button id="res" type="button" class="btn btn-info">Batal</button>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </section>
    {{-- end section conten --}}

    <script>
        $(document).on('change', '#checkboxPrimary1', function() {
            if ($(this).is(':checked') === false) {
                $('.input-plp-1').hide();
            };

            if ($(this).is(':checked') === true) {
                $('.input-plp-1').show();
            };
            // $('.input-plp').hide(html);
        });

        $(document).on('change', '#checkboxPrimary2', function() {
            if ($(this).is(':checked') === false) {
                $('.input-plp-2').hide();
            };

            if ($(this).is(':checked') === true) {
                $('.input-plp-2').show();
            };
            // $('.input-plp').hide(html);
        })
    </script>

@endsection
