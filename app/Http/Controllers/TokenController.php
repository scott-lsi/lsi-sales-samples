<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Token;

class TokenController extends Controller
{
    public function storeToSession(Token $token)
    {
        session(['token' => $token]);

        return redirect()->route('home');
    }
}
