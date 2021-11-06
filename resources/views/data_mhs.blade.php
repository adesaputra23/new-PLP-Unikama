@extends('template/template_admin')
@section('conten')
    {{-- secction header --}}
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Mahasiswa</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item">Data Mahasiswa</li>
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
                <h3 class="card-title">Data Mahasiswa</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>

            <div class="card-body">

                <div class="card">
                    <div class="card-body">
                        <div class="btn-group">
                            <a href="{{ route('form.tambah.data.mhs') }}" type="button" class="btn btn-primary">
                                Tambah Mahasiswa
                            </a>
                            <a href="{{ route('export.mhs') }}" type="button" class="btn btn-success">
                                Export
                            </a>
                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#import-data">
                                Import
                            </button>
                        </div>
                    </div>
                </div>

                <div class="tab-custom-content"></div>
                <div class="mt-2">
                    <ul class="nav nav-tabs" id="custom-content-above-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="tab-1-tab" data-toggle="pill" href="#tab-1" role="tab"
                                aria-controls="tab-1" aria-selected="true">PLP I</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="tab-2-tab" data-toggle="pill" href="#tab-2" role="tab"
                                aria-controls="tab-2" aria-selected="false">PLP II</a>
                        </li>
                    </ul>
                    <div class="tab-content mt-4" id="custom-content-above-tabContent">
                        @include('data_mhs_plp_1')
                        @include('data_mhs_plp_2')
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- end section conten --}}

    {{-- modal hapus data mahasiswa --}}
    <div class="modal fade" id="hapus-mhs">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fas fa-trash-alt"></i> Hapus Data Mahasiswa</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('proses.hapus.mhs') }}" method="post">
                    @csrf
                    <div class="modal-body text-center">
                        <input type="hidden" id="npm" name="npm">
                        <p>Anda yakin ingin menghapus data ini?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Hapus</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- modal export data mahasiswa --}}
    <div class="modal fade" id="import-data">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fas fa-file-import"></i> Import Data Mahasiswa</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('import.mhs') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-2">
                            <a href="{{ asset('template_import_excel/template_excel.xlsx') }}"
                                class="btn btn-success btn-sm"><i class="far fa-file-excel"></i> Download
                                Template</a>
                        </div>

                        {{-- file upload --}}
                        <div class="form-group">
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="file_import" name="file_import"
                                        required oninvalid="this.setCustomValidity('File Tidak Boleh Kosong')"
                                        oninput="this.setCustomValidity('')" />
                                    <label class="custom-file-label" for="exampleInputFile">Browse</label>
                                </div>
                            </div>
                            <small>
                                <p>
                                    <span class="badge bg-info">Node* : type file (<i>xlsx</i>)</span>
                                    <span id="name_file" class="badge bg-warning"></span>
                                </p>
                            </small>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Import</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).on('change', '#file_import', function() {
            var file_import = $('#file_import').prop('files')[0];
            $('#name_file').text(file_import.name);
        });

        $(document).on('click', '#btn-hapus-plp-1', function() {
            var npm = $(this).data('npm');
            $('#npm').val(npm);
        });

        $(document).on('click', '#btn-hapus-plp-2', function() {
            var npm = $(this).data('npm');
            $('#npm').val(npm);
        });

        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": false,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
        $('#example1').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": false,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    </script>

@endsection
