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
                        <li class="breadcrumb-item">Data Mitra Sekolah</li>
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
                <h3 class="card-title">Data Mitra Sekolah</h3>

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
                            <a href="{{ route('form.tambah.data.sekolah') }}" type="button" class="btn btn-primary">
                                Tambah Mitra
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
                                        <th>Kode Sekolah</th>
                                        <th>Nama Sekolah</th>
                                        <th>NIK/NIDN Kepala Sekolah</th>
                                        <th>Nama Kepala Sekolah</th>
                                        <th>Jenis PLP</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($list_mitra as $item => $sekolah)
                                        <tr>
                                            <td class="text-center">{{ $no++ }}</td>
                                            <td>{{ $sekolah->kode_sekolah }}</td>
                                            <td>{{ $sekolah->nama_sekolah }}</td>
                                            <td>{{ $sekolah->JointoKepsek->nik }}</td>
                                            <td>{{ $sekolah->JointoKepsek->nama_kepsek }}</td>
                                            <td>
                                                @if ($sekolah->status_plp_1 === 1 && $sekolah->status_plp_2 === 1)
                                                    {{ 'PLP I dan PLP II' }}
                                                @else
                                                    @if ($sekolah->status_plp_1 === 1)
                                                        {{ 'PLP I' }}
                                                    @endif

                                                    @if ($sekolah->status_plp_2 === 1)
                                                        {{ 'PLP II' }}
                                                    @endif
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="{{ route('form.edit.data.sekolah', ['id_sekolah' => $sekolah->id_sekolah]) }}"
                                                        class="btn btn-warning btn-sm">Edit</a>

                                                    @if (!empty($sekolah->JointoZonasi))
                                                        <button type="button" data-toggle="modal"
                                                            data-target="#not-hapus-sekolah"
                                                            class="btn btn-danger btn-sm">Hapus</button>
                                                    @else
                                                        <button type="button" data-toggle="modal"
                                                            data-target="#hapus-sekolah"
                                                            data-kode_sekolah="{{ $sekolah->kode_sekolah }}"
                                                            id="btn-hapus-sekolah"
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

    {{-- modal hapus data mahasiswa --}}
    <div class="modal fade" id="hapus-sekolah">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fas fa-trash-alt"></i> Hapus Data Sekolah Mitra</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('hapus.sekolah') }}" method="post">
                    @csrf
                    <div class="modal-body text-center">
                        <input type="hidden" id="kode_sekolah" name="kode_sekolah">
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

    {{-- modal hapus data mahasiswa --}}
    <div class="modal fade" id="not-hapus-sekolah">
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
        $(document).on('click', '#btn-hapus-sekolah', function() {
            var kode_sekolah = $(this).data('kode_sekolah');
            $('#kode_sekolah').val(kode_sekolah);
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
