<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TSDoctor - Visualizar Conta</title>

    <!-- Meta -->
    <meta name="description" content="Admin dashboard for managing Contas">
    <meta name="author" content="TSDoctor">
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
                            <a href="{{ url('/contas') }}">Contas</a>
                        </li>
                        <li class="breadcrumb-item text-primary" aria-current="page">
                            Visualizar Conta
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

                            <!-- Row starts -->
                            <div class="row gx-3">
                                <div class="col-xxl-12 col-sm-12">
                                    <div class="card mb-3 bg-4">
                                        <div class="card-body mh-230">

                                            <!-- Row starts -->
                                            <div class="row gx-3">
                                                <div class="col-sm-9">
                                                    <div class="text-white mt-3">
                                                        <h3>Detalhes da Conta</h3>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Row ends -->

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row gx-3">
                                <div class="col-sm-12">
                                    <div class="card">
                                        <div class="card-header d-flex align-items-center justify-content-between">
                                            <h5 class="card-title">Informações da Conta</h5>
                                            <a href="{{ route('contas.index') }}" class="btn btn-primary ms-auto">Voltar</a>
                                        </div>
                                        <div class="card-body">

                                            <!-- Conta details starts -->
                                            <div class="mb-3">
                                                <label class="form-label"><strong>ID:</strong></label>
                                                <p>{{ $conta->conta_id }}</p>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label"><strong>Descrição:</strong></label>
                                                <p>{{ $conta->descricao }}</p>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label"><strong>Tipo:</strong></label>
                                                <p>{{ $conta->tipo == 'R' ? 'Receita' : 'Despesa' }}</p>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label"><strong>Situação:</strong></label>
                                                <p>
                                                    @if ($conta->situacao == 'A')
                                                        Ativo
                                                    @else
                                                        Inativo
                                                    @endif
                                                </p>
                                            </div>

                                            <a href="{{ route('contas.edit', $conta->conta_id) }}" class="btn btn-outline-success">Editar</a>

                                            <form action="{{ route('contas.destroy', $conta->conta_id) }}" method="POST" class="d-inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Tem certeza que deseja excluir esta conta?')">Excluir</button>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Row ends -->

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
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/moment.min.js') }}"></script>

    <!-- Vendor JS Files -->
    <script src="{{ asset('assets/vendor/overlay-scroll/jquery.overlayScrollbars.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/overlay-scroll/custom-scrollbar.js') }}"></script>

    <!-- Custom JS files -->
    <script src="{{ asset('assets/js/custom.js') }}"></script>
</body>

</html>
