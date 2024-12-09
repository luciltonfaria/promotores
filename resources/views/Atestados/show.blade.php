<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TSDoctor - Detalhes do Atestado</title>

    <!-- Meta -->
    <meta name="description" content="Show Atestado">
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
                        <li class="breadcrumb-item text-primary" aria-current="page">
                            Detalhes do Atestado
                        </li>
                    </ol>
                    <!-- Breadcrumb ends -->

                </div>
                <!-- App Hero header ends -->

                <!-- App body starts -->
                <div class="app-body">

                    <!-- Row starts -->
                    <div class="row">
                        <div class="col-12 mt-4">

                            <!-- Card starts -->
                            <div class="card">
                                <div class="card-header d-flex align-items-center justify-content-between">
                                    <h5 class="card-title">Detalhes do Atestado</h5>
                                    <a href="{{ url('/atestados') }}" class="btn btn-primary ms-auto">Voltar</a>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3 mb-3">
                                            <label for="data" class="form-label">Data</label>
                                            <input type="text" class="form-control" id="data" value="{{ \Carbon\Carbon::parse($atestado->data)->format('d/m/Y') }}" readonly>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="tipo" class="form-label">Tipo</label>
                                            <input type="text" class="form-control" id="tipo" value="{{ $atestado->tipo }}" readonly>
                                        </div>
                                        <div class="col-md-6 mb-6">
                                            <label for="nome_paciente" class="form-label">Nome Paciente</label>
                                            <input type="text" class="form-control fw-bold" id="nome_paciente" value="{{ $atestado->nome_paciente }}" readonly>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-9 mb-3">
                                            <label for="codigo_profissional" class="form-label">Profissional</label>
                                            <input type="text" class="form-control" id="codigo_profissional" value="{{ $atestado->profissional->nome }}" readonly>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="data_comparecimento" class="form-label">Data Comparecimento</label>
                                            <input type="text" class="form-control" id="data_comparecimento" value="{{ \Carbon\Carbon::parse($atestado->data_comparecimento)->format('d/m/Y') }}" readonly>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="hora_comparecimento" class="form-label">Hora Comparecimento</label>
                                            <input type="text" class="form-control" id="hora_comparecimento" value="{{ $atestado->hora_comparecimento }}" readonly>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="dias_afastamento" class="form-label">Dias Afastamento</label>
                                            <input type="text" class="form-control" id="dias_afastamento" value="{{ $atestado->dias_afastamento }}" readonly>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="cid10" class="form-label">CID-10</label>
                                            <input type="text" class="form-control" id="cid10" value="{{ $atestado->cid10 }}" readonly>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="data_impressao" class="form-label">Data Impressão</label>
                                            <input type="text" class="form-control" id="data_impressao" value="{{ \Carbon\Carbon::parse($atestado->data_impressao)->format('d/m/Y') }}" readonly>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 mb-12">
                                            <label for="procedimento_descricao" class="form-label">Descrição do Procedimento</label>
                                            <textarea class="form-control" id="procedimento_descricao" rows="3" readonly>{{ $atestado->procedimento_descricao }}</textarea>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-3 mb-3">
                                            <a href="{{ route('atestados.viewPDF', $atestado->id) }}" target="_blank" class="btn btn-primary">View PDF</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Card ends -->

                        </div>
                    </div>
                    <!-- Row ends -->

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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Vendor Js Files -->
    <!-- Overlay Scroll JS -->
    <script src="{{ asset('assets/vendor/overlay-scroll/jquery.overlayScrollbars.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/overlay-scroll/custom-scrollbar.js') }}"></script>

    <!-- Apex Charts -->
    <script src="{{ asset('assets/vendor/apex/apexcharts.min.js') }}"></script>

    <!-- Custom JS files -->
    <script src="{{ asset('assets/js/custom.js') }}"></script>
</body>

</html>
