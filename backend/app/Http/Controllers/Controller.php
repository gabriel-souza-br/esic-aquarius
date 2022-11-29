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

use Laravel\Lumen\Routing\Controller as BaseController;
use  App\Services\Helper\AlertService;
use  App\Services\Helper\JsonRespostaService;
use Illuminate\Support\Facades\App;

class Controller extends BaseController
{
    /*-------------------------------------------------
    | AlertService: Adicionado para criar um Alert sem precisar instanciar
    | JsonRespostaService: Adicionado para criar uma RespostaJson sem precisar instanciar
    |--------------------------------------------------
    */
    use AlertService, JsonRespostaService;

    /**
     * Pega uma instância de um determinado Serviço
     * @param null $service Nome da service a ser chamada.
     * @return mixed
     */
    public function getService($service = null)
    {
        if (empty($service) || is_null($service)) {
            throw new \Exception('Erro: O nome do serviço é nulo ou não foi informado.');
        }
        $app = App::getFacadeApplication();
        return $app->make('App\\Services\\' . $service);
    }
}
