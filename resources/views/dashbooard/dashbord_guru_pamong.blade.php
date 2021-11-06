@php
use App\ZonasiSekolah;
use App\Penilaian;
$data_user = Auth::user();
$data_sekolah = $data_user->get_guru_pamong->Kepsek->JointoMitraSekolah;
$count_plp_1 = ZonasiSekolah::where('kode_sekolah', $data_sekolah->kode_sekolah)
    ->whereHas('JointoMhs', function ($query) {
        return $query->where('jenis_plp', 1);
    })
    ->count();
$count_plp_2 = ZonasiSekolah::where('kode_sekolah', $data_sekolah->kode_sekolah)
    ->whereHas('JointoMhs', function ($query) {
        return $query->where('jenis_plp', 2);
    })
    ->count();
$count_penilaian_plp_1 = Penilaian::whereHas('JointoMhs', function ($query) {
    $query->where('jenis_plp', 1);
})
    ->whereHas('JointoZonasi', function ($query) {
        $data_user = Auth::user()->get_guru_pamong->id_guru_pamong;
        $query->where('id_guru_pamong', $data_user);
    })
    ->count();
$count_penilaian_plp_2 = Penilaian::whereHas('JointoMhs', function ($query) {
    $query->where('jenis_plp', 2);
})
    ->whereHas('JointoZonasi', function ($query) {
        $data_user = Auth::user()->get_guru_pamong->id_guru_pamong;
        $query->where('id_guru_pamong', $data_user);
    })
    ->count();
@endphp

<section class="content">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div style="margin-left: 80px; margin-top: 90px;">
                        <h3>Selamat Datang di Website Kami . . . .</h3>
                        <p>Terima kasih
                            <b>{{ Auth::user()->get_guru_pamong->Kepsek->JointoMitraSekolah->nama_sekolah }}</b>
                            telah berkeja sama dengan kami <b>Universitas PGRI Kanjuruhan Malang</b> dalam pelaksanaan
                            Program Pengenalan Lingkungan Persekolahan (PLP)
                        </p>
                        <p>Semoga Sistem ini dapat membantu anda dalam pelaksanaan kegiatan PLP</p>
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

                @if ($data_sekolah->status_plp_1 === 1)
                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box bg-info">
                            <span class="info-box-icon"><i class="far fa-bookmark"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Mahasiswa PLP I</span>
                                <span class="info-box-number">{{ $count_plp_1 }}</span>
                            </div>
                        </div>
                    </div>
                @endif

                @if ($data_sekolah->status_plp_2 === 1)
                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box bg-success">
                            <span class="info-box-icon"><i class="far fa-thumbs-up"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Mahasiswa PLP II</span>
                                <span class="info-box-number">{{ $count_plp_2 }}</span>
                            </div>
                        </div>
                    </div>
                @endif

                @if ($data_sekolah->status_plp_1 === 1)
                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box bg-warning">
                            <span class="info-box-icon"><i class="far fa-calendar-alt"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Penilaian PLP I</span>
                                <span class="info-box-number">{{ $count_penilaian_plp_1 }}</span>
                            </div>
                        </div>
                    </div>
                @endif

                @if ($data_sekolah->status_plp_2 === 1)
                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box bg-danger">
                            <span class="info-box-icon"><i class="fas fa-comments"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Penilaian PLP II</span>
                                <span class="info-box-number">{{ $count_penilaian_plp_2 }}</span>
                            </div>
                        </div>
                    </div>
                @endif

            </div>

        </div>
    </div>
</section>
