<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TSDoctor - Atestados</title>

    <!-- Meta -->
    <meta name="description" content="List of Atestados">
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
                            Atestados
                        </li>
                    </ol>
                    <!-- Breadcrumb ends -->
                </div>
                <!-- App Hero header ends -->

                <!-- App body starts -->
                <div class="app-body">
                    <!-- Row starts -->
                    <div class="row gx-3">
                                <div class="col-xxl-12 col-sm-12">
                                    <div class="card mb-3 bg-4">
                                        <div class="card-body mh-230">

                                            <!-- Row starts -->
                                            <div class="row gx-3">
                                                <div class="col-sm-9">
                                                    <div class="text-white mt-3">
                                                        <h3>Atestados</h3>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Row ends -->

                                        </div>
                                    </div>
                                </div>
                            </div>

                    <!-- Filter Form starts -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="card-title">Filtro de Atestados</h5>
                        </div>
                        <div class="card-body">
                            <form method="GET" action="{{ route('atestados.index') }}">
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label for="patient_name" class="form-label">Paciente Nome</label>
                                        <input type="text" id="patient_name" name="patient_name" class="form-control" value="{{ request('patient_name') }}">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="date" class="form-label">Data</label>
                                        <input type="date" id="date" name="date" class="form-control" value="{{ request('date') }}">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="atestado_type" class="form-label">Tipo de Atestado</label>
                                        <select id="atestado_type" name="atestado_type" class="form-control">
                                            <option value="">Selecione um tipo</option>
                                            <option value="Afastamento" {{ request('atestado_type') == 'Afastamento' ? 'selected' : '' }}>Afastamento</option>
                                            <option value="Comparecimento" {{ request('atestado_type') == 'Comparecimento' ? 'selected' : '' }}>Comparecimento</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary">Pesquisar</button>
                                        <a href="{{ route('atestados.index') }}" class="btn btn-secondary">Limpar</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- Filter Form ends -->

                    <!-- Table starts -->
                    <div class="card">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="card-title">Atestados Cadastrados</h5>
                            <a href="{{ route('atestados.create') }}" class="btn btn-primary">Criar novo Atestado</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="atestadosGrid" class="table m-0 align-middle">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Patient Name</th>
                                            <th>Date</th>
                                            <th>Atestado Type</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($atestados as $atestado)
                                            <tr>
                                                <td>{{ $atestado->id }}</td>
                                                <td>{{ $atestado->nome_paciente }}</td>
                                                <td>{{ \Carbon\Carbon::parse($atestado->data)->format('d/m/Y') }}</td>
                                                <td>{{ $atestado->tipo }}</td>
                                                <td>
                                                    <div class="d-inline-flex gap-1">
                                                        <a href="{{ route('atestados.show', $atestado->id) }}" class="btn btn-success btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="View">
                                                            <i class="ri-eye-line"></i>
                                                        </a>
                                                        <a href="{{ route('atestados.edit', $atestado->id) }}" class="btn btn-outline-success btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Edit">
                                                            <i class="ri-edit-line"></i>
                                                        </a>
                                                        <form action="{{ route('atestados.destroy', $atestado->id) }}" method="POST" class="form-delete">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="btn btn-outline-danger btn-sm btn-delete" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Delete">
                                                                <i class="ri-delete-bin-line"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5">No atestados found.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- Table ends -->

                    <!-- Pagination -->
                    <div class="d-flex justify-content-center">
                        {{ $atestados->links() }}
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

    <!-- Custom JS files -->
    <script src="{{ asset('assets/js/custom.js') }}"></script>
</body>

</html>
