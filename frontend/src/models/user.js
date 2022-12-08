/*
 * This file is part of the eSIC Aquarius.
 *
 * (c) Gabriel de Araújo Souza <gabriel.takashi@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

export default class User {

    constructor(dados) {
        this._itens = [
            'cpfcnpj', 'nome', 'email',
            'telefone', 'celular', 'cep',
            'logradouro', 'bairro', 'cidade',
            'numero', 'complemento', 'data_cadastro',
            'data_ativacao', 'data_inativacao'
        ];

        this._itens.forEach(elemento => {
            this['_' + elemento] = (dados && dados[elemento]) ? dados[elemento] : null;
        });
    }
    get cpfcnpj() {
        return this._cpfcnpj;
    }

    set cpfcnpj(cpfcnpj) {
        this._cpfcnpj = cpfcnpj;
    }

    get nome() {
        return this._nome;
    }

    set nome(nome) {
        this._nome = nome;
    }

    get email() {
        return this._email;
    }

    set email(email) {
        this._email = email;
    }

    get telefone() {
        return this._telefone;
    }

    set telefone(telefone) {
        this._telefone = telefone;
    }

    get celular() {
        return this._celular;
    }

    set celular(celular) {
        this._celular = celular;
    }

    get cep() {
        return this._cep;
    }

    set cep(cep) {
        this._cep = cep;
    }

    get logradouro() {
        return this._logradouro;
    }

    set logradouro(logradouro) {
        this._logradouro = logradouro;
    }

    get bairro() {
        return this._bairro;
    }

    set bairro(bairro) {
        this._bairro = bairro;
    }

    get cidade() {
        return this._cidade;
    }

    set cidade(cidade) {
        this._cidade = cidade;
    }

    get numero() {
        return this._numero;
    }

    set numero(numero) {
        this._numero = numero;
    }

    get complemento() {
        return this._complemento;
    }

    set complemento(complemento) {
        this._complemento = complemento;
    }

    get data_cadastro() {
        return this._data_cadastro;
    }

    set data_cadastro(data_cadastro) {
        this._data_cadastro = data_cadastro;
    }

    get data_ativacao() {
        return this._data_ativacao;
    }

    set data_ativacao(data_ativacao) {
        this._data_ativacao = data_ativacao;
    }

    get data_inativacao() {
        return this._data_inativacao;
    }

    set data_inativacao(data_inativacao) {
        this._data_inativacao = data_inativacao;
    }
}

