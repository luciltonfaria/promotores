<?php
namespace App\Http\Controllers;

use App\Models\Conta;
use Illuminate\Http\Request;

class ContaController extends Controller
{
    // Display a listing of the resource
    public function index()
    {
        $contas = Conta::all();
        return view('contas.index', compact('contas'));
    }

    // Show the form for creating a new resource
    public function create()
    {
        return view('contas.create');
    }

    // Store a newly created resource in storage
    public function store(Request $request)
    {
        $validatedData = $request->validate(Conta::rules());

        Conta::create($validatedData);

        return redirect()->route('contas.index')->with('success', 'Conta created successfully.');
    }

    // Display the specified resource
    public function show(Conta $conta)
    {
        return view('contas.show', compact('conta'));
    }

    // Show the form for editing the specified resource
    public function edit(Conta $conta)
    {
        return view('contas.edit', compact('conta'));
    }

    // Update the specified resource in storage
    public function update(Request $request, Conta $conta)
    {
        $validatedData = $request->validate(Conta::rules());

        $conta->update($validatedData);

        return redirect()->route('contas.index')->with('success', 'Conta updated successfully.');
    }

    // Remove the specified resource from storage
    public function destroy(Conta $conta)
    {
        $conta->delete();

        return redirect()->route('contas.index')->with('success', 'Conta deleted successfully.');
    }
}
