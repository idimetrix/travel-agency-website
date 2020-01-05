import axios from 'axios'
import Vue from 'vue'
import store from '../store'

let util = {}
util.ajax = axios.create({
    baseURL: '/api/v1/',
})

util.ajax.interceptors.request.use(config => {
    // Do something before request is sent
    if (store.state.user.access_token) config.headers.Authorization = `Bearer ${store.state.user.access_token}`;
    return config;
}, error => {
    // Do something with request error
    return Promise.reject(error);
});
util.ajax.interceptors.response.use(response => {
    // Do something with response data
    return response;
}, error => {
    if (error.response.status === 401 && !error.config._retry) {
        error.config._retry = true;
//if not login
        if (location.pathname !== '/login') {
            store.commit('removeUserData');
            location.href = 'login'
        } else {
            store.commit('setLoginFail', true)
        }
        return;
    }
    store.commit('setAnswer', error.response.data.errors)
    return Promise.reject(error.response ? error.response : error);
});

Vue.prototype.$axios = util.ajax;
export default util;