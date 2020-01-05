import Vue from 'vue'
import Vuetify from 'vuetify'
import util from './settings/util.js'
import store from './store'
import Cookie from 'js-cookie'

Vue.use(Vuetify)

import 'vuetify/dist/vuetify.min.css'
import "material-design-icons-iconfont/dist/material-design-icons.css";
import {generals} from "./components/mixins/generals";

Vue.filter('limiter', (val, max_count) => {
    return val.length <= max_count ? val : val.slice(0, max_count) + '...'
});
Vue.mixin(generals);

const app = new Vue({
    el: "#app",
    store,
    util,
    beforeCreate() {
        if (Cookie.get('cronix-tour-extended')) {
            this.$store.commit('setUser', JSON.parse(Cookie.get('cronix-tour-extended')))
        }
    }
})
