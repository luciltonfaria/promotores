<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TSDoctor - Lista de Recibos</title>

    <!-- Meta -->
    <meta name="description" content="Lista de Recibos">
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
                            Lista de Recibos
                        </li>
                    </ol>
                    <!-- Breadcrumb ends -->
                </div>
                <!-- App Hero header ends -->

                <!-- App body starts -->
                <div class="app-body">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Lista de Recibos</h5>
                            <a href="{{ route('recibos.create') }}" class="btn btn-primary ms-auto">Criar Recibo</a>
                        </div>
                        <div class="card-body">

                            @if(session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nome</th>
                                        <th>Valor</th>
                                        <th>Referência</th>
                                        <th>Emitido</th>
                                        <th>Data de Emissão</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recibos as $recibo)
                                    <tr>
                                        <td>{{ $recibo->id }}</td>
                                        <td>{{ $recibo->nome }}</td>
                                        <td>{{ $recibo->valor }}</td>
                                        <td>{{ $recibo->referencia }}</td>
                                        <td>{{ $recibo->emitido }}</td>
                                        <td>{{ $recibo->dt_emissao ? \Carbon\Carbon::parse($recibo->dt_emissao)->format('d/m/Y') : '' }}</td>
                                        <td>
                                            <a href="{{ route('recibos.show', $recibo->id) }}" class="btn btn-success btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="View">
                                                                        <i class="ri-eye-line"></i>
                                                                    </a>
                                            <a href="{{ route('recibos.edit', $recibo->id) }}" class="btn btn-outline-success btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Edit">
                                                                        <i class="ri-edit-line"></i>
                                                                    </a>
                                            <form action="{{ route('recibos.destroy', $recibo->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-outline-danger btn-sm btn-delete" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Delete">
                                                    <i class="ri-delete-bin-line"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

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
