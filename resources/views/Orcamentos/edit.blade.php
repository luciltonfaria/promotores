<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TSDoctor - Editar Orçamento</title>
    <link rel="stylesheet" href="{{ asset('assets/css/main.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/remix/remixicon.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/overlay-scroll/OverlayScrollbars.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/gallery/gallery.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
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
                        <li class="breadcrumb-item text-primary" aria-current="page">Editar Orçamento</li>
                    </ol>
                </div>
                <div class="app-body">
                    <form action="{{ route('orcamentos.update', $orcamento->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-12 mt-4">
                                <div class="card">
                                    <div class="card-header d-flex align-items-center justify-content-between">
                                        <h5 class="card-title">Editar Orçamento</h5>
                                    </div>
                                    <div class="card-body">
                                        <!-- Dados do Orçamento -->
                                        <div class="row gx-3">
                                            <div class="col-lg-6">
                                                <label for="nome" class="form-label">Nome</label>
                                                <input type="text" name="nome" id="nome" class="form-control upper-text" value="{{ $orcamento->nome }}" required>
                                            </div>
                                            <div class="col-lg-3">
                                                <label for="data_nascimento" class="form-label">Data de Nascimento</label>
                                                <input type="date" name="data_nascimento" id="data_nascimento" class="form-control" value="{{ $orcamento->data_nascimento }}">
                                            </div>
                                            <div class="col-lg-3">
                                                <label for="cpf" class="form-label">CPF</label>
                                                <input type="text" name="cpf" id="cpf" class="form-control cpf-mask" value="{{ $orcamento->cpf }}">
                                            </div>
                                            <div class="col-lg-3">
                                                <label for="rg" class="form-label">RG</label>
                                                <input type="text" name="rg" id="rg" class="form-control upper-text" value="{{ $orcamento->rg }}">
                                            </div>
                                            <div class="col-lg-9">
                                                <label for="email" class="form-label">Email</label>
                                                <input type="email" name="email" id="email" class="form-control" value="{{ $orcamento->email }}">
                                            </div>
                                            <!-- Telefones e Tipos -->
                                            <div class="col-lg-4">
                                                <label for="telefone1" class="form-label">Telefone 1</label>
                                                <input type="text" name="telefone1" id="telefone1" class="form-control phone-mask" value="{{ $orcamento->telefone1 }}">
                                            </div>
                                            <div class="col-lg-2">
                                                <label for="tipo1" class="form-label">Tipo</label>
                                                <select name="tipo1" class="form-control">
                                                    <option value="residencial" {{ $orcamento->tipo1 == 'residencial' ? 'selected' : '' }}>Residencial</option>
                                                    <option value="comercial" {{ $orcamento->tipo1 == 'comercial' ? 'selected' : '' }}>Comercial</option>
                                                    <option value="whatsapp" {{ $orcamento->tipo1 == 'whatsapp' ? 'selected' : '' }}>WhatsApp</option>
                                                </select>
                                            </div>
                                            <!-- Repita o mesmo para telefone2 e telefone3 -->

                                            <!-- Endereço -->
                                            <div class="col-lg-6">
                                                <label for="endereco" class="form-label">Endereço</label>
                                                <input type="text" name="endereco" id="endereco" class="form-control upper-text" value="{{ $orcamento->endereco }}">
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="bairro" class="form-label">Bairro</label>
                                                <input type="text" name="bairro" id="bairro" class="form-control upper-text" value="{{ $orcamento->bairro }}">
                                            </div>
                                            <!-- Cidade, CEP, UF, etc. -->
                                        </div>
                                        <hr>

                                        <!-- Serviços do Orçamento -->
                                        <div class="card mt-4">
                                            <div class="card-header d-flex align-items-center justify-content-between">
                                                <h5 class="card-title">Editar Serviços</h5>
                                            </div>
                                            <div class="card-body">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Procedimento</th>
                                                            <th>Descrição</th>
                                                            <th>Dentes</th>
                                                            <th>Faces</th>
                                                            <th>Quantidade</th>
                                                            <th>Valor</th>
                                                            <th>Ações</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="servicos-container">
                                                        @foreach ($orcamento->servicos as $i => $servico)
                                                            <tr>
                                                                <td>
                                                                    <select name="servicos[{{ $i }}][procedimento_id]" class="form-control select2">
                                                                        <option value="">Selecione o Procedimento</option>
                                                                        @foreach ($procedimentos as $procedimento)
                                                                            <option value="{{ $procedimento->id }}" {{ $servico->procedimento_id == $procedimento->id ? 'selected' : '' }}>
                                                                                {{ $procedimento->codigo }} - {{ $procedimento->descricao }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </td>
                                                                <td><input type="text" name="servicos[{{ $i }}][descricao]" class="form-control" value="{{ $servico->descricao }}"></td>
                                                                <td><input type="text" name="servicos[{{ $i }}][dentes]" class="form-control dentes-input" value="{{ $servico->dentes }}"></td>
                                                                <td><input type="text" name="servicos[{{ $i }}][faces]" class="form-control faces-input" value="{{ $servico->faces }}"></td>
                                                                <td><input type="number" name="servicos[{{ $i }}][quantidade]" class="form-control quantidade" value="{{ $servico->quantidade }}"></td>
                                                                <td><input type="text" name="servicos[{{ $i }}][valor]" class="form-control valor" value="{{ number_format($servico->valor, 2, ',', '.') }}"></td>
                                                                <td><button type="button" class="btn btn-danger remove-servico">Remover</button></td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                                <button type="button" id="add-servico" class="btn btn-primary mt-2">Adicionar Serviço</button>
                                            </div>
                                        </div>

                                        <!-- Pagamentos -->
                                        <div class="card mt-4">
                                            <div class="card-header d-flex align-items-center justify-content-between">
                                                <h5 class="card-title">Editar Pagamentos</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="row gx-3">
                                                    <div class="col-md-2 mb-2">
                                                        <label for="valor_total" class="form-label">Valor Total</label>
                                                        <input type="text" name="valor_total" id="valor_total" class="form-control" value="{{ number_format($orcamento->valor_total, 2, ',', '.') }}">
                                                    </div>
                                                    <div class="col-md-2 mb-2">
                                                        <label for="convenio" class="form-label">Convênio</label>
                                                        <select id="convenio_id" name="convenio_id" class="form-control">
                                                            <option value="">Selecione um Convênio</option>
                                                            @foreach($convenios as $convenio)
                                                                <option value="{{ $convenio->id }}" {{ $orcamento->convenio_id == $convenio->id ? 'selected' : '' }}>{{ $convenio->descricao }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-2 mb-2">
                                                        <label for="desconto_percentual" class="form-label">Desconto (%)</label>
                                                        <input type="number" step="0.01" id="desconto_percentual" name="desconto_percentual" class="form-control" value="{{ $orcamento->desconto_percentual }}">
                                                    </div>
                                                    <div class="col-md-2 mb-2">
                                                        <label for="data1pagto" class="form-label">Data 1o. Pagto</label>
                                                        <input type="date" id="data1pagto" name="data1pagto" class="form-control" value="{{ $orcamento->data1pagto }}">
                                                    </div>
                                                    <div class="col-md-2 mb-2">
                                                        <label for="parcelas" class="form-label">Parcelas</label>
                                                        <input type="number" id="parcelas" name="parcelas" class="form-control" value="{{ $orcamento->parcelas }}">
                                                    </div>
                                                    <div class="col-md-2 mb-2">
                                                        <label for="valor_liquido" class="form-label">Valor Líquido</label>
                                                        <input type="text" name="valor" id="valor" class="form-control" value="{{ number_format($orcamento->valor, 2, ',', '.') }}">
                                                    </div>
                                                </div>
                                                <div id="parcelas-container">
                                                    @for ($i = 1; $i <= $orcamento->parcelas; $i++)
                                                        <div class="row mt-2">
                                                            <div class="col-md-6">
                                                                <label for="data_parcela{{ $i }}" class="form-label">Data Parcela {{ $i }}</label>
                                                                <input type="date" id="data_parcela{{ $i }}" name="data_parcela[{{ $i }}]" class="form-control" value="{{ date('Y-m-d', strtotime($orcamento->{'data_parcela'.$i})) }}">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="valor_parcela{{ $i }}" class="form-label">Valor Parcela {{ $i }}</label>
                                                                <input type="text" id="valor_parcela{{ $i }}" name="valor_parcela[{{ $i }}]" class="form-control" value="{{ number_format($orcamento->{'valor_parcela'.$i}, 2, ',', '.') }}">
                                                            </div>
                                                        </div>
                                                    @endfor
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Imagens -->
                                        <div class="card mt-4">
                                            <div class="card-header d-flex align-items-center justify-content-between">
                                                <h5 class="card-title">Editar Imagens</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    @foreach ($orcamento->imagens as $imagem)
                                                        <div class="col-md-3 position-relative">
                                                            <img src="{{ asset('storage/orcamentos_imagens/' . basename($imagem->path_imagem)) }}" style="max-width: 100%; border: 1px solid #ddd; padding: 5px;">
                                                            <button type="button" class="btn btn-danger position-absolute top-0 end-0">Excluir</button>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <div class="mb-3 mt-3">
                                                    <label for="imagens" class="form-label">Adicionar Novas Imagens</label>
                                                    <input type="file" name="imagens[]" id="imagens" class="form-control" multiple>
                                                </div>
                                                <div class="mt-3" id="image-preview-container"></div>
                                            </div>
                                        </div>

                                        <!-- Observações -->
                                        <div class="col-md-12 mb-3 mt-4">
                                            <label for="observacao" class="form-label">Observação</label>
                                            <textarea id="observacao" name="observacao" class="form-control">{{ $orcamento->observacao }}</textarea>
                                        </div>

                                        <button type="submit" class="btn btn-success mt-4">Salvar</button>
                                        <a href="{{ route('orcamentos.index') }}" class="btn btn-secondary mt-4">Cancelar</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="app-footer bg-white">
                    <span>© TSul Tecnologia 2024</span>
                </div>
            </div>
        </div>
    </div>
    
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/overlay-scroll/jquery.overlayScrollbars.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/gallery/baguetteBox.js') }}"></script>

       <script>
        $(document).ready(function () {

            let servicoIndex = 1;
            window.imageArray = [];

            $('.select2').select2();
            $('.phone-mask').mask('(00) 00000-0000');
            $('#cpf').mask('000.000.000-00');

            var maskBehavior = function (val) {
                return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
            },
            options = {
                onKeyPress: function(val, e, field, options) {
                    field.mask(maskBehavior.apply({}, arguments), options);
                }
            };

            $('.select2').select2({
                placeholder: "Selecione o Procedimento",
                allowClear: true
            });

            $('.phone-mask').mask(maskBehavior, options);

            // Aplica a máscara de CPF
            $('#cpf').mask('999.999.999-99');

            // Função para formatar automaticamente o input dos dentes
            function formatDentesInput(input) {
                let value = input.val().replace(/[^0-9]/g, ''); // Remove qualquer caractere que não seja numérico
                let formatted = '';

                for (let i = 0; i < value.length; i += 2) {
                    let pair = value.substring(i, i + 2);
                    
                    // Verifica se o par de dígitos está entre 01 e 32
                    if (pair >= '01' && pair <= '32') {
                        if (formatted.length > 0) {
                            formatted += ',';
                        }
                        formatted += pair;
                    }
                }

                input.val(formatted);
            }

            // Função para formatar automaticamente o input das faces
            function formatFacesInput(input) {
                let validFaces = ['M', 'D', 'O', 'V', 'L'];
                let value = input.val().toUpperCase().replace(/[^MDOVL]/g, ''); // Aceita apenas letras M, D, O, V, L
                let formatted = '';

                for (let i = 0; i < value.length; i++) {
                    if (i > 0) {
                        formatted += ',';
                    }
                    formatted += value[i];
                }

                input.val(formatted);
            }

            // Aplica a formatação ao digitar nos campos de dentes
            $(document).on('input', '.dentes-input', function () {
                formatDentesInput($(this));
            });

            // Aplica a formatação ao digitar nos campos de faces
            $(document).on('input', '.faces-input', function () {
                formatFacesInput($(this));
            });

            // Força o texto em maiúsculas nos campos com a classe upper-text
            $(document).on('input', '.upper-text', function () {
                this.value = this.value.toUpperCase();
            });

            $('#add-servico').click(function () {
                const newRow = `
                    <tr>
                        <td>
                            <select name="servicos[${servicoIndex}][procedimento_id]" class="form-control select-procedimento select2">
                                <option value="">Selecione o Procedimento</option>
                                @foreach ($procedimentos as $procedimento)
                                    <option value="{{ $procedimento->id }}"> {{ $procedimento->codigo }} - {{ $procedimento->descricao }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td><input type="text" name="servicos[${servicoIndex}][descricao]" class="form-control descricao" readonly></td>
                        <td>
                            <div class="input-group">
                                <input type="text" name="servicos[${servicoIndex}][dentes]" id="dentes-input-${servicoIndex}" class="form-control dentes-input" placeholder="Ex: 16,18,25">
                            </div>
                        </td>
                        <td>
                            <div class="input-group">
                                <input type="text" name="servicos[${servicoIndex}][faces]" id="faces-input-${servicoIndex}" class="form-control faces-input" placeholder="Ex: M,D,O">
                            </div>
                        </td>
                        <td><input type="number" name="servicos[${servicoIndex}][quantidade]" class="form-control quantidade"></td>
                        <td><input type="text" name="servicos[${servicoIndex}][valor]" class="form-control valor"></td>
                        <td>
                            <button type="button" class="btn btn-danger remove-servico">Remover</button>
                            <button type="button" class="btn btn-secondary repeat-servico">Repetir</button>
                        </td>
                    </tr>
                `;
                $('#servicos-container').append(newRow);
                
                // Inicializa o Select2 no novo select
                $('.select2').select2({
                    placeholder: "Selecione o Procedimento",
                    allowClear: true
                });
                servicoIndex++;
                calcularValorTotal();
            });

            // Função para repetir a linha de serviço
            $(document).on('click', '.repeat-servico', function () {
                let currentRow = $(this).closest('tr').clone();
                currentRow.find('input, select').each(function () {
                    $(this).attr('name', $(this).attr('name').replace(/\d+/, servicoIndex));
                });
                $('#servicos-container').append(currentRow);
                servicoIndex++;
                calcularValorTotal();
            });

            $(document).on('click', '.remove-servico', function () {
                $(this).closest('tr').remove();
                calcularValorTotal();
            });

            $(document).on('change', '.select-procedimento', function () {
                const selectedOption = $(this).find('option:selected');
                const descricao = selectedOption.text();
                $(this).closest('tr').find('.descricao').val(descricao);
            });

            $(document).on('input', '.quantidade, .valor', function () {
                calcularValorTotal();
            });

            function calcularValorTotal() {
                let valorTotal = 0;
                $('#servicos-container tr').each(function () {
                    const quantidade = parseFloat($(this).find('.quantidade').val()) || 0;
                    const valor = parseFloat($(this).find('.valor').val()) || 0;
                    valorTotal += quantidade * valor;
                });

                // Atualiza o valor total no input correspondente
                $('#valor_total').val(valorTotal.toFixed(2));
                $('#valor_hidden').val(valorTotal.toFixed(2));
                
                // Chama a função para calcular parcelas e aplicar o desconto
                calcularParcelas();
            }

            $('#desconto_percentual, #parcelas, #data1pagto').on('input change', function () {
                calcularParcelas();
            });

            function calcularParcelas() {
                const descontoPercentual = parseFloat($('#desconto_percentual').val()) || 0;
                const parcelas = parseInt($('#parcelas').val());
                let valor = parseFloat($('#valor_total').val());
                const data1pagto = $('#data1pagto').val();

                const valorDesconto = valor * (descontoPercentual / 100);
                valor = valor - valorDesconto;

                // Atualiza o campo valor com o valor total menos os descontos
                $('#valor').val(valor.toFixed(2));

                const parcelasContainer = $('#parcelas-container');
                parcelasContainer.empty();

                if (parcelas > 0 && valor > 0 && data1pagto) {
                    const valorParcela = (valor / parcelas).toFixed(2);
                    let dataParcela = new Date(data1pagto);

                    for (let i = 1; i <= parcelas; i++) {
                        const dataFormatada = dataParcela.toISOString().split('T')[0]; // Formata a data para YYYY-MM-DD

                        const parcelaRow = `
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="data_parcela${i}" class="form-label">Data Parcela ${i}</label>
                                    <input type="date" id="data_parcela${i}" name="data_parcela${i}" class="form-control" value="${dataFormatada}">
                                </div>
                                <div class="col-md-6">
                                    <label for="valor_parcela${i}" class="form-label">Valor Parcela ${i}</label>
                                    <input type="text" id="valor_parcela${i}" name="valor_parcela${i}" class="form-control valor-parcela" value="${valorParcela}" readonly>
                                </div>
                            </div>
                        `;

                        parcelasContainer.append(parcelaRow);

                        // Adiciona 30 dias à data da próxima parcela
                        dataParcela.setDate(dataParcela.getDate() + 30);
                    }
                }
            }

            $('form').submit(function () {
                $('#valor_hidden').val($('#valor_total').val());
            });

            $(document).on('input', '.valor-parcela', function () {
                let val = parseFloat($(this).val()).toFixed(2);
                $(this).val(val);
            });

            $('#imagens').on('change', function () {
                const files = this.files;

                if (files.length === 0) {
                    return; // Nenhum arquivo selecionado
                }

                Array.from(files).forEach(file => {
                    if (file.type.startsWith('image/')) {
                        const reader = new FileReader();
                        reader.onload = function (e) {
                            const imgIndex = imageArray.length;
                            const img = $('<img>').attr('src', e.target.result).css({
                                'max-width': '150px',
                                'max-height': '150px',
                                'margin': '10px',
                                'border': '1px solid #ddd',
                                'padding': '5px',
                                'position': 'relative'
                            });

                            const deleteIcon = $('<span>&times;</span>').css({
                                'position': 'absolute',
                                'top': '5px',
                                'right': '5px',
                                'color': 'red',
                                'cursor': 'pointer',
                                'font-size': '18px',
                                'background': '#fff',
                                'border-radius': '50%',
                                'padding': '2px'
                            });

                            const imgWrapper = $('<div>').css({
                                'display': 'inline-block',
                                'position': 'relative'
                            }).append(img).append(deleteIcon);

                            $('#image-preview-container').append(imgWrapper);

                            // Adiciona a imagem ao array
                            imageArray.push(file);

                            // Remove a imagem da visualização e do array ao clicar no ícone de delete
                            deleteIcon.on('click', function () {
                                imageArray.splice(imgIndex, 1); // Remove do array
                                imgWrapper.remove(); // Remove do DOM
                            });
                        };
                        reader.readAsDataURL(file);
                    } else {
                        // Exibe um aviso se o arquivo não for uma imagem
                        const warning = $('<div>').text('O arquivo "' + file.name + '" não é uma imagem válida.')
                                                .css({'color': 'red', 'margin': '10px'});
                        $('#image-preview-container').append(warning);
                    }
                });

                // Reset the input field so the same image can be selected again if needed
                $(this).val('');
            });
            

        });
        $('form').submit(function(e) {
            e.preventDefault(); // Previne o envio padrão do formulário

            let formData = new FormData(this); // Cria um FormData com todos os campos

            imageArray.forEach(function(file, index) {
                formData.append('imagens[]', file); // Adiciona as imagens selecionadas ao FormData
            });

            $.ajax({
                url: $(this).attr('action'),
                method: $(this).attr('method'),
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    // Lógica de sucesso
                },
                error: function(response) {
                    // Lógica de erro
                }
            });
        });
    </script>
</body>

</html>
