<?php

namespace App\Http\Controllers;

use App\Models\Orcamento;
use App\Models\Convenio; 
use App\Models\ServicosOrcamentos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Services\FPDFService;

class OrcamentoController extends Controller
{
    public function index()
    {
        $orcamentos = Orcamento::all();
        return view('orcamentos.index', compact('orcamentos'));
    }

    public function create()
    {
        $procedimentos = \App\Models\Procedimento::all();
        $convenios = \App\Models\Convenio::all();
        $formasPagamento = \App\Models\FormaPagto::all();
        Log::info('Convenios:', ['convenios' => $convenios]);

        return view('orcamentos.create', compact('procedimentos', 'convenios', 'formasPagamento'));
    }

    public function store(Request $request)
    {
        Log::info('Entrando no método store', ['request' => $request->all()]);
    
        // Ajuste no valor para salvar no formato correto
        $request->merge([
            'valor' => str_replace(',', '.', $request->input('valor')),
        ]);
    
        // Validação dos dados recebidos
        $validatedData = $request->validate([
            'nome' => 'required|string|max:255',
            'endereco' => 'nullable|string|max:255',
            'bairro' => 'nullable|string|max:255',
            'cep' => 'nullable|string|max:10',
            'cidade' => 'nullable|string|max:255',
            'uf' => 'nullable|string|max:2',
            'cpf' => 'required|string|max:14',
            'rg' => 'nullable|string|max:20',
            'email' => 'required|email|max:255',
            'telefone1' => 'nullable|string|max:15',
            'tipo1' => 'nullable|string|max:15',
            'telefone2' => 'nullable|string|max:15',
            'tipo2' => 'nullable|string|max:15',
            'telefone3' => 'nullable|string|max:15',
            'tipo3' => 'nullable|string|max:15',
            'valor' => 'required|numeric',
            'convenio_id' => 'nullable|integer',
            'parcelas' => 'nullable|integer|min:1|max:12',
            'desconto_percentual' => 'nullable|numeric|min:0|max:100',
            'observacao' => 'nullable|string|max:1000',
            'indicado_por' => 'nullable|string|max:255',
            'imagens.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validação para imagens
            // Validação das parcelas
            'data_parcela1' => 'nullable|date',
            'valor_parcela1' => 'nullable|numeric',
            'data_parcela2' => 'nullable|date',
            'valor_parcela2' => 'nullable|numeric',
            'data_parcela3' => 'nullable|date',
            'valor_parcela3' => 'nullable|numeric',
            'data_parcela4' => 'nullable|date',
            'valor_parcela4' => 'nullable|numeric',
            'data_parcela5' => 'nullable|date',
            'valor_parcela5' => 'nullable|numeric',
            'data_parcela6' => 'nullable|date',
            'valor_parcela6' => 'nullable|numeric',
            'data_parcela7' => 'nullable|date',
            'valor_parcela7' => 'nullable|numeric',
            'data_parcela8' => 'nullable|date',
            'valor_parcela8' => 'nullable|numeric',
            'data_parcela9' => 'nullable|date',
            'valor_parcela9' => 'nullable|numeric',
            'data_parcela10' => 'nullable|date',
            'valor_parcela10' => 'nullable|numeric',
            'data_parcela11' => 'nullable|date',
            'valor_parcela11' => 'nullable|numeric',
            'data_parcela12' => 'nullable|date',
            'valor_parcela12' => 'nullable|numeric',
            'forma_pagto' => 'nullable|integer|exists:forma_pagto,id',       
        ]);
    
        // Criação do orçamento
        $orcamento = Orcamento::create($request->all());
        Log::info('create no método store', ['orcamento' => $orcamento]);
    
        // Adicionar serviços ao orçamento
        foreach ($request->input('servicos', []) as $servico) {
            if (!isset($servico['procedimento_id']) || is_null($servico['procedimento_id'])) {
                Log::warning('Serviço ignorado devido a procedimento_id nulo', ['servico' => $servico]);
                continue; // Pula para o próximo serviço
            }
    
            $procedimento = \App\Models\Procedimento::find($servico['procedimento_id']);
    
            if ($procedimento) {
                $orcamento->servicos()->create([
                    'procedimento_id' => $procedimento->id,
                    'descricao' => $procedimento->descricao,
                    'dentes' => $servico['dentes'],
                    'faces' => $servico['faces'],
                    'quantidade' => $servico['quantidade'],
                    'valor' => $servico['valor'],
                ]);
            } else {
                Log::warning('Serviço ignorado devido a procedimento não encontrado', ['servico' => $servico]);
            }
        }
    
        // Upload e associação das imagens
        if ($request->hasFile('imagens')) {
            foreach ($request->file('imagens') as $imagem) {
                $path = $imagem->store('orcamentos_imagens', 'public');
    
                // Salva o path da imagem no banco de dados
                \App\Models\ImagensOrcamento::create([
                    'orcamento_id' => $orcamento->id,
                    'path_imagem' => $path
                ]);
            }
        }
    
        return redirect()->route('orcamentos.index')->with('success', 'Orçamento criado com sucesso!');
    }
    

    public function show(Orcamento $orcamento)
    {
        // Carregar serviços e imagens com o orçamento
        $orcamento->load('servicos', 'imagens'); // Adicione os relacionamentos necessários

        // Carregar todos os convênios
        $convenios = Convenio::all();
    
        return view('orcamentos.show', compact('orcamento', 'convenios'));
    }

    public function edit(Orcamento $orcamento)
    {
        $orcamento->load(['servicos', 'imagens']);
        $convenios = Convenio::all();
        $procedimentos = \App\Models\Procedimento::all();
        $formasPagamento = \App\Models\FormaPagto::all();

        return view('orcamentos.edit', compact('orcamento', 'convenios', 'procedimentos', 'formasPagamento'));
    }

    
    public function update(Request $request, Orcamento $orcamento)
    {
        // Verifique se o valor está preenchido, caso contrário, defina um valor padrão
        if (!$request->filled('valor')) {
            $request->merge(['valor' => '0']);
        } else {
            $request->merge(['valor' => str_replace(',', '.', $request->input('valor'))]);
        }
    
        if ($request->filled('valor_total')) {
            $request->merge(['valor_total' => str_replace(',', '.', $request->input('valor_total'))]);
        }

        // Atualizar o orçamento com os dados recebidos
        $orcamento->update($request->all());
    
        // Atualizar as parcelas com verificação de valores vazios
        for ($i = 1; $i <= $request->input('parcelas'); $i++) {
            $dataParcela = $request->input("data_parcela$i");
            $valorParcela = $request->input("valor_parcela$i");

            // Defina o valor padrão se estiver vazio
            $orcamento->{"data_parcela$i"} = $dataParcela ?: null;
            $orcamento->{"valor_parcela$i"} = $valorParcela ? str_replace(',', '.', $valorParcela) : '0';
        }
    
        // Salvar as alterações das parcelas
        $orcamento->save();
    
        Log::warning('Salvei A Alteracao');
    
        // Atualize os serviços do orçamento (deletar os antigos e criar novos)
        $orcamento->servicos()->delete();
        foreach ($request->input('servicos', []) as $servico) {
            $orcamento->servicos()->create([
                'descricao' => $servico['descricao'],
                'dentes' => $servico['dentes'],
                'faces' => $servico['faces'],
                'quantidade' => $servico['quantidade'],
                'valor' => str_replace(',', '.', $servico['valor']),
            ]);
        }
    
        // Verifique e armazene as imagens
        if ($request->hasFile('imagens')) {
            foreach ($request->file('imagens') as $imagem) {
                $path = $imagem->store('orcamentos_imagens', 'public');
                $orcamento->imagens()->create(['path_imagem' => $path]);
            }
        }
    
        Log::warning('vai para redirect');
        return redirect()->route('orcamentos.index')->with('success', 'Orçamento atualizado com sucesso');
    }
    


    public function upload(Request $request)
    {
        $request->validate([
            'imagem' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        $imageName = time().'.'.$request->imagem->extension();  
        $path = $request->imagem->storeAs('public/images', $imageName);
    
        return back()
            ->with('success', 'You have successfully uploaded the image.')
            ->with('imagem_path', $imageName);
    }
    

    public function destroy(Orcamento $orcamento)
    {
        $orcamento->delete();
        return redirect()->route('orcamentos.index');
    }

     // Definir o relacionamento hasMany com ServicosOrcamentos
     public function servicosOrcamentos()
     {
         return $this->hasMany(ServicosOrcamentos::class, 'orcamento_id');
     }

    public function contrato($id)
    {
        // Recupera o orçamento pelo ID
        $orcamento = Orcamento::with('servicos')->findOrFail($id);

        // Inicializa o FPDF
        $pdf = new FPDFService();
        $pdf->AddPage();

        $logo = env('COMPANY_LOGO');

               // Adiciona a logomarca no canto superior esquerdo
        if (file_exists($logo)) {
            $pdf->Image($logo, 20, 10, 50); // X, Y, largura (altura será proporcional)
        }
        
        // Define a fonte
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Ln(5);

        // Define as fontes
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(0, 10, utf8_decode('Orçamento'), 0, 1, 'C');
        $pdf->SetLineWidth(0.7);
        $pdf->Line(10, 30, 200, 30);
        // Define o conteúdo do contrato
        

        $pdf->Ln(10);
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 8, 'Dados do Cliente', 0, 1);

        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(100, 8, utf8_decode('Nome: ' . $orcamento->nome), 0, 0, 'L');
        $pdf->Cell(48, 8, utf8_decode('CPF: ' . $orcamento->cpf), 0, 0, 'L');
        $pdf->Cell(40, 8, 'Data Nasc: ' . \Carbon\Carbon::parse($orcamento->data_nascimento)->format('d/m/Y'), 0, 0, 'L');
        $pdf->Ln(8);
        $pdf->Cell(60, 8, utf8_decode('Identidade: ' . $orcamento->rg), 0, 0, 'L');
        $pdf->Cell(100, 8, utf8_decode('Email: ' . $orcamento->email), 0, 0, 'L');
        $pdf->Ln(8);
        $pdf->Cell(90, 8, utf8_decode('Endereço: ' . $orcamento->endereco), 0, 0, 'L');
        $pdf->Cell(50, 8,  utf8_decode('Bairro: ' . $orcamento->bairro), 0, 0, 'L');
        $pdf->Cell(40, 8,  utf8_decode('Cidade-UF: ' . $orcamento->cidade.'-'. $orcamento->uf), 0, 0, 'L');
        $pdf->Ln(8);
        $pdf->Cell(75, 8, utf8_decode('Telefones: 1- ' . $orcamento->telefone1.' - '.strtoupper($orcamento->tipo1)), 0, 0, 'L');
        $pdf->Cell(60, 8, utf8_decode('2- ' . $orcamento->telefone2.' - '.strtoupper($orcamento->tipo2)), 0, 0, 'L');
        $pdf->Cell(60, 8, utf8_decode('3- ' . $orcamento->telefone3.' - '.strtoupper($orcamento->tipo3)), 0, 0, 'L'); 
        $pdf->Ln(8);

        $pdf->SetLineWidth(0.2);
        // Adicionar os serviços do orçamento
        $pdf->Ln(10);
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 10, utf8_decode('Serviços'), 0, 1);

        // Definindo a largura de cada coluna
        $larguraColProcedimento = 80;
        $larguraColDentes = 30;
        $larguraColFaces = 30;
        $larguraColQtde = 20;
        $larguraColValor = 30;

        // Cabeçalho da tabela
        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell($larguraColProcedimento, 10, 'Procedimento', 1, 0, 'C');
        $pdf->Cell($larguraColDentes, 10, 'Dentes', 1, 0, 'C');
        $pdf->Cell($larguraColFaces, 10, 'Faces', 1, 0, 'C');
        $pdf->Cell($larguraColQtde, 10, 'Qtde', 1, 0, 'C');
        $pdf->Cell($larguraColValor, 10, 'Valor', 1, 1, 'C'); // O último parâmetro define quebra de linha

        // Dados da tabela
        $pdf->SetFont('Arial', '', 10);
        foreach ($orcamento->servicos as $servico) {
            $pdf->Cell($larguraColProcedimento, 8, utf8_decode($servico->descricao), 1, 0, 'L');
            $pdf->Cell($larguraColDentes, 8, utf8_decode($servico->dentes), 1, 0, 'C');
            $pdf->Cell($larguraColFaces, 8, utf8_decode($servico->faces), 1, 0, 'C');
            $pdf->Cell($larguraColQtde, 8, utf8_decode($servico->quantidade), 1, 0, 'C');
            $pdf->Cell($larguraColValor, 8, 'R$ ' . number_format($servico->valor, 2, ',', '.'), 1, 1, 'R'); // O último parâmetro define quebra de linha
        }
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(140, 8, 'TOTAL', 1, 0, 'R');
        $pdf->Cell(50, 8, 'R$ ' . number_format($orcamento->valor_total, 2, ',', '.'), 1, 1, 'R');         
        $pdf->Ln(0);        
        $pdf->Cell(90, 8, '% Descontos', 1, 0, 'R');
        $pdf->Cell(50, 8,  number_format($orcamento->desconto_percentual, 2, ',', '.'), 1, 0, 'R');         
        $pdf->Cell(50, 8, 'R$ ' . number_format($orcamento->valor, 2, ',', '.'), 1, 1, 'R');         
        
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 10, 'Pagamentos', 0, 1);
        
        // Definindo a largura de cada coluna (Data e Valor) e o espaçamento entre as "tabelas"
        $larguraColData = 40;
        $larguraColValor = 45;
        $espacamentoEntreTabelas = 20; // Espaçamento entre as duas "tabelas"
        
        // Cabeçalho da tabela de parcelas
        $pdf->Cell($larguraColData, 8, 'Data', 1, 0, 'C');
        $pdf->Cell($larguraColValor, 8, 'Valor', 1, 0, 'C');
        $pdf->Cell($espacamentoEntreTabelas, 8, '', 0, 0); // Espaçamento entre as duas colunas
        $pdf->Cell($larguraColData, 8, 'Data', 1, 0, 'C');
        $pdf->Cell($larguraColValor, 8, 'Valor', 1, 1, 'C'); // Quebra de linha após os cabeçalhos

        $pdf->SetFont('Arial', '' , 10);
        
        // Loop para exibir as parcelas em pares (2 por linha)
        for ($i = 1; $i <= $orcamento->parcelas; $i += 2) {
            // Primeira parcela da linha
            $dataParcela1 = 'data_parcela' . $i;
            $valorParcela1 = 'valor_parcela' . $i;
        
            // Segunda parcela da linha (se existir)
            $dataParcela2 = 'data_parcela' . ($i + 1);
            $valorParcela2 = 'valor_parcela' . ($i + 1);
        
            // Exibir a primeira parcela
            if (!empty($orcamento->$dataParcela1) && !empty($orcamento->$valorParcela1)) {
                $pdf->Cell($larguraColData, 7, \Carbon\Carbon::parse($orcamento->$dataParcela1)->format('d/m/Y'), 0, 0, 'C');
                $pdf->Cell($larguraColValor, 7, 'R$ ' . number_format($orcamento->$valorParcela1, 2, ',', '.'), 0, 0, 'R');
            } else {
                $pdf->Cell($larguraColData, 7, '', 0, 0, 'C');
                $pdf->Cell($larguraColValor, 7, '', 0, 0, 'R');
            }
        
            // Espaçamento entre as duas tabelas
            $pdf->Cell($espacamentoEntreTabelas, 7, '', 0, 0); // Espaço vazio entre as colunas
        
            // Exibir a segunda parcela (se existir)
            if (!empty($orcamento->$dataParcela2) && !empty($orcamento->$valorParcela2)) {
                $pdf->Cell($larguraColData, 7, \Carbon\Carbon::parse($orcamento->$dataParcela2)->format('d/m/Y'), 10, 0, 'C');
                $pdf->Cell($larguraColValor, 7, 'R$ ' . number_format($orcamento->$valorParcela2, 2, ',', '.'), 0, 1, 'R'); // Quebra de linha após a última célula
            } else {
                $pdf->Cell($larguraColData, 7, '', 0, 0, 'C');
                $pdf->Cell($larguraColValor, 7, '', 0, 1, 'R'); // Quebra de linha após a última célula
            }
        }
        $pdf->Ln(8);   
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 10, utf8_decode('Observações'), 0, 1);

        // Defina as coordenadas e dimensões do retângulo
        $x = $pdf->GetX(); // Posição X atual
        $y = $pdf->GetY(); // Posição Y atual
        $largura = 190; // Largura do retângulo (toda a largura da página)
        $altura = 32; // Altura fixa do quadrado/retângulo

        // Desenha o retângulo com borda, ocupando toda a largura da página e altura definida
        $pdf->Rect($x, $y, $largura, $altura);

        // Agora, insira o texto dentro desse retângulo usando MultiCell, garantindo que ele fique dentro da área do retângulo
        $texto = utf8_decode($orcamento->observacao);
        $alturaPorLinha = 8; // Altura de cada linha de texto

        $pdf->SetFont('Arial', '' , 10);

        // Insere o texto dentro do espaço reservado
        $pdf->MultiCell($largura, $alturaPorLinha, $texto, 0, 'L');

        // Move o cursor para fora da área do retângulo após o texto
        $pdf->SetXY($x, $y + $altura); // Move para a posição logo após o retângulo

        $pdf->Ln(8);         
        // Definir a localização para Português do Brasil
        setlocale(LC_TIME, 'pt_BR.UTF-8', 'portuguese');

        // Usar a data atual ou uma variável de data
        $date = '2024-10-19'; // Exemplo de data
        $dataExtenso = strftime('%d de %B de %Y', strtotime($date));

        // Exibir a data no PDF com o texto centralizado e bordas
        $pdf->Cell(190, 8, 'Uberaba, ' . utf8_decode(ucwords($dataExtenso)), 0, 1, 'C');
        $pdf->Ln(8);  
        $pdf->Cell(190, 8, '____________________________________', 0, 1, 'C');

        $companyAddress = config('company.address');
        $companyCity = config('company.city');
        $companyState = config('company.state');
        $companyZip = config('company.zip');

        $pdf->SetXY(10, 268);
        $pdf->Line(10, 266, 200, 266);
        $pdf->Cell(190, 8, "$companyAddress, $companyCity, $companyState, $companyZip", 0, 0, 'C');
        
          

        // Fecha e envia o PDF
        return response($pdf->Output(), 200)->header('Content-Type', 'application/pdf');
    }
}
