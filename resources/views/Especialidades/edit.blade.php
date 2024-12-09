<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TSDoctor - Editar Especialidade</title>
    <link rel="stylesheet" href="{{ asset('assets/css/main.min.css') }}">
    <!-- Meta -->
    <meta name="description" content="Marketplace for Bootstrap Admin Dashboards">
    <meta name="author" content="Bootstrap Gallery">
    <link rel="canonical" href="https://www.bootstrap.gallery/">
    <meta property="og:url" content="https://www.bootstrap.gallery">
    <meta property="og:title" content="Admin Templates - Dashboard Templates | Bootstrap Gallery">
    <meta property="og:description" content="Marketplace for Bootstrap Admin Dashboards">
    <meta property="og:type" content="Website">
    <meta property="og:site_name" content="Bootstrap Gallery">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.svg') }}">

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/remix/remixicon.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main.min.css') }}">

    <!-- Scrollbar CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/overlay-scroll/OverlayScrollbars.min.css') }}">

</head>

<body>
    <!-- Page wrapper starts -->
    <div class="page-wrapper">
        <!-- App header starts -->
        @include('partials.header')
        <!-- App header ends -->

        <!-- Main container starts -->
        <div class="main-container">
            <!-- Sidebar wrapper starts -->
            @include('partials.sidebar')
            <!-- Sidebar wrapper ends -->

            <!-- App container starts -->
            <div class="app-container">
                <!-- App hero header starts -->
                <div class="app-hero-header d-flex align-items-center">
                    <!-- Breadcrumb starts -->
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <i class="ri-home-8-line lh-1 pe-3 me-3 border-end"></i>
                            <a href="{{ url('/') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ url('/especialidades') }}">Especialidades</a>
                        </li>
                        <li class="breadcrumb-item text-primary" aria-current="page">
                            Editar Especialidade
                        </li>
                    </ol>
                    <!-- Breadcrumb ends -->
                </div>
                <!-- App Hero header ends -->

                <!-- App body starts -->
                <div class="app-body">
                    <div class="row">
                        <div class="col-12 mt-4">
                            <div class="card">
                                <div class="card-header d-flex align-items-center justify-content-between">
                                    <h5 class="card-title">Editar Especialidade</h5>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('especialidades.update', $especialidade->cod_espec) }}" method="POST">
                                        @csrf
                                        @method('PUT')

                                        <!-- Row starts -->
                                        <div class="row gx-3">

                                            <div class="col-xxl-9 col-lg-6 col-sm-6">
                                                <div class="mb-3">
                                                    <label for="especialidade" class="form-label">Especialidade</label>
                                                    <input type="text" name="especialidade" id="especialidade" class="form-control" value="{{ $especialidade->especialidade }}" required>
                                                </div>
                                            </div>

                                            <div class="col-xxl-12 col-lg-4 col-sm-6">
                                                <button type="submit" class="btn btn-primary">Salvar</button>
                                                <a href="{{ route('especialidades.index') }}" class="btn btn-secondary">Cancelar</a>
                                            </div>
                                        </div>
                                        <!-- Row ends -->
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- App body ends -->

                <!-- App footer starts -->
                <div class="app-footer bg-white">
                    <span>© TSul Tecnologia 2024</span>
                </div>
                <!-- App footer ends -->
            </div>
            <!-- App container ends -->
        </div>
        <!-- Main container ends -->
    </div>
    <!-- Page wrapper ends -->

    <!-- JavaScript Files -->
    <!-- Required jQuery first, then Bootstrap Bundle JS -->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/moment.min.js') }}"></script>

    <!-- Vendor Js Files -->
    <!-- Overlay Scroll JS -->
    <script src="{{ asset('assets/vendor/overlay-scroll/jquery.overlayScrollbars.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/overlay-scroll/custom-scrollbar.js') }}"></script>

    <!-- Apex Charts -->
    <script src="{{ asset('assets/vendor/apex/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/apex/custom/dentist/patients.js') }}"></script>
    <script src="{{ asset('assets/vendor/apex/custom/dentist/appointments.js') }}"></script>
    <script src="{{ asset('assets/vendor/apex/custom/dentist/surgeries.js') }}"></script>
    <script src="{{ asset('assets/vendor/apex/custom/dentist/income.js') }}"></script>
    <script src="{{ asset('assets/vendor/apex/custom/dentist/earnings.js') }}"></script>
    <script src="{{ asset('assets/vendor/apex/custom/dentist/gender-age.js') }}"></script>
    <script src="{{ asset('assets/vendor/apex/custom/dentist/claims.js') }}"></script>

    <!-- Custom JS files -->
    <script src="{{ asset('assets/js/custom.js') }}"></script>
</body>

</html>
