@extends('template/template_admin')
@section('conten')
    {{-- secction header --}}
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Laporan Penilaian</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item">Laporan Penilaian</li>
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
                <h3 class="card-title">Laporan Penilaian</h3>

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
                            <a href="" type="button" class="btn btn-success">
                                Export
                            </a>
                        </div>
                    </div>
                </div>

                <div class="mt-2">
                    <ul class="nav nav-tabs" id="custom-content-above-tab" role="tablist">
                        @if ($data_sekolah->status_plp_1 == 1)
                            <li class="nav-item">
                                <a class="nav-link active" id="tab-1-tab" data-toggle="pill" href="#tab-1" role="tab"
                                    aria-controls="tab-1" aria-selected="true">PLP I</a>
                            </li>
                        @else
                        @endif

                        @if ($data_sekolah->status_plp_2 == 1)
                            <li class="nav-item">
                                <a class="nav-link" id="tab-2-tab" data-toggle="pill" href="#tab-2" role="tab"
                                    aria-controls="tab-2" aria-selected="false">PLP II</a>
                            </li>
                        @else
                        @endif

                    </ul>
                    <div class="tab-content mt-4" id="custom-content-above-tabContent">
                        @if ($data_sekolah->status_plp_1 == 1)
                            @include('kepala_sekolah/laporan_plp_1')
                        @else
                        @endif
                        @if ($data_sekolah->status_plp_2 == 1)
                            @include('kepala_sekolah/laporan_plp_2')
                        @else
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- end section conten --}}


@endsection
