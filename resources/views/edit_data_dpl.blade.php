@extends('template/template_admin')
@section('conten')
    {{-- secction header --}}
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data DPL</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="#">Data DPL</a></li>
                        <li class="breadcrumb-item">Tambah Data DPL</li>
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
                <h3 class="card-title">TambahData DPL</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>

            <form action="{{ route('proses.edit.dpl', ['id_dpl' => $get_dpl->id_dpl]) }}" method="POST">
                @csrf
                <div class="card-body">
                    {{-- NIK/NIDN DPL --}}
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">NIK/NIDN*</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nik" name="nik" value="{{ $get_dpl->nik }}"
                                readonly />
                        </div>
                    </div>
                    {{-- Nama DPL --}}
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Nama DPL*</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama_dpl" name="nama_dpl"
                                value="{{ $get_dpl->nama_dpl }}" placeholder="Nama DPL" required
                                oninvalid="this.setCustomValidity('Nama DPL Tidak Boleh Kosong')" />
                        </div>
                    </div>
                    {{-- jenis Kelamin --}}
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Jenis Kelamin*</label>
                        <div class="col-sm-10">
                            <select class="custom-select" name="jenis_kelamin" id="jenis_kelamin" required
                                oninvalid="this.setCustomValidity('Jenis Kelamin Tidak Boleh Kosong')"
                                oninput="this.setCustomValidity('')" />
                            <option value="1" {{ $get_dpl->jenis_kelamin == '1' ? 'selected' : '' }}>Laki-Laki</option>
                            <option value="2" {{ $get_dpl->jenis_kelamin == '2' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>
                    </div>
                    {{-- program studi --}}
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Program Studi*</label>
                        <div class="col-sm-10">
                            <select class="custom-select" name="prodi" id="prodi" required
                                oninvalid="this.setCustomValidity('Program Studi Tidak Boleh Kosong')"
                                oninput="this.setCustomValidity('')" />
                            <option value="" selected disabled>Pilih Program Studi</option>
                            @foreach ($list_prodi as $prodi_key => $prodi)
                                <option value="{{ $prodi_key }}"
                                    {{ $prodi_key == $get_dpl->program_studi ? 'selected' : '' }}>{{ $prodi }}
                                </option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                    {{-- fakultas --}}
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Fakultas*</label>
                        <div class="col-sm-10">
                            <select class="custom-select" name="fakultas" id="fakultas" required
                                oninvalid="this.setCustomValidity('Fakultas Tidak Boleh Kosong')"
                                oninput="this.setCustomValidity('')" />
                            <option value="" selected disabled>Pilih Fakultas</option>
                            @foreach ($list_fakultas as $fakultas_key => $fakultas)
                                <option value="{{ $fakultas_key }}"
                                    {{ $fakultas_key == $get_dpl->fakultas ? 'selected' : '' }}>{{ $fakultas }}
                                </option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                    {{-- alamat --}}
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Alamat</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" id="alamat" name="alamat"
                                placeholder="Alamat">{{ $get_dpl->alamat }}</textarea>
                        </div>
                    </div>
                    {{-- no hp --}}
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">No Hp</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="no_hp" name="no_hp" placeholder="No Hp"
                                value="{{ $get_dpl->no_telpon }}">
                        </div>
                    </div>

                    <div class="btn-group float-right">
                        <div style="margin-right: 10px">
                            <button id="add" type="submit" class="btn btn-success">Simpan</button>
                        </div>
                        <div>
                            <button id="res" type="button" class="btn btn-danger">Batal</button>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </section>
    {{-- end section conten --}}

@endsection
