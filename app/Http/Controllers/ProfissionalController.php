<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profissional;
use App\Models\Estado;
use App\Rules\ValidCpf;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProfissionalController extends Controller
{
    // Display a listing of the resource.
    public function index()
    {
        $profissionais = Profissional::all();
        return view('profissionais.index', compact('profissionais'));
    }

    // Show the form for creating a new resource.
    public function create()
    {
        $estados = Estado::all();
        return view('profissionais.create', compact('estados'));
    }

    public function store(Request $request)
    {
        try {

            Log::info('Entrando no método store', ['request' => $request->all()]);
            $validatedData = $request->validate([
                'nome' => 'required|string|max:65',
                'cpf' => 'nullable|string|max:14',
                'email' => 'required|email|max:100|unique:profissionais,email',
                // Add other validation rules as needed
            ]);

            Log::info('Validação concluída', ['validatedData' => $validatedData]);

 
            $profissional = new Profissional($request->all());
            if ($request->hasFile('foto')) {
                $profissional->foto = $request->file('foto')->store('fotos', 'public');
            }
            $profissional->save();

            return redirect()->route('profissionais.index');
        } catch (\Exception $e) {
            Log::error('Erro no método store', ['exception' => $e]);
           
            return redirect()->back()->withInput();
        }
    }

    // Display the specified resource.
    public function show($id)
    {
        $profissional = Profissional::findOrFail($id);
        return view('profissionais.show', compact('profissional'));
    }

    // Show the form for editing the specified resource.
    public function edit($id)
    {
        $profissional = Profissional::findOrFail($id);
        $estados = Estado::all();
        return view('profissionais.edit', compact('profissional', 'estados'));
    }

    // Update the specified resource in storage.
    public function update(Request $request, $codigo)
    {
        try {
            Log::info('Entrando no método store', ['request' => $request->all()]);
            $profissional = Profissional::findOrFail($codigo);
        
            $validatedData = $request->validate([
                'nome' => 'required|string|max:65',
                'cpf' => 'nullable|string|max:14',
                'email' => 'required|email|max:100',
                // Add other validation rules as needed
            ]);
        
            Log::info('Validação concluída', ['validatedData' => $validatedData]);
            $profissional->fill($request->all());
        
            if ($request->hasFile('foto')) {
                if ($profissional->foto) {
                    Storage::disk('public')->delete($profissional->foto);
                }
                $profissional->foto = $request->file('foto')->store('fotos', 'public');
            }
        
            $profissional->save();
        
            return redirect()->route('profissionais.index')->with('success', 'Profissional atualizado com sucesso.');
        } catch (\Exception $e) {
            Log::error('Erro no método store', ['exception' => $e]);
            return back()->withErrors('Ocorreu um erro ao adicionar o ProfissionalS. Por favor, tente novamente.')->withInput();
        }       
    }
    
    

    // Remove the specified resource from storage.
    public function destroy($id)
    {
        $profissional = Profissional::findOrFail($id);
        $profissional->delete();

        return redirect()->route('profissionais.index')->with('success', 'Profissional deletado com sucesso.');
    }
}
