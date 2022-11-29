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

use App\Models\Helper\Alert;

trait AlertService
{
    public static function AlertSucesso($mensagem = null, $titulo = null)
    {
        return new Alert(Alert::TIPO_SUCESSO, $mensagem, $titulo);
    }

    public static function AlertInformacao($mensagem = null, $titulo = null)
    {
        return new Alert(Alert::TIPO_INFORMACAO, $mensagem, $titulo);
    }

    public static function AlertAlerta($mensagem = null, $titulo = null)
    {
        return new Alert(Alert::TIPO_ALERTA, $mensagem, $titulo);
    }

    public static function AlertErro($mensagem = null, $titulo = null)
    {
        return new Alert(Alert::TIPO_ERRO, $mensagem, $titulo);
    }
}
