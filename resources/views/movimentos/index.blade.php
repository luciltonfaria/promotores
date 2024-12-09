<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TSDoctor - Movimentos Financeiros</title>

    <!-- Meta -->
    <meta name="description" content="Admin dashboard for managing Movimentos Financeiros">
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
                            Movimentos Financeiros
                        </li>
                    </ol>
                    <!-- Breadcrumb ends -->

                </div>
                <!-- App Hero header ends -->

                <!-- App body starts -->
                <div class="app-body">

                    <!-- Row starts -->
                    <div class="row">
                    <div class="row gx-3">
                                <div class="col-xxl-12 col-sm-12">
                                    <div class="card mb-3 bg-4">
                                        <div class="card-body mh-230">

                                            <!-- Row starts -->
                                            <div class="row gx-3">
                                                <div class="col-sm-9">
                                                    <div class="text-white mt-3">
                                                        <h3>Movimento Financeiro</h3>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Row ends -->

                                        </div>
                                    </div>
                                </div>
                            </div>
                        <div class="col-12 mt-4">

                            <!-- Row starts -->
                            <div class="row gx-3">
                                <div class="col-sm-12">
                                    <div class="card">
                                        <div class="card-header d-flex align-items-center justify-content-between">
                                            <h5 class="card-title">Lista de Movimentos Financeiros</h5>
                                            <a href="{{ route('movimentos.create') }}" class="btn btn-primary ms-auto">Novo Movimento</a>
                                        </div>
                                        <div class="card-body">
                                        <div class="search-filters mb-4" style=" background-color: #f9f9f9;">
                                            <form action="{{ route('movimentos.index') }}" method="GET">
                                                <div class="row">
                                                    <!-- Filtro por Intervalo de Data de Pagamento -->
                                                    <div class="col-md-3">
                                                        <label for="data_pagamento_inicio" class="form-label">Data de Pagamento (Início)</label>
                                                        <input type="date" id="data_pagamento_inicio" name="data_pagamento_inicio" class="form-control" value="{{ request('data_pagamento_inicio') }}">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label for="data_pagamento_fim" class="form-label">Data de Pagamento (Fim)</label>
                                                        <input type="date" id="data_pagamento_fim" name="data_pagamento_fim" class="form-control" value="{{ request('data_pagamento_fim') }}">
                                                    </div>

                                                    <!-- Filtro por Intervalo de Data de Vencimento -->
                                                    <div class="col-md-3">
                                                        <label for="data_vencimento_inicio" class="form-label">Data de Vencimento (Início)</label>
                                                        <input type="date" id="data_vencimento_inicio" name="data_vencimento_inicio" class="form-control" value="{{ request('data_vencimento_inicio') }}">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label for="data_vencimento_fim" class="form-label">Data de Vencimento (Fim)</label>
                                                        <input type="date" id="data_vencimento_fim" name="data_vencimento_fim" class="form-control" value="{{ request('data_vencimento_fim') }}">
                                                    </div>

                                                    <!-- Filtro por Nome do Cliente/Paciente -->
                                                    <div class="col-md-3 mt-3">
                                                        <label for="cliente_nome" class="form-label">Nome do Paciente</label>
                                                        <input type="text" id="cliente_nome" name="cliente_nome" class="form-control" placeholder="Digite o nome do paciente" value="{{ request('cliente_nome') }}">
                                                    </div>

                                                    <!-- Filtro por Conta -->
                                                    <div class="col-md-3 mt-3">
                                                        <label for="conta_id" class="form-label">Conta</label>
                                                        <select id="conta_id" name="conta_id" class="form-select select2-searchable">
                                                            <option value="" disabled selected>Selecione a Conta</option>
                                                            @foreach ($contas as $conta)
                                                                <option value="{{ $conta->conta_id }}" {{ request('conta_id') == $conta->conta_id ? 'selected' : '' }}>
                                                                    {{ $conta->descricao }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <!-- Filtro por Forma de Pagamento -->
                                                    <div class="col-md-3 mt-3">
                                                        <label for="forma_pagto" class="form-label">Forma de Pagamento</label>
                                                        <select id="forma_pagto" name="forma_pagto" class="form-select select2-searchable">
                                                            <option value="" disabled selected>Selecione a Forma de Pagamento</option>
                                                            @foreach ($formasPagto as $forma)
                                                                <option value="{{ $forma->id }}" {{ request('forma_pagto') == $forma->id ? 'selected' : '' }}>
                                                                    {{ $forma->descricao }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <!-- Botões de Ação -->
                                                <div class="row mt-3">
                                                    <div class="col-md-12">
                                                        <button type="submit" class="btn btn-primary">Filtrar</button>
                                                        <a href="{{ route('movimentos.index') }}" class="btn btn-secondary">Limpar Filtros</a>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>


                                            <hr>

                                            <!-- Table starts -->
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>Data</th>
                                                            <th>Tipo</th>
                                                            <th>Cliente/Fornecedor</th>
                                                            <th>Receita/Despesa</th>
                                                            <th>Data Vencimento</th>
                                                            <th>Valor Devido</th>
                                                            <th>Data Pagto</th>
                                                            <th>Forma Pagto</th>
                                                            <th>Valor Pago</th>
                                                            <th>Situação</th>
                                                            <th>Ações</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($movimentos as $movimento)
                                                            <tr>
                                                                <td>{{ $movimento->movimento_id }}</td>
                                                                <td>{{ date('d/m/Y', strtotime($movimento->data)) }}</td>
                                                                <td>{{ $movimento->tipo == 'R' ? 'Receita' : 'Despesa' }}</td>
                                                                <td>{{ $movimento->paciente->nome ?? 'Paciente não encontrado' }}</td>
                                                                <td>{{ $movimento->conta->descricao ?? 'Conta não encontrada' }}</td>
                                                                <td>{{ date('d/m/Y', strtotime($movimento->data_vencimento)) }}</td>
                                                                <td>{{ number_format($movimento->valor_devido, 2, ',', '.') }}</td>
                                                                <td>{{ date('d/m/Y',strtotime($movimento->data_pagamento)) }}</td>
                                                                <td>{{ $movimento->formaPagamento->descricao ?? 'N/A' }}</td> 
                                                                <td>{{ number_format($movimento->valor_pago, 2, ',', '.') }}</td>                                                                
                                                                <td>{{ $movimento->situacao == 'P' ? 'Pendente' : ($movimento->situacao == 'Q' ? 'Quitado' : 'Cancelado') }}</td>
                                                                <td>
                                                                    <div class="d-inline-flex gap-1">
                                                                        <a href="{{ route('movimentos.show', $movimento->movimento_id) }}" class="btn btn-success btn-sm" data-bs-toggle="tooltip" title="Ver">
                                                                            <i class="ri-eye-line"></i>
                                                                        </a>
                                                                        <a href="{{ route('movimentos.edit', $movimento->movimento_id) }}" class="btn btn-outline-success btn-sm" data-bs-toggle="tooltip" title="Editar">
                                                                            <i class="ri-edit-line"></i>
                                                                        </a>
                                                                        <form action="{{ route('movimentos.destroy', $movimento->movimento_id) }}" method="POST" class="d-inline-block">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button type="button" class="btn btn-outline-danger btn-sm btn-delete" data-bs-toggle="tooltip" title="Excluir">
                                                                                <i class="ri-delete-bin-line"></i>
                                                                            </button>
                                                                        </form>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <td colspan="6"></td>
                                                            <td colspan="2"><strong>Total Receitas:</strong></td>
                                                            <td>{{ number_format($totalReceitas, 2, ',', '.') }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="6"></td>
                                                            <td colspan="2"><strong>Total Despesas:</strong></td>
                                                            <td>{{ number_format($totalDespesas, 2, ',', '.') }}</td>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                            <!-- Table ends -->

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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).on('click', '.btn-delete', function (e) {
            e.preventDefault();
            var form = $(this).closest('form');
            Swal.fire({
                title: 'Tem certeza?',
                text: "Você não poderá reverter isso!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, delete!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    </script>

    <!-- Vendor Js Files -->
    <script src="{{ asset('assets/vendor/overlay-scroll/jquery.overlayScrollbars.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/overlay-scroll/custom-scrollbar.js') }}"></script>

    <!-- Custom JS files -->
    <script src="{{ asset('assets/js/custom.js') }}"></script>
</body>

</html>
