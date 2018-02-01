/**
 * JavaScript dependencies
 */

window._ = require('lodash');
window.axios = require('axios');

/**
 * Ajax config
 */
console.log(window.Laravel.csrfToken);
window.axios.defaults.headers.common = {
    'X-CSRF-TOKEN': window.Laravel.csrfToken,
    'X-Requested-With': 'XMLHttpRequest',
    //'Authorization': 'basic '+window.Laravel.csrfToken,
};

//console.log(window.axios.defaults.headers.common['X-CSRF-TOKEN'])
//console.log('token: '+window.Laravel.csrfToken)
/**
 * Vue application instance
 */




import Vue from 'vue'
import VueRouter from 'vue-router'
import VueAxios from 'vue-axios'
import VueAuth from '@websanova/vue-auth'
import ElementUI from 'element-ui'
import lang from 'element-ui/lib/locale/lang/es'
import locale from 'element-ui/lib/locale'
import 'element-ui/lib/theme-default/index.css'
import './assets/icon.css'
import { TrixVue } from 'trix-vue2'
import VueSimplemde from 'vue-simplemde'
locale.use(lang)

// app components
Vue.use(ElementUI)
Vue.use(VueRouter)
Vue.use(VueAxios, window.axios)
Vue.use(VueSimplemde)

// disable message
Vue.config.productionTip = false

// routes
import routes from './routes'
Vue.router = new VueRouter({ routes: routes});

/*Importando pusher desde front-end*/
  
  import Echo from "laravel-echo"

  window.Pusher = require('pusher-js');

  window.Echo = new Echo({
      broadcaster: 'pusher',
      key: '8f7416536e2111def304',
      cluster : 'eu',
      encrypted :true,
  });
/**fin**/

// vue auth
Vue.use(VueAuth, {
      auth: require('@websanova/vue-auth/drivers/auth/bearer.js'),
      http: require('@websanova/vue-auth/drivers/http/axios.1.x.js'),
      router: require('@websanova/vue-auth/drivers/router/vue-router.2.x.js'),
      rolesVar: 'type',
			loginData: {url: 'login'},
			logoutData: {url: 'logout'},
      fetchData: {url: 'frontend/user'},
      refreshData: {enabled: false},
});

// init
var component = require('./views/App.vue');
component.router = Vue.router;

var App = new Vue({
    el:'#app',
    mounted(){
        
        window.Echo.private('chat')
      .listen('MessageSent', (e) => {
        this.messages.push({
          message: e.message.message,
          user: e.user
        });
      });

    }

});


new Vue(component).$mount('#app');

/*window.Echo.private('chat')
      .listen('MessageSent', (e) => {
        this.messages.push({
          message: e.message.message,
          user: e.user
        });
      });
      */

//https://blog.pusher.com/how-to-build-a-laravel-chat-app-with-pusher/
