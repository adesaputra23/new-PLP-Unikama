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
                <form action="{{ route('proses.tambah.mhs') }}" method="post">
                    @csrf
                    {{-- NPM --}}
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">NPM*</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="npm" name="npm" placeholder="NPM" required
                                oninvalid="this.setCustomValidity('NPM Tidak Boleh Kosong')"
                                oninput="this.setCustomValidity('')" />
                        </div>
                    </div>

                    {{-- nama mahasiswa --}}
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Nama Mahasiswa*</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Mahasiswa"
                                required oninvalid="this.setCustomValidity('Nama Mahasiswa Tidak Boleh Kosong')"
                                oninput="this.setCustomValidity('')" />
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
                                <option value="{{ $prodi_key }}">{{ $prodi }}</option>
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
                                <option value="{{ $fakultas_key }}">{{ $fakultas }}</option>
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
                            <option value="1">PLP I</option>
                            <option value="2">PLP II</option>
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
                            <option value="1">Kelas Reguler</option>
                            <option value="2">Kelas Karyawan</option>
                            </select>
                        </div>
                    </div>

                    {{-- angkatan mahasiswa --}}
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Angkatan*</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="angkatan" name="angkatan"
                                placeholder="Angkatan Mahasiswa" required
                                oninvalid="this.setCustomValidity('Agkatan Tidak Boleh Kosong')"
                                oninput="this.setCustomValidity('')" />
                        </div>
                    </div>

                    {{-- ipk --}}
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">IPK*</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="ipk" name="ipk" placeholder="IPK Exc 0.00"
                                step="any" required oninvalid="this.setCustomValidity('IPK Tidak Boleh Kosong')"
                                oninput="this.setCustomValidity('')" />
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
                            <option value="1">Laki-Laki</option>
                            <option value="2">Perempuan</option>
                            </select>
                        </div>
                    </div>

                    {{-- alamat --}}
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Alamat</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" id="alamat" name="alamat" placeholder="Alamat"></textarea>
                        </div>
                    </div>

                    {{-- agama --}}
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Agama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="agama" name="agama" placeholder="Agama">
                        </div>
                    </div>

                    {{-- no hp --}}
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">No Hp</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="no_hp" name="no_hp" placeholder="No Hp">
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
