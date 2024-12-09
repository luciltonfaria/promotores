<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TSDoctor - Detalhes do Orçamento</title>
    <link rel="stylesheet" href="{{ asset('assets/css/main.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/remix/remixicon.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/overlay-scroll/OverlayScrollbars.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/gallery/gallery.css') }}">
</head>

<body>
    <div class="page-wrapper">
        @include('partials.header')
        <div class="main-container">
            @include('partials.sidebar')
            <div class="app-container">
                <div class="app-hero-header d-flex align-items-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><i class="ri-home-8-line lh-1 pe-3 me-3 border-end"></i><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('/orcamentos') }}">Orçamentos</a></li>
                        <li class="breadcrumb-item text-primary" aria-current="page">Detalhes do Orçamento</li>
                    </ol>
                </div>
                <div class="app-body">
                    <div class="row">
                        <div class="col-12 mt-4">
                            <div class="card">
                                <div class="card-header d-flex align-items-center justify-content-between">
                                    <h5 class="card-title">Detalhes do Orçamento</h5>
                                </div>
                                <div class="card-body">
                                    <!-- Dados do Orçamento -->
                                    <div class="row gx-3">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="nome" class="form-label">Nome</label>
                                                <p class="form-control-static">{{ $orcamento->nome }}</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="mb-3">
                                                <label for="data_nascimento" class="form-label">Data de Nascimento</label>
                                                <p class="form-control-static">{{ $orcamento->data_nascimento }}</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="mb-3">
                                                <label for="cpf" class="form-label">CPF</label>
                                                <p class="form-control-static">{{ $orcamento->cpf }}</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="mb-3">
                                                <label for="rg" class="form-label">RG</label>
                                                <p class="form-control-static">{{ $orcamento->rg }}</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="mb-4">
                                                <label for="email" class="form-label">Email</label>
                                                <p class="form-control-static">{{ $orcamento->email }}</p>
                                            </div>
                                        </div>
                                        
                                        <!-- Telefones e Tipos -->
                                        @php
                                            $telefones = [
                                                ['name' => 'Telefone 1', 'telefone' => $orcamento->telefone1, 'tipo' => $orcamento->tipo1],
                                                ['name' => 'Telefone 2', 'telefone' => $orcamento->telefone2, 'tipo' => $orcamento->tipo2],
                                                ['name' => 'Telefone 3', 'telefone' => $orcamento->telefone3, 'tipo' => $orcamento->tipo3]
                                            ];
                                        @endphp

                                        @foreach ($telefones as $tel)
                                            <div class="col-lg-4">
                                                <div class="mb-3">
                                                    <label for="telefone" class="form-label">{{ $tel['name'] }}</label>
                                                    <p class="form-control-static">{{ $tel['telefone'] }} ({{ $tel['tipo'] }})</p>
                                                </div>
                                            </div>
                                        @endforeach

                                        <!-- Endereço -->
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="endereco" class="form-label">Endereço</label>
                                                <p class="form-control-static">{{ $orcamento->endereco }}</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="bairro" class="form-label">Bairro</label>
                                                <p class="form-control-static">{{ $orcamento->bairro }}</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="cidade" class="form-label">Cidade</label>
                                                <p class="form-control-static">{{ $orcamento->cidade }}</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="mb-3">
                                                <label for="cep" class="form-label">CEP</label>
                                                <p class="form-control-static">{{ $orcamento->cep }}</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="mb-3">
                                                <label for="uf" class="form-label">UF</label>
                                                <p class="form-control-static">{{ $orcamento->uf }}</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="indicado_por" class="form-label">Indicado por</label>
                                                <p class="form-control-static">{{ $orcamento->indicado_por }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>

                                    <!-- Serviços -->
                                    <div class="card">
                                        <div class="card-header d-flex align-items-center justify-content-between">
                                            <h5 class="card-title">Serviços</h5>
                                        </div>
                                        <div class="card-body">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Procedimento</th>
                                                        <th>Dentes</th>
                                                        <th>Faces</th>
                                                        <th>Quantidade</th>
                                                        <th>Valor</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($orcamento->servicos as $servico)
                                                        <tr>
                                                            <td>{{ $servico->descricao }}</td>
                                                            <td>{{ $servico->dentes }}</td>
                                                            <td>{{ $servico->faces }}</td>
                                                            <td>{{ $servico->quantidade }}</td>
                                                            <td>{{ number_format($servico->valor, 2, ',', '.') }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <!-- Pagamentos -->
                                    <div class="card">
                                        <div class="card-header d-flex align-items-center justify-content-between">
                                            <h5 class="card-title">Pagamentos</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="row gx-3">
                                                <div class="col-md-3 mb-2">
                                                    <label for="valor_total" class="form-label">Valor Total</label>
                                                    <p class="form-control-static">{{ number_format($orcamento->valor_total, 2, ',', '.') }}</p>
                                                </div>


                                                <div class="col-md-3 mb-2">
                                                    <label for="desconto_percentual" class="form-label">Desconto Percentual</label>
                                                    <p class="form-control-static">{{ $orcamento->desconto_percentual }}%</p>
                                                </div>

                                                <div class="col-md-2 mb-2">
                                                    <label for="data1pagto" class="form-label">Data 1o. Pagto</label>
                                                    <p class="form-control-static">{{ \Carbon\Carbon::parse($orcamento->data1pagto)->format('d/m/Y') }}</p>
                                                </div>

                                                <div class="col-md-2 mb-2">
                                                    <label for="parcelas" class="form-label">Parcelas</label>
                                                    <p class="form-control-static">{{ $orcamento->parcelas }}</p>
                                                </div>

                                                <div class="col-md-2 mb-2">
                                                    <label for="valor_liquido" class="form-label">Valor Líquido</label>
                                                    <p class="form-control-static">{{ number_format($orcamento->valor, 2, ',', '.') }}</p>
                                                </div>
                                            </div>

                                            <!-- Parcelas -->
                                            <div id="parcelas-container">
                                                @for ($i = 1; $i <= $orcamento->parcelas; $i++)
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label for="data_parcela{{ $i }}" class="form-label">Data Parcela {{ $i }}</label>
                                                            <p class="form-control-static">{{ \Carbon\Carbon::parse($orcamento->{'data_parcela'.$i})->format('d/m/Y') }}</p>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="valor_parcela{{ $i }}" class="form-label">Valor Parcela {{ $i }}</label>
                                                            <p class="form-control-static">{{ number_format($orcamento->{'valor_parcela'.$i}, 2, ',', '.') }}</p>
                                                        </div>
                                                    </div>
                                                @endfor
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Imagens -->
                                    <div class="card">
                                        <div class="card-header d-flex align-items-center justify-content-between">
                                            <h5 class="card-title">Imagens</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                @foreach ($orcamento->imagens as $imagem)
                                                    <div class="col-md-3">
                                                        <img src="{{ asset('storage/orcamentos_imagens/' . basename($imagem->path_imagem)) }}" style="max-width: 100%; border: 1px solid #ddd; padding: 5px;">
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Observações -->
                                    <div class="col-md-12 mb-3">
                                        <label for="observacao" class="form-label">Observação</label>
                                        <p class="form-control-static">{{ $orcamento->observacao }}</p>
                                    </div>

                                    <a href="{{ route('orcamentos.index') }}" class="btn btn-secondary mt-4">Voltar</a>
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
