/*
 * This file is part of the eSIC Aquarius.
 *
 * (c) Gabriel de Araújo Souza <gabriel.takashi@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

import axios from 'axios'
import AuthService from "@/services/auth.service";
import AlertService from '@/services/helpers/alert.service';

const api = axios.create({ baseURL: process.env.VUE_APP_API_URL });

/*
* Trata as requisições adicionando o TOKEN de autenticação, se houver um TOKEN válido.
*/
api.interceptors.request.use(function (config) {
    const jwt_token = AuthService.jwt_token.acesso_token;
    if (jwt_token) {
        config.headers.Authorization = `Bearer ${jwt_token}`;
    }
    return config;
}, function (err) {
    return Promise.reject(err);
});

/*
* Intercepta e mostra mensagens de Alerta vindas do Backend
*/
api.interceptors.response.use(
    (res) => {
        var alerta = new AlertService(res);
        alerta.processa();
        return res;
    },
    async (err) => {
        var alerta = new AlertService(err.response);
        alerta.processa();
        return Promise.reject(err);
    }
);

export { axios, api }