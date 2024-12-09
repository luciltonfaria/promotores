<?php

namespace App\Http\Controllers;

use App\Models\UserExternal;

class UserExternalController extends Controller
{
    public function index()
    {
        // Recuperar todos os usuários do segundo banco
        $users = UserExternal::all();

        // Retornar uma view ou JSON
        return view('user_external.index', compact('users')); // Exemplo com view
        // return response()->json($users); // Exemplo com JSON
    }
}

