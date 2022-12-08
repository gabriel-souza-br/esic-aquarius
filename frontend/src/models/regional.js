/*
 * This file is part of the eSIC Aquarius.
 *
 * (c) Gabriel de Araújo Souza <gabriel.takashi@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

export default class Regional {

    constructor(dados) {
        this._itens = [
            'id', 'nome', 'sigla',
            'data_cadastro', 'data_inativacao'
        ];

        this._itens.forEach(elemento => {
            this['_' + elemento] = (dados && dados[elemento]) ? dados[elemento] : null;
        });
    }
    get id() {
        return this._id;
    }

    set id(id) {
        this._id = id;
    }

    get nome() {
        return this._nome;
    }

    set nome(nome) {
        this._nome = nome;
    }

    get sigla() {
        return this._sigla;
    }

    set sigla(sigla) {
        this._sigla = sigla;
    }


    get data_cadastro() {
        return this._data_cadastro;
    }

    set data_cadastro(data_cadastro) {
        this._data_cadastro = data_cadastro;
    }

    get data_inativacao() {
        return this._data_inativacao;
    }

    set data_inativacao(data_inativacao) {
        this._data_inativacao = data_inativacao;
    }
}

