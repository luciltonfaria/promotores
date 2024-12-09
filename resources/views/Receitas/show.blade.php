<!-- resources/views/receitas/show.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TSDoctor - Detalhes da Receita</title>
    <link rel="stylesheet" href="{{ asset('assets/css/main.min.css') }}">
</head>
<body>
    <div class="page-wrapper">
        @include('partials.header')
        <div class="main-container">
            @include('partials.sidebar')
            <div class="app-container">
                <div class="app-hero-header d-flex align-items-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <i class="ri-home-8-line lh-1 pe-3 me-3 border-end"></i>
                            <a href="{{ url('/') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ url('/receitas') }}">Receitas</a>
                        </li>
                        <li class="breadcrumb-item text-primary" aria-current="page">
                            Detalhes da Receita
                        </li>
                    </ol>
                </div>
                <div class="app-body">
                    <div class="row">
                        <div class="col-12 mt-4">
                            <div class="card">
                                <div class="card-header d-flex align-items-center justify-content-between">
                                    <h5 class="card-title">Detalhes da Receita</h5>
                                    <a href="{{ url('/receitas') }}" class="btn btn-primary ms-auto">Voltar</a>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3 mb-3">
                                            <label for="data" class="form-label">Data</label>
                                            <input type="text" class="form-control" id="data" value="{{ \Carbon\Carbon::parse($receita->data)->format('d/m/Y') }}" readonly>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="tipo_receita" class="form-label">Tipo de Receita</label>
                                            <input type="text" class="form-control" id="tipo_receita" value="{{ $receita->tipo_receita }}" readonly>
                                        </div>
                                        <div class="col-md-6 mb-6">
                                            <label for="nome_paciente" class="form-label">Nome Paciente</label>
                                            <input type="text" class="form-control" id="nome_paciente" value="{{ $receita->nome_paciente }}" readonly>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-9 mb-3">
                                            <label for="codigo_profissional" class="form-label">Profissional</label>
                                            <input type="text" class="form-control" id="codigo_profissional" value="{{ $receita->profissional->nome }}" readonly>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="imprime_data" class="form-label">Imprimir Data?</label>
                                            <input type="text" class="form-control" id="imprime_data" value="{{ $receita->imprime_data == 'S' ? 'Sim' : 'Não' }}" readonly>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 mb-12">
                                            <label for="medicamentos" class="form-label">Medicamentos Prescritos</label>
                                            <ul class="list-group">
                                                @foreach($receita->medicamentos as $medicamento)
                                                    <li class="list-group-item">
                                                        <strong>Medicamento:</strong> {{ $medicamento->medicamento }}<br>
                                                        <strong>Quantidade:</strong> {{ $medicamento->quantidade }}<br>
                                                        <strong>Modo de Usar:</strong> {{ $medicamento->modo_usar }}
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-3 mb-3">
                                            <form action="{{ route('receitas.viewPDF', $receita->id) }}" method="GET" target="_blank">
                                                @csrf
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="nao_imprimir_data" id="nao_imprimir_data">
                                                    <label class="form-check-label" for="nao_imprimir_data">
                                                        Não Imprimir Data
                                                    </label>
                                                </div>
                                                <button type="submit" class="btn btn-primary mt-2">Imprimir Receituário Controlado</button>
                                            </form>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <form action="{{ route('receitas.printSimplePDF', $receita->id) }}" method="GET" target="_blank">
                                                @csrf
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="nao_imprimir_data" id="nao_imprimir_data_simple">
                                                    <label class="form-check-label" for="nao_imprimir_data_simple">
                                                        Não Imprimir Data
                                                    </label>
                                                </div>
                                                <button type="submit" class="btn btn-secondary mt-2">Imprimir Receituário Simples Simples</button>
                                            </form>
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
                <div class="app-footer bg-white">
                    <span>© TSul Tecnologia 2024</span>
                </div>
            </div>
        </div>
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
