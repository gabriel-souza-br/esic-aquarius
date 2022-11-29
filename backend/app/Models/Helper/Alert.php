<?php
/*
 * This file is part of the eSIC Aquarius.
 *
 * (c) Gabriel de Araújo Souza <gabriel.takashi@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Models\Helper;

use JsonSerializable;

/**
 * Classe que gera um Objeto para utilização como Alert no Frontend
 * Criado para ser incorporado a uma resposta JSON da API para o Frontend
 *
 * @author Gabriel de Araújo Souza <gabriel.takashi@gmail.com>
 */

class Alert implements JsonSerializable
{
    public const TIPO_SUCESSO = 1;
    public const TIPO_INFORMACAO = 2;
    public const TIPO_ALERTA = 3;
    public const TIPO_ERRO = 4;

    protected $tipo;
    protected $titulo;
    protected $mensagem;

    function __construct(int $tipo = 1, $mensagem = null, $titulo = null)
    {
        $this->tipo = $tipo;
        $this->mensagem = $mensagem;
        $this->titulo = $titulo;
    }

    public function toArray()
    {
        return [
            'tipo' => $this->tipo,
            'mensagem' => $this->mensagem,
            'titulo' => $this->titulo
        ];
    }

    public function jsonSerialize()
    {
        return $this->toArray();
    }
}
