@extends('template/template_admin')
@section('conten')
    {{-- secction header --}}
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Guru Pamong</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item">Data Guru Pamong</li>
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
                <h3 class="card-title">Data Guru Pamong</h3>

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
                            <a href="{{ route('form.add.guru.pamong') }}" type="button" class="btn btn-primary">
                                Tambah Guru Pamong
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
                                        <th>Nama Guru Pamong</th>
                                        {{-- <th>Status User</th> --}}
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($list_guru_pamong as $item => $gp)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $gp->nik }}</td>
                                            <td>{{ $gp->nama_guru_pamong }}</td>
                                            {{-- <td>
                                                <div class="text-center">
                                                    @if ($gp->status_user === 1)
                                                        <span class="badge bg-success">{{ 'Aktif' }}</span>
                                                    @else
                                                        <span class="badge bg-danger">{{ 'Tidak Aktif' }}</span>
                                                    @endif
                                                </div>
                                            </td> --}}
                                            <td>
                                                <div class="btn-group">
                                                    <a href="{{ route('form.edit.guru.pamong', ['id' => $gp->id_guru_pamong]) }}"
                                                        class="btn btn-warning btn-sm">Edit</a>
                                                    <button type="button" data-toggle="modal" data-target="#hapus-gp"
                                                        data-id_gp="{{ $gp->id_guru_pamong }}" id="btn-hapus-gp"
                                                        class="btn btn-danger btn-sm">Hapus</button>
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
    <div class="modal fade" id="hapus-gp">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fas fa-trash-alt"></i> Hapus Data Guru Pamong</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('hapus.guru.pamong') }}" method="post">
                    @csrf
                    <div class="modal-body text-center">
                        <input type="hidden" id="id_gp" name="id_gp">
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
    {{-- <div class="modal fade" id="not-hapus-dpl">
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
    </div> --}}

    <script>
        $(document).on('click', '#btn-hapus-gp', function() {
            var id_gp = $(this).data('id_gp');
            $('#id_gp').val(id_gp);
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
