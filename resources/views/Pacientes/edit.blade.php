<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TSDoctor - Editar Paciente</title>
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
                            <a href="{{ url('/pacientes') }}">Pacientes</a>
                        </li>
                        <li class="breadcrumb-item text-primary" aria-current="page">
                            Editar Paciente
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
                                    <h5 class="card-title">Editar Paciente</h5>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('pacientes.update', $paciente->codigo) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')

                                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link card-title active" id="paciente-tab" data-bs-toggle="tab" href="#paciente" role="tab" aria-controls="paciente" aria-selected="true">Dados do Paciente</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link card-title" id="anamnese-tab" data-bs-toggle="tab" href="#anamnese" role="tab" aria-controls="anamnese" aria-selected="false">Anamnese</a>
                                            </li>
                                        </ul>

                                        <div class="tab-content mt-3" id="myTabContent">

                                            <div class="tab-pane fade show active" id="paciente" role="tabpanel" aria-labelledby="paciente-tab">
                                                <!-- Row starts -->
                                                <div class="row gx-3">

                                                    <div class="col-xxl-3 col-lg-6 col-sm-6">
                                                        <div class="mb-3">
                                                            <label for="foto" class="form-label">Foto</label>
                                                            <div class="position-relative">
                                                                <img id="imgPreview" class="img-preview" src="{{ asset('storage/' . $paciente->foto) }}" alt="Imagem selecionada" style="display: block;">
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
                                                            <input type="text" name="nome" id="nome" class="form-control upper-text" value="{{ $paciente->nome }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="filiacao_mae" class="form-label">Filiação (Mãe)</label>
                                                            <input type="text" name="filiacao_mae" id="filiacao_mae" class="form-control upper-text" value="{{ $paciente->filiacao_mae }}">
                                                        </div>
                                                    </div>

                                                    <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                        <div class="mb-3">
                                                            <label for="dt_nasc" class="form-label">Data de Nascimento</label>
                                                            <input type="date" name="dt_nasc" id="dt_nasc" class="form-control" value="{{ $paciente->dt_nasc }}">
                                                        </div>
                                                    </div>

                                                    <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                        <div class="mb-3">
                                                            <label for="sexo" class="form-label">Sexo</label>
                                                            <select name="sexo" id="sexo" class="form-control">
                                                                <option value="">Selecione o Sexo</option>
                                                                <option value="M" @if($paciente->sexo == 'M') selected @endif>Masculino</option>
                                                                <option value="F" @if($paciente->sexo == 'F') selected @endif>Feminino</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-xxl-2 col-lg-4 col-sm-6">
                                                        <div class="mb-3">
                                                            <label for="cpf" class="form-label">CPF</label>
                                                            <input type="text" name="cpf" id="cpf" class="form-control" value="{{ $paciente->cpf }}">
                                                        </div>
                                                    </div>

                                                    <div class="col-xxl-4 col-lg-4 col-sm-6">
                                                        <div class="mb-3">
                                                            <label for="email" class="form-label">Email</label>
                                                            <input type="email" name="email" id="email" class="form-control" value="{{ $paciente->email }}">
                                                        </div>
                                                    </div>

                                                    <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                        <div class="mb-3">
                                                            <label for="rg" class="form-label">RG</label>
                                                            <input type="text" name="rg" id="rg" class="form-control upper-text" value="{{ $paciente->rg }}">
                                                        </div>
                                                    </div>

                                                    <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                        <div class="mb-3">
                                                            <label for="org_rg" class="form-label">Orgão Emissor do RG</label>
                                                            <input type="text" name="org_rg" id="org_rg" class="form-control upper-text" value="{{ $paciente->org_rg }}">
                                                        </div>
                                                    </div>

                                                    <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                        <div class="mb-3">
                                                            <label for="profissao" class="form-label">Profissão</label>
                                                            <input type="text" name="profissao" id="profissao" class="form-control upper-text" value="{{ $paciente->profissao }}">
                                                        </div>
                                                    </div>

                                                    <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                        <div class="mb-3">
                                                            <label for="estado_civil" class="form-label">Estado Civil</label>
                                                            <select name="estado_civil" id="estado_civil" class="form-control">
                                                                <option value="">Selecione o Estado Civil</option>
                                                                <option value="S" @if($paciente->estado_civil == 'S') selected @endif>Solteiro</option>
                                                                <option value="C" @if($paciente->estado_civil == 'C') selected @endif>Casado</option>
                                                                <option value="D" @if($paciente->estado_civil == 'D') selected @endif>Divorciado</option>
                                                                <option value="O" @if($paciente->estado_civil == 'O') selected @endif>Outros</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                        <div class="mb-3">
                                                            <label for="convenio" class="form-label">Convênio</label>
                                                            <select name="convenio" id="convenio" class="form-control">
                                                                <option value="">Selecione o Convênio</option>
                                                                @foreach ($convenios as $convenio)
                                                                    <option value="{{ $convenio->id }}" @if($paciente->convenio_id == $convenio->id) selected @endif>{{ $convenio->descricao }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                        <div class="mb-3">
                                                            <label for="nro_reg" class="form-label">Nro Convênio</label>
                                                            <input type="text" name="nro_reg" id="nro_reg" class="form-control upper-text" value="{{ $paciente->nro_reg }}">
                                                        </div>
                                                    </div>

                                                    <div class="col-xxl-6 col-lg-4 col-sm-6">
                                                        <div class="mb-3">
                                                            <label for="nome_seg" class="form-label">Nome do Segurado</label>
                                                            <input type="text" name="nome_seg" id="nome_seg" class="form-control upper-text" value="{{ $paciente->nome_seg }}">
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                        <div class="mb-3">
                                                            <label for="cep_resid" class="form-label">CEP Residencial</label>
                                                            <input type="text" name="cep_resid" id="cep_resid" class="form-control" value="{{ $paciente->cep_resid }}">
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                        <div class="mb-3">
                                                            <label for="end_resid" class="form-label">Endereço Residencial</label>
                                                            <input type="text" name="end_resid" id="end_resid" class="form-control upper-text" value="{{ $paciente->end_resid }}">
                                                        </div>
                                                    </div>

                                                    <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                        <div class="mb-3">
                                                            <label for="bairro_resid" class="form-label">Bairro Residencial</label>
                                                            <input type="text" name="bairro_resid" id="bairro_resid" class="form-control upper-text" value="{{ $paciente->bairro_resid }}">
                                                        </div>
                                                    </div>

                                                    <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                        <div class="mb-3">
                                                            <label for="cidade_resid" class="form-label">Cidade Residencial</label>
                                                            <input type="text" name="cidade_resid" id="cidade_resid" class="form-control upper-text" value="{{ $paciente->cidade_resid }}">
                                                        </div>
                                                    </div>

                                                    <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                        <div class="mb-3">
                                                            <label for="estado_resid" class="form-label">Estado Residencial</label>
                                                            <select name="estado_resid" id="estado_resid" class="form-control">
                                                                <option value="">Selecione o Estado</option>
                                                                @foreach ($estados as $estado)
                                                                    <option value="{{ $estado->sigla }}" @if($paciente->estado_resid == $estado->sigla) selected @endif>{{ $estado->descricao }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                        <div class="mb-3">
                                                            <label for="telef_resid" class="form-label">Telefone Residencial</label>
                                                            <input type="text" name="telef_resid" id="telef_resid" class="form-control" value="{{ $paciente->telef_resid }}">
                                                        </div>
                                                    </div>

                                                    <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                        <div class="mb-3">
                                                            <label for="telef_recado_resid" class="form-label">Telefone de Recado Residencial</label>
                                                            <input type="text" name="telef_recado_resid" id="telef_recado_resid" class="form-control" value="{{ $paciente->telef_recado_resid }}">
                                                        </div>
                                                    </div>

                                                    <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                        <div class="mb-3">
                                                            <label for="celular" class="form-label">Celular</label>
                                                            <input type="text" name="celular" id="celular" class="form-control" value="{{ $paciente->celular }}">
                                                        </div>
                                                    </div>

                                                    <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                        <div class="mb-3">
                                                            <label for="cep_comerc" class="form-label">CEP Comercial</label>
                                                            <input type="text" name="cep_comerc" id="cep_comerc" class="form-control" value="{{ $paciente->cep_comerc }}">
                                                        </div>
                                                    </div>

                                                    <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                        <div class="mb-3">
                                                            <label for="end_comerc" class="form-label">Endereço Comercial</label>
                                                            <input type="text" name="end_comerc" id="end_comerc" class="form-control" value="{{ $paciente->end_comerc }}">
                                                        </div>
                                                    </div>

                                                    <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                        <div class="mb-3">
                                                            <label for="bairro_comerc" class="form-label">Bairro Comercial</label>
                                                            <input type="text" name="bairro_comerc" id="bairro_comerc" class="form-control upper-text" value="{{ $paciente->bairro_comerc }}">
                                                        </div>
                                                    </div>

                                                    <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                        <div class="mb-3">
                                                            <label for="cidade_comerc" class="form-label">Cidade Comercial</label>
                                                            <input type="text" name="cidade_comerc" id="cidade_comerc" class="form-control upper-text" value="{{ $paciente->cidade_comerc }}">
                                                        </div>
                                                    </div>

                                                    <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                        <div class="mb-3">
                                                            <label for="estado_comerc" class="form-label">Estado Comercial</label>
                                                            <input type="text" name="estado_comerc" id="estado_comerc" class="form-control upper-text" value="{{ $paciente->estado_comerc }}">
                                                        </div>
                                                    </div>

                                                    <div class="col-xxl-3 col-lg-4 col-sm-6">
                                                        <div class="mb-3">
                                                            <label for="telef_comerc" class="form-label">Telefone Comercial</label>
                                                            <input type="text" name="telef_comerc" id="telef_comerc" class="form-control" value="{{ $paciente->telef_comerc }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-xxl-6 col-lg-4 col-sm-6">
                                                        <div class="mb-3">
                                                            <label for="indicacao" class="form-label">Indicado Por</label>
                                                            <input type="text" name="indicacao" id="indicacao" class="form-control upper-text" value="{{ $paciente->indicacao }}">
                                                        </div>
                                                    </div>

                                                    <div class="col-xxl-12 col-lg-4 col-sm-6">
                                                        <div class="mb-3">
                                                            <label for="obsev" class="form-label">Observações</label>
                                                            <textarea name="obsev" id="obsev" class="form-control">{{ $paciente->obsev }}</textarea>
                                                        </div>
                                                    </div>

                                                    <div class="col-xxl-12 col-lg-4 col-sm-6">
                                                        <button type="submit" class="btn btn-primary">Salvar</button>
                                                        <a href="{{ route('pacientes.index') }}" class="btn btn-secondary">Cancelar</a>
                                                        <button type="button" class="btn btn-secondary" onclick="window.location.href='{{ route('pacientes.print', $paciente->codigo) }}'">Imprimir</button>
                                                    
                                                    </div>
                                                </div> 
                                            </div>    
                                            <div class="tab-pane fade" id="anamnese" role="tabpanel" aria-labelledby="anamnese-tab">

                                                <div class="col-lg-12 col-sm-6 col-12">
                                                    <div class="row">
                                                        <!-- Nome (não editável) -->
                                                        <div class="col-xxl-4 col-lg-4 col-sm-12">
                                                            <label class="form-label fw-bold">Nome</label>
                                                            <input type="hidden" name="paciente_id" id="paciente_id" class="form-control" value="{{ $paciente->codigo }}" disabled>
                                                            <input type="text" id="anamneseNome" class="form-control" disabled>
                                                        </div>

                                                        <!-- Filiação (Mãe) -->
                                                        <div class="col-xxl-4 col-lg-4 col-sm-12">
                                                            <label class="form-label fw-bold">Filiação (Mãe)</label>
                                                            <input type="text" id="anamneseFiliacaoMae" class="form-control" disabled>
                                                        </div>

                                                        <!-- Data de Nascimento -->
                                                        <div class="col-xxl-4 col-lg-4 col-sm-12">
                                                            <label class="form-label fw-bold">Data de Nascimento</label>
                                                            <input type="text" id="anamneseDtNasc" class="form-control" disabled>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="card mb-3">
                                                        <div class="card-body">
                                                            <!-- Linha com 4 colunas -->
                                                            <div class="row">
                                                                <!-- Sangramento -->
                                                                <div class="col-md-3">
                                                                    <label class="form-label mb-0 fw-bold" for="gengivasSwitch">Suas gengivas sangram facilmente?</label>
                                                                    <div class="form-check form-switch">
                                                                        <input class="form-check-input" type="checkbox" role="switch" id="gengivasSwitch" name="gengiva_sangram" {{ $anamnese && $anamnese->gengiva_sangram == 1 ? 'checked' : '' }}>
                                                                    </div>
                                                                </div>

                                                                <!-- Fio dental -->
                                                                <div class="col-md-2">
                                                                    <label class="form-label mb-0 fw-bold" for="fiodentalSwitch">Usa fio dental?</label>
                                                                    <div class="form-check form-switch">
                                                                        <input class="form-check-input" type="checkbox" role="switch" id="fiodentalSwitch" name="fio_dental" {{ $anamnese && $anamnese->fio_dental == 1 ? 'checked' : '' }}>
                                                                    </div>
                                                                </div>
                                                                
                                                                <!-- Diabetes -->
                                                                <div class="col-md-2">
                                                                    <label class="form-label mb-0 fw-bold" for="diabetesSwitch">Tem diabetes?</label>
                                                                    <div class="form-check form-switch">
                                                                        <input class="form-check-input" type="checkbox" role="switch" id="diabetesSwitch" name="diabetis" {{ $anamnese && $anamnese->diabetis == 1 ? 'checked' : '' }}>                                                                        
                                                                    </div>
                                                                </div>

                                                                <!-- Gravidez -->
                                                                <div class="col-md-2">
                                                                    <label class="form-label mb-0 fw-bold" for="gravidezSwitch">Está Grávida</label>
                                                                    <div class="form-check form-switch">
                                                                        <input class="form-check-input" type="checkbox" role="switch" id="gravidezSwitch" name="gravida" {{ $anamnese && $anamnese->gravida == 1 ? 'checked' : '' }}>   
                                                                    </div>
                                                                </div>

                                                            
                                                            </div>
                                                        </div>
                                                    </div> 
                                                    <div class="row">
                                                        <div class="card mb-3">
                                                            <div class="card-body">
                                                                <!-- Problema de Saúde -->
                                                                <div class="row d-flex align-items-center">
                                                                    <div class="col-12 col-md-auto">
                                                                        <label class="form-label mb-0 fw-bold" for="anestesiLocaSwitch">Já tomou anestesial local?</label>
                                                                    </div>
                                                                    <div class="col-md-auto d-flex align-items-center">
                                                                        <div class="form-check form-switch">
                                                                            <input class="form-check-input" type="checkbox" role="switch" id="anestesiLocaSwitch" name="anestesia" {{ $anamnese && $anamnese->anestesia == 1 ? 'checked' : '' }}>   
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-md-auto">
                                                                        <label class="form-label mb-0 fw-bold" for="sentiuMauSwitch">Sentiu-se mal??</label>
                                                                    </div>
                                                                    <div class="col-md-auto d-flex align-items-center">
                                                                        <div class="form-check form-switch">
                                                                            <input class="form-check-input" type="checkbox" role="switch" id="sentiuMauSwitch" name="sentiu_mal" {{ $anamnese && $anamnese->sentiu_mal == 1 ? 'checked' : '' }}>   
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="card mb-3">
                                                            <div class="card-body">
                                                                <!-- Problema de Saúde -->
                                                                <div class="row d-flex align-items-center">
                                                                    <div class="col-12 col-md-auto">
                                                                        <label class="form-label mb-0 fw-bold" for="problemaSaudeSwitch">Tem algum problema de Saúde?</label>
                                                                    </div>
                                                                    <div class="col-md-auto d-flex align-items-center">
                                                                        <div class="form-check form-switch">
                                                                            <input class="form-check-input" type="checkbox" role="switch" id="problemaSaudeSwitch" name="probl_saude" {{ $anamnese && $anamnese->probl_saude == 1 ? 'checked' : '' }}>   
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-md">
                                                                        <input type="text" id="problemaSaudeInput" class="form-control" placeholder="Quais Problemas?" name="probl_saude_quais" value="{{ isset($anamnese) ? $anamnese->probl_saude_quais  : '' }}" disabled>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="card mb-3">
                                                            <div class="card-body">
                                                                <!-- Toma Medicamentos -->
                                                                <div class="row d-flex align-items-center">
                                                                    <div class="col-12 col-md-auto">
                                                                        <label class="form-label mb-0 fw-bold" for="medicamentosSwitch">Toma Medicamentos?</label>
                                                                    </div>
                                                                    <div class="col-md-auto d-flex align-items-center">
                                                                        <div class="form-check form-switch">
                                                                            <input class="form-check-input" type="checkbox" role="switch" id="medicamentosSwitch" name="toma_medicamentos" {{ $anamnese && $anamnese->toma_medicamentos == 1 ? 'checked' : '' }}>   
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-md">
                                                                        <input type="text" id="medicamentosInput" class="form-control" placeholder="Quais Medicamentos?" name="toma_medic_quais" value="{{ isset($anamnese) ? $anamnese->toma_medic_quais : '' }}" disabled>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="card mb-3">
                                                            <div class="card-body">
                                                                <!-- Alergia a Medicamentos -->
                                                                <div class="row d-flex align-items-center">
                                                                    <div class="col-12 col-md-auto">
                                                                        <label class="form-label mb-0 fw-bold" for="alergiaSwitch">Tem alergia a medicamentos?</label>
                                                                    </div>
                                                                    <div class="col-md-auto d-flex align-items-center">
                                                                        <div class="form-check form-switch">
                                                                            <input class="form-check-input" type="checkbox" role="switch" id="alergiaSwitch" name="alergico_medicamentos" {{ $anamnese && $anamnese->alergico_medicamentos == 1 ? 'checked' : '' }}>   
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-md">
                                                                        <input type="text" id="alergiaInput" class="form-control" placeholder="Quais Medicamentos?" name="alergico_medicamentos_quais" value="{{ isset($anamnese) ? $anamnese->alergico_medicamentos_quais : '' }}" disabled>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="card mb-3">
                                                            <div class="card-body">
                                                                <!-- Cirurgias -->
                                                                <div class="row d-flex align-items-center">
                                                                    <div class="col-12 col-md-auto">
                                                                        <label class="form-label mb-0 fw-bold" for="cirurgiaSwitch">Fez alguma cirurgia?</label>
                                                                    </div>
                                                                    <div class="col-md-auto d-flex align-items-center">
                                                                        <div class="form-check form-switch">
                                                                            <input class="form-check-input" type="checkbox" role="switch" id="cirurgiaSwitch" name="cirugia" {{ $anamnese && $anamnese->cirugia == 1 ? 'checked' : '' }}> 
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-md">
                                                                        <input type="text" id="cirurgiaInput" class="form-control" placeholder="Quais Cirurgias?" name="cirugia_quais" value="{{ isset($anamnese) ? $anamnese->cirugia_quais : '' }}" disabled>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="card mb-3">
                                                            <div class="card-body">
                                                                <!-- Problema no Coração -->
                                                                <div class="row d-flex align-items-center">
                                                                    <div class="col-12 col-md-auto">
                                                                        <label class="form-label mb-0 fw-bold" for="problemaCoracaoSwitch">Tem problemas no coração?</label>
                                                                    </div>
                                                                    <div class="col-md-auto d-flex align-items-center">
                                                                        <div class="form-check form-switch">
                                                                            <input class="form-check-input" type="checkbox" role="switch" id="problemaCoracaoSwitch" name="problemas_coracao" {{ $anamnese && $anamnese->problemas_coracao == 1 ? 'checked' : '' }}> 
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-md">
                                                                        <input type="text" id="problemaCoracaoInput" class="form-control" placeholder="Quais Problemas?" name="problema_coracao__quais" value="{{ isset($anamnese) ? $anamnese->problema_coracao__quais : '' }}" disabled>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>    

                                                    <div class="card mb-3">
                                                        <div class="card-body">
                                                            <!-- Linha com 4 colunas -->
                                                            <div class="row">
                                                                <!-- Perda de Peso -->
                                                                <div class="col-md-3">
                                                                    <label class="form-label mb-0 fw-bold" for="perdaPesoSwitch">Teve perda de peso recentemente?</label>
                                                                    <div class="form-check form-switch">
                                                                        <input class="form-check-input" type="checkbox" role="switch" id="perdaPesoSwitch" name="perdido_peso" {{ $anamnese && $anamnese->perdido_peso == 1 ? 'checked' : '' }}> 
                                                                    </div>
                                                                </div>


                                                                <!-- Tonturas -->
                                                                <div class="col-md-2">
                                                                    <label class="form-label mb-0 fw-bold" for="tonturasSwitch">Sente tonturas frequentemente?</label>
                                                                    <div class="form-check form-switch">
                                                                        <
                                                                        <input class="form-check-input" type="checkbox" role="switch" id="tonturasSwitch" name="tonturas" {{ $anamnese && $anamnese->tonturas == 1 ? 'checked' : '' }}> 
                                                                    </div>
                                                                </div>
                                                                <!-- Fuma -->
                                                                <div class="col-md-2">
                                                                    <label class="form-label mb-0 fw-bold" for="fumaSwitch">Fuma?</label>
                                                                    <div class="form-check form-switch">
                                                                     
                                                                        <input class="form-check-input" type="checkbox" role="switch" id="fumaSwitch" name="fuma" {{ $anamnese && $anamnese->fuma == 1 ? 'checked' : '' }}> 
                                                                    </div>
                                                                </div>                                                            
                                                            </div>
                                                            <div class="card mb-3">
                                                                <div class="card-body">
                                                                    <!-- Outras Informações-->
                                                                    <div class="row">
                                                                        <div class="col-12">
                                                                            <!-- Coloca a label acima do textarea -->
                                                                            <label class="form-label mb-2 fw-bold" for="outrosPronlemasInput">Há alguma informação importante sobre seu estado de saúde que não fora perguntado nessa anamnese?</label>
                                                                            <textarea id="outrosPronlemasInput"  name="outros" class="form-control" placeholder="Quais informações?">{{isset($anamnese) ? $anamnese->outros : '' }}</textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>    
                                                        </div>
                                                    </div> 
                                                    <!-- Dias de Vigência Slider -->
                                                    <div class="row mt-4">
                                                        <div class="col-md-6">
                                                            <label class="form-label" for="vigenciaSlider">Dias de Vigência:</label>
                                                            <input type="range" class="form-range" id="vigenciaSlider" name="qtd_dia_validade" min="0" max="365" step="1" value="180">
                                                            <p>Dias selecionados: <span id="vigenciaValue">180</span></p>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label" for="dataValidade">Data de Validade:</label>
                                                            <input type="text" id="dataValidade" class="form-control" name="data_validade" readonly>
                                                        </div>
                                                    </div>      

                                                </div>
                                            </div>    

                                            <div class="col-xxl-12 col-lg-4 col-sm-6">
                                                <button type="submit" class="btn btn-primary">Salvar</button>
                                                <a href="{{ route('pacientes.index') }}" class="btn btn-secondary">Cancelar</a>
                                                <button type="button" class="btn btn-secondary" onclick="window.location.href='{{ route('pacientes.print', $paciente->codigo) }}'">Imprimir Paciente</button>
                                                
                                                @if(isset($anamnese))
                                                    <button type="button" class="btn btn-secondary" onclick="window.location.href='{{ route('anamnese.print', $paciente->codigo) }}'">Imprimir Anamnese</button>
                                                @endif
                                            </div>
                                                                                       
                                        </div>       
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
    <!-- jQuery Mask Plugin -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
<!-- Inclua no seu arquivo de JavaScript -->
 <!-- jQuery (ou JavaScript Puro) -->
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        const slider = $('#vigenciaSlider');
        const vigenciaValue = $('#vigenciaValue');
        const dataValidade = $('#dataValidade');

        // Função para calcular a data de validade
        function calcularDataValidade(dias) {
            const dataAtual = new Date();
            dataAtual.setDate(dataAtual.getDate() + parseInt(dias)); // Adiciona os dias ao dia atual
            const dia = String(dataAtual.getDate()).padStart(2, '0');
            const mes = String(dataAtual.getMonth() + 1).padStart(2, '0'); // Mês começa do zero
            const ano = dataAtual.getFullYear();
            return `${dia}/${mes}/${ano}`;
        }

        // Atualiza o valor do slider e a data de validade quando o slider é movido
        slider.on('input', function() {
            const dias = $(this).val();
            vigenciaValue.text(dias); // Atualiza o texto dos dias
            dataValidade.val(calcularDataValidade(dias)); // Atualiza o campo de data de validade
        });

        // Inicializa a data de validade com o valor inicial do slider
        dataValidade.val(calcularDataValidade(slider.val()));

        // Problema de Saúde
        $('#problemaSaudeSwitch').change(function() {
            $('#problemaSaudeInput').prop('disabled', !$(this).is(':checked'));
        });

        // Toma Medicamentos
        $('#medicamentosSwitch').change(function() {
            $('#medicamentosInput').prop('disabled', !$(this).is(':checked'));
        });

        // Alergia a Medicamentos
        $('#alergiaSwitch').change(function() {
            $('#alergiaInput').prop('disabled', !$(this).is(':checked'));
        });

        // Cirurgias
        $('#cirurgiaSwitch').change(function() {
            $('#cirurgiaInput').prop('disabled', !$(this).is(':checked'));
        });

        // Problema no Coração
        $('#problemaCoracaoSwitch').change(function() {
            $('#problemaCoracaoInput').prop('disabled', !$(this).is(':checked'));
        });

        // Outros campos simples sem input de texto adicional
        $('#perdaPesoSwitch, #diabetesSwitch, #sangramentoSwitch, #tonturasSwitch, #fumaSwitch').change(function() {
            // Apenas capturando o estado, sem input de texto adicional
        });

        function atualizarAnamnese() {
            $('#anamneseNome').val($('#nome').val());
            $('#anamneseFiliacaoMae').val($('#filiacao_mae').val());
            $('#anamneseDtNasc').val(function() {
                // Obtém a data original no formato yyyy-mm-dd
                let originalDate = $('#dt_nasc').val();
                
                // Separa a string da data em partes (ano, mês, dia)
                let dateParts = originalDate.split('-');
                
                // Reorganiza no formato dd/mm/yyyy
                let formattedDate = dateParts[2] + '/' + dateParts[1] + '/' + dateParts[0];
                
                // Retorna a data formatada
                return formattedDate;
            });
        }

        // Atualiza a aba "Anamnese" quando há mudanças nos campos da aba "Dados do Paciente"
        $('#nome, #filiacao_mae, #dt_nasc').on('input change', function() {
            atualizarAnamnese();
        });

        // Inicializa os valores na aba "Anamnese" ao carregar a página
        atualizarAnamnese();
    });
</script>
<script>
    $(document).ready(function() {
        $('#cpf').mask('000.000.000-00');
        $('#telef_resid, #telef_comerc, #telef_recado_resid').mask('(00) 0000-0000');
        $('#celular').mask('(00) 00000-0000');
        $('#cep_resid, #cep_comerc').mask('00000-000');

        // Função para buscar o endereço pelo CEP e preencher os campos
        function buscarEnderecoPorCep(cep, tipo) {
            // Limpa os campos de endereço se o CEP estiver vazio
            if (cep === "") {
                $(`#end_${tipo}, #bairro_${tipo}, #cidade_${tipo}, #estado_${tipo}`).val('');
                return;
            }

            // Faz a requisição à API ViaCEP
            $.ajax({
                url: `https://viacep.com.br/ws/${cep}/json/`,
                dataType: 'json',
                success: function(response) {
                    if (!response.erro) {
                        // Preenche os campos com os dados retornados
                        $(`#end_${tipo}`).val(response.logradouro.toUpperCase());
                        $(`#bairro_${tipo}`).val(response.bairro.toUpperCase());
                        $(`#cidade_${tipo}`).val(response.localidade.toUpperCase());
                        $(`#estado_${tipo}`).val(response.uf.toUpperCase());
                    } else {
                        alert('CEP não encontrado.');
                    }
                },
                error: function() {
                    alert('Erro ao buscar o CEP.');
                }
            });
        }

        // Evento ao perder o foco do campo de CEP Residencial
        $('#cep_resid').on('blur', function() {
            let cep = $(this).val().replace(/\D/g, ''); // Remove qualquer caractere não numérico
            buscarEnderecoPorCep(cep, 'resid');
        });

        // Evento ao perder o foco do campo de CEP Comercial
        $('#cep_comerc').on('blur', function() {
            let cep = $(this).val().replace(/\D/g, ''); // Remove qualquer caractere não numérico
            buscarEnderecoPorCep(cep, 'comerc');
        });

        // Conversão automática para letras maiúsculas
        $(document).on('input', '.upper-text', function () {
            this.value = this.value.toUpperCase();
        });
    });
</script>

</body>

</html>
