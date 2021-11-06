@extends('template.template_conten')
@section('conten')
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg bg-secondary text-uppercase fixed-top" id="mainNav">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">PLP-UNIKAMA</a>
            <button class="navbar-toggler text-uppercase font-weight-bold bg-primary text-white rounded" type="button"
                data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive"
                aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded"
                            href="{{ url('/') }}">Home</a></li>
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded"
                            href="{{ route('login') }}">Login</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Portfolio Section-->
    <section class="page-section portfolio" id="portfolio">
        <div class="container mt-4">
            <!-- Portfolio Section Heading-->
            <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0 mt-4" style="margin-top: 50%;">
                Zonasi Sekolah</h2>
            <!-- Icon Divider-->
            <div class="divider-custom">
                <div class="divider-custom-line"></div>
                <div class="divider-custom-line"></div>
                <div class="divider-custom-line"></div>
                <div class="divider-custom-line"></div>
            </div>
            <div class="card">
                <form action="{{ route('proses.add.zonasi') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">NPM</label>
                            <input type="number" class="form-control" id="npm" name="npm" placeholder="NPM" required
                                oninvalid="this.setCustomValidity('NPM tidak boleh kosong')"
                                oninput="this.setCustomValidity('')">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Janis PLP</label>
                            <select class="form-select" aria-label="Default select example" id="jenis_plp"
                                name="jenis_plp" required oninvalid="this.setCustomValidity('Jenis PLP tidak boleh kosong')"
                                oninput="this.setCustomValidity('')">
                                <option value="" selected disabled>Pilih PLP</option>
                                <option value="1">PLP I</option>
                                <option value="2">PLP II</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Sekolah</label>
                            <select class="form-select" aria-label="Default select example" id="kode_sekolah"
                                name="kode_sekolah" required
                                oninvalid="this.setCustomValidity('Sekolah tidak boleh kosong')"
                                oninput="this.setCustomValidity('')">
                                <option value="" selected disabled>Pilih Sekolah</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <button type="reset" class="btn btn-danger">Batal</button>
                        </div>
                </form>
            </div>
        </div>
    </section>

    @include('sweetalert::alert')

    <script>
        $(document).on('change', '#jenis_plp', function() {
            var jenis_plp = $('#jenis_plp').val();
            $('#kode_sekolah').html('<option value="" selected disabled>Sedang mengambil data...</option>');
            $.ajax({
                type: "POST",
                url: "{{ url('ajax/jenis_plp') }}",
                data: {
                    jenis_plp: jenis_plp,
                    _token: "{{ csrf_token() }}",
                },
                dataType: "json",
                success: function(response) {
                    console.log(response);
                    var ListData = response;
                    var DataHtml = '';
                    DataHtml += '<option value="" selected disabled>~Sekolah~</option>';
                    $.each(ListData, function(index, value) {
                        DataHtml += '<option value="' + value.kode_sekolah + '">' + value
                            .kode_sekolah + ' ~ ' + value.nama_sekolah + '</option>';
                    });
                    $('#kode_sekolah').html(DataHtml);
                }
            });
        })
    </script>
@endsection
