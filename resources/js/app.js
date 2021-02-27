/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');


import VueRouter from 'vue-router';
import router from './route';
import store from './store';
import axios from 'axios';
import VueAxios from 'vue-axios';
 import DatePicker from 'vue2-datepicker';
import 'vue2-datepicker/index.css';
import * as VeeValidate from 'vee-validate';
import VueAuthenticate from 'vue-authenticate';
import Toast, { POSITION } from "vue-toastification";
// Import the CSS or use your own!
import "vue-toastification/dist/index.css";




Vue.use(Toast, {});

Vue.use(VueAuthenticate, {
    tokenName: 'admin_access_token',
    baseUrl: '/',
    loginUrl: '/api/auth/login',
    registerUrl: '/api/auth/register',
    logoutUrl: '/api/auth/logout',
    storageType: 'cookieStorage',
    providers: {
        oauth2: {
            name: 'oauth2',
            url: 'Token/Exchange',
        }
    }
})


const config = {
  aria: true,
  classNames: {},
  classes: false,
  delay: 0,
  dictionary: null,
  errorBagName: 'errorBag', // change if property conflicts
  events: 'input',
  fieldsBagName: 'fields',
  i18n: null, // the vue-i18n plugin instance
  i18nRootKey: 'validations', // the nested key under which the validation messages will be located
  inject: true,
  locale: 'en',
  validity: false,
  useConstraintAttrs: true
};

Vue.use(VeeValidate, config);
 




Vue.use(VueRouter)
Vue.use(router)
Vue.use(VueAxios, axios)

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('http', require('./components/HTTP.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

require('./route-guard');


const app = new Vue({
    el: '#app',
    router,
    store,
    http: {
      root: '/',
      headers: {
      }
    },
    mounted () {
    },
    created () {

    },
    watch:{
    }
});

require('./interceptor');
