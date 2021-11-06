@extends('template/template_admin')
@section('conten')
    {{-- secction header --}}
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Data Guru Pamong</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="">Data Guru Pamong</a></li>
                        <li class="breadcrumb-item">Edit Data Guru Pamong</li>
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
                <h3 class="card-title">Edit Data Guru Pamong</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

            </div>

            {{-- {{ route('proses.simpan.guru.pamong') }} --}}
            <form action="{{ route('proses.simpan.guru.pamong') }}" method="POST">
                @csrf
                <div class="card-body">
                    {{-- id guru pamong --}}
                    <input type="hidden" value="{{ $get_id_gp->id_guru_pamong }}" name="id_gp">
                    {{-- NIK/NIDN Guru Pamong --}}
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">NIK/NIDN*</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nik" name="nik" placeholder="NIK/NIDN Guru Pamong"
                                required oninvalid="this.setCustomValidity('NIK/NIDN Guru Pamong Tidak Boleh Kosong')"
                                oninput="this.setCustomValidity('')" value="{{ $get_id_gp->nik }}" readonly />
                        </div>
                    </div>
                    {{-- Nama Guru Pamong --}}
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Nama*</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama_guru_pamong" name="nama_guru_pamong"
                                placeholder="Nama Guru Pamong" required
                                oninvalid="this.setCustomValidity('Nama Guru Pamong Tidak Boleh Kosong')"
                                oninput="this.setCustomValidity('')" value="{{ $get_id_gp->nama_guru_pamong }}" />
                        </div>
                    </div>
                    {{-- jenis Kelamin --}}
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Jenis Kelamin*</label>
                        <div class="col-sm-10">
                            <select class="custom-select" name="jenis_kelamin" id="jenis_kelamin" required
                                oninvalid="this.setCustomValidity('Jenis Kelamin Tidak Boleh Kosong')"
                                oninput="this.setCustomValidity('')" />
                            <option value="" selected disabled>Pilih Jenis Kelamin</option>
                            <option value="1" {{ $get_id_gp->jenis_kelamin == 1 ? 'selected' : '' }}>Laki-Laki</option>
                            <option value="2" {{ $get_id_gp->jenis_kelamin == 2 ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>
                    </div>
                    {{-- alamat --}}
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Alamat</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" id="alamat" name="alamat"
                                placeholder="Alamat">{{ $get_id_gp->alamat_guru_pamong }}</textarea>
                        </div>
                    </div>
                    {{-- no hp --}}
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">No Hp</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="no_hp" name="no_hp" placeholder="No Hp"
                                value="{{ $get_id_gp->no_telpon_guru_pamong }}">
                        </div>
                    </div>
                    {{-- status user --}}
                    {{-- <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Status User*</label>
                        <div class="col-sm-10">
                            <select class="custom-select" name="status_user" id="status_user" required
                                oninvalid="this.setCustomValidity('Status User Tidak Boleh Kosong')"
                                oninput="this.setCustomValidity('')" />
                            <option value="" selected disabled>Status User</option>
                            <option value="1" {{ $get_id_gp->status_user == 1 ? 'selected' : '' }}>Aktif</option>
                            <option value="2" {{ $get_id_gp->status_user == 2 ? 'selected' : '' }}>Tidak Aktif</option>
                            </select>
                        </div>
                    </div> --}}
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
