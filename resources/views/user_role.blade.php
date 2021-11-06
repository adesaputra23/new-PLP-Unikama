@extends('template/template_admin')
@section('conten')
    {{-- secction header --}}
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>User Role</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item">User Role</li>
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
                <h3 class="card-title">Data User</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>

            <div class="card-body">
                {{-- <div class="mb-2">
                    <button type="button" class="btn btn-block btn-primary btn-flat btn-sm" style="width: 10%">
                    <i class="fa fa-plus"></i><b> User</b></button>
                </div> --}}
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="width: 10px">No</th>
                            <th>NIK/NIDN</th>
                            <th>Nama User</th>
                            <th>User Role</th>
                            <th style="width: 40px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($list_user as $items => $user)
                            <tr>
                                <td>{{ $items + 1 }}</td>
                                <td>{{ $user->nik }}</td>
                                <td>
                                    {{ $user->get_pegawai != null ? $user->get_pegawai->nama_peg : '' }}
                                    {{ $user->get_dpl != null ? $user->get_dpl->nama_dpl : '' }}
                                    {{ $user->get_kepala_sekolah != null ? $user->get_kepala_sekolah->nama_kepsek : '' }}
                                    {{ $user->get_guru_pamong != null ? $user->get_guru_pamong->nama_guru_pamong : '' }}

                                </td>
                                <td><span class="badge bg-info">{{ $list_role[$user->user_role->role] }}</span></td>
                                <td>
                                    <div class="btn-group">
                                        {{-- <button type="button" class="btn btn-warning btn-sm">Edit</button> --}}
                                        @if ($user->user_role->role == 1)
                                            <button type="button" class="btn btn-danger btn-sm" type="button"
                                                data-toggle="modal" data-target="#hapus-admin">Hapus</button>
                                        @else
                                            @if ($user->user_role->role == 2)
                                                @if (empty($user->get_dpl->JointoZonasi))
                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                        data-target="#hapus-dpl" id="btn-hapus-dpl"
                                                        data-nik_dpl="{{ $user->nik }}">Hapus</button>
                                                @else
                                                    <button type="button" class="btn btn-danger btn-sm" type="button"
                                                        data-toggle="modal" data-target="#tidak-hapus-dpl">Hapus</button>
                                                @endif
                                            @elseif($user->user_role->role == 3)
                                                @if (empty($user->get_kepala_sekolah->JointoZonasi))
                                                    <button class="btn btn-danger btn-sm" type="button" data-toggle="modal"
                                                        data-target="#hapus-kepsek" id="btn-hapus-kepsek"
                                                        data-nik_kepsek="{{ $user->nik }}">Hapus</button>
                                                @else
                                                    <button class="btn btn-danger btn-sm" type="button" data-toggle="modal"
                                                        data-target="#tidak-hapus-kepsek">Hapus</button>
                                                @endif
                                            @elseif($user->user_role->role == 4)
                                                @if (empty($user->get_guru_pamong->JointoZonasi))
                                                    <button type="button" data-toggle="modal" data-target="#hapus-gp"
                                                        id="btn-hapus-gp" data-nik_gp="{{ $user->nik }}"
                                                        class="btn btn-danger btn-sm">Hapus</button>
                                                @else
                                                    <button type="button" data-toggle="modal" data-target="#tidak-hapus-gp"
                                                        class="btn btn-danger btn-sm">Hapus</button>
                                                @endif
                                            @endif
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    {{-- end section conten --}}

    {{-- modal pop up --}}
    <div class="modal fade" id="hapus-admin">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Hapus User</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="text-center">Role user Admin tidak bisa di hapus.</p>
                </div>
                <div class="modal-footer">
                    {{-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> --}}
                    <button type="button" class="btn btn-info" data-dismiss="modal">Keluar</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    {{-- modal pop up --}}
    <div class="modal fade" id="tidak-hapus-dpl">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Hapus User</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="text-center">Role user ini terkait dengan data zonasi, tidak bisa di hapus.</p>
                </div>
                <div class="modal-footer">
                    {{-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> --}}
                    <button type="button" class="btn btn-info" data-dismiss="modal">Keluar</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    {{-- modal pop up --}}
    <div class="modal fade" id="hapus-dpl">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Hapus User</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('hapus.user') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" id="nik_dpl" name="nik_dpl">
                        <p class="text-center">Anda yakin ingin menghapus data ini?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Hapus</button>
                        <button type="button" class="btn btn-info" data-dismiss="modal">Keluar</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    {{-- modal pop up --}}
    <div class="modal fade" id="tidak-hapus-kepsek">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Hapus User</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="text-center">Role user ini terkait dengan data zonasi, tidak bisa di hapus.</p>
                </div>
                <div class="modal-footer">
                    {{-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> --}}
                    <button type="button" class="btn btn-info" data-dismiss="modal">Keluar</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    {{-- modal pop up --}}
    <div class="modal fade" id="hapus-kepsek">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Hapus User</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('hapus.user') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" id="nik_kepsek" name="nik_kepsek">
                        <p class="text-center">Anda yakin ingin menghapus data ini?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Hapus</button>
                        <button type="button" class="btn btn-info" data-dismiss="modal">Keluar</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    {{-- modal pop up --}}
    <div class="modal fade" id="hapus-gp">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Hapus User</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('hapus.user') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="nik_gp" id="nik_gp">
                        <p class="text-center">Anda yakin ingin menghapus data ini?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Hapus</button>
                        <button type="button" class="btn btn-info" data-dismiss="modal">Keluar</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    {{-- modal pop up --}}
    <div class="modal fade" id="tidak-hapus-gp">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Hapus User</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="text-center">Role user ini terkait dengan data zonasi, tidak bisa di hapus.</p>
                </div>
                <div class="modal-footer">
                    {{-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> --}}
                    <button type="button" class="btn btn-info" data-dismiss="modal">Keluar</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->


    <script>
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "ordering": false,
            // dom: 'Bfrtip',
            // buttons: [{
            //     text: '<i class="fa fa-plus-circle fa-x5"></i> User',
            //     action: function(e, dt, node, config) {
            //         window.location = "{{ url('add-form-user') }}";
            //     }
            // }],
            // initComplete: function() {
            //     var btns = $('.dt-button');
            //     btns.addClass('btn btn-primary  btn-sm btn-with');
            //     btns.removeClass('dt-button');
            // }
        })

        $(document).on('click', '#btn-hapus-gp', function() {
            var nik_gp = $(this).data('nik_gp');
            $('#nik_gp').val(nik_gp);
        })

        $(document).on('click', '#btn-hapus-kepsek', function() {
            var nik_kepsek = $(this).data('nik_kepsek');
            $('#nik_kepsek').val(nik_kepsek);
        })

        $(document).on('click', '#btn-hapus-dpl', function() {
            var nik_dpl = $(this).data('nik_dpl');
            $('#nik_dpl').val(nik_dpl);
        })
    </script>

@endsection
