<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TSDoctor - Editar Profissional</title>
    <link rel="stylesheet" href="{{ asset('assets/css/main.min.css') }}">
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

    <!-- Inputmask CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/inputmask/5.0.6/inputmask.min.js">

    <style>
        .img-preview {
            width: 150px;
            height: 150px;
            border: 5px solid white;
            border-radius: 10px;
            object-fit: cover;
            display: block;
            margin-bottom: 10px;
            position: relative;
        }

        #foto {
            display: none;
        }

        .btn-select-photo {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: rgba(255, 255, 255, 0.8);
            border: none;
            border-radius: 50%;
            padding: 10px;
            cursor: pointer;
        }

        .btn-select-photo i {
            font-size: 20px;
        }
    </style>
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
                        <li class="breadcrumb-item">
                            <a href="{{ url('/profissionais') }}">Profissionais</a>
                        </li>
                        <li class="breadcrumb-item text-primary" aria-current="page">
                            Editar Profissional
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
                                    <h5 class="card-title">Editar Profissional</h5>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('profissionais.update', $profissional->codigo) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')

                                        <!-- Row starts -->
                                        <div class="row gx-3">

                                            <div class="col-xxl-3 col-lg-6 col-sm-6">
                                                <div class="mb-3">
                                                    <label for="foto" class="form-label">Foto</label>
                                                    <div class="position-relative">
                                                        <img id="imgPreview" class="img-preview" src="{{ asset('storage/' . $profissional->foto) }}" alt="Imagem selecionada" style="display: block;">
                                                        <button type="button" class="btn-select-photo" onclick="document.getElementById('foto').click()">
                                                            <i class="ri-search-line"></i>
                                                        </button>
                                                    </div>
                                                    <input type="file" name="foto" id="foto" accept="image/*" onchange="previewImage(event)">
                                                </div>
                                            </div>

                                            <div class="col-xxl-9 col-lg-6 col-sm-6">
                                                <div class="mb-3">
                                                    <label for="nome" class="form-label">Nome</label>
                                                    <input type="text" name="nome" id="nome" class="form-control" value="{{ $profissional->nome }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="filiacao_mae" class="form-label">Filiação (Mãe)</label>
                                                    <input type="text" name="filiacao_mae" id="filiacao_mae" class="form-control" value="{{ $profissional->filiacao_mae }}">
                                                </div>
                                            </div>

                                            <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                <div class="mb-3">
                                                    <label for="dt_nasc" class="form-label">Data de Nascimento</label>
                                                    <input type="date" name="dt_nasc" id="dt_nasc" class="form-control" value="{{ $profissional->dt_nasc }}">
                                                </div>
                                            </div>

                                            <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                <div class="mb-3">
                                                    <label for="sexo" class="form-label">Sexo</label>
                                                    <select name="sexo" id="sexo" class="form-control">
                                                        <option value="">Selecione o Sexo</option>
                                                        <option value="M" {{ $profissional->sexo == 'M' ? 'selected' : '' }}>Masculino</option>
                                                        <option value="F" {{ $profissional->sexo == 'F' ? 'selected' : '' }}>Feminino</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-xxl-2 col-lg-4 col-sm-6">
                                                <div class="mb-3">
                                                    <label for="cpf" class="form-label">CPF</label>
                                                    <input type="text" name="cpf" id="cpf" class="form-control" value="{{ $profissional->cpf }}">
                                                </div>
                                            </div>

                                            <div class="col-xxl-4 col-lg-4 col-sm-6">
                                                <div class="mb-3">
                                                    <label for="email" class="form-label">Email</label>
                                                    <input type="email" name="email" id="email" class="form-control" value="{{ $profissional->email }}">
                                                </div>
                                            </div>

                                            <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                <div class="mb-3">
                                                    <label for="rg" class="form-label">RG</label>
                                                    <input type="text" name="rg" id="rg" class="form-control" value="{{ $profissional->rg }}">
                                                </div>
                                            </div>

                                            <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                <div class="mb-3">
                                                    <label for="org_rg" class="form-label">Orgão Emissor do RG</label>
                                                    <input type="text" name="org_rg" id="org_rg" class="form-control" value="{{ $profissional->org_rg }}">
                                                </div>
                                            </div>

                                            <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                <div class="mb-3">
                                                    <label for="nro_conselho" class="form-label">Nro Conselho</label>
                                                    <input type="text" name="nro_conselho" id="nro_conselho" class="form-control" value="{{ $profissional->nro_conselho }}">
                                                </div>
                                            </div>

                                            <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                <div class="mb-3">
                                                    <label for="conselho" class="form-label">Conselho</label>
                                                    <input type="text" name="conselho" id="conselho" class="form-control" value="{{ $profissional->conselho }}">
                                                </div>
                                            </div>

                                            <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                <div class="mb-3">
                                                    <label for="end_resid" class="form-label">Endereço Residencial</label>
                                                    <input type="text" name="end_resid" id="end_resid" class="form-control" value="{{ $profissional->end_resid }}">
                                                </div>
                                            </div>

                                            <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                <div class="mb-3">
                                                    <label for="bairro_resid" class="form-label">Bairro Residencial</label>
                                                    <input type="text" name="bairro_resid" id="bairro_resid" class="form-control" value="{{ $profissional->bairro_resid }}">
                                                </div>
                                            </div>

                                            <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                <div class="mb-3">
                                                    <label for="cidade_resid" class="form-label">Cidade Residencial</label>
                                                    <input type="text" name="cidade_resid" id="cidade_resid" class="form-control" value="{{ $profissional->cidade_resid }}">
                                                </div>
                                            </div>

                                            <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                <div class="mb-3">
                                                    <label for="estado_resid" class="form-label">Estado Residencial</label>
                                                    <select name="estado_resid" id="estado_resid" class="form-control">
                                                        <option value="">Selecione o Estado</option>
                                                        @foreach ($estados as $estado)
                                                            <option value="{{ $estado->sigla }}" {{ $profissional->estado_resid == $estado->sigla ? 'selected' : '' }}>{{ $estado->descricao }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                <div class="mb-3">
                                                    <label for="cep_resid" class="form-label">CEP Residencial</label>
                                                    <input type="text" name="cep_resid" id="cep_resid" class="form-control" value="{{ $profissional->cep_resid }}">
                                                </div>
                                            </div>

                                            <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                <div class="mb-3">
                                                    <label for="telef_resid" class="form-label">Telefone Residencial</label>
                                                    <input type="text" name="telef_resid" id="telef_resid" class="form-control" value="{{ $profissional->telef_resid }}">
                                                </div>
                                            </div>

                                            <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                <div class="mb-3">
                                                    <label for="telef2_resid" class="form-label">Telefone Residencial 2</label>
                                                    <input type="text" name="telef2_resid" id="telef2_resid" class="form-control" value="{{ $profissional->telef2_resid }}">
                                                </div>
                                            </div>

                                            <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                <div class="mb-3">
                                                    <label for="celular" class="form-label">Celular</label>
                                                    <input type="text" name="celular" id="celular" class="form-control" value="{{ $profissional->celular }}">
                                                </div>
                                            </div>

                                            <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                <div class="mb-3">
                                                    <label for="telef2_comer" class="form-label">Telefone Comercial 2</label>
                                                    <input type="text" name="telef2_comer" id="telef2_comer" class="form-control" value="{{ $profissional->telef2_comer }}">
                                                </div>
                                            </div>

                                            <div class="col-xxl-12 col-lg-4 col-sm-6">
                                                <div class="mb-3">
                                                    <label for="observacoes" class="form-label">Observações</label>
                                                    <textarea name="observacoes" id="observacoes" class="form-control">{{ $profissional->observacoes }}</textarea>
                                                </div>
                                            </div>

                                            <div class="col-xxl-12 col-lg-4 col-sm-6">
                                                <button type="submit" class="btn btn-primary">Salvar</button>
                                                <a href="{{ route('profissionais.index') }}" class="btn btn-secondary">Cancelar</a>
                                            </div>
                                        </div>
                                        <!-- Row ends -->
                                    </form>
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
    <!-- Required jQuery first, then Bootstrap Bundle JS -->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/moment.min.js') }}"></script>

    <!-- Vendor Js Files -->
    <!-- Overlay Scroll JS -->
    <script src="{{ asset('assets/vendor/overlay-scroll/jquery.overlayScrollbars.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/overlay-scroll/custom-scrollbar.js') }}"></script>

    <!-- Inputmask JS -->
    <script type='text/javascript' src="https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>

    <!-- Custom JS files -->
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <script>
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function() {
                const output = document.getElementById('imgPreview');
                output.src = reader.result;
                output.style.display = 'block';
            }
            reader.readAsDataURL(event.target.files[0]);
        }

        $(document).ready(function(){
            Inputmask({
                mask: '999.999.999-99',
                placeholder: '___.___.___-__'
            }).mask('#cpf');

            Inputmask({
                mask: '(99) 9999-9999',
                placeholder: '(__) ____-____'
            }).mask('#telef_resid, #telef2_resid, #telef2_comer');

            Inputmask({
                mask: '(99) 99999-9999',
                placeholder: '(__) _____-____'
            }).mask('#celular');

            Inputmask({
                mask: '99999-999',
                placeholder: '_____-___'
            }).mask('#cep_resid');
        });
    </script>
</body>

</html>
