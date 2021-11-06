@extends('template/template_admin')
@section('conten')
    {{-- secction header --}}
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Dashboard</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    {{-- end section header --}}

    {{-- section conten --}}
    @if (Auth::user()->user_role->role === 1)
        @include('dashbooard/dashboard_admin')
    @endif
    @if (Auth::user()->user_role->role === 2)
        @include('dashbooard/dashboard_dpl')
    @endif
    @if (Auth::user()->user_role->role === 3)
        @include('dashbooard/dashboard_kepala_sekolah')
    @endif
    @if (Auth::user()->user_role->role === 4)
        @include('dashbooard/dashbord_guru_pamong')
    @endif
    {{-- end section conten --}}
@endsection
