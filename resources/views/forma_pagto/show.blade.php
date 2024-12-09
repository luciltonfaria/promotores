<!-- resources/views/forma_pagto/show.blade.php -->
<!DOCTYPE html>
<html lang="en">

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
    <div class="page-wrapper">
        @include('partials.header')

        <div class="main-container">
            @include('partials.sidebar')

            <div class="app-container">
                <div class="app-hero-header">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ url('/') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ url('/forma_pagto') }}">Formas de Pagamento</a>
                        </li>
                        <li class="breadcrumb-item text-primary">Detalhes</li>
                    </ol>
                </div>

                <div class="app-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Detalhes da Forma de Pagamento</h5>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label for="id" class="form-label">ID</label>
                                        <input type="text" class="form-control" id="id" value="{{ $formaPagto->id }}" disabled>
                                    </div>
                                    <div class="mb-3">
                                        <label for="descricao" class="form-label">Descrição</label>
                                        <input type="text" class="form-control" id="descricao" value="{{ $formaPagto->descricao }}" disabled>
                                    </div>
                                    <div class="mb-3">
                                        <label for="lanca_quitacao" class="form-label">Lança Quitação</label>
                                        <input type="text" class="form-control" id="lanca_quitacao" value="{{ $formaPagto->lanca_quitacao == 'S' ? 'Sim' : 'Não' }}" disabled>
                                    </div>
                                    <div class="mb-3">
                                        <label for="created_at" class="form-label">Criado em</label>
                                        <input type="text" class="form-control" id="created_at" value="{{ $formaPagto->created_at }}" disabled>
                                    </div>
                                    <div class="mb-3">
                                        <label for="updated_at" class="form-label">Atualizado em</label>
                                        <input type="text" class="form-control" id="updated_at" value="{{ $formaPagto->updated_at }}" disabled>
                                    </div>
                                    <a href="{{ url('/forma_pagto') }}" class="btn btn-secondary">Voltar</a>
                                    <a href="{{ url('/forma_pagto/' . $formaPagto->id . '/edit') }}" class="btn btn-primary">Editar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="app-footer bg-white">
                    <span>© TSul Tecnologia 2024</span>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
