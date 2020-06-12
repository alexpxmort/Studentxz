require('./bootstrap');

//Configração das dependências que serão utilizadas em conjunto com o vue no projeto
import '../../node_modules/bulma/css/bulma.css';
import LoginComponent from './components/LoginComponent.vue';
import SignUpComponent from './components/SignUpComponent.vue';
import HomeComponent from './components/HomeComponent.vue';
import Alert from './components/alert.vue';
import Buefy from 'buefy'
import store from './vuex/vuex';
import VueRouter from 'vue-router';
import routes from './routes/route';
import NavBar from './components/NavBar.vue';
import Vue from 'vue';
import Vuelidate from 'vuelidate'
import XGrid from './components/grids/xgrid.vue';

window.Vue = require('vue');
window.VueRouter = require('vue-router');

 Vue.component('login-component',LoginComponent);
 Vue.component('signup-component',SignUpComponent);
 Vue.component('home-component',HomeComponent);
 Vue.component('alert-vuexx',Alert);
 Vue.component('custom-nav-bar', NavBar);
 Vue.component('x-grid',XGrid);

 Vue.config.devtools = true;

Vue.use(Vuelidate);
Vue.use(Buefy);
Vue.use(VueRouter);


const router = new VueRouter({
    routes
});


Window.router = router;
const app = new Vue({
    el: '#app',
    components: {
        LoginComponent,
        SignUpComponent,
        HomeComponent,
        Alert,
        XGrid
    },
    store: store,
    router
  }).$mount('#app');

