@extends('template/template_admin')
@section('conten')
    {{-- secction header --}}
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    @if ($role == 1)
                        <h1>Data Zonasi</h1>
                    @else
                        <h1>Data Mahasiswa</h1>
                    @endif
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        @if ($role == 1)
                            <li class="breadcrumb-item">Data Mahasiswa</li>
                        @else
                            <li class="breadcrumb-item">Data Mahasiswa</li>
                        @endif
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
                @if ($role == 1)
                    <h3 class="card-title">Data Zonasi</h3>
                @else
                    <h3 class="card-title">Data Mahasiswa</h3>
                @endif

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
                            <a href="{{ route('export.mhs') }}" type="button" class="btn btn-success">
                                Export
                            </a>
                        </div>
                    </div>
                </div>

                <div class="mt-2">
                    <ul class="nav nav-tabs" id="custom-content-above-tab" role="tablist">
                        @if ($role != 1)
                            @if ($cek_plp_1 == 1)
                                <li class="nav-item">
                                    <a class="nav-link active" id="tab-1-tab" data-toggle="pill" href="#tab-1" role="tab"
                                        aria-controls="tab-1" aria-selected="true">PLP I</a>
                                </li>
                            @else
                            @endif
                            @if ($cek_plp_2 == 1)
                                <li class="nav-item">
                                    <a class="nav-link" id="tab-2-tab" data-toggle="pill" href="#tab-2" role="tab"
                                        aria-controls="tab-2" aria-selected="false">PLP II</a>
                                </li>
                            @else
                            @endif
                        @else
                            <li class="nav-item">
                                <a class="nav-link active" id="tab-1-tab" data-toggle="pill" href="#tab-1" role="tab"
                                    aria-controls="tab-1" aria-selected="true">PLP I</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="tab-2-tab" data-toggle="pill" href="#tab-2" role="tab"
                                    aria-controls="tab-2" aria-selected="false">PLP II</a>
                            </li>
                        @endif
                    </ul>
                    <div class="tab-content mt-4" id="custom-content-above-tabContent">
                        @if ($role != 1)
                            @if ($cek_plp_1 == 1)
                                @include('zonasi_plp_1')
                            @else
                            @endif
                            @if ($cek_plp_2 == 1)
                                @include('zonasi_plp_2')
                            @else
                            @endif
                        @else
                            @include('zonasi_plp_1')
                            @include('zonasi_plp_2')
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </section>
    {{-- end section conten --}}

    {{-- modal --}}

    {{-- modal hapus data zonasi --}}
    <div class="modal fade" id="hapus-mhs">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fas fa-trash-alt"></i> Hapus Data Mahasiswa</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('hapus.data.zonasi') }}" method="post">
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

    {{-- end modal --}}

    <script>
        $(document).on('click', '#btn-hapus-plp-1', function() {
            var npm = $(this).data('npm1');
            $('#npm').val(npm);
        });

        $(document).on('click', '#btn-hapus-plp-2', function() {
            var npm = $(this).data('npm2');
            $('#npm').val(npm);
        });

        $(document).on('change', '#dpl_plp_1', function() {
            var id_dpl_plp_1 = $('#dpl_plp_1').val();
            var npm_plp_1 = $(this).data('npm_plp_1');
            $.ajax({
                type: "POST",
                url: "{{ url('ajax/add-dpl-1') }}/" + npm_plp_1,
                data: {
                    npm: npm_plp_1,
                    id_dpl: id_dpl_plp_1,
                    _token: "{{ csrf_token() }}",
                },
                dataType: "json",
                success: function(response) {
                    window.location.reload()
                }
            });
        });

        $(document).on('change', '#guru_pamong_plp_1', function() {
            var id_guru_pamong_plp_1 = $('#guru_pamong_plp_1').val();
            var npm_plp_1 = $(this).data('npm_plp_1');
            $.ajax({
                type: "POST",
                url: "{{ url('ajax/add-guru-pamong-1') }}/" + npm_plp_1,
                data: {
                    npm: npm_plp_1,
                    id_guru_pamong: id_guru_pamong_plp_1,
                    _token: "{{ csrf_token() }}",
                },
                dataType: "json",
                success: function(response) {
                    window.location.reload()
                }
            });
        });

        $('#zonasi_1').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": false,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "language": {
                "search": "Cari:"
            }
        });
        // plp 1

        $(document).on('change', '#dpl_plp_2', function() {
            var id_dpl_plp_2 = $('#dpl_plp_2').val();
            var npm_plp_2 = $(this).data('npm_plp_2');
            $.ajax({
                type: "POST",
                url: "{{ url('ajax/add-dpl-2') }}/" + npm_plp_2,
                data: {
                    npm: npm_plp_2,
                    id_dpl: id_dpl_plp_2,
                    _token: "{{ csrf_token() }}",
                },
                dataType: "json",
                success: function(response) {
                    window.location.reload()
                }
            });
        });

        $(document).on('change', '#guru_pamong_plp_2', function() {
            var id_guru_pamong_plp_2 = $('#guru_pamong_plp_2').val();
            var npm_plp_2 = $(this).data('npm_plp_2');
            $.ajax({
                type: "POST",
                url: "{{ url('ajax/add-guru-pamong-2') }}/" + npm_plp_2,
                data: {
                    npm: npm_plp_2,
                    id_guru_pamong: id_guru_pamong_plp_2,
                    _token: "{{ csrf_token() }}",
                },
                dataType: "json",
                success: function(response) {
                    window.location.reload()
                }
            });
        });

        $('#zonasi_2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": false,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "language": {
                "search": "Cari:"
            }
        });
    </script>

@endsection
