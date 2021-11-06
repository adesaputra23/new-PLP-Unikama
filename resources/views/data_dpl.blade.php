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
                        <li class="breadcrumb-item">Data DPL</li>
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
                <h3 class="card-title">Data DPL</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

            </div>

            <div class="card-body">
                <div class="card">
                    <div class="card-body">
                        <div class="btn-group">
                            <a href="{{ route('form.data.dpl') }}" type="button" class="btn btn-primary">
                                Tambah DPL
                            </a>
                        </div>
                    </div>
                </div>
                <div class="tab-custom-content"></div>
                <div class="mt-2">
                    <div class="tab-pane fade show active" id="tab-1" role="tabpanel" aria-labelledby="tab-1-tab">
                        <div class="table-responsive">
                            <table id="tabel1" class="table table-bordered table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>NIK/NIDN</th>
                                        <th>Nama DPL</th>
                                        <th>Prodi</th>
                                        <th>Fakultas</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($list_dpl as $item => $dpl)
                                        <tr>
                                            <td class="text-center">{{ $no++ }}</td>
                                            <td>{{ $dpl->nik }}</td>
                                            <td>{{ $dpl->nama_dpl }}</td>
                                            <td>{{ $list_prodi[$dpl->program_studi] }}</td>
                                            <td>{{ $list_fakultas[$dpl->fakultas] }}</td>
                                            <td>

                                                <div class="btn-group">
                                                    <a href="{{ route('form.edit.dpl', ['id_dpl' => $dpl->id_dpl]) }}"
                                                        class="btn btn-warning btn-sm">Edit</a>
                                                    @if (!empty($dpl->JointoZonasi))
                                                        <button type="button" data-toggle="modal"
                                                            data-target="#not-hapus-dpl"
                                                            class="btn btn-danger btn-sm">Hapus</button>
                                                    @else
                                                        <button type="button" data-toggle="modal" data-target="#hapus-dpl"
                                                            data-id_dpl="{{ $dpl->id_dpl }}" id="btn-hapus-dpl"
                                                            class="btn btn-danger btn-sm">Hapus</button>
                                                    @endif

                                                </div>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </section>
    {{-- end section conten --}}

    {{-- modal hapus data dpl --}}
    <div class="modal fade" id="hapus-dpl">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fas fa-trash-alt"></i> Hapus Data Sekolah Mitra</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('hapus.dpl') }}" method="post">
                    @csrf
                    <div class="modal-body text-center">
                        <input type="hidden" id="id_dpl" name="id_dpl">
                        <p>Anda yakin ingin menghapus data ini?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Hapus</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- modal not hapus data dpl --}}
    <div class="modal fade" id="not-hapus-dpl">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fas fa-exclamation-circle"></i> Warning</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="#" method="post">
                    @csrf
                    <div class="modal-body text-center">
                        <p>Data Sekolah sudah terkait dengan Zonasi!</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Keluar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).on('click', '#btn-hapus-dpl', function() {
            var id_dpl = $(this).data('id_dpl');
            $('#id_dpl').val(id_dpl);
        })
        $('#tabel1').DataTable({
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
