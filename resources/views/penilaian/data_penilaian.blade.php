@extends('template/template_admin')
@section('conten')
    {{-- secction header --}}
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Penilaian</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item">Penilaian</li>
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
                <h3 class="card-title">Penilaian</h3>

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
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add-mhs">
                                Add Mahasiswa
                            </button>
                            <a href="" type="button" class="btn btn-success">
                                Export
                            </a>
                        </div>
                    </div>
                </div>

                <div class="tab-custom-content"></div>
                <div class="mt-2">
                    <ul class="nav nav-tabs" id="custom-content-above-tab" role="tablist">
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
                    </ul>
                    <div class="tab-content mt-4" id="custom-content-above-tabContent">
                        @if ($cek_plp_1 == 1)
                            @include('penilaian.data_penilaian_plp_1')
                        @else
                        @endif
                        @if ($cek_plp_2 == 1)
                            @include('penilaian.data_penilaian_plp_2')
                        @else
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- end section conten --}}

    <div class="modal fade" id="add-mhs">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"> Add Mahasiswa</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('simpan.penilaian') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-4 col-form-label">Jenis PLP*</label>
                            <div class="col-sm-8">
                                <select class="custom-select" name="plp" id="plp">
                                    <option value="" selected disabled>Pilih PLP</option>
                                    <option value="1">PLP I</option>
                                    <option value="2">PLP II</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-4 col-form-label">Mahasiswa*</label>
                            <div class="col-sm-8">
                                <select class="custom-select" name="mhs" id="mhs">
                                    <option value="" selected disabled>Pilih Mahasiswa</option>
                                    {{-- @foreach ($list_mhs as $item_mhs => $mhs)
                                        <option value="">{{ $mhs->npm . ' - ' . $mhs->JointoMhs->nama_mhs }}</option>
                                    @endforeach --}}
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Simpan</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).on('change', '#plp', function() {
            var plp = $('#plp').val();
            $.ajax({
                type: "POST",
                url: "{{ url('json/get-mhs-penilaian') }}",
                data: {
                    plp: plp,
                    _token: "{{ csrf_token() }}"
                },
                dataType: "json",
                success: function(response) {
                    if (response.length == 0) {
                        $('#mhs').html('<option value="">Tidak ada data</option>');
                    } else {
                        var data = response;
                        var Html = '';
                        var HtmlZonasi = '';
                        $('#mhs').html('<option value="">Sedang mengambil data</option>');
                        $.each(data, function(index, value) {
                            Html += '<option value="' + value.npm + '">' + value.npm + ' - ' +
                                value.nama + '</option>';
                        });
                        $('#mhs').html(Html);
                    }
                }

            });

        });

        // $(document).on('click', '#btn-hapus-plp-1', function() {
        //     var npm = $(this).data('npm');
        //     $('#npm').val(npm);
        // });

        // $(document).on('click', '#btn-hapus-plp-2', function() {
        //     var npm = $(this).data('npm');
        //     $('#npm').val(npm);
        // });

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
