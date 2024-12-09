<?php

namespace App\Http\Controllers;

use App\Models\Anamnese;
use App\Models\Paciente;
use Illuminate\Http\Request;
use App\Services\FPDFService;

class AnamneseController extends Controller
{
    // Listar todos os registros de anamnese
    public function index()
    {
        $anamnese = Anamnese::all();
        return response()->json($anamnese);
    }

    // Exibir um registro específico de anamnese
    public function show($id)
    {
        $anamnese = Anamnese::findOrFail($id);
        return response()->json($anamnese);
    }

    // Criar um novo registro de anamnese
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'paciente_id' => 'required|numeric',
            'probl_saude' => 'nullable|numeric',
            'probl_saude_quais' => 'nullable|string|max:50',
            'toma_medicamentos' => 'nullable|numeric',
            'toma_medic_quais' => 'nullable|string|max:50',
            'gravida' => 'nullable|numeric',
            'anestesia' => 'nullable|numeric',
            'sentiu_mal' => 'nullable|numeric',
            'alergico_medicamentos' => 'nullable|numeric',
            'alergico_medicamentos_quais' => 'nullable|string|max:50',
            'perdido_peso' => 'nullable|numeric',
            'diabetis' => 'nullable|numeric',
            'problemas_coracao' => 'nullable|numeric',
            'problema_coracao__quais' => 'nullable|string|max:50',
            'reumatica' => 'nullable|numeric',
            'sangra_muito' => 'nullable|numeric',
            'hepatite' => 'nullable|numeric',
            'cirugia' => 'nullable|numeric',
            'cirugia_quais' => 'nullable|string|max:50',
            'gengiva_sangram' => 'nullable|numeric',
            'mobilidade_dentes' => 'nullable|numeric',
            'mobildade_quais' => 'nullable|string|max:50',
            'escova_dentes' => 'nullable|string|max:15',
            'fio_dental' => 'nullable|numeric',
            'sentiu_anestesia' => 'nullable|string|max:1',
            'febre' => 'nullable|string|max:1',
            'tonturas' => 'nullable|string|max:1',
            'aspirina' => 'nullable|string|max:1',
            'fuma' => 'nullable|string|max:1',
            'bebe' => 'nullable|string|max:1',
            'penicilina' => 'nullable|string|max:1',
            'anemia' => 'nullable|string|max:1',
            'infecciosa' => 'nullable|string|max:1',
            'disturbio_neu' => 'nullable|string|max:1',
            'problema_tto' => 'nullable|string|max:1',
            'probl_tto_quais' => 'nullable|string|max:30',
            'hemorragia' => 'nullable|string|max:1',
            'complemento' => 'nullable|string|max:60',
            'codigo' => 'nullable|integer', // Este campo é nullable, de acordo com o DDL
            'outros' => 'nullable|string', // Remover o max para o campo de tipo TEXT
            'qtd_dia_validade' => 'nullable|integer',
            'data_validade' => 'nullable|date',
        ]);
        
        $anamnese = Anamnese::create($validatedData);

        return response()->json($anamnese, 201);
    }

    // Atualizar um registro de anamnese
    public function update(Request $request, $id)
    {
        $anamnese = Anamnese::findOrFail($id);

        $validatedData = $request->validate([
            'paciente_id' => 'required|numeric',
            'probl_saude' => 'nullable|numeric',
            'probl_saude_quais' => 'nullable|string|max:50',
            'toma_medicamentos' => 'nullable|numeric',
            'toma_medic_quais' => 'nullable|string|max:50',
            'gravida' => 'nullable|numeric',
            'anestesia' => 'nullable|numeric',
            'sentiu_mal' => 'nullable|numeric',
            'alergico_medicamentos' => 'nullable|numeric',
            'alergico_medicamentos_quais' => 'nullable|string|max:50',
            'perdido_peso' => 'nullable|numeric',
            'diabetis' => 'nullable|numeric',
            'problemas_coracao' => 'nullable|numeric',
            'problema_coracao__quais' => 'nullable|string|max:50',
            'reumatica' => 'nullable|numeric',
            'sangra_muito' => 'nullable|numeric',
            'hepatite' => 'nullable|numeric',
            'cirugia' => 'nullable|numeric',
            'cirugia_quais' => 'nullable|string|max:50',
            'gengiva_sangram' => 'nullable|numeric',
            'mobilidade_dentes' => 'nullable|numeric',
            'mobildade_quais' => 'nullable|string|max:50',
            'escova_dentes' => 'nullable|string|max:15',
            'fio_dental' => 'nullable|numeric',
            'sentiu_anestesia' => 'nullable|string|max:1',
            'febre' => 'nullable|string|max:1',
            'tonturas' => 'nullable|string|max:1',
            'aspirina' => 'nullable|string|max:1',
            'fuma' => 'nullable|string|max:1',
            'bebe' => 'nullable|string|max:1',
            'penicilina' => 'nullable|string|max:1',
            'anemia' => 'nullable|string|max:1',
            'infecciosa' => 'nullable|string|max:1',
            'disturbio_neu' => 'nullable|string|max:1',
            'problema_tto' => 'nullable|string|max:1',
            'probl_tto_quais' => 'nullable|string|max:30',
            'hemorragia' => 'nullable|string|max:1',
            'complemento' => 'nullable|string|max:60',
            'codigo' => 'nullable|integer', // Este campo é nullable, de acordo com o DDL
            'outros' => 'nullable|string', // Remover o max para o campo de tipo TEXT
            'qtd_dia_validade' => 'nullable|integer',
            'data_validade' => 'nullable|date',
        ]);
        
        $anamnese->update($validatedData);

        return response()->json($anamnese);
    }

    // Deletar um registro de anamnese
    public function destroy($id)
    {
        $anamnese = Anamnese::findOrFail($id);
        $anamnese->delete();

        return response()->json(null, 204);
    }

    public function print($codigo)
    {
        // Recupera o paciente com o relacionamento da anamnese
        $paciente = Paciente::with(['convenio', 'anamnese'])->findOrFail($codigo);

        // Mapeamento de estado civil
        $estadoCivilDescricao = [
            'S' => 'Solteiro',
            'C' => 'Casado',
            'D' => 'Divorciado',
            'O' => 'Outros'
        ];

        // Obtenha a descrição do estado civil
        $estadoCivil = isset($estadoCivilDescricao[$paciente->estado_civil])
            ? $estadoCivilDescricao[$paciente->estado_civil]
            : 'N/A';

        // Cria uma nova instância do FPDF
        $pdf = new FPDFService();
        $pdf->AddPage();

        // Definir o caminho da logomarca da empresa e da foto do paciente
        $logo = env('COMPANY_LOGO');
        $fotoPaciente = storage_path('app/public/' . $paciente->foto);

        // Adiciona a logomarca no canto superior esquerdo
        if (file_exists($logo)) {
            $pdf->Image($logo, 20, 10, 70); // X, Y, largura (altura será proporcional)
        }
        
        $pdf->SetXY(8, 8); // Add some padding inside the box (adjust as necessary)
        // Define a fonte
        $pdf->SetFont('Arial', 'B', 9);             
        $pdf->Cell(190, 10, 'Dr. Cristiano Souto Ferreira', 0, 1, 'R');
        $pdf->SetXY(8, 12); // Add some padding inside the box (adjust as necessary)
        $pdf->Cell(190, 10, 'CRO-MG 18.873', 0, 1, 'R');
        
        $pdf->SetXY(8, 20); // Add some padding inside the box (adjust as necessary)
        // Define a fonte
        $pdf->SetFont('Arial', 'B', 9);             
        $pdf->Cell(190, 10, 'Dr. Denismar Soares Ribeiro', 0, 1, 'R');
        $pdf->SetXY(8, 24); // Add some padding inside the box (adjust as necessary)
        $pdf->Cell(190, 10, 'CRO-MG 25.297', 0, 1, 'R');
        
        $pdf->SetLineWidth(1);
        $pdf->Line(10, 40, 200, 40);
        $pdf->Line(10, 70, 200, 70);


       // Define a fonte para o conteúdo
        $pdf->SetFont('Arial', '', 12);

        // Define a posição inicial X para os dados (ajuste conforme necessário)
        $xPosition = 90; // Isso move o conteúdo mais à direita

        // Adiciona os dados do paciente começando a partir da posição X definida
        $pdf->Ln(5); // Quebra de linha
        $pdf->Cell(100, 10, 'Nome: ' . $paciente->nome);
        $pdf->Cell(100, 10, 'CPF: ' . $paciente->cpf);
        $pdf->Ln(7);
        $pdf->Cell(100, 10, 'Data de Nascimento: ' . $paciente->dt_nasc);
        $pdf->Cell(100, 10, 'Sexo: ' . ($paciente->sexo == 'M' ? 'Masculino' : 'Feminino'));
        $pdf->Ln(7);
        $pdf->Cell(100, 10, 'Email: ' . $paciente->email);
        $pdf->Cell(100, 10, 'Telefone: ' . $paciente->celular);
        $pdf->Ln(7);
        $pdf->Cell(100, 10, 'Estado Civil: ' . $estadoCivil);
        $pdf->Ln(3);

        // Adiciona os campos de Anamnese
        if ($paciente->anamnese) {
            $pdf->Ln(10); // Quebra de linha para a seção de anamnese
            $pdf->SetFont('Arial', 'B', 14);
            $pdf->Cell(190, 10, 'Anamnese', 0, 1, 'C');
            $pdf->SetFont('Arial', '', 12);

            // Exibe campos de anamnese
            $anamnese = $paciente->anamnese;

            $pdf->Ln(8);
            $pdf->Cell(100, 10, 'Gengiva sangra: ' . ($anamnese->gengiva_sangram ? 'Sim' : 'Não'));
            $pdf->Ln(8);
            $pdf->Cell(80, 10, 'Usa Fio dental: ' . ($anamnese->fio_dental ? 'Sim' : 'Não'));
            $pdf->Cell(100, 10, utf8_decode('Quantas vezes escova os dentes por dia: ' . ($anamnese->escova_dentes ?: 'N/A')));
            $pdf->Ln(8);
            $pdf->Cell(100, 10, 'Diabetes: ' . ($anamnese->diabetis ? 'Sim' : 'Não'));
            $pdf->Ln(8);
            $pdf->Cell(100, 10, 'Gravidez: ' . ($anamnese->gravida ? 'Sim' : 'Não'));
            $pdf->Ln(8);
            $pdf->Cell(100, 10, 'Anestesia: ' . ($anamnese->anestesia ? 'Sim' : 'Não'));
            $pdf->Ln(8);
            $pdf->Cell(80, 10, utf8_decode('Problema de Saúde: ') . ($anamnese->probl_saude ? 'Sim' : 'Não'));
            $pdf->Cell(100, 10, utf8_decode('Quais: ' . ($anamnese->probl_saude_quais ?: 'N/A')));
            $pdf->Ln(8);
            $pdf->Cell(80, 10, 'Toma Medicamentos: ' . ($anamnese->toma_medicamentos ? 'Sim' : 'Não'));
            $pdf->Cell(100, 10, 'Quais Medicamentos: ' . utf8_decode( ($anamnese->toma_medic_quais ?: 'N/A')));
            $pdf->Ln(8);
            $pdf->Cell(80, 10, 'Alergia a Medicamentos: ' . ($anamnese->alergico_medicamentos ? 'Sim' : 'Não'));
            $pdf->Cell(100, 10, 'Quais Medicamentos: ' . utf8_decode( ($anamnese->alergico_medicamentos_quais ?: 'N/A')));
            $pdf->Ln(8);
            $pdf->Cell(80, 10, 'Cirurgia: ' . ($anamnese->cirugia ? 'Sim' : 'Não'));
            $pdf->Cell(100, 10, 'Quais Cirurgias: ' . utf8_decode(($anamnese->cirugia_quais ?: 'N/A')));
            $pdf->Ln(8);
            $pdf->Cell(80, 10, utf8_decode('Problema no Coração: ') . ($anamnese->problemas_coracao ? 'Sim' : 'Não'));
            $pdf->Cell(100, 10, utf8_decode('Quais: ' . ($anamnese->problema_coracao__quais ?: 'N/A')) );
            $pdf->Ln(8);
            $pdf->Cell(100, 10, 'Perdeu Peso: ' . ($anamnese->perdido_peso ? 'Sim' : 'Não'));
            $pdf->Ln(8);
            $pdf->Cell(100, 10, utf8_decode('Há alguma informação importante sobre seu estado de saúde que não fora perguntado nessa'));
            $pdf->Ln(8);
            $pdf->Cell(100, 10, utf8_decode('anamnese?'));
            $pdf->Ln(8);
            // Define the position and size for the text box
            $x = $pdf->GetX(); // Current X position
            $y = $pdf->GetY(); // Current Y position

            // Define the width and height for the text box
            $width = 180;
            $height = 24; // This height will allow for approximately 3 lines of text (adjust as needed)
            $pdf->SetLineWidth(0.2);
            // Draw the border for the text box
            $pdf->Rect($x, $y, $width, $height);

            // Move the cursor inside the box and print the content with MultiCell
            $pdf->SetXY($x + 2, $y + 2); // Add some padding inside the box (adjust as necessary)
            $pdf->MultiCell($width - 4, 8, utf8_decode($anamnese->outros ?: 'N/A'), 0, 'L');

            // After printing the text, move the cursor below the box
            $pdf->Ln($height + 3);
        }
         

        // Rodapé
        $companyAddress = env('COMPANY_ADDRESS');
        $companyCity = env('COMPANY_CITY');
        $companyPhone = env('COMPANY_PHONE');


        $pdf->Cell(0, 10, utf8_decode($companyCity.', '.date('d/m/Y')), 0, 1, 'C');

        $pdf->Line(65, 250, 145, 250);
        $pdf->Ln(8);
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(0, 6, utf8_decode($paciente->nome), 0, 1, 'C');
        $pdf->Cell(0, 6, utf8_decode($paciente->cpf), 0, 1, 'C');

        // Definir a posição do rodapé
        $pdf->SetY(-30); // Move para 30 unidades acima do fim da página

        // Desenha o traço de divisão
        $pdf->SetLineWidth(0.5); // Define a espessura da linha
        $pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY()); // Desenha a linha horizontal

        // Define a fonte menor para o rodapé
        $pdf->SetFont('Arial', '', 9);

        // Primeira linha do rodapé (Endereço da empresa)
        $pdf->Cell(0, 5, utf8_decode($companyAddress), 0, 1, 'C');

        // Segunda linha do rodapé (Cidade e Telefone)
        $pdf->Cell(0, 5, utf8_decode($companyCity . ' - Telefone: ' . $companyPhone), 0, 1, 'C');

        // Saída do PDF
        $pdf->Output();

        exit;
    }

}
