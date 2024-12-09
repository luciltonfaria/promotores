<?php

namespace App\Http\Controllers;

use App\Models\Recibo;
use Illuminate\Http\Request;
use App\Services\FPDFService;

class ReciboController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recibos = Recibo::all();
        return view('recibos.index', compact('recibos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('recibos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nome' => 'required|string|max:255',
            'valor' => 'required|numeric',
            'referencia' => 'required|string|max:255',
            'emitido' => 'required|in:S,N',
            'dt_emissao' => 'nullable|date',
        ]);

        Recibo::create($validatedData);

        return redirect()->route('recibos.index')->with('success', 'Recibo criado com sucesso.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Recibo  $recibo
     * @return \Illuminate\Http\Response
     */
    public function show(Recibo $recibo)
    {
        return view('recibos.show', compact('recibo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Recibo  $recibo
     * @return \Illuminate\Http\Response
     */
    public function edit(Recibo $recibo)
    {
        return view('recibos.edit', compact('recibo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Recibo  $recibo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Recibo $recibo)
    {
        $validatedData = $request->validate([
            'nome' => 'required|string|max:255',
            'valor' => 'required|numeric',
            'referencia' => 'required|string|max:255',
            'emitido' => 'required|in:S,N',
            'dt_emissao' => 'nullable|date',
        ]);

        $recibo->update($validatedData);

        return redirect()->route('recibos.index')->with('success', 'Recibo atualizado com sucesso.');
    }

 
    public function generatePdf($reciboId)
{
    // Obter as configurações da empresa
    $companyAddress = config('company.address');
    $companyCity = config('company.city');
    $companyState = config('company.state');
    $companyZip = config('company.zip');

    // Retrieve the recibo data (assuming $reciboId is an instance of a Recibo model)
    $recibo = Recibo::find($reciboId);

    // Função para converter valor para texto
    function extenso($valor = 0, $complemento = true) {
        $singular = array("centavo", "real", "mil", "milhão", "bilhão", "trilhão", "quatrilhão");
        $plural = array("centavos", "reais", "mil", "milhões", "bilhões", "trilhões", "quatrilhões");

        $c = array("", "cem", "duzentos", "trezentos", "quatrocentos", "quinhentos", "seiscentos", "setecentos", "oitocentos", "novecentos");
        $d = array("", "dez", "vinte", "trinta", "quarenta", "cinquenta", "sessenta", "setenta", "oitenta", "noventa");
        $d10 = array("dez", "onze", "doze", "treze", "quatorze", "quinze", "dezesseis", "dezessete", "dezoito", "dezenove");
        $u = array("", "um", "dois", "três", "quatro", "cinco", "seis", "sete", "oito", "nove");

        $z = 0;
        $valor = number_format($valor, 2, ".", ".");
        $inteiro = explode(".", $valor);

        for ($i = 0; $i < count($inteiro); $i++) {
            for ($ii = strlen($inteiro[$i]); $ii < 3; $ii++) {
                $inteiro[$i] = "0" . $inteiro[$i];
            }
        }

        $rt = null;
        $fim = count($inteiro) - ($inteiro[count($inteiro) - 1] > 0 ? 1 : 2);
        for ($i = 0; $i < count($inteiro); $i++) {
            $valor = $inteiro[$i];
            $rc = (($valor > 100) && ($valor < 200)) ? "cento" : $c[$valor[0]];
            $rd = ($valor[1] < 2) ? "" : $d[$valor[1]];
            $ru = ($valor > 0) ? (($valor[1] == 1) ? $d10[$valor[2]] : $u[$valor[2]]) : "";

            $r = $rc . (($rc && ($rd || $ru)) ? " e " : "") . $rd . (($rd && $ru) ? " e " : "") . $ru;
            $t = count($inteiro) - 1 - $i;
            $r .= $r ? " " . ($valor > 1 ? $plural[$t] : $singular[$t]) : "";
            if ($valor == "000") {
                $z++;
            } elseif ($z > 0) {
                $z--;
            }

            if (($t == 1) && ($z > 0) && ($inteiro[0] > 0)) {
                $r .= (($z > 1) ? " de " : "") . $plural[$t];
            }

            if ($r) {
                $rt = $rt . ((($i > 0) && ($i <= $fim) && ($inteiro[0] > 0) && ($z < 1)) ? (($i < $fim) ? ", " : " e ") : " ") . $r;
            }
        }

        if (!$complemento) {
            return ($rt ? $rt : "zero");
        }

        $valor = explode(".", number_format($valor, 2, ".", "."));
        $r = $rt . (($rt && isset($valor[1]) && $valor[1]) ? " e " : "") . (isset($valor[1]) && $valor[1] ? extenso($valor[1], false) : "");
        return ($r ? $r : "zero");
    }

    // Create a new FPDF instance
    $pdf = new FPDFService();
    $pdf->AddPage();

    // Add an image (logo)
    $pdf->Image(public_path('images/logomarca.jpg'), 10, 10, 80); 

    $pdf->Line(10, 40, 200, 40);

    // Add the recibo details
    $pdf->SetFont('Arial', '', 12);
    $pdf->Ln(40); // Line break

    // Set the font and add a title
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(190, 10, 'Recibo', 0, 1, 'C');
    $pdf->Ln(10); // Line break

    // Add the custom text
    $valorPorExtenso = extenso($recibo->valor);
    $pdf->SetFont('Arial', '', 12);
    $texto = "Recebi de ".$recibo->nome." a quantia de R$" . number_format($recibo->valor, 2, ',', '.') . ", $valorPorExtenso, referente a(o) " . $recibo->referencia . ".";
    $pdf->MultiCell(0, 10, utf8_decode($texto), 0, 'L');
    $pdf->Ln(10); // Line break

    $pdf->Cell(180, 10, utf8_decode('Data de Emissão: ') . ($recibo->dt_emissao ? \Carbon\Carbon::parse($recibo->dt_emissao)->format('d/m/Y') : ''), 0, 1, "C");
    $pdf->Ln(15); // Line break
    $pdf->Cell(180, 10, '_____________________________________', 0, 1, "C");
    // Footer
    $pdf->SetXY(10, 266);
    $pdf->Line(10, 265, 200, 265);
    $pdf->Cell(190, 8, "$companyAddress, $companyCity, $companyState, $companyZip", 0, 0, 'C');

    // Get the PDF content
    $pdfContent = $pdf->Output('S');

    // Return response with headers to open PDF in new tab
    return response($pdfContent, 200)
        ->header('Content-Type', 'application/pdf')
        ->header('Content-Disposition', 'inline; filename=\"recibo.pdf\"');
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Recibo  $recibo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Recibo $recibo)
    {
        $recibo->delete();

        return redirect()->route('recibos.index')->with('success', 'Recibo excluído com sucesso.');
    }
}

