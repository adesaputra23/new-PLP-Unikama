@php
use App\ZonasiSekolah;
use App\PenilaianDPl;

$user = Auth::user()->get_dpl->id_dpl;
$count_mhs_plp_1 = ZonasiSekolah::where('id_dpl', $user)
    ->whereHas('JointoMhs', function ($query) {
        $query->where('jenis_plp', 1);
    })
    ->count();
$count_mhs_plp_2 = ZonasiSekolah::where('id_dpl', $user)
    ->whereHas('JointoMhs', function ($query) {
        $query->where('jenis_plp', 2);
    })
    ->count();
$count_penilaian = PenilaianDPl::count();
@endphp

<section class="content">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div style="margin-left: 80px; margin-top: 90px;">
                        <h3>Selamat Datang Dosen Pembimbing Lapangan <b>(DPL)</b></h3>
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
                <div class="col-md-4 col-sm-6 col-12">
                    <div class="info-box bg-info">
                        <span class="info-box-icon"><i class="far fa-bookmark"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Mahasiswa PLP I</span>
                            <span class="info-box-number">{{ $count_mhs_plp_1 }}</span>
                        </div>
                    </div>
                </div>
                {{-- @endif --}}

                {{-- @if ($data_sekolah->status_plp_2 === 1) --}}
                <div class="col-md-4 col-sm-6 col-12">
                    <div class="info-box bg-success">
                        <span class="info-box-icon"><i class="far fa-thumbs-up"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Mahasiswa PLP II</span>
                            <span class="info-box-number">{{ $count_mhs_plp_2 }}</span>
                        </div>
                    </div>
                </div>
                {{-- @endif --}}

                <div class="col-md-4 col-sm-6 col-12">
                    <div class="info-box bg-warning">
                        <span class="info-box-icon"><i class="far fa-calendar-alt"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Penilaian</span>
                            <span class="info-box-number">{{ $count_penilaian }}</span>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</section>
