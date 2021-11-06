@extends('template/template_admin')
@section('conten')
    {{-- secction header --}}
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Penilaian DPL</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item">Penilaian DPL</li>
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
                <h3 class="card-title">Penilaian DPL</h3>

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
                {{-- <div class="mt-2">
                    <ul class="nav nav-tabs" id="custom-content-above-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="tab-1-tab" data-toggle="pill" href="#tab-1" role="tab"
                                aria-controls="tab-1" aria-selected="true">PLP I</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" id="tab-2-tab" data-toggle="pill" href="#tab-2" role="tab"
                                aria-controls="tab-2" aria-selected="false">PLP II</a>
                        </li>
                    </ul>
                </div> --}}
                {{-- <div class="tab-content mt-4" id="custom-content-above-tabContent"> --}}
                {{-- @include('dpl/penilaian_p1') --}}
                @include('dpl/penilaian_p2')
                {{-- </div> --}}

            </div>

        </div>
    </section>

    <script>
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": false,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
        // $('#example1').DataTable({
        //     "paging": true,
        //     "lengthChange": false,
        //     "searching": true,
        //     "ordering": false,
        //     "info": true,
        //     "autoWidth": false,
        //     "responsive": true,
        // });
    </script>

@endsection
