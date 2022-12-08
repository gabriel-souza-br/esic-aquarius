<?php

namespace App\Services;

use App\Services\Helper\ValidacaoService;
use App\Models\User;
use Illuminate\Http\Request;

class UserService
{
    use ValidacaoService;

    /**
     * Realiza a Validacao dos campos do Registro a ser Criado
     * 
     * @param Illuminate\Http\Request
     * @return array
     */
    public static function validar_criar(Request $request)
    {
        $regras = [
            'cpfcnpj' => 'required|unique:users',
            'nome' => 'required|min:3|max:60',
            'email' => 'required|email|min:3|max:80|unique:users',
            'telefone' => 'nullable|telefone_com_ddd',
            'celular' => 'nullable|celular_com_ddd',
            'cep' => 'nullable|formato_cep',
            'cidade' => 'nullable|min:2|max:50',
            'bairro' => 'nullable|min:2|max:50',
            'logradouro' => 'nullable|min:2|max:80',
            'numero' => 'nullable|min:1|max:10',
            'complemento' => 'nullable|min:2|max:40',
            'password' => 'required|min:7|max:30|confirmed',
        ];
        return self::validate($request, $regras);
    }

    /**
     * Realiza a Criacao do Registro
     * 
     * @param Illuminate\Http\Request
     * @return User
     */
    public static function criar(Request $request)
    {
        $user = new User;
        $user->cpfcnpj = preg_replace('/\D/', '', $request->input('cpfcnpj', null));
        $user->nome = $request->input('nome', null);
        $user->email = $request->input('email', null);
        $user->telefone = $request->input('telefone', null);
        $user->cep = $request->input('cep', null);
        $user->cidade = $request->input('cidade', null);
        $user->bairro = $request->input('bairro', null);
        $user->logradouro = $request->input('logradouro', null);
        $user->numero = $request->input('numero', null);
        $user->complemento = $request->input('complemento', null);
        $user->password = app('hash')->make($request->input('password'));
        $user->data_cadastro = date("Y-m-d H:i:s");
        $user->codigo_ativacao = '$$$$$$$$';
        $user->save();
        return $user;
    }

    /**
     * Realiza a Pesquisa do Registro pelo ID
     * 
     * @param int $id
     * @return User
     */
    public static function pesquisar($id)
    {
        return User::find($id);
    }

    /**
     * Realiza a inativação (exclusão lógica) do Registro pelo ID
     * 
     * @param int $id
     * @return User
     */
    public static function inativar($id)
    {
        $user = User::find($id);
        $user->data_inativacao = date("Y-m-d H:i:s");
        $user->save();
        return $user;
    }

    /**
     * Realiza a exclusão física do Registro pelo ID
     * 
     * @param int $id
     * @return User
     */
    public static function excluir($id)
    {
        $user = User::find($id);
        return $user->delete();
    }

    /**
     * Realiza a Atualização do Registro pelo ID
     * 
     * @param int $id
     * @param Illuminate\Http\Request
     * @return User
     */
    public static function atualizar($id, Request $request)
    {
        return User::where('id', $id)->update($request->except('_token', '_method'));
    }
}
