<?php

/*
 * This file is part of the eSIC Aquarius.
 *
 * (c) Gabriel de Araújo Souza <gabriel.takashi@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Services\Helper;

use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Models\Helper\Alert;

trait JsonRespostaService
{
    /**
     * Formata a resposta em JSON no padrão HTTP para o FrontEnd
     * Lista de Status:
     * https://developer.mozilla.org/pt-BR/docs/Web/HTTP/Status
     *    
     *   1) Respostas de informação (100-199)
     *   2) Respostas de sucesso (200-299)
     *   3) Redirecionamentos (300-399)
     *   4) Erros do cliente (400-499)
     *   5) Erros do servidor (500-599)
     * 
     * @param  int $status_codigo
     * @param  Object $mensagens
     * @param  Object $alert
     * @return JsonResponse
     * 
     */
    private static function jsonResposta(
        int $status_codigo = Response::HTTP_INTERNAL_SERVER_ERROR,
        $mensagens = [],
        Alert $alert = null
    ) {
        $r = [
            'sucesso' => ($status_codigo >= Response::HTTP_OK && $status_codigo < Response::HTTP_MULTIPLE_CHOICES) ? true : false,
            'status' => [
                'codigo' => $status_codigo,
                'texto' => Response::$statusTexts[$status_codigo]
            ],
            'mensagens' => $mensagens,
            'alert' => $alert
        ];
        return new JsonResponse(
            $r,
            $status_codigo,
            ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
            JSON_UNESCAPED_UNICODE
        );
    }

    /**
     * Formata a resposta de Sucesso com HTTP_OK (200)
     *
     * @param  Object  $mensagens
     * @return JsonResponse
     * 
     */
    public static function responderOK($mensagens = [], Alert $alert = null)
    {
        return self::jsonResposta(Response::HTTP_OK, $mensagens, $alert);
    }

    /**
     * Formata a resposta de Erro de Validação com HTTP_UNPROCESSABLE_ENTITY (422)
     *
     * @param  Object  $mensagens
     * @return JsonResponse
     * 
     */
    public static function responderErroValidacao($mensagens = [], Alert $alert = null)
    {
        return self::jsonResposta(Response::HTTP_UNPROCESSABLE_ENTITY, $mensagens, $alert);
    }

    /**
     * Formata a resposta de Erro Genérico com HTTP_INTERNAL_SERVER_ERROR (500)
     *
     * @param  Object  $mensagens
     * @return JsonResponse
     * 
     */
    public static function responderErroGenerico($mensagens = [],  Alert $alert = null)
    {
        return self::jsonResposta(Response::HTTP_INTERNAL_SERVER_ERROR, $mensagens, $alert);
    }

    /**
     * Formata a resposta de Item Criado/Atualizado com Sucesso HTTP_CREATED (201)
     *
     * @param  Object  $mensagens
     * @return JsonResponse
     * 
     */
    public static function responderCriadoOuAtualizado($mensagens = [],  Alert $alert = null)
    {
        return self::jsonResposta(Response::HTTP_CREATED, $mensagens, $alert);
    }

    /**
     * Formata a resposta de Requisição Não Autorizada com HTTP_UNAUTHORIZED (401)
     *
     * @param  Object  $mensagens
     * @return JsonResponse
     * 
     */
    public static function responderAcessoNegado($mensagens = [],  Alert $alert = null)
    {
        return self::jsonResposta(Response::HTTP_UNAUTHORIZED, $mensagens, $alert);
    }
}
