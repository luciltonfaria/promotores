<!-- resources/views/receitas/create.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TSDoctor - Create Receita</title>

    <!-- Meta -->
    <meta name="description" content="Criar nova Receita">
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
                            Create Receita
                        </li>
                    </ol>
                    <!-- Breadcrumb ends -->
                </div>
                <!-- App Hero header ends -->

                <!-- App body starts -->
                <div class="app-body">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title"> Receita</h5>
                        </div>
                        <div class="card-body">

                            @if($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form action="{{ route('receitas.store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-3">
                                        <div class="form-group mb-4">
                                            <label for="data">Data</label>
                                            <input type="date" id="data" name="data" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-9">
                                        <div class="form-group mb-4">
                                            <label for="nome_paciente">Nome Paciente</label>
                                            <input type="text" id="nome_paciente" name="nome_paciente" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-9">
                                        <div class="form-group mb-4">
                                            <label for="codigo_profissional">Professional</label>
                                            <select id="codigo_profissional" name="codigo_profissional" class="form-control" required>
                                                @foreach ($profissionais as $profissional)
                                                    <option value="{{ $profissional->codigo }}">{{ $profissional->nome }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group mb-4">
                                            <label for="tipo_receita">Tipo Receita</label>
                                            <select id="tipo_receita" name="tipo_receita" class="form-control" required>
                                                <option value="Normal">Normal</option>
                                                <option value="CEspecial">Controle Especial</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label for="medicamentos">Medicamentos</label>
                                    <table class="table" id="medicamentos">
                                        <tbody>

                                        </tbody>
                                    </table>
                                    <button type="button" id="add-medicamento" class="btn btn-secondary mt-2">Add Medicamento</button>
                                </div>
                                <button type="submit" class="btn btn-primary">Salvar</button>
                            </form>

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

    <!-- Vendor Js Files -->
    <!-- Overlay Scroll JS -->
    <script src="{{ asset('assets/vendor/overlay-scroll/jquery.overlayScrollbars.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/overlay-scroll/custom-scrollbar.js') }}"></script>


    <!-- Custom JS files -->
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <script>
        document.getElementById('add-medicamento').addEventListener('click', function() {
    var medicamentos = document.getElementById('medicamentos').getElementsByTagName('tbody')[0];
    var index = medicamentos.children.length;
    var newMedicamento = document.createElement('tr');
    newMedicamento.className = 'medicamento';
    newMedicamento.innerHTML = `
        <td colspan="2">
            <div class="row">
                <div class="col-8">
                    <select name="medicamentos[${index}][medicamento]" class="form-control mb-2 medicamento-select" required>
                        <option value="">Selecione um medicamento</option>
                        @foreach ($medicamentos as $medicamento)
                            <option value="{{ $medicamento->medicamento }}" data-quant="{{ $medicamento->quant }}" data-posologia="{{ $medicamento->posologia }}">{{ $medicamento->medicamento }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-4">
                    <input type="text" name="medicamentos[${index}][quantidade]" placeholder="Quantidade" class="form-control mb-2 medicamento-quant" required>
                </div>
            </div>
            <div class="row">
                <div class="col-8">
                    <textarea name="medicamentos[${index}][modo_usar]" placeholder="Modo de Usar" class="form-control mb-2 medicamento-posologia" required></textarea>
                </div>
                <div class="col-4">
                    <button type="button" class="btn btn-danger btn-remove-medicamento">Remove</button>
                </div>
            </div>
        </td>
    `;
    medicamentos.appendChild(newMedicamento);
});


        document.addEventListener('change', function(e) {
    if (e.target && e.target.classList.contains('medicamento-select')) {
        var selectedOption = e.target.options[e.target.selectedIndex];
        var row = e.target.closest('.medicamento');
        var quantidadeInput = row.querySelector('.medicamento-quant');
        var posologiaTextarea = row.querySelector('.medicamento-posologia');
        if (quantidadeInput && posologiaTextarea) {
            quantidadeInput.value = selectedOption.getAttribute('data-quant') || '';
            posologiaTextarea.value = selectedOption.getAttribute('data-posologia') || '';
        }
    }
});



        document.addEventListener('click', function(e) {
            if (e.target && e.target.classList.contains('btn-remove-medicamento')) {
                e.target.closest('.medicamento').remove();
            }
        });
    </script>
</body>

</html>
