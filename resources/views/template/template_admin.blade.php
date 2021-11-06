<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'PREDIKSI-PRODUKSI') }}</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('Admin/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('Admin/dist/css/adminlte.min.css') }}">
    {{-- data tabel --}}
    <link rel="stylesheet" href="{{ asset('Admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('Admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('Admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    {{-- is check --}}
    <link rel="stylesheet" href="{{ asset('Admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.0/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">


    <!-- jQuery -->
    <script src="{{ asset('Admin/plugins/jquery/jquery.min.js') }}"></script>

    <script src="{{ asset('Admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('Admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('Admin/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('Admin/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>

</head>
<style>
    .btn-with {
        width: 170%;
    }

</style>

{{-- auth callback --}}
@php
use App\UserRole;
$role = Auth::user()->user_role->role;
$pegawai = Auth::user()->get_pegawai;
$dpl = Auth::user()->get_dpl;
$kepala_sekolah = Auth::user()->get_kepala_sekolah;
$guru_pamong = Auth::user()->get_guru_pamong;
$nama_user = '';

if (empty($pegawai->nama_peg)) {
    if (empty($dpl->nama_dpl)) {
        if (empty($kepala_sekolah->nama_kepsek)) {
            $nama_user = $guru_pamong->nama_guru_pamong;
        } else {
            $nama_user = $kepala_sekolah->nama_kepsek;
        }
    } else {
        $nama_user = $dpl->nama_dpl;
    }
} else {
    $nama_user = $pegawai->nama_peg;
}

if ($role === 1) {
    $role = 'ADMIN';
} elseif ($role === 2) {
    $role = 'DPL';
} elseif ($role === 3) {
    $role = 'KEPALA SEKOLAH';
} else {
    $role = 'GURU PAMONG';
}
@endphp

<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">

                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="fas fa-th-large"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-item dropdown-header">User Acount</span>
                        <div class="dropdown-divider"></div>
                        {{-- <a href="#" class="dropdown-item">
                            <i class="fas fa-user"></i> Profile
                        </a> --}}
                        <div class="dropdown-divider"></div>
                        <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault(); 
                        document.getElementById('logout-form').submit();" {{ __('Logout') }}>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                class="d-none">
                                @csrf
                            </form>
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                    </div>
                </li>

            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="../../index3.html" class="brand-link">
                <b><span
                        class="brand-text font-weight-light">{{ config('app.name', 'PREDIKSI-PRODUKSI') }}</span></b>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ asset('images/default.PNG') }}" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">{{ $nama_user }}</a>
                        <a href="#" class="d-block text-right"><b>{{ $role }}</b></a>
                        <a href="#" class="d-block text-right text-warning">online</a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-1">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="{{ route('dashboard') }}" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>

                        @if ($role == 'ADMIN')
                            <li class="nav-header">MASTER DATA</li>
                            <li class="nav-item">
                                <a href="{{ route('data.mhs') }}" class="nav-link">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>
                                        Mahasiswa
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('data.sekolah') }}" class="nav-link">
                                    <i class="nav-icon fas fa-school"></i>
                                    <p>
                                        Sekolah Mitra
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('data.dpl') }}" class="nav-link">
                                    <i class="nav-icon fas fa-chalkboard-teacher"></i>
                                    <p>
                                        DPL
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('data.zonasi') }}" class="nav-link">
                                    <i class="nav-icon fas fa-users-cog"></i>
                                    <p>
                                        Zonasi
                                    </p>
                                </a>
                            </li>

                            <li class="nav-header">LAPORAN PENILAIAN</li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-chart-pie"></i>
                                    <p>
                                        Laporan Penilaian
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('laporan.penilaian.sekolah') }}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Penilaian Sekolah</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('laporan.penilaian.dpl') }}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Penilaian DPL</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('rekap.nilai') }}" class="nav-link">
                                    <i class="nav-icon fas fa-user-cog"></i>
                                    <p>
                                        Rekap Nilai
                                    </p>
                                </a>
                            </li>

                            <li class="nav-header">USER DATA</li>
                            <li class="nav-item">
                                <a href="{{ route('user.role') }}" class="nav-link">
                                    <i class="nav-icon fas fa-user-cog"></i>
                                    <p>
                                        User Role
                                    </p>
                                </a>
                            </li>

                            <li class="nav-header">INDIKATOR PENILAIAN </li>

                            <li class="nav-item">
                                <a href="{{ route('indikator.sekolah') }}" class="nav-link">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>
                                        Penilaian Sekolah
                                    </p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('indikator.dpl') }}" class="nav-link">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>
                                        Penilaian DPL
                                    </p>
                                </a>
                            </li>
                        @endif

                        @if ($role == 'DPL')
                            <li class="nav-item">
                                <a href="{{ route('data.zonasi') }}" class="nav-link">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>
                                        Mahasiswa
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('penilaian.dpl.p1') }}" class="nav-link">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>
                                        Penilaian
                                    </p>
                                </a>
                            </li>
                            {{-- <li class="nav-item">
                                <a href="" class="nav-link">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>
                                        Rekpan Penilaian
                                    </p>
                                </a>
                            </li> --}}
                        @endif

                        @if ($role == 'KEPALA SEKOLAH')
                            <li class="nav-item">
                                <a href="{{ route('data.zonasi') }}" class="nav-link">
                                    <i class="nav-icon fas fa-users-cog"></i>
                                    <p>
                                        Mahasiswa
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('data.guru.pamong') }}" class="nav-link">
                                    <i class="nav-icon fas fa-user-cog"></i>
                                    <p>
                                        Guru Pamong
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('penilaian.kepsek') }}" class="nav-link">
                                    <i class="nav-icon fas fa-user-cog"></i>
                                    <p>
                                        Penilaian
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('laporan.penilaian') }}" class="nav-link">
                                    <i class="nav-icon fas fa-user-cog"></i>
                                    <p>
                                        Laporan Penilaian
                                    </p>
                                </a>
                            </li>
                        @endif

                        @if ($role == 'GURU PAMONG')
                            <li class="nav-item">
                                <a href="{{ route('data.zonasi') }}" class="nav-link">
                                    <i class="nav-icon fas fa-users-cog"></i>
                                    <p>
                                        Mahasiswa
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('data.penilaian') }}" class="nav-link">
                                    <i class="nav-icon fas fa-users-cog"></i>
                                    <p>
                                        Penilaian
                                    </p>
                                </a>
                            </li>
                        @endif

                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @yield('conten')
        </div>
        <!-- /.content-wrapper -->

        <footer class="main-footer">
            <strong>Copyright &copy; MyApp.</strong>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    {{-- alert --}}
    @include('sweetalert::alert')

    <!-- Bootstrap 4 -->
    <script src="{{ asset('Admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- AdminLTE App -->
    <script src="{{ asset('Admin/dist/js/adminlte.min.js') }}"></script>
    <!-- AdminLTE for demo purposes
<script src="{{ asset('Admin/dist/js/demo.js') }}"></script> -->

</body>

</html>
