@extends('template/template_admin')
@section('conten')
    {{-- secction header --}}
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Indikator Penilaian DPL</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item">Indikator Penilaian DPL</li>
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
                <h3 class="card-title">Indikator Penilaian DPL</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>

            <div class="card-body">

                <div class="row">
                    <div class="col-5 col-sm-3">
                        <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist"
                            aria-orientation="vertical">
                            <a class="nav-link active" id="vert-tabs-home-tab" data-toggle="pill" href="#vert-tabs-home"
                                role="tab" aria-controls="vert-tabs-home" aria-selected="true">Penilaian RPP (N1)</a>
                            <a class="nav-link" id="vert-tabs-profile-tab" data-toggle="pill"
                                href="#vert-tabs-profile" role="tab" aria-controls="vert-tabs-profile"
                                aria-selected="false">Penilaian Video (N2)</a>
                        </div>
                    </div>
                    <div class="col-7 col-sm-9">
                        <div class="tab-content" id="vert-tabs-tabContent">
                            <div class="tab-pane text-left fade show active" id="vert-tabs-home" role="tabpanel"
                                aria-labelledby="vert-tabs-home-tab">
                                <div class="mt-2 mb-2">
                                    <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#modal-dpl"
                                        id="tambah-indikator-n1">Tambah
                                        Indikator</button>
                                </div>
                                <table class="table table-bordered table-striped table-sm">
                                    <thead class="text-center">
                                        <tr>
                                            <th>INDIKATOR</th>
                                            <th>NILAI</th>
                                            <th>CREATED</th>
                                            <th>UPDATED</th>
                                            <th>ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($list_inidkator_n1 as $item_n1_p1 => $inidkator_n1)
                                            <tr>
                                                <td>{{ $inidkator_n1->nama_indikator_dpl }}</td>
                                                <th class="text-center">{{ $inidkator_n1->jumlah_nilai }}</th>
                                                <td class="text-center">{{ $inidkator_n1->created_at }}</td>
                                                <td class="text-center">{{ $inidkator_n1->updated_at ?? '-' }}</td>
                                                <td>
                                                    <div class="btn-group">
                                                        <button class="btn btn-warning btn-sm" data-toggle="modal"
                                                            data-target="#modal-dpl" id="ubah-indikator-n1"
                                                            data-id="{{ $inidkator_n1->id_indikator_dpl }}">Ubah</button>
                                                        @if (empty($inidkator_n1->RkapIdPnIndikatorDPl))
                                                            <button class="btn btn-danger btn-sm" data-toggle="modal"
                                                                data-target="#hapus"
                                                                data-id="{{ $inidkator_n1->id_indikator_dpl }}"
                                                                id="btn-hapus">Hapus</button>
                                                        @else
                                                            <button class="btn btn-danger btn-sm" data-toggle="modal"
                                                                data-target="#non-hapus">Hapus</button>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="vert-tabs-profile" role="tabpanel"
                                aria-labelledby="vert-tabs-profile-tab">
                                <div class="mt-2 mb-2">
                                    <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#modal-dpl"
                                        id="tambah-indikator-n2">Tambah
                                        Indikator</button>
                                </div>
                                <table class="table table-bordered table-striped table-sm">
                                    <thead class="text-center">
                                        <tr>
                                            <th>INDIKATOR</th>
                                            <th>NILAI</th>
                                            <th>CREATED</th>
                                            <th>UPDATED</th>
                                            <th>ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($list_inidkator_n2 as $item_n2 => $inidkator_n2)
                                            <tr>
                                                <td>{{ $inidkator_n2->nama_indikator_dpl }}</td>
                                                <th class="text-center">{{ $inidkator_n2->jumlah_nilai }}</th>
                                                <td class="text-center">{{ $inidkator_n2->created_at }}</td>
                                                <td class="text-center">{{ $inidkator_n2->updated_at ?? '-' }}</td>
                                                <td>
                                                    <div class="btn-group">
                                                        <button class="btn btn-warning btn-sm" data-toggle="modal"
                                                            data-target="#modal-dpl" id="ubah-indikator-n1"
                                                            data-id="{{ $inidkator_n2->id_indikator_dpl }}">Ubah</button>
                                                        @if (empty($inidkator_n2->RkapIdPnIndikatorDPl))
                                                            <button class="btn btn-danger btn-sm" data-toggle="modal"
                                                                data-target="#hapus"
                                                                data-id="{{ $inidkator_n2->id_indikator_dpl }}"
                                                                id="btn-hapus">Hapus</button>
                                                        @else
                                                            <button class="btn btn-danger btn-sm" data-toggle="modal"
                                                                data-target="#non-hapus">Hapus</button>
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
        </div>
    </section>
    {{-- end section conten --}}

    @include('indikator_penilaian/_modal')

    <script>
        $(document).on('click', '#tambah-indikator-n1', function() {
            $('.modal-title').text('Tambah Indikator');
            $('#aspek_dpl').val(1);
        })

        $(document).on('click', '#tambah-indikator-n2', function() {
            $('.modal-title').text('Tambah Indikator');
            $('#aspek_dpl').val(2);
        })

        $(document).on('click', '#ubah-indikator-n1', function() {
            $('.modal-title').text('Ubah Indikator');
            var id = $(this).data('id');
            $.ajax({
                type: "GET",
                url: "{{ url('ajax/indikator-dpl') }}",
                data: {
                    id: id,
                    _token: "{{ csrf_token() }}",
                },
                dataType: "json",
                success: function(response) {
                    $('#id_indikator_dpl').val(id);
                    $('#indikator_dpl').val(response.nama_indikator_dpl);
                    $('#nilai_dpl').val(response.jumlah_nilai);
                }
            });
        })

        $(document).on('click', '#btn-hapus', function() {
            var id = $(this).data('id');
            $('#id_hapus_indikator').val(id);
        })
    </script>

@endsection
