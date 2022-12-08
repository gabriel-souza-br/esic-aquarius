/*
 * This file is part of the eSIC Aquarius.
 *
 * (c) Gabriel de Araújo Souza <gabriel.takashi@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

export default class jwtToken {

    constructor(dados) {
        this._itens = [
            'acesso_token',
            'acesso_tipo',
            'acesso_expira_em'
        ];

        this._itens.forEach(elemento => {
            this['_' + elemento] = (dados && dados[elemento]) ? dados[elemento] : null;
        });
    }
    get acesso_token() {
        return this._acesso_token;
    }

    set acesso_token(acesso_token) {
        this._acesso_token = acesso_token;
    }

    get acesso_tipo() {
        return this._acesso_tipo;
    }

    set acesso_tipo(acesso_tipo) {
        this._acesso_tipo = acesso_tipo;
    }

    get acesso_expira_em() {
        return this._acesso_expira_em;
    }

    set acesso_expira_em(acesso_expira_em) {
        this._acesso_expira_em = acesso_expira_em;
    }
}

