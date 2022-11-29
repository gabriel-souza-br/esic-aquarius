<?php

/*
 * This file is part of the eSIC Aquarius.
 *
 * (c) Gabriel de Araújo Souza <gabriel.takashi@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Http\Controllers;

class AuthController extends Controller
{
    /**
     * Cria uma nova instância de AuthController.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
     * Retorna o Usuário logado atualmente.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function user()
    {
        return self::responderOK([auth()->user()]);
    }

    /**
     * Tenta efetuar o Login
     *
     * @return void
     */
    public function login()
    {
        $credentials = request(['email', 'password']);
        if (!$token = auth()->attempt($credentials)) {
            return self::responderAcessoNegado(
                ['error' => 'Acesso não autorizado!'],
                self::AlertErro('Acesso não autorizado!', 'ERRO')
            );
        }
        return $this->respondWithToken($token);
    }

    /**
     * Tenta efetuar o Refresh do Token ativo
     *
     * @return void
     */
    public function refresh()
    {
        $token = auth()->refresh();
        return $this->respondWithToken($token);
    }

    /**
     * Tenta efetuar o Logout
     *
     * @return void
     */
    public function logout()
    {
        auth()->logout();
        return self::responderOK(
            ['message' => 'Logout with success!']
        );
    }

    /**
     * Formata a resposta contendo o token atual
     *
     * @param String $token
     * @return void
     */
    protected function respondWithToken($token)
    {
        return self::responderOK(
            [
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => auth()->factory()->getTTL() * 60 // default: 1 hora (Configuravel no .env)
            ]
        );
    }
}
