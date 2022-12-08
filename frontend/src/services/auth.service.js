/*
 * This file is part of the eSIC Aquarius.
 *
 * (c) Gabriel de Araújo Souza <gabriel.takashi@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

import { api } from '@/boot/axios'
import User from '@/models/user'
import JwtToken from '@/models/jwtToken'

const AUTH_URL = '/auth';

class AuthService {

    /**
     * Responsável por executar o login
     **/
    login(credenciais) {
        return api
            .post(AUTH_URL + '/login', {
                cpfcnpj: credenciais.cpfcnpj,
                password: credenciais.password
            })
            .then(response => {
                return response.data.mensagens;
            });
    }
    /**
     * Responsável por executar o refresh do Token
     **//*
    refresh() {
        return axios
            .post(AUTH_URL + '/refresh')
            .then(response => {
                return response.data.mensagens;
            });
    }*/
    /**
     * Responsável por executar o Logout
     **//*
    logout() {
        return axios
            .get(AUTH_URL + '/logout')
            .then(response => {
                return response.data;
            });
    }
*/
    get jwt_token() {
        return new JwtToken(
            JSON.parse(localStorage.getItem("jwt_token"))
        );
    }

    get user() {
        return new User(
            JSON.parse(localStorage.getItem("user"))
        );
    }
}

export default new AuthService();
