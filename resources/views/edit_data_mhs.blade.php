@extends('template/template_admin')
@section('conten')
    {{-- secction header --}}
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tambah Data Mahasiswa</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('data.mhs') }}">Data Mahasiswa</a></li>
                        <li class="breadcrumb-item">Tambah Data Mahasiswa</li>
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
                <h3 class="card-title">Tambah Data Mahasiswa</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>

            <div class="card-body">
                <form action="{{ route('proses.edit.mhs') }}" method="post">
                    @csrf
                    {{-- NPM --}}
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">NPM*</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="npm" name="npm" placeholder="NPM" readonly
                                value="{{ $get_mhs->npm }}" />
                        </div>
                    </div>

                    {{-- nama mahasiswa --}}
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Nama Mahasiswa*</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Mahasiswa"
                                required oninvalid="this.setCustomValidity('Nama Mahasiswa Tidak Boleh Kosong')"
                                oninput="this.setCustomValidity('')" value="{{ $get_mhs->nama_mhs }}" />
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
                                    {{ $prodi_key == $get_mhs->program_studi ? 'selected' : '' }}>
                                    {{ $prodi }}</option>
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
                                    {{ $fakultas_key == $get_mhs->fakultas ? 'selected' : '' }}>
                                    {{ $fakultas }}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- jenis plp --}}
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Jenis PLP*</label>
                        <div class="col-sm-10">
                            <select class="custom-select" name="jenis_plp" id="jenis_plp" required
                                oninvalid="this.setCustomValidity('Jenis PLP Tidak Boleh Kosong')"
                                oninput="this.setCustomValidity('')" />
                            <option value="" selected disabled>Pilih Jenis PLP</option>
                            <option value="1" {{ $get_mhs->jenis_plp == '1' ? 'selected' : '' }}>PLP I</option>
                            <option value="2" {{ $get_mhs->jenis_plp == '2' ? 'selected' : '' }}>PLP II</option>
                            </select>
                        </div>
                    </div>

                    {{-- kelas --}}
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Kelas*</label>
                        <div class="col-sm-10">
                            <select class="custom-select" name="kelas" id="kelas" required
                                oninvalid="this.setCustomValidity('Kelas Tidak Boleh Kosong')"
                                oninput="this.setCustomValidity('')" />
                            <option value="" selected disabled>Pilih Kelas</option>
                            <option value="1" {{ $get_mhs->kelas == '1' ? 'selected' : '' }}>Kelas Reguler</option>
                            <option value="2" {{ $get_mhs->kelas == '2' ? 'selected' : '' }}>Kelas Karyawan</option>
                            </select>
                        </div>
                    </div>

                    {{-- angkatan mahasiswa --}}
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Angkatan*</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="angkatan" name="angkatan" placeholder="Angkatan"
                                required oninvalid="this.setCustomValidity('Agkatan Tidak Boleh Kosong')"
                                oninput="this.setCustomValidity('')" value="{{ $get_mhs->angkatan }}" />
                        </div>
                    </div>

                    {{-- ipk --}}
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">IPK*</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="ipk" name="ipk" placeholder="IPK Exc 0.00"
                                step="any" required oninvalid="this.setCustomValidity('IPK Tidak Boleh Kosong')"
                                oninput="this.setCustomValidity('')" value="{{ $get_mhs->ipk }}" />
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
                            <option value="1" {{ $get_mhs->jenis_kelamin == '1' ? 'selected' : '' }}>Laki-Laki</option>
                            <option value="2" {{ $get_mhs->jenis_kelamin == '2' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>
                    </div>

                    {{-- alamat --}}
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Alamat</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" id="alamat" name="alamat"
                                placeholder="Alamat">{{ $get_mhs->alamat }}</textarea>
                        </div>
                    </div>

                    {{-- agama --}}
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Agama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="agama" name="agama" placeholder="Agama"
                                value="{{ $get_mhs->agama }}">
                        </div>
                    </div>

                    {{-- no hp --}}
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">No Hp</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="no_hp" name="no_hp" placeholder="No Hp"
                                value="{{ $get_mhs->no_hp }}">
                        </div>
                    </div>

                    <div class="btn-group float-right">
                        <div style="margin-right: 10px">
                            <button id="add" type="submit" class="btn btn-success">Simpan</button>
                        </div>
                        <div>
                            <button id="res" type="button" class="btn btn-default">Batal</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    {{-- end section conten --}}

@endsection
