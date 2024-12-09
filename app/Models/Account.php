<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'balance'];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function credit($amount, $description = null)
    {
        $transaction = $this->transactions()->create([
            'amount' => $amount,
            'type' => 'credit',
            'description' => $description,
        ]);

        $this->increment('balance', $amount);

        return $transaction;
    }

    public function debit($amount, $description = null)
    {
        $transaction = $this->transactions()->create([
            'amount' => $amount,
            'type' => 'debit',
            'description' => $description,
        ]);

        $this->decrement('balance', $amount);

        return $transaction;
    }
}
