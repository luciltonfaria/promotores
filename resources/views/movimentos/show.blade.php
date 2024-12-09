<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TSDoctor - Visualizar Movimento Financeiro</title>

    <!-- Meta -->
    <meta name="description" content="Admin dashboard for viewing Movimentos Financeiros">
    <meta name="author" content="TSDoctor">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.svg') }}">

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/remix/remixicon.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main.min.css') }}">

    <!-- Select2 CSS for searchable dropdown -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

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
                            <a href="{{ url('/movimentos') }}">Movimentos Financeiros</a>
                        </li>
                        <li class="breadcrumb-item text-primary" aria-current="page">
                            Visualizar Movimento Financeiro
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
                                    <h5 class="card-title">Detalhes do Movimento Financeiro</h5>
                                </div>
                                <div class="card-body">

                                    <!-- Display form fields in read-only mode -->
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="data" class="form-label">Data</label>
                                            <input type="date" id="data" class="form-control" value="{{ $movimento->data }}" disabled>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="tipo" class="form-label">Tipo</label>
                                            <input type="text" id="tipo" class="form-control" value="{{ $movimento->tipo == 'R' ? 'Receita' : 'Despesa' }}" disabled>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12 mb-3">
                                            <label for="conta_id" class="form-label">Conta</label>
                                            <input type="text" id="conta_id" class="form-control" value="{{ $movimento->conta->descricao ?? 'Conta não encontrada' }}" disabled>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="cliente_fornecedor" class="form-label">Cliente/Fornecedor</label>
                                        <input type="text" id="cliente_fornecedor" class="form-control" value="{{ $movimento->paciente->nome ?? 'Paciente não encontrado' }}" disabled>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="data_vencimento" class="form-label">Data de Vencimento</label>
                                            <input type="date" id="data_vencimento" class="form-control" value="{{ $movimento->data_vencimento }}" disabled>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="valor_devido" class="form-label">Valor Devido</label>
                                            <input type="text" id="valor_devido" class="form-control" value="{{ number_format($movimento->valor_devido, 2, ',', '.') }}" disabled>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="data_pagamento" class="form-label">Data de Pagamento</label>
                                            <input type="date" id="data_pagamento" class="form-control" value="{{ $movimento->data_pagamento }}" disabled>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="valor_pago" class="form-label">Valor Pago</label>
                                            <input type="text" id="valor_pago" class="form-control" value="{{ number_format($movimento->valor_pago, 2, ',', '.') }}" disabled>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="situacao" class="form-label">Situação</label>
                                        <input type="text" id="situacao" class="form-control" value="{{ $movimento->situacao == 'P' ? 'Pendente' : ($movimento->situacao == 'Q' ? 'Quitado' : 'Cancelado') }}" disabled>
                                    </div>

                                    <a href="{{ route('movimentos.index') }}" class="btn btn-secondary">Voltar</a>
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
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

</body>

</html>
