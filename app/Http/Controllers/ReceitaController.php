<?php

namespace App\Http\Controllers;

use App\Models\Receita;
use App\Models\ReceitaMedicamento;
use App\Models\Profissional;
use App\Models\Medicamento;
use Illuminate\Http\Request;
use App\Services\FPDFService;


class ReceitaController extends Controller
{
    public function index(Request $request)
    {
        
        $query = Receita::with('profissional');
    
        if ($request->filled('patient_name')) {
            $query->where('nome_paciente', 'like', '%' . $request->patient_name . '%');
        }
    
        if ($request->filled('date')) {
            $query->whereDate('data', $request->date);
        }

        if ($request->filled('receita_tipo')) {
            $query->where('tipo_receita', $request->receita_tipo);
        }

    
        $receitas = $query->paginate(10); // Change this line to paginate results
    
        return view('receitas.index', compact('receitas'));
    }

    public function create()
    {
        $profissionais = Profissional::all();
        $medicamentos  = Medicamento::all(); // Adicionado para fornecer dados de medicamentos
        return view('receitas.create', compact('profissionais', 'medicamentos')); // Adicionado 'medicamentos'
    }

    public function store(Request $request)
    {
        $request->validate([
            'data' => 'required|date',
            'nome_paciente' => 'required|string|max:255',
            'codigo_profissional' => 'required|integer|exists:profissionais,codigo',
            'medicamentos.*.quantidade' => 'required|string|max:255',
            'medicamentos.*.modo_usar' => 'required|string',
        ]);

        $receita = Receita::create($request->only('data', 'nome_paciente', 'codigo_profissional', 'tipo_receita'));

        foreach ($request->medicamentos as $medicamento) {
            $receita->medicamentos()->create($medicamento);
        }

        return redirect()->route('receitas.index')->with('success', 'Receita created successfully.');
    }
    // ReceitaController.php
    public function show($id)
    {
        $receita = Receita::with('profissional')->findOrFail($id);
        return view('receitas.show', compact('receita'));
    }

    public function viewPDF($id, Request $request)
    {
        $receita = Receita::with('medicamentos', 'profissional')->findOrFail($id);
          // Verifica se o checkbox "Não Imprimir Data" foi marcado
        $naoImprimirData = $request->has('nao_imprimir_data');

        // Obter as configurações da empresa
        $companyAddress = config('company.address');
        $companyCity    = config('company.city');
        $companyState   = config('company.state');
        $companyZip     = config('company.zip');

        $pdf = new FPDFService();
        $pdf->AddPage('L');
        $pdf->SetFont('Arial', 'B', 16);

        // Adicione a imagem de fundo
        $pdf->Image(public_path('images/receita-especial.png'), 0, 0, 300, 217);

        // Adicione o conteúdo

        
        $pdf->SetFont('Arial', '', 12);
       
        $pdf->Image(public_path('images/logomarca.jpg'), 19, 38, 30); 
        $pdf->Image(public_path('images/logomarca.jpg'), 159, 38, 30); 
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetXY(35, 63);
        $pdf->Cell(0, 10, $receita->nome_paciente);
        $pdf->SetXY(175, 63);
        $pdf->Cell(0, 10, $receita->nome_paciente);
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->SetXY(48, 38);
        $pdf->Cell(51, 10, $receita->profissional->nome,0,1,'C');
        $pdf->SetXY(188, 38);
        $pdf->Cell(50, 10, $receita->profissional->nome,0,1,'C');
        $pdf->SetXY(47, 42);
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(50, 10, $receita->profissional->conselho.':'.$receita->profissional->nro_conselho,0,1,'C');
        $pdf->SetXY(187, 42);
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(50, 10, $receita->profissional->conselho.':'.$receita->profissional->nro_conselho,0,1,'C');
        $pdf->SetFont('Arial', '', 8);
        $pdf->SetXY(18, 50);
        $pdf->Cell(78, 8, "$companyAddress", 0, 0, 'C');
        $pdf->SetXY(158, 50);
        $pdf->Cell(78, 8, "$companyAddress", 0, 0, 'C');
        $pdf->SetXY(18, 54);
        $pdf->Cell(78, 8, "$companyCity, $companyState, $companyZip", 0, 1, 'C');
        $pdf->SetXY(158, 54);
        $pdf->Cell(78, 8, "$companyCity, $companyState, $companyZip", 0, 1, 'C');        
        $pdf->SetXY(20, 83);
        foreach ($receita->medicamentos as $medicamento) {
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->SetX(16);
            $pdf->Cell(70, 9,$medicamento->medicamento);
            $pdf->SetX(156);
            $pdf->Cell(70, 9,$medicamento->medicamento);
            $pdf->SetFont('Arial', '', 10);
            $pdf->SetX(90);
            $pdf->Cell(50, 9, $medicamento->quantidade);
            $pdf->SetX(250);
            $pdf->Cell(50, 9, $medicamento->quantidade);
            $pdf->Ln(7); // Cria uma nova linha
            $pdf->SetX(16); // Define a posição X inicial
            $pdf->SetFont('Arial', '', 9);
            
            // Criar o primeiro MultiCell mantendo o cursor
            $y = $pdf->GetY(); // Armazena a posição Y atual
            $pdf->MultiCell(125, 4, $medicamento->modo_usar, 0, 'L'); // Cria o primeiro MultiCell
            
            // Retorna à posição X original para o próximo bloco, mantendo a mesma linha
            $pdf->SetXY(156, $y); // Define a posição X e Y para o próximo bloco na mesma linha
            
            // Cria o segundo MultiCell
            $pdf->MultiCell(125, 4, $medicamento->modo_usar, 0, 'L');
            //$pdf->Cell(0, 9, $medicamento->modo_usar);
            $pdf->Ln(8);
        }
        
        
        $pdf->SetXY(38, 140);
            // Exemplo de como ajustar se a data deve ser impressa ou não
        if (!$naoImprimirData) {
            $pdf->Cell(30, 10,  \Carbon\Carbon::parse($receita->data)->format('d/m/Y'));
            $pdf->SetXY(178, 140);
            $pdf->Cell(30, 10,  \Carbon\Carbon::parse($receita->data)->format('d/m/Y'));
        } else {
            $pdf->Cell(30, 10,  '      /       /');
            $pdf->SetXY(178, 140);
            $pdf->Cell(30, 10,  '      /       /');
        }

        return response($pdf->Output('S', 'receita.pdf'), 200)
            ->header('Content-Type', 'application/pdf');
    }

    public function printSimplePDF($id, Request $request)
    {
        $receita = Receita::with('medicamentos', 'profissional')->findOrFail($id);

        // Verifica se o checkbox "Não Imprimir Data" foi marcado
        $naoImprimirData = $request->has('nao_imprimir_data');

        // Obter as configurações da empresa
        $companyAddress = config('company.address');
        $companyCity    = config('company.city');
        $companyState   = config('company.state');
        $companyZip     = config('company.zip');

        $pdf = new FPDFService();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);

        // Cabeçalho
        $pdf->Image(public_path('images/logomarca.jpg'), 8, 8, 55);
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->SetXY(50, 15);
        $pdf->Cell(0, 10, "Receita Medica", 0, 1, 'C');
        
        $pdf->SetLineWidth(0.5); // Espessura da linha
        $pdf->Line(10, 27, 200, 27); // (X1, Y1, X2, Y2)

        $pdf->SetFont('Arial', 'BI', 12);
        $pdf->SetXY(10, 30);
        $pdf->Cell(0, 10, "Para: " . $receita->nome_paciente, 0, 1);

        // Corpo - Medicamentos
        $pdf->SetFont('Arial', '', 10);
        $pdf->SetXY(10, 40);
        foreach ($receita->medicamentos as $medicamento) {
            $pdf->SetFont('Arial', 'B', 11);
            $pdf->Cell(120, 8, $medicamento->medicamento, 0, 0);
            $pdf->Cell(70, 8, $medicamento->quantidade, 0, 1);
            $pdf->SetFont('Arial', '', 9);
            $pdf->MultiCell(0, 5, $medicamento->modo_usar, 0, 'L');
            $pdf->Ln(5); // Espaçamento entre os medicamentos
        }

        // Data de emissão
        if (!$naoImprimirData) {
            $pdf->SetXY(10, 200);
            $pdf->Cell(0, 10, "Data: " . \Carbon\Carbon::parse($receita->data)->format('d/m/Y'), 0, 1);
        } else {
            $pdf->SetXY(10, 200);
            $pdf->Cell(0, 10, "Data:       /       /", 0, 1);
        }

        // Assinatura do Profissional
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetXY(10, 230);
        $pdf->Cell(0, 10, "___________________________", 0, 1, 'C');
        $pdf->SetXY(10, 240);
        $pdf->Cell(0, 10, $receita->profissional->nome, 0, 1, 'C');
        $pdf->SetXY(10, 250);
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(0, 10, $receita->profissional->conselho . ": " . $receita->profissional->nro_conselho, 0, 1, 'C');

        
        $pdf->SetLineWidth(0.5); // Espessura da linha
        $pdf->Line(10, 263, 200, 263); // (X1, Y1, X2, Y2)
        // Rodapé
        $pdf->SetXY(10, -35);
        $pdf->SetFont('Arial', 'I', 8);
        $pdf->Cell(0, 10, "$companyAddress, $companyCity, $companyState, $companyZip", 0, 1, 'C');

        return response($pdf->Output('S', 'receita_simples.pdf'), 200)
            ->header('Content-Type', 'application/pdf');
    }



    // Métodos restantes não foram alterados
}
