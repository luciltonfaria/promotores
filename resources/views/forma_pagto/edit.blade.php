<!-- resources/views/forma_pagto/edit.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar Forma de Pagamento</title>
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
    <div class="page-wrapper">
        @include('partials.header')

        <div class="main-container">
            @include('partials.sidebar')

            <div class="app-container">
                <div class="app-hero-header">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ url('/') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ url('/forma_pagto') }}">Formas de Pagamento</a>
                        </li>
                        <li class="breadcrumb-item text-primary">Editar</li>
                    </ol>
                </div>

                <div class="app-body">
                    <div class="row">
                        <!-- App hero header starts -->
                <div class="app-hero-header d-flex align-items-center">
                    <!-- Breadcrumb starts -->
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <i class="ri-home-8-line lh-1 pe-3 me-3 border-end"></i>
                            <a href="{{ url('/') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ url('/especialidades') }}">Forma de Pagamento</a>
                        </li>
                        <li class="breadcrumb-item text-primary" aria-current="page">
                            Editar Especialidade
                        </li>
                    </ol>
                    <!-- Breadcrumb ends -->
                </div>
                <!-- App Hero header ends -->

                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <form action="{{ url('/forma_pagto/' . $formaPagto->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="mb-3">
                                            <label for="descricao" class="form-label">Descrição</label>
                                            <input type="text" class="form-control" id="descricao" name="descricao" value="{{ $formaPagto->descricao }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="lanca_quitacao" class="form-label">Lança Quitação</label>
                                            <select class="form-control" id="lanca_quitacao" name="lanca_quitacao" required>
                                                <option value="S" {{ $formaPagto->lanca_quitacao == 'S' ? 'selected' : '' }}>Sim</option>
                                                <option value="N" {{ $formaPagto->lanca_quitacao == 'N' ? 'selected' : '' }}>Não</option>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Atualizar</button>
                                        <a href="{{ url('/forma_pagto') }}" class="btn btn-secondary">Cancelar</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="app-footer bg-white">
                    <span>© TSul Tecnologia 2024</span>
                </div>
            </div>
        </div>
    </div>
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
