<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TSDoctor - Detalhes do Recibo</title>

    <!-- Meta -->
    <meta name="description" content="Detalhes do Recibo">
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
                            <a href="{{ route('recibos.index') }}">Recibos</a>
                        </li>
                        <li class="breadcrumb-item text-primary" aria-current="page">
                            Detalhes do Recibo
                        </li>
                    </ol>
                    <!-- Breadcrumb ends -->
                </div>
                <!-- App Hero header ends -->

                <!-- App body starts -->
                <div class="app-body">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Detalhes do Recibo</h5>
                            <a href="{{ route('recibos.index') }}" class="btn btn-primary ms-auto">Voltar</a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="nome" class="form-label">Nome</label>
                                    <input type="text" class="form-control" id="nome" value="{{ $recibo->nome }}" readonly>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="valor" class="form-label">Valor</label>
                                    <input type="text" class="form-control" id="valor" value="R$ {{ number_format($recibo->valor, 2, ',', '.') }}" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="referencia" class="form-label">Referência</label>
                                    <input type="text" class="form-control" id="referencia" value="{{ $recibo->referencia }}" readonly>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="emitido" class="form-label">Emitido</label>
                                    <input type="text" class="form-control" id="emitido" value="{{ $recibo->emitido == 'S' ? 'Sim' : 'Não' }}" readonly>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="dt_emissao" class="form-label">Data de Emissão</label>
                                    <input type="text" class="form-control" id="dt_emissao" value="{{ $recibo->dt_emissao ? \Carbon\Carbon::parse($recibo->dt_emissao)->format('d/m/Y') : '' }}" readonly>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-3 mb-3">
                                    <a href="{{ route('recibos.viewPDF', $recibo->id) }}" target="_blank" class="btn btn-primary">Visualizar PDF</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Card ends -->
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
    <script src="{{ asset('assets/vendor/overlay-scroll/jquery.overlayScrollbars.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/overlay-scroll/custom-scrollbar.js') }}"></script>
    <script src="{{ asset('assets/vendor/apex/apexcharts.min.js') }}"></script>
</body>

</html>
