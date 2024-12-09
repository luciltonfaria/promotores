<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index()
    {
        // Retrieve all accounts
        $accounts = Account::with('user')->get();

        // Pass the accounts to the view
        return view('accounts.index', compact('accounts'));
    }

    public function show($id)
    {
        // Retrieve the specific account by id
        $account = Account::with('transactions')->findOrFail($id);

        // Pass the account to the view
        return view('accounts.show', compact('account'));
    }

    public function credit(Request $request, $id)
    {
        $account = Account::findOrFail($id);
        $account->credit($request->amount, $request->description);
        return redirect()->route('accounts.show', $account);
    }

    public function debit(Request $request, $id)
    {
        $account = Account::findOrFail($id);
        $account->debit($request->amount, $request->description);
        return redirect()->route('accounts.show', $account);
    }
}
