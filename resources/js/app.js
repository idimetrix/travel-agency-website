require('./bootstrap');
require('jquery-validation/dist/jquery.validate.min');
require('jquery-validation/dist/additional-methods.min');
require('./jQuery.succinct.min');
require('jquery-lazy/jquery.lazy.min')
require ('jquery-bar-rating/dist/jquery.barrating.min')
require('./custom');
require('./contact-form');
require('slick-carousel/slick/slick.min');
require('slick-lightbox/dist/slick-lightbox.min');
require('owl.carousel/dist/owl.carousel.min');
require('fg-loadcss');



import Vue from 'vue'
import {proofs} from "./proof-mixin.js";
import {places} from "./scopedAdminSetting";

Vue.component('login-form', require('./components/LoginComponent.vue')) //login
Vue.component('dashboard-container', require('./components/DashboardContainer.vue')) //main dashboard container
Vue.component('wheel-component', require('./components/FortuneWheel.vue'))

if (!places.includes(location.pathname)) {
    const proof = new Vue({
        el: '#proof',
        mixins: [proofs]
    });
} else {
    require('./admin-settings.js')
}


