<!-- resources/views/procedimentos/index.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TSDoctor</title>

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
                            Especialidades
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
                                                        <h3>Jogos Analiticos</h3>
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
                                    <!-- Filtro -->
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <form method="GET" action="{{ route('jogos.index') }}">
                                                <div class="row g-2 align-items-center">
                                                    <div class="row gx-3">
                                                        <!-- Data Inicial -->
                                                        <div class="col-auto">
                                                            <label for="start_date" class="form-label mb-0">Data Inicial:</label>
                                                            <input type="date" name="start_date" id="start_date" value="{{ old('start_date', $startDate ?? '') }}" class="form-control">
                                                        </div>

                                                        <!-- Data Final -->
                                                        <div class="col-auto">
                                                            <label for="end_date" class="form-label mb-0">Data Final:</label>
                                                            <input type="date" name="end_date" id="end_date" value="{{ old('end_date', $endDate ?? '') }}" class="form-control">
                                                        </div>

                                                        <!-- Loteria -->
                                                        <div class="col-auto">
                                                            <label for="loteria" class="form-label mb-0">Loteria</label>
                                                            <select id="loteria" name="loteria" class="form-select">
                                                                <option value="">Todas as Loterias</option>
                                                                @foreach ($loterias as $loteria)
                                                                    <option value="{{ $loteria->loteria_id }}" {{ $loteria->loteria_id == $loteriaId ? 'selected' : '' }}>
                                                                        {{ $loteria->descricao }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>    
                                                    <div class="row gx-3">
                                                        <!-- Botões -->
                                                        <div class="col-auto d-flex align-items-end">
                                                            <button type="submit" class="btn btn-primary me-2">Filtrar</button>
                                                            <a href="{{ route('jogos.index') }}" class="btn btn-secondary">Limpar</a>
                                                        </div>
                                                    </div>>    
                                                </div>

                                            </form>
                                        </div>
                                    </div>

                                    @php
                                        $totalValor = 0;
                                        $totalBonus = 0;
                                        $totalValorBonus = 0;
                                    @endphp

                                    <!-- Tabela de Jogos -->
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="card-title">Jogos</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Data</th>
                                                            <th>Usuário</th>
                                                            <th>Loteria</th>
                                                            <th>Modalidade</th>
                                                            <th>Números</th>
                                                            <th>Prêmio Possível</th>
                                                            <th>Cotação</th>
                                                            <th>Colocação</th>
                                                            <th>Loteria</th>
                                                            <th>Valor</th>
                                                            <th>Bônus</th>
                                                            <th>Valor Bônus</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse ($jogos as $jogo)
                                                            <tr>
                                                                <td>{{ $jogo->jogo_id }}</td>
                                                                <td>{{ \Carbon\Carbon::parse($jogo->data)->format('d/m/Y') }}</td>
                                                                <td>{{ $jogo->gamer->username }}</td>
                                                                <td>{{ $jogo->modalidade->nome }}</td>
                                                                <td>{{ $jogo->loteriaRel->sigla }}</td>
                                                                <td>{{ $jogo->numeros }}</td>
                                                                <td class="text-end">{{ number_format($jogo->premio_possivel, 2, ',', '.') }}</td>
                                                                <td class="text-end">{{ number_format($jogo->cotacao, 2, ',', '.') }}</td>
                                                                <td>{{ $jogo->colocacao_label }}</td>
                                                                <td>{{ $jogo->loteria }}</td>
                                                                <td class="text-end">{{ number_format($jogo->valor, 2, ',', '.') }}</td>
                                                                <td class="text-end">{{ number_format($jogo->bonus, 2, ',', '.') }}</td>
                                                                <td class="text-end">{{ number_format($jogo->valor_bonus, 2, ',', '.') }}</td>
                                                                @php
                                                                    $totalValor += $jogo->valor;
                                                                    $totalBonus += $jogo->bonus;
                                                                    $totalValorBonus += $jogo->valor_bonus;
                                                                @endphp

                                                            </tr>
                                                        @empty
                                                            <tr>
                                                                <td colspan="13" class="text-center">Nenhum jogo encontrado.</td>
                                                            </tr>
                                                        @endforelse
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th colspan="10" class="text-end">Totais:</th>
                                                            <th class="text-end">{{ number_format($totalValor, 2, ',', '.') }}</th>
                                                            <th class="text-end">{{ number_format($totalBonus, 2, ',', '.') }}</th>
                                                            <th class="text-end">{{ number_format($totalValorBonus, 2, ',', '.') }}</th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
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
    <!-- Required jQuery first, then Bootstrap Bundle JS -->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/moment.min.js') }}"></script>
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
