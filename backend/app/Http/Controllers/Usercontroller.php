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

use App\Models\User;

class UserController extends Controller
{
    /**
     * Retorna o Usuário logado atualmente
     *
     * @return void
     */
    public function me()
    {
        return self::responderOK([auth()->user()]);
    }

    /**
     * Listar todos Usuários
     *
     * @return void
     */
    public function getUsers()
    {
        return self::responderOK([
            'lista' => User::all()
        ]);
    }
}
