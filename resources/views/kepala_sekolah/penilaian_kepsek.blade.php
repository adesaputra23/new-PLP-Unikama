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
                            <a href="" type="button" class="btn btn-success">
                                Export
                            </a>
                        </div>
                    </div>
                </div>

                <div class="mt-2">
                    <div class="tab-pane fade show active" id="tab-2" role="tabpanel" aria-labelledby="tab-2-tab">
                        <div class="table-responsive">
                            <table id="tabel1" class="table table-bordered table-striped table-sm">
                                <thead class="text-center">
                                    <tr>
                                        <th>No</th>
                                        <th>NPM</th>
                                        <th>Nama Mahasiswa</th>
                                        <th>Prodi</th>
                                        <th>Fakultas</th>
                                        <th>Nilai</th>
                                        <th>Grade</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no_plp_2 = 1;
                                    @endphp
                                    @foreach ($list_mhs_plp_2 as $item_plp_2 => $mhs_plp_2)
                                        <tr>
                                            <td class="text-center">{{ $no_plp_2++ }}</td>
                                            <td>{{ $mhs_plp_2->JointoMhs->npm }}</td>
                                            <td>{{ $mhs_plp_2->JointoMhs->nama_mhs }}</td>
                                            <td>{{ $list_prodi[$mhs_plp_2->JointoMhs->program_studi] }}</td>
                                            <td>{{ $list_fakultas[$mhs_plp_2->JointoMhs->fakultas] }}</td>
                                            <th class="text-center">
                                                @if ($mhs_plp_2->JointoPenilaian->nilai_kepsek)
                                                    {{ $mhs_plp_2->JointoPenilaian->nilai_kepsek }}
                                                @else
                                                    {{ '-' }}
                                                @endif
                                            </th>
                                            <th class="text-center">
                                                @if ($mhs_plp_2->JointoPenilaian->grade_kepsek)
                                                    {{ $mhs_plp_2->JointoPenilaian->grade_kepsek }}
                                                @else
                                                    {{ '-' }}
                                                @endif
                                            </th>
                                            <td class="text-center">
                                                @if ($mhs_plp_2->JointoPenilaian->grade_kepsek)
                                                    <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#penilaian"
                                                      type="button" 
                                                      data-id="{{$mhs_plp_2->JointoPenilaian->id_penilaian}}" 
                                                      data-npm="{{$mhs_plp_2->JointoMhs->npm}}" 
                                                      data-nama="{{$mhs_plp_2->JointoMhs->nama_mhs}}"
                                                      data-nilai="{{$mhs_plp_2->JointoPenilaian->nilai_kepsek}}" 
                                                      id="btn-update">
                                                        Edit Nilai
                                                    </button>
                                                @else
                                                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#penilaian"
                                                      type="button" data-npm="{{$mhs_plp_2->JointoMhs->npm}}" data-nama="{{$mhs_plp_2->JointoMhs->nama_mhs}}" id="btn-simpan">
                                                      Set Nilai
                                                    </button>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    {{-- end section conten --}}

    <div class="modal fade" id="penilaian">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('simpan.nilai.kepsek') }}" method="POST">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="id" id="id">
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-4 col-form-label">NPM</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="npm" name="npm" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-4 col-form-label">Nama Mahasiswa</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="nama" name="nama" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-4 col-form-label">Nilai</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" id="nilai" name="nilai" min="{{0}}" max="{{100}}">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Simpan</button>
                        <button type="button" class="btn btn-info" data-dismiss="modal">Batal</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <script>
        $(document).on('click', '#btn-simpan', function(){
            var npm = $(this).data('npm');
            var nama = $(this).data('nama');
            $('#npm').val(npm);
            $('#nama').val(nama);
            $('.modal-title').text('Seting Penilaian');
        })

        $(document).on('click', '#btn-update', function(){
            var id = $(this).data('id');
            var npm = $(this).data('npm');
            var nama = $(this).data('nama');
            var nilai = $(this).data('nilai');
            $('#id').val(id);
            $('#npm').val(npm);
            $('#nama').val(nama);
            $('#nilai').val(nilai);
            $('.modal-title').text('Edit Penilaian');
        })


    </script>


@endsection
