@extends('template.template_conten')
@section('conten')
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg bg-secondary text-uppercase fixed-top" id="mainNav">
        <div class="container">
            <a class="navbar-brand" href="#page-top">PLP-UNIKAMA</a>
            <button class="navbar-toggler text-uppercase font-weight-bold bg-primary text-white rounded" type="button"
                data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive"
                aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="#portfolio">Menu</a>
                    </li>
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="#about">Tentang</a>
                    </li>
                    <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded"
                            href="{{ route('login') }}">Login</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Masthead-->
    <header class="masthead bg-primary text-white text-center">
        <div class="container d-flex align-items-center flex-column">
            <!-- Masthead Avatar Image-->
            <img class="masthead-avatar mb-5" src="assets/img/Unikama.PNG" alt="..." />
            <!-- Masthead Heading-->
            <h1 class="masthead-heading text-uppercase mb-0">PLP-UNIKAMA</h1>
            <!-- Icon Divider-->
            <div class="divider-custom divider-light">
                <div class="divider-custom-line"></div>
                <div class="divider-custom-line"></div>
                <div class="divider-custom-line"></div>
                <div class="divider-custom-line"></div>
            </div>
            <!-- Masthead Subheading-->
            <p class="masthead-subheading font-weight-light mb-0">
                Program Pengenalan Lingkungan Persekolahan (PLP) tetap akan dilaksanakan dengan menyesuaikan kondisi saat
                ini. Mahasiswa yang telah memenuhi syarat diharapkan segera melakukan pemilihan sekolah untuk mengikuti
                program kegiatan ini, dengan klik buton Zonasi Sekolah pada tab Menu di bawah.
            </p>
        </div>
    </header>
    <!-- Portfolio Section-->
    <section class="page-section portfolio" id="portfolio">
        <div class="container">
            <!-- Portfolio Section Heading-->
            <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Menu</h2>
            <!-- Icon Divider-->
            <div class="divider-custom">
                <div class="divider-custom-line"></div>
                <div class="divider-custom-line"></div>
                <div class="divider-custom-line"></div>
                <div class="divider-custom-line"></div>
            </div>
            <!-- Portfolio Grid Items-->
            <div class="row justify-content-center">
                <!-- Portfolio Item 1-->
                <div class="col-md-6 col-lg-4 mb-5">
                    <a href="{{ route('zonasi') }}">
                        <div class="portfolio-item mx-auto">
                            <div
                                class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                                <div class="portfolio-item-caption-content text-center text-white"><i
                                        class="fas fa-plus fa-3x"></i></div>
                            </div>
                            <img class="img-fluid" src="{{ asset('assets/img/portfolio') }}" alt="..." />
                            <h4 class="text-center mt-2">Zonasi Sekolah</h4>
                        </div>
                    </a>
                </div>

                <!-- Portfolio Item 2-->
                <div class="col-md-6 col-lg-4 mb-5">
                    <a href="{{ url('pengumuman') }}">
                        <div class="portfolio-item mx-auto" data-bs-toggle="modal" data-bs-target="#portfolioModal2">
                            <div
                                class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                                <div class="portfolio-item-caption-content text-center text-white"><i
                                        class="fas fa-plus fa-3x"></i></div>
                            </div>
                            <img class="img-fluid" src="assets/img/portfolio/cake.png" alt="..." />
                            <h4 class="text-center mt-2">Pengumuman</h4>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- About Section-->
    <section class="page-section bg-primary text-white mb-0" id="about">
        <div class="container">
            <!-- About Section Heading-->
            <h2 class="page-section-heading text-center text-uppercase text-white">Tentang</h2>
            <!-- Icon Divider-->
            <div class="divider-custom divider-light">
                <div class="divider-custom-line"></div>
                <div class="divider-custom-line"></div>
                <div class="divider-custom-line"></div>
                <div class="divider-custom-line"></div>
            </div>
            <!-- About Section Content-->
            <div class="row">
                <div class="col-lg-4 ms-auto">
                    <p class="lead">Freelancer is a free bootstrap theme created by Start Bootstrap. The download
                        includes the complete source files including HTML, CSS, and JavaScript as well as optional SASS
                        stylesheets for easy customization.</p>
                </div>
                <div class="col-lg-4 me-auto">
                    <p class="lead">You can create your own custom avatar for the masthead, change the icon in the
                        dividers, and add your email address to the contact form to make it fully functional!</p>
                </div>
            </div>
        </div>
    </section>
@endsection
