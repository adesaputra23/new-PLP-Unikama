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
                Pengumuman</h2>
            <!-- Icon Divider-->
            <div class="divider-custom">
                <div class="divider-custom-line"></div>
                <div class="divider-custom-line"></div>
                <div class="divider-custom-line"></div>
                <div class="divider-custom-line"></div>
            </div>

            {{-- <form action="{{ route('proses.add.zonasi') }}" method="POST"> --}}
            {{-- @csrf --}}

            <br>
            <div class="row">
                <div class="col-sm-4">
                    <div class="card">
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
                                    name="jenis_plp" required
                                    oninvalid="this.setCustomValidity('Jenis PLP tidak boleh kosong')"
                                    oninput="this.setCustomValidity('')">
                                    <option value="" selected disabled>Pilih PLP</option>
                                    <option value="1">PLP I</option>
                                    <option value="2">PLP II</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="card">
                        <p class="text-center mt-2 text">Silahkan Masukan NPM dan Jenis PLP Untuk Menmapilkan Data</p>
                        <div class="load-tabel">

                            {{-- <table class="table table-striped table-bordered table-sm">
                                    <tbody>
    
                                        
                                        
                                        
                                        
                                        
                                        
                                        <tr>
                                            <th>Nama DPL</th>
                                            <td>NPM</td>
                                        </tr>
                                        <tr>
                                            <th>Created At</th>
                                            <td>NPM</td>
                                        </tr>
                                    </tbody>
                                </table> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- </form> --}}


    </section>

    @include('sweetalert::alert')

    <script>
        $(document).on('change', '#jenis_plp', function() {
            $('.load-tabel').html('<p class="text-center mt-2">Mengambil Data....</p>');
            var npm = $('#npm').val();
            var jenis_plp = $('#jenis_plp').val();
            // $('#kode_sekolah').html('<option value="" selected disabled>Sedang mengambil data...</option>');
            $.ajax({
                type: "POST",
                url: "{{ url('ajax/pengumuman') }}",
                data: {
                    npm: npm,
                    jenis_plp: jenis_plp,
                    _token: "{{ csrf_token() }}",
                },
                dataType: "json",
                success: function(response) {
                    console.log(response.get_mhs);
                    if (response.get_mhs == null) {
                        $('.text').show();
                        $('.text').text('Data Tidak Ditemukan');
                        $('.load-tabel').hide();
                    }
                    $('.load-tabel').html('<p class="text-center mt-2">Mengambil Data....</p>');
                    var url = "{{ url('pengumuman_pdf') }}"
                    var DataHtml = '';
                    DataHtml +=
                        '<div class="mt-2" style="margin-left: 20px"><a href="' +
                        url + '/' + response.get_mhs_zonasi
                        .id_zonasi +
                        '" class="btn btn-sm btn-primary" target="_blank">Cetak PDF</a></div>';
                    DataHtml += '<div class="card-body">';
                    DataHtml += '<table class="table table-striped table-sm">';
                    DataHtml += '<tbody>';
                    DataHtml += '<tr><th style="width: 240px">NPM</th><td>' + response.get_mhs.npm +
                        '</td></tr>';
                    DataHtml += '<tr><th>Nama Mahasiswa</th><td>' + response.get_mhs.nama_mhs +
                        '</td></tr>';
                    DataHtml += '<tr><th>Program Studi</th><td>' + response.list_prodi[response.get_mhs
                            .program_studi] +
                        '</td></tr>';
                    DataHtml += '<tr><th>Fakultas</th><td>' + response.list_fakultas[response.get_mhs
                        .fakultas] + '</td></tr>';
                    DataHtml += '<tr><th>Penempatan Sekolah</th><td>' + response.get_sekolah
                        .nama_sekolah + '</td></tr>';
                    DataHtml += '<tr><th>Nama Kepala Sekolah</th><td>' + response.get_kepsek
                        .nama_kepsek + '</td></tr>';
                    DataHtml += '<tr><th>Nama Guru Pamong</th><td>' + response.get_guru_pamong
                        .nama_guru_pamong + '</td></tr>';
                    DataHtml += '<tr><th>Nama DPL</th><td>' + response.get_dpl
                        .nama_dpl + '</td></tr>';
                    DataHtml += '<tr><th>Created At</th><td>' + response.get_mhs_zonasi
                        .created_at + '</td></tr>';
                    DataHtml += '</tbody>';
                    DataHtml += '</table>';
                    DataHtml += '</div></div>';
                    $('.load-tabel').show();
                    $('.text').hide();
                    $('.load-tabel').html(DataHtml);
                }
            });
        })
    </script>
@endsection
