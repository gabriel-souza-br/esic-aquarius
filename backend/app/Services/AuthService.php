<?php

namespace App\Services;

use App\Services\Helper\ValidacaoService;
use Illuminate\Http\Request;

class AuthService
{
    use ValidacaoService;

    /**
     * Realiza a Validacao dos campos do Login
     * 
     * @param Illuminate\Http\Request
     * @return Validator
     */
    public static function validar_login(Request $request)
    {
        $regras = [
            'cpfcnpj' => 'required',
            'password' => 'required',
            /*'g-recaptcha-response' => 'required|captcha',*/
        ];
        return self::validate($request, $regras);
    }
}
