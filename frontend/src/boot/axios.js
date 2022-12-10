import { boot } from 'quasar/wrappers'
import axios from 'axios'
import AuthService from "@/services/auth.service";

/*
* Seta o nome "api" nas URLs que chamarem por api ao invés de axios
*/
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

//Quasar framework config axios/api:
export default boot(({ app }) => {
    app.config.globalProperties.$axios = axios
    app.config.globalProperties.$api = api
})

export { axios, api }