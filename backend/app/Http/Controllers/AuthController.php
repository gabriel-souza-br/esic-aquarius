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

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\AuthService;
use App\Services\UserService;

class AuthController extends Controller
{
    /**
     * Cria uma nova instância de AuthController.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    /**
     * Tenta efetuar o Login
     *
     * @return void
     */
    public function login(Request $request)
    {
        AuthService::validar_login($request);
        $credenciais = $request->only(['cpfcnpj', 'password']);

        try {
            if (!$token = Auth::attempt($credenciais)) {
                return self::responderAcessoNegado(['Acesso Negado'], self::AlertErro('Acesso Negado', 'ERRO'));
            }
            return self::responderOK($this->estruturarToken($token));
        } catch (\Exception $e) {
            return self::responderErroGenerico(
                [utf8_encode($e->getMessage())],
                self::AlertErro('Erro ao tentar efetuar Login.', 'ERRO')
            );
        }
    }

    /**
     * Tenta efetuar o Refresh do Token ativo
     *
     * @return void
     */
    public function refresh()
    {
        try {
            $token = Auth::refresh();
            return self::responderOK([$this->estruturarToken($token)]);
        } catch (\Exception $e) {
            return self::responderErroGenerico(
                [utf8_encode($e->getMessage())],
                self::AlertErro('Erro ao efetuar refresh do Token de Acesso.', 'ERRO')
            );
        }
    }

    /**
     * Cria novo registro (Usuário)
     *
     * @param  Request  $request
     * @return JsonResponse
     */
    public function register(Request $request)
    {
        UserService::validar_criar($request);
        try {
            return self::responderCriadoOuAtualizado(UserService::criar($request));
        } catch (\Exception $e) {
            return self::responderErroGenerico(
                [utf8_encode($e->getMessage())],
                self::AlertErro('Erro ao Cadastrar Registro.', 'ERRO')
            );
        }
    }

    /**
     * Tenta efetuar o Logout
     *
     * @return void
     */
    public function logout()
    {
        try {
            auth()->logout();
            return self::responderCriadoOuAtualizado(['Deslogado com sucesso!']);
        } catch (\Exception $e) {
            $err = utf8_encode($e->getMessage());
            return self::responderErroGenerico([$err], self::AlertErro($err, 'ERRO'));
        }
    }

    /**
     * Formata a resposta contendo o token atual
     *
     * @param String $token
     * @return void
     */
    protected function estruturarToken($token)
    {
        $u = Auth::user();
        $user =  [
            'cpfcnpj' => $u->cpfcnpj,
            'nome' => $u->nome,
            'email' => $u->email,
            'telefone' => $u->telefone,
            'celular' => $u->celular,
            'cep' => $u->cep,
            'logradouro' => $u->logradouro,
            'bairro' => $u->bairro,
            'cidade' => $u->cidade,
            'numero' => $u->numero,
            'complemento' => $u->complemento,
            'data_cadastro' => $u->data_cadastro,
            'data_ativacao' => $u->data_ativacao,
            'data_inativacao' => $u->data_inativacao
        ];
        $jwt_token = [
            'acesso_token' => $token,
            'acesso_tipo' => 'bearer',
            'acesso_expira_em' => Auth::factory()->getTTL() * 60,
        ];
        return ['jwt_token' => $jwt_token, 'user' => $user];
    }
}
