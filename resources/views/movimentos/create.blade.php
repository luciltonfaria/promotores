<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TSDoctor - Adicionar Movimento Financeiro</title>

    <!-- Meta -->
    <meta name="description" content="Admin dashboard for managing Movimentos Financeiros">
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
                            Adicionar Movimento Financeiro
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
                                    <h5 class="card-title">Adicionar Movimento Financeiro</h5>
                                </div>
                                <div class="card-body">

                                    <!-- Form starts -->
                                    <form action="{{ route('movimentos.store') }}" method="POST">
                                        @csrf

                                        <!-- First line: Data and Tipo in two columns -->
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="data" class="form-label">Data</label>
                                                <input type="date" name="data" id="data" class="form-control" value="{{ old('data') }}" required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="tipo" class="form-label">Tipo</label>
                                                <select name="tipo" id="tipo" class="form-select" required>
                                                    <option value="" disabled selected>Selecione o Tipo</option>
                                                    <option value="R">Receita</option>
                                                    <option value="D">Despesa</option>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Second line: Conta field -->
                                        <div class="row">
                                            <div class="col-12 mb-3">
                                                <label for="conta_id" class="form-label">Conta</label>
                                                <select name="conta_id" id="conta_id" class="form-select select2-searchable" required>
                                                    <option value="" disabled selected>Selecione a Conta</option>
                                                    @foreach ($contas as $conta)
                                                        <option value="{{ $conta->conta_id }}">{{ $conta->descricao }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Other form fields below -->
                                        <div class="mb-3">
                                            <label for="cliente_fornecedor" class="form-label">Cliente/Fornecedor</label>
                                            <select name="cliente_fornecedor" id="cliente_fornecedor" class="form-select select2-searchable">
                                                <option value="" disabled selected>Selecione um paciente</option>
                                                @foreach ($pacientes as $paciente)
                                                    <option value="{{ $paciente->codigo }}">{{ $paciente->nome }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="forma_pagto" class="form-label">Forma de Pagamento</label>
                                            <select name="forma_pagto" id="forma_pagto" class="form-select select2-searchable">
                                                <option value="" disabled selected>Selecione a Forma de Pagamento</option>
                                                @foreach ($formasPagto as $forma)
                                                    <option value="{{ $forma->id }}">{{ $forma->descricao }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="data_vencimento" class="form-label">Data de Vencimento</label>
                                                <input type="date" name="data_vencimento" id="data_vencimento" class="form-control" value="{{ old('data_vencimento') }}">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="valor_devido" class="form-label">Valor Devido</label>
                                                <input type="text" name="valor_devido" id="valor_devido" class="form-control" value="{{ old('valor_devido') }}" oninput="formatCurrency(this)">
                                            </div>    
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="data_pagamento" class="form-label">Data de Pagamento</label>
                                                <input type="date" name="data_pagamento" id="data_pagamento" class="form-control" value="{{ old('data_pagamento') }}">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="valor_pago" class="form-label">Valor Pago</label>
                                                <input type="text"  name="valor_pago" id="valor_pago" class="form-control" value="{{ old('valor_pago') }}" oninput="formatCurrency(this)">
                                            </div>    
                                        </div>
                                        

                                        <div class="mb-3">
                                            <label for="situacao" class="form-label">Situação</label>
                                            <select name="situacao" id="situacao" class="form-select" required>
                                                <option value="" disabled selected>Selecione a Situação</option>
                                                <option value="P" {{ old('situacao') == 'P' ? 'selected' : '' }}>Pendente</option>
                                                <option value="Q" {{ old('situacao') == 'Q' ? 'selected' : '' }}>Quitado</option>
                                                <option value="C" {{ old('situacao') == 'C' ? 'selected' : '' }}>Cancelado</option>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="repetir_tipo">Repetir:</label>
                                            <select name="repetir_tipo" id="repetir_tipo" class="form-control">
                                                <option value="">Não repetir</option>
                                                <option value="dias">A cada X dias</option>
                                                <option value="mensal">Todo mês</option>
                                                <option value="vezes">Repetir X vezes</option>
                                            </select>
                                        </div>

                                        <div class="mb-3 form-group">
                                            <label for="repetir_valor">Valor de repetição:</label>
                                            <input type="number" name="repetir_valor" id="repetir_valor" class="form-control">
                                        </div>

                                        <button type="submit" class="btn btn-primary">Salvar</button>
                                        <a href="{{ route('movimentos.index') }}" class="btn btn-secondary">Cancelar</a>
                                    </form>
                                    <!-- Form ends -->

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

    <!-- Select2 JS for searchable dropdown -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            // Inicializa o Select2 para o campo de Conta
            $('#conta_id').select2({
                placeholder: "Selecione a Conta",  // Placeholder para o campo de Conta
                allowClear: true                   // Permite limpar a seleção
            });

            // Inicializa o Select2 para o campo cliente_fornecedor (Paciente)
            $('#cliente_fornecedor').select2({
                placeholder: "Selecione um paciente",  // Placeholder para o campo de Paciente
                allowClear: true                       // Permite limpar a seleção
            });
            // Inicializa o Select2 para o campo forma_pagto (Forma de Pagamento)
            $('#forma_pagto').select2({
                placeholder: "Selecione a Forma de Pagamento",  // Placeholder para o campo de Forma de Pagamento
                allowClear: true                                // Permite limpar a seleção
            });
            
        });
    </script>


    <script>
        function formatCurrency(input) {
            // Remove tudo que não seja dígito e vírgula
            let value = input.value.replace(/\D/g, '');
            
            // Divide os centavos
            let parts = value.split(/(\d{2})$/);

            // Formata o valor com separador de milhar e vírgula para decimal
            input.value = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ".") + (parts[1] ? ',' + parts[1] : '');
        }
    </script>

    



</body>

</html>
