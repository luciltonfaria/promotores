<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transactions';
    protected $primaryKey = 'transaction_id';
    public $timestamps = false;

    // Filtrando Depósitos
    public static function getDeposits($startDate, $endDate)
    {
        return self::where('status', 2)
            ->where('type', 1)
            ->whereBetween('time', [$startDate, $endDate])
            ->get();
    }

    // Filtrando Saques
    public static function getWithdrawals($startDate, $endDate)
    {
        return self::where('status', 2)
            ->where('type', 2)
            ->whereBetween('time', [$startDate, $endDate])
            ->get();
    }

    // Total de Depósitos
    public static function totalDeposits($startDate, $endDate)
    {
        return self::where('status', 2)
            ->where('type', 1)
            ->whereBetween('time', [$startDate, $endDate])
            ->sum('amount');
    }

    // Total de Saques
    public static function totalWithdrawals($startDate, $endDate)
    {
        return self::where('status', 2)
            ->where('type', 2)
            ->whereBetween('time', [$startDate, $endDate])
            ->sum('amount');
    }
}
