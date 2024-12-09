<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use App\Models\Estado;
use App\Models\Convenio;
use App\Models\anamnese;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Services\FPDFService;

class PacienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pacientes = Paciente::all();
        return view('pacientes.index', compact('pacientes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
     public function create()
    {
        $estados = Estado::all();
        $convenios = Convenio::all();
        return view('pacientes.create', compact('estados', 'convenios'));
    }

    public function anamnese()
    {
        return $this->hasOne(Anamnese::class, 'paciente_id', 'codigo');
    }


    public function edit(Paciente $paciente)
    {
         $estados = Estado::all();
         $convenios = Convenio::all();

         // Recupera a anamnese relacionada ao paciente
         $anamnese = $paciente->anamnese;

         return view('pacientes.edit', compact('paciente', 'estados', 'convenios', 'anamnese'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {

            // if ($request->has('dt_nasc')) {
            //     $dt_nasc = \DateTime::createFromFormat('d/m/Y', $request->input('dt_nasc'));
            //     if ($dt_nasc) {
            //         $request->merge(['dt_nasc' => $dt_nasc->format('Y-m-d')]);
            //     } else {
            //         Log::error('Formato de data inválido', ['dt_nasc' => $request->input('dt_nasc')]);
            //         return back()->withErrors('Formato de data inválido.')->withInput();
            //     }
            // }

            Log::info('Entrando no método store', ['request' => $request->all()]);
            $validatedData = $request->validate([
                'nome' => 'required|string|max:35',
                'estado_resid' => 'nullable|string|max:2',
                'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'dt_nasc' => 'nullable|date_format:Y-m-d', // Validação da data no formato Y-m-d
                'sexo' => 'nullable|string|max:1',
                'cpf' => 'nullable|string|max:14',
                'email' => 'nullable|string|email|max:255',
                // Adicione outras validações conforme necessário
            ]);

            Log::info('Validação concluída', ['validatedData' => $validatedData]);

            $data = $request->all();

            if ($request->hasFile('foto')) {
                $imagePath = $request->file('foto')->store('images', 'public');
                $data['foto'] = $imagePath;
                Log::info('Foto armazenada', ['fotoPath' => $validatedData['foto']]);
            }

            $paciente = Paciente::create($data);
            Log::info('Objeto Paciente criado', ['paciente' => $paciente]);

            // return redirect()->route('pacientes.index')
            //                 ->with('success', 'Paciente criado com sucesso.');
        } catch (\Exception $e) {
            Log::error('Erro no método store', ['exception' => $e]);
            return back()->withErrors('Ocorreu um erro ao adicionar o paciente. Por favor, tente novamente.')->withInput();
        }                   
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Paciente  $paciente
     * @return \Illuminate\Http\Response
     */
    public function show(Paciente $paciente)
    {
        return view('pacientes.show', compact('paciente'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Paciente  $paciente
     * @return \Illuminate\Http\Response
     */

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Paciente  $paciente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Paciente $paciente)
    {
        try {
            Log::info('Entrando no método Update', ['request' => $request->all()]);
                        
            $validatedData = $request->validate([
                'nome' => 'required|string|max:35',
                'cpf' => 'nullable|string|max:14',
                'estado_resid' => 'nullable|string|max:2',
                'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                // Adicione outras validações conforme necessário
            ]);
            // Converte valores dos checkboxes para 1 ou 0
            $validatedData['gengiva_sangram'] = $request->has('gengiva_sangram') ? 1 : 0;
            $validatedData['fio_dental'] = $request->has('fio_dental') ? 1 : 0;
            $validatedData['diabetis'] = $request->has('diabetis') ? 1 : 0;
            $validatedData['gravida'] = $request->has('gravida') ? 1 : 0;
            $validatedData['anestesia'] = $request->has('anestesia') ? 1 : 0;
            $validatedData['sentiu_mal'] = $request->has('sentiu_mal') ? 1 : 0;
            $validatedData['probl_saude'] = $request->has('probl_saude') ? 1 : 0;
            $validatedData['toma_medicamentos'] = $request->has('toma_medicamentos') ? 1 : 0;
            $validatedData['alergico_medicamentos'] = $request->has('alergico_medicamentos') ? 1 : 0;
            $validatedData['cirugia'] = $request->has('cirugia') ? 1 : 0;
            $validatedData['problemas_coracao'] = $request->has('problemas_coracao') ? 1 : 0;
            $validatedData['perdido_peso'] = $request->has('perdido_peso') ? 1 : 0;
            $validatedData['tonturas'] = $request->has('tonturas') ? 1 : 0;
            $validatedData['fuma'] = $request->has('fuma') ? 1 : 0;
            Log::info('Validação concluída', ['validatedData' => $validatedData]);
            $data = $request->all();

            if ($request->hasFile('foto')) {
                // Delete the old photo if it exists
                if ($paciente->foto) {
                    Storage::disk('public')->delete($paciente->foto);
                }
                $imagePath = $request->file('foto')->store('images', 'public');
                $data['foto'] = $imagePath;
                Log::info('Foto armazenada', ['fotoPath' => $validatedData['foto']]);
            }

            $paciente->update($data);

            // Gerenciamento da Anamnese
            $anamneseData = $request->only([
                'probl_saude_quais',
                'toma_medic_quais',
                'alergico_medicamentos_quais',
                'cirugia_quais',
                'problema_coracao__quais',
                'outros',
                'qtd_dia_validade',
            ]);

            // Converte os checkboxes para 1 ou 0 para anamnese
            $anamneseData['gengiva_sangram'] = $request->has('gengiva_sangram') ? 1 : 0;
            $anamneseData['fio_dental'] = $request->has('fio_dental') ? 1 : 0;
            $anamneseData['diabetis'] = $request->has('diabetis') ? 1 : 0;
            $anamneseData['gravida'] = $request->has('gravida') ? 1 : 0;
            $anamneseData['anestesia'] = $request->has('anestesia') ? 1 : 0;
            $anamneseData['sentiu_mal'] = $request->has('sentiu_mal') ? 1 : 0;
            $anamneseData['probl_saude'] = $request->has('probl_saude') ? 1 : 0;
            $anamneseData['toma_medicamentos'] = $request->has('toma_medicamentos') ? 1 : 0;
            $anamneseData['alergico_medicamentos'] = $request->has('alergico_medicamentos') ? 1 : 0;
            $anamneseData['cirugia'] = $request->has('cirugia') ? 1 : 0;
            $anamneseData['problemas_coracao'] = $request->has('problemas_coracao') ? 1 : 0;
            $anamneseData['perdido_peso'] = $request->has('perdido_peso') ? 1 : 0;
            $anamneseData['tonturas'] = $request->has('tonturas') ? 1 : 0;
            $anamneseData['fuma'] = $request->has('fuma') ? 1 : 0;

            // Converte o campo data_validade para o formato correto (Y-m-d)
            if ($request->filled('data_validade')) {
                $anamneseData['data_validade'] = \Carbon\Carbon::createFromFormat('d/m/Y', $request->input('data_validade'))->format('Y-m-d');
            }


            // Se o paciente já tiver uma anamnese, faz o update, caso contrário, cria uma nova
            if ($paciente->anamnese) {
                $paciente->anamnese->update($anamneseData);
            } else {
                $anamneseData['paciente_id'] = $paciente->codigo; // Definir o paciente_id na anamnese
                Anamnese::create($anamneseData);
            }


            return redirect()->route('pacientes.index')
                            ->with('success', 'Paciente atualizado com sucesso.');
        } catch (\Exception $e) {
            Log::error('Erro no método Update', ['exception' => $e]);
            return back()->withErrors('Ocorreu um erro ao adicionar o paciente. Por favor, tente novamente.')->withInput();
        }                    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Paciente  $paciente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Paciente $paciente)
    {
        $paciente->delete();

        return redirect()->route('pacientes.index')
                         ->with('success', 'Paciente deletado com sucesso.');
    }
    public function print($codigo)
    {
        // Recupera o paciente
        $paciente = Paciente::with('convenio')->findOrFail($codigo);
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
            $pdf->Image($logo, 20, 10, 50); // X, Y, largura (altura será proporcional)
        }
    
        // Define a fonte
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Ln(5);
        // Adiciona um título centralizado
        $pdf->Cell(190, 10, 'Ficha do Paciente', 0, 1, 'C');
        $pdf->SetLineWidth(1);
        $pdf->Line(10, 30, 200, 30);
    
        if (file_exists($fotoPaciente)) {
            // Pega o tamanho original da imagem
            list($larguraOriginal, $alturaOriginal) = getimagesize($fotoPaciente);
    
            // Definir a largura da imagem no PDF
            $x = 15; // Posição X da imagem
            $y = 40; // Posição Y da imagem
            $largura = 70; // Largura da imagem no PDF
    
            // Calcula a altura proporcional da imagem
            $altura = ($largura / $larguraOriginal) * $alturaOriginal;
    
            // Desenha a imagem
            $pdf->Image($fotoPaciente, $x, $y, $largura, $altura);
    
            // Desenha o retângulo ao redor da imagem
            $pdf->Rect($x, $y, $largura, $altura); // O retângulo agora usa a altura calculada
        }
    
        // Define a fonte para o conteúdo
        $pdf->SetFont('Arial', '', 12);
    
        // Define a posição inicial X para os dados (ajuste conforme necessário)
        $xPosition = 90; // Isso move o conteúdo mais à direita
    
        // Adiciona os dados do paciente começando a partir da posição X definida
        $pdf->Ln(10); // Quebra de linha
        $pdf->SetX($xPosition); // Define a posição X
        $pdf->Cell(100, 10, 'Nome: ' . $paciente->nome);
        $pdf->Ln(8);
        $pdf->SetX($xPosition);
        $pdf->Cell(100, 10, 'CPF: ' . $paciente->cpf);
        $pdf->Ln(8);
        $pdf->SetX($xPosition);
        $pdf->Cell(100, 10, 'Data de Nascimento: ' . $paciente->dt_nasc);
        $pdf->Ln(8);
        $pdf->SetX($xPosition);
        $pdf->Cell(100, 10, 'Sexo: ' . ($paciente->sexo == 'M' ? 'Masculino' : 'Feminino'));
        $pdf->Ln(8);
        $pdf->SetX($xPosition);
        $pdf->Cell(100, 10, 'Email: ' . $paciente->email);
        $pdf->Ln(8);
        $pdf->SetX($xPosition);
        $pdf->Cell(100, 10, 'Telefone: ' . $paciente->celular);
    
        // Adiciona os campos restantes
        $pdf->Ln(10);
        $pdf->Cell(100, 10, 'Data de Cadastro: ' . date('d/m/Y', $paciente->create_at));
        $pdf->Cell(100, 10, utf8_decode('Filiação (Mãe): ' . $paciente->filiacao_mae));
        $pdf->Ln(8);
        $pdf->Cell(100, 10, utf8_decode('Profissão: ' . $paciente->profissao));
        $pdf->Cell(100, 10, utf8_decode('Estado Civil: ' . $estadoCivil));
        $pdf->Ln(8);
        $pdf->Cell(100, 10, utf8_decode('Doc. identidade: ' . $paciente->rg));
        $pdf->Cell(100, 10, utf8_decode('Órgão Emissor RG: ' . $paciente->org_rg));
        $pdf->Ln(8);
        $pdf->Cell(100, 10, utf8_decode('Convênio: ' . (is_object($paciente->convenio) ? $paciente->convenio->descricao : 'N/A')));
        $pdf->Ln(8);
        $pdf->Cell(100, 10, utf8_decode('Indicação: ' . $paciente->indicacao));
    
        // Endereço residencial
        $pdf->Ln(10);
        $pdf->Cell(100, 10, utf8_decode('Endereço Residencial: ' . $paciente->end_resid));
        $pdf->Ln(8);
        $pdf->Cell(100, 10, utf8_decode('Bairro Residencial: ' . $paciente->bairro_resid));
        $pdf->Cell(100, 10, utf8_decode('Cidade Residencial: ' . $paciente->cidade_resid.' '.$paciente->estado_resid));
        $pdf->Ln(8);
        $pdf->Cell(100, 10, utf8_decode('CEP Residencial: ' . $paciente->cep_resid));
        $pdf->Cell(100, 10, utf8_decode('Telefone Residencial: ' . $paciente->telef_resid));
        $pdf->Cell(100, 10, utf8_decode('Telefone Recado Residencial: ' . $paciente->telef_recado_resid));
    
        // Endereço comercial
        $pdf->Ln(10);
        $pdf->Cell(100, 10, utf8_decode('Endereço Comercial: ' . $paciente->end_comerc));
        $pdf->Ln(8);
        $pdf->Cell(100, 10, utf8_decode('Bairro Comercial: ' . $paciente->bairro_comerc));
        $pdf->Cell(100, 10, utf8_decode('Cidade Comercial: ' . $paciente->cidade_comerc.' '.$paciente->estado_comerc));
        $pdf->Ln(8);
        $pdf->Cell(100, 10, utf8_decode('CEP Comercial: ' . $paciente->cep_comerc));
        $pdf->Cell(100, 10, utf8_decode('Telefone Comercial: ' . $paciente->telef_comerc));
    
        // Outros campos

        $pdf->Ln(8);
        $pdf->Cell(100, 10, utf8_decode('Observações: ' . $paciente->obsev));

          // Obtemos as informações do .env
        $companyAddress = env('COMPANY_ADDRESS');
        $companyCity = env('COMPANY_CITY');
        $companyPhone = env('COMPANY_PHONE');

        // Definir a posição do rodapé
        $pdf->SetY(-31); // Move para 30 unidades acima do fim da página

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

    public function search(Request $request)
    {
        $term = $request->get('term');

        // Buscar pacientes que correspondem ao nome digitado
        $pacientes = Paciente::where('nome', 'LIKE', '%' . $term . '%')->get();

        return response()->json($pacientes);
    }
    
}
