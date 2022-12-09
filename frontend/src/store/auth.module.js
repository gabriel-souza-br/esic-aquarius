import router from '@/router'
import AuthService from '@/services/auth.service';

/*this.$store.state.auth: {jwt_token: Object , user: Object}*/
const _jwt_token = JSON.parse(localStorage.getItem('jwt_token'));
const _user = JSON.parse(localStorage.getItem('user'));

const estado_incial = (_jwt_token && _user) ?
    { jwt_token: _jwt_token, user: _user } :
    { jwt_token: null, user: null };

export const auth = {
    namespaced: true,
    state: estado_incial,
    getters: {
        estadoAtual: state => {
            return state;
        }
    },
    actions: {
        login({ commit }, credenciais) {
            return AuthService.login(credenciais).then(
                response => {
                    commit('loginSuccess', response);
                    return Promise.resolve(response);
                },
                error => {
                    commit('loginFailure');
                    return Promise.reject(error);
                }
            );
        },
        refresh({ commit }) {
            return AuthService.refresh().then(
                response => {
                    commit('refreshSuccess', response);
                    return Promise.resolve(response);
                },
                error => {
                    commit('refreshFailure');
                    return Promise.reject(error);
                }
            );
        },
        logout({ commit }) {
            return AuthService.logout().then(
                response => {
                    commit('logout', response);
                    return Promise.resolve(response);
                },
                error => {
                    commit('logout');
                    return Promise.reject(error);
                }
            );
        },
    },
    mutations: {
        loginSuccess(state, response) {
            state.jwt_token = response.jwt_token;
            state.user = response.user;
            localStorage.setItem('jwt_token', JSON.stringify(response.jwt_token));
            localStorage.setItem('user', JSON.stringify(response.user));
        },
        loginFailure(state) {
            state.usuario_nome = null;
            state.jwt_token = null;
            localStorage.setItem('jwt_token', null);
            localStorage.setItem('user', null);
        },
        refreshSuccess(state, response) {
            state.jwt_token = response.jwt_token;
            localStorage.setItem('jwt_token', JSON.stringify(response.jwt_token));
        },
        refreshFailure(state) {
            this.loginFailure(state);
        },
        logout(state) {
            state.user = null;
            state.jwt_token = null;
            localStorage.removeItem('jwt_token');
            localStorage.removeItem('user');
            router.push("/auth/login");
        },
    }
};
