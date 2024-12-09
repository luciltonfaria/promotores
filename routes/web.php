<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProcedimentoController;
use App\Http\Controllers\MedicamentoController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\ConvenioController;
use App\Http\Controllers\ProfissionalController;
use App\Http\Controllers\EspecialidadeController;
use App\Http\Controllers\AtestadoController;
use App\Http\Controllers\ReceitaController;
use App\Http\Controllers\ReciboController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrcamentoController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ImagensOrcamentoController;
use App\Http\Controllers\AnamneseController;
use App\Http\Controllers\ContaController;
use App\Http\Controllers\MovimentoFinanceiroController;
use App\Http\Controllers\FormaPagtoController;
use App\Http\Controllers\JogoController;



Auth::routes(['register' => false]); // Desabilita registro


Route::resource('users', UsuarioController::class);


Route::get('/home', [HomeController::class, 'index'])->name('home');

// Protect routes with 'auth' middleware
//Route::middleware(['auth'])->group(function () {
    Route::resource('especialidades', EspecialidadeController::class);
    Route::resource('profissionais', ProfissionalController::class);
    Route::resource('convenios', ConvenioController::class);
    Route::resource('procedimentos', ProcedimentoController::class);
    Route::resource('medicamentos', MedicamentoController::class);
    Route::resource('pacientes', PacienteController::class);
    Route::resource('atestados', AtestadoController::class);
    Route::resource('receitas', ReceitaController::class);
    Route::resource('orcamentos', OrcamentoController::class);
    Route::resource('contas', ContaController::class);    
    Route::resource('movimentos', MovimentoFinanceiroController::class);
    Route::resource('forma_pagto', FormaPagtoController::class);

//});



Route::get('atestados/{atestado}/pdf', [AtestadoController::class, 'downloadPDF'])->name('atestados.pdf');
Route::get('atestados/{atestado}/view', [AtestadoController::class, 'viewPDF'])->name('atestados.viewPDF');
Route::get('receitas/{id}/pdf', [ReceitaController::class, 'viewPDF'])->name('receitas.viewPDF');
Route::resource('recibos', ReciboController::class);
Route::get('/recibo/{id}/pdf', [ReciboController::class, 'generatePdf']);
Route::resource('accounts', AccountController::class);
Route::post('accounts/{account}/credit', [AccountController::class, 'credit'])->name('accounts.credit');
Route::post('accounts/{account}/debit', [AccountController::class, 'debit'])->name('accounts.debit');

Route::post('orcamentos/upload', [OrcamentoController::class, 'upload'])->name('orcamentos.upload');
Route::post('/orcamentos/{orcamento}/imagens', [ImagensOrcamentoController::class, 'store'])->name('imagens.store');
Route::get('/orcamentos/{id}/contrato', [OrcamentoController::class, 'contrato'])->name('orcamentos.contrato');

Route::get('/pacientes/{codigo}/print', [PacienteController::class, 'print'])->name('pacientes.print');
Route::get('/pacientes/search', [PacienteController::class, 'search'])->name('pacientes.search');
Route::get('anamnese/{id}/print', [AnamneseController::class, 'print'])->name('anamnese.print');
Route::get('/receitas/{id}/printSimplePDF', [ReceitaController::class, 'printSimplePDF'])->name('receitas.printSimplePDF');
Route::get('/jogos', [JogoController::class, 'index'])->name('jogos.index');

                                   



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::redirect('/', 'login');

Auth::routes(['register' => false]); // Disable registration

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

