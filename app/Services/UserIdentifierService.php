<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Request;

class UserIdentifierService
{
    public function getUserIdentifier(Request $request)
    {
        if (Auth::user() == null){
            if (!$request->cookie('user_identifier')) {
                // Gera um identificador único
                $identifier = uniqid(true);

                // Cria o cookie por 30 dias
                Cookie::queue('user_identifier', $identifier, 43200); // 30 dias

                // Redireciona para a mesma página para que o cookie seja lido corretamente
                return redirect()->back();
            }

            // Obtém o cookie e exibe
            return $user = $request->cookie('user_identifier');
        }else{
            return $user = Auth::user()->id;
        }
    }
}
