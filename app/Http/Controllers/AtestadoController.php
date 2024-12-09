<?php

namespace App\Http\Controllers;

use App\Models\Atestado;
use App\Models\Profissional;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class AtestadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Atestado::query();
    
        if ($request->filled('patient_name')) {
            $query->where('nome_paciente', 'like', '%' . $request->patient_name . '%');
        }
    
        if ($request->filled('date')) {
            $query->whereDate('data', $request->date);
        }
    
        if ($request->filled('atestado_type')) {
            $query->where('tipo', $request->atestado_type);
        }
    
        $atestados = $query->paginate(10);
    
        return view('atestados.index', compact('atestados'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $profissionais = Profissional::all();
        return view('atestados.create', compact('profissionais'));
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
            'data' => 'required|date',
            'tipo' => 'required|string|max:255',
            'nome_paciente' => 'required|string|max:255',
            'codigo_paciente' => 'nullable|string|max:255',
            'codigo_profissional' => 'required|exists:profissionais,codigo',
            'data_comparecimento' => 'nullable|date',
            'hora_comparecimento' => 'nullable|date_format:H:i',
            'dias_afastamento' => 'nullable|integer',
            'cid10' => 'nullable|string|max:255',
            'procedimento_descricao' => 'nullable|string',
            'data_impressao' => 'nullable|date_format:Y-m-d H:i:s',
        ]);

        try {
            Atestado::create($validatedData);
            return redirect()->route('atestados.index')->with('success', 'Atestado created successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['msg' => 'Error creating atestado: ' . $e->getMessage()]);
        }

        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Atestado  $atestado
     * @return \Illuminate\Http\Response
     */
    public function show(Atestado $atestado)
    {
        return view('atestados.show', compact('atestado'));
    }

    public function downloadPDF(Atestado $atestado)
    {
        $view = $atestado->tipo == 'Afastamento' ? 'atestados.afastamento_pdf' : 'atestados.comparecimento_pdf';
        $pdf = Pdf::loadView($view, compact('atestado'));
        return $pdf->stream('atestado_'.$atestado->id.'.pdf');
    }

    public function viewPDF(Atestado $atestado)
    {
        $view = $atestado->tipo == 'Afastamento' ? 'atestados.afastamento_pdf' : 'atestados.comparecimento_pdf';
        $pdf = Pdf::loadView($view, compact('atestado'));
        $pdfContent = $pdf->output();

        return view('atestados.pdf_viewer', ['pdfContent' => base64_encode($pdfContent)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Atestado  $atestado
     * @return \Illuminate\Http\Response
     */
    public function edit(Atestado $atestado)
    {
        $profissionais = Profissional::all();
        return view('atestados.edit', compact('atestado', 'profissionais'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Atestado  $atestado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Atestado $atestado)
    {
        $validatedData = $request->validate([
            'data' => 'required|date',
            'tipo' => 'required|string|max:255',
            'nome_paciente' => 'required|string|max:255',
            'codigo_paciente' => 'required|string|max:255',
            'codigo_profissional' => 'required|exists:profissionais,codigo',
            'data_comparecimento' => 'nullable|date',
            'hora_comparecimento' => 'nullable|date_format:H:i',
            'dias_afastamento' => 'nullable|integer',
            'cid10' => 'nullable|string|max:255',
            'procedimento_descricao' => 'nullable|string',
            'data_impressao' => 'nullable|date_format:Y-m-d H:i:s',
        ]);

        $atestado->update($validatedData);

        return redirect()->route('atestados.index')->with('success', 'Atestado updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Atestado  $atestado
     * @return \Illuminate\Http\Response
     */
    public function destroy(Atestado $atestado)
    {
        $atestado->delete();
        return redirect()->route('atestados.index')->with('success', 'Atestado deleted successfully.');
    }
}
