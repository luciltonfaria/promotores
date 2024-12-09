<!-- resources/views/atestados/edit.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TSDoctor - Editar Atestado</title>

    <!-- Meta -->
    <meta name="description" content="Edit Atestado">
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
                            Editar Atestado
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
                                    <h5 class="card-title">Editar Atestado</h5>
                                </div>
                                <div class="card-body">

                                    <!-- Form starts -->
                                    <form action="{{ url('/atestados/' . $atestado->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')

                                        <div class="mb-3">
                                            <label for="data" class="form-label">Data</label>
                                            <input type="date" class="form-control" id="data" name="data" value="{{ $atestado->data }}" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="tipo" class="form-label">Tipo</label>
                                            <input type="text" class="form-control" id="tipo" name="tipo" value="{{ $atestado->tipo }}" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="nome_paciente" class="form-label">Nome Paciente</label>
                                            <input type="text" class="form-control" id="nome_paciente" name="nome_paciente" value="{{ $atestado->nome_paciente }}" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="codigo_paciente" class="form-label">Código Paciente</label>
                                            <input type="text" class="form-control" id="codigo_paciente" name="codigo_paciente" value="{{ $atestado->codigo_paciente }}" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="codigo_profissional" class="form-label">Profissional</label>
                                            <select class="form-control" id="codigo_profissional" name="codigo_profissional" required>
                                                @foreach ($profissionais as $profissional)
                                                    <option value="{{ $profissional->codigo }}" {{ $atestado->codigo_profissional == $profissional->codigo ? 'selected' : '' }}>
                                                        {{ $profissional->nome }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="data_comparecimento" class="form-label">Data Comparecimento</label>
                                            <input type="date" class="form-control" id="data_comparecimento" name="data_comparecimento" value="{{ $atestado->data_comparecimento }}">
                                        </div>

                                        <div class="mb-3">
                                            <label for="hora_comparecimento" class="form-label">Hora Comparecimento</label>
                                            <input type="time" class="form-control" id="hora_comparecimento" name="hora_comparecimento" value="{{ $atestado->hora_comparecimento }}">
                                        </div>

                                        <div class="mb-3">
                                            <label for="dias_afastamento" class="form-label">Dias Afastamento</label>
                                            <input type="number" class="form-control" id="dias_afastamento" name="dias_afastamento" value="{{ $atestado->dias_afastamento }}">
                                        </div>

                                        <div class="mb-3">
                                            <label for="cid10" class="form-label">CID-10</label>
                                            <input type="text" class="form-control" id="cid10" name="cid10" value="{{ $atestado->cid10 }}">
                                        </div>

                                        <div class="mb-3">
                                            <label for="procedimento_descricao" class="form-label">Descrição do Procedimento</label>
                                            <textarea class="form-control" id="procedimento_descricao" name="procedimento_descricao" rows="3">{{ $atestado->procedimento_descricao }}</textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label for="data_impressao" class="form-label">Data Impressão</label>
                                            <input type="datetime-local" class="form-control" id="data_impressao" name="data_impressao" value="{{ $atestado->data_impressao }}">
                                        </div>

                                        <button type="submit" class="btn btn-primary">Salvar</button>
                                    </form>
                                    <!-- Form ends -->

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
