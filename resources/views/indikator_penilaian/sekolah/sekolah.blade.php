@extends('template/template_admin')
@section('conten')
    {{-- secction header --}}
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Indikator Penilaian Sekolah</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item">Indikator Penilaian Sekolah</li>
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
                <h3 class="card-title">Indikator Penilaian Sekolah</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>

            <div class="card-body">

                <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="custom-content-below-home-tab" data-toggle="pill"
                            href="#custom-content-below-home" role="tab" aria-controls="custom-content-below-home"
                            aria-selected="true">PLP I</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-content-below-profile-tab" data-toggle="pill"
                            href="#custom-content-below-profile" role="tab" aria-controls="custom-content-below-profile"
                            aria-selected="false">PLP II</a>
                    </li>
                </ul>
                <div class="tab-content" id="custom-content-below-tabContent">
                    @include('indikator_penilaian/sekolah/plp_1')
                    @include('indikator_penilaian/sekolah/plp_2')
                </div>

            </div>
        </div>
    </section>
    {{-- end section conten --}}

    {{-- modal include --}}

    @include('indikator_penilaian/_modal')

    {{-- end modal --}}

    <script>
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "ordering": false,
        })

        $(document).on('click', '#tambah-indikator-n1-p1', function() {
            $('.modal-title').text('Tambah Indikator');
            $('.form-group').show();
            $('.simpan').text('Simpan');
            $('.batal').text('Batal');
            $('.text-non-hapus').hide();
            $('.text-hapus').hide();
            $('#aspek').val(1);
        })

        $(document).on('click', '#ubah-n1-p1', function() {
            $('.modal-title').text('Ubah Indikator');
            $('.form-group').show();
            $('.simpan').text('Simpan');
            $('.batal').text('Batal');
            $('.text-non-hapus').hide();
            $('.text-hapus').hide();
            $('#aspek').val(1);

            var id_n1_p1 = $(this).data('id_n1_p1');
            var id_n2_p1 = $(this).data('id_n2_p1');
            var id_n3_p1 = $(this).data('id_n3_p1');

            if (id_n1_p1 != null) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('ajax/get-indikator') }}",
                    data: {
                        id: id_n1_p1,
                        _token: "{{ csrf_token() }}",
                    },
                    dataType: "json",
                    success: function(response) {
                        // console.log(response.nama_indikator);
                        $('#id_indikator').val(id_n1_p1);
                        $('#indikator').val(response.nama_indikator);
                        $('#grade_nilai').val(response.nilai_indikator);
                        $('#nilai').val(response.jumlah_nilai);
                    }
                });
            }

            if (id_n2_p1 != null) {
                $('#grade').hide();
                $.ajax({
                    type: "GET",
                    url: "{{ url('ajax/get-indikator') }}",
                    data: {
                        id: id_n2_p1,
                        _token: "{{ csrf_token() }}",
                    },
                    dataType: "json",
                    success: function(response) {
                        // console.log(response.nama_indikator);
                        $('#id_indikator').val(id_n2_p1);
                        $('#indikator').val(response.nama_indikator);
                        $('#grade_nilai').val(response.nilai_indikator);
                        $('#nilai').val(response.jumlah_nilai);
                    }
                });
            }

            if (id_n3_p1 != null) {
                $('#grade').hide();
                $.ajax({
                    type: "GET",
                    url: "{{ url('ajax/get-indikator') }}",
                    data: {
                        id: id_n3_p1,
                        _token: "{{ csrf_token() }}",
                    },
                    dataType: "json",
                    success: function(response) {
                        // console.log(response.nama_indikator);
                        $('#id_indikator').val(id_n3_p1);
                        $('#indikator').val(response.nama_indikator);
                        $('#grade_nilai').val(response.nilai_indikator);
                        $('#nilai').val(response.jumlah_nilai);
                    }
                });
            }


        })

        $(document).on('click', '#non-hapus-n1-p1', function() {
            $('.modal-title').text('Hapus Indikator');
            $('.form-group').hide();
            $('.simpan').hide();
            $('.text-hapus').hide();
            $('.batal').text('Keluar');
            $('.text-non-hapus').show();
        })

        $(document).on('click', '#hapus-n1-p1', function() {
            $('.modal-title').text('Hapus Indikator');
            $('.form-group').hide();
            $('.simpan').show();
            $('.simpan').text('Hapus');
            $('.batal').text('Batal');
            $('.text-non-hapus').hide();
            $('.text-hapus').show();
            var url = "{{ url('hapus-indikator-n1-p1') }}";
            var form = $('#form').attr('action', url);
            var id_n1_p1 = $(this).data('id_n1_p1');
            var id_n2_p1 = $(this).data('id_n2_p1');
            var id_n3_p1 = $(this).data('id_n3_p1');
            if (id_n1_p1 != null) {
                $('#id_indikator').val(id_n1_p1);
            }
            if (id_n2_p1 != null) {
                $('#id_indikator').val(id_n2_p1);
            }
            if (id_n3_p1 != null) {
                $('#id_indikator').val(id_n3_p1);
            }
        })


        // n2

        $(document).on('click', '#tambah-indikator-n2-p1', function() {
            $('.modal-title').text('Tambah Indikator');
            $('.form-group').show();
            $('#grade').hide();
            $('.simpan').text('Simpan');
            $('.batal').text('Batal');
            $('.text-non-hapus').hide();
            $('.text-hapus').hide();
            $('#aspek').val(2);
        })

        // n3

        $(document).on('click', '#tambah-indikator-n3-p1', function() {
            $('.modal-title').text('Tambah Indikator');
            $('.form-group').show();
            $('#grade').hide();
            $('.simpan').text('Simpan');
            $('.batal').text('Batal');
            $('.text-non-hapus').hide();
            $('.text-hapus').hide();
            $('#aspek').val(3);
        })

        // p2 n1
        $(document).on('click', '#tambah-indikator-n1-p2', function() {
            $('.modal-title').text('Tambah Indikator');
            $('.form-group').show();
            $('#grade').hide();
            $('.simpan').text('Simpan');
            $('.batal').text('Batal');
            $('.text-non-hapus').hide();
            $('.text-hapus').hide();
            $('#aspek').val(4);
        })

        // p2 n2
        $(document).on('click', '#tambah-indikator-n2-p2', function() {
            $('.modal-title').text('Tambah Indikator');
            $('.form-group').show();
            $('#grade').hide();
            $('.simpan').text('Simpan');
            $('.batal').text('Batal');
            $('.text-non-hapus').hide();
            $('.text-hapus').hide();
            $('#aspek').val(5);
        })

        // p2 n3
        $(document).on('click', '#tambah-indikator-n3-p2', function() {
            $('.modal-title').text('Tambah Indikator');
            $('.form-group').show();
            $('#grade').hide();
            $('.simpan').text('Simpan');
            $('.batal').text('Batal');
            $('.text-non-hapus').hide();
            $('.text-hapus').hide();
            $('#aspek').val(6);
        })

        // p2 n4
        $(document).on('click', '#tambah-indikator-n4-p2', function() {
            $('.modal-title').text('Tambah Indikator');
            $('.form-group').show();
            $('#grade').hide();
            $('.simpan').text('Simpan');
            $('.batal').text('Batal');
            $('.text-non-hapus').hide();
            $('.text-hapus').hide();
            $('#aspek').val(7);
        })
    </script>

@endsection
