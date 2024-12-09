<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserExternal;
use App\Models\Transaction;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;




class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    
       
     public function index()
     {
         // Total de usuários
         //$totalUsers = User::count();
     
         // Usuários cadastrados no mês corrente
        //  $currentMonthUsers = User::whereMonth('created_at', Carbon::now()->month)
        //                           ->whereYear('created_at', Carbon::now()->year)
        //                           ->count();
     
         // Últimos 30 usuários do segundo banco
         $lastThirtyUsers = UserExternal::orderBy('created', 'desc')->take(30)->get();
     
         // Período atual
        //  $startDate = Carbon::now()->startOfMonth();
        //  $endDate = Carbon::now()->endOfMonth();
     
    
         // Totais de Depósitos e Saques
        //  $totalDeposits = Transaction::totalDeposits($startDate, $endDate); // Método do modelo
        //  $totalWithdrawals = Transaction::totalWithdrawals($startDate, $endDate); // Método do modelo
     
         return view('home', compact('lastThirtyUsers'));
     }
     
    
}