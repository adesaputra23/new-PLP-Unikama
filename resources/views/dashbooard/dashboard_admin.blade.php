@php
use App\Mahasiswa;
use App\MitraSekolah;
use App\Dpl;
use App\Penilaian;
use App\PenilaianDPl;

$count_plp_1 = Mahasiswa::where('jenis_plp', 1)->count();
$count_plp_2 = Mahasiswa::where('jenis_plp', 2)->count();
$count_sekolah = MitraSekolah::count();
$count_Dpl = Dpl::count();
$count_penilaian = Penilaian::count();
$count_penilaian_dpl = PenilaianDPl::count();

@endphp

<section class="content">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div style="margin-left: 80px; margin-top: 90px;">
                        <h3>Selamat Datang <b>Admin</b></h3>
                        <p>Gunakan Sistem ini untunk mengolah data dalam pelaksanaan
                            Program Pengenalan Lingkungan Persekolahan (PLP)
                        </p>
                        <p></p>
                    </div>
                </div>
                <div class="co-md-6">
                    <img style="width: 350px; margin-left: 120px" src="{{ asset('images/dashboard.png') }}"
                        class="rounded float-right" alt="...">
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row">

                {{-- @if ($data_sekolah->status_plp_1 === 1) --}}
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box bg-info">
                        <span class="info-box-icon"><i class="far fa-bookmark"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Mahasiswa PLP I : <b>{{ $count_plp_1 }}</b></span>
                            <span class="info-box-text">Mahasiswa PLP II : <b>{{ $count_plp_2 }}</b></span>
                        </div>
                    </div>
                </div>
                {{-- @endif --}}

                {{-- @if ($data_sekolah->status_plp_2 === 1) --}}
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box bg-success">
                        <span class="info-box-icon"><i class="far fa-thumbs-up"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Sekolah Mitra</span>
                            <span class="info-box-number">{{ $count_sekolah }}</span>
                        </div>
                    </div>
                </div>
                {{-- @endif --}}

                {{-- @if ($data_sekolah->status_plp_1 === 1) --}}
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box bg-warning">
                        <span class="info-box-icon"><i class="far fa-calendar-alt"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">DPL</span>
                            <span class="info-box-number">{{ $count_Dpl }}</span>
                        </div>
                    </div>
                </div>
                {{-- @endif --}}

                {{-- @if ($data_sekolah->status_plp_2 === 1) --}}
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box bg-danger">
                        <span class="info-box-icon"><i class="fas fa-comments"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Penilaian Mitra Sekolah :
                                <b>{{ $count_penilaian }}</b></span>
                            <span class="info-box-text">Penilaian DPL : <b>{{ $count_penilaian_dpl }}</b></span>
                        </div>
                    </div>
                </div>
                {{-- @endif --}}

            </div>

        </div>
    </div>
</section>
