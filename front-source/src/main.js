import Vue from 'vue'
import BootstrapVue from 'bootstrap-vue';
import App from './App.vue';
import VueRouter from 'vue-router';
import Routes from './routers/router';
import * as uiv from 'uiv';
import Vuex from 'vuex';
import store from './store/'
import VueLazyload from 'vue-lazyload'
import vueVimeoPlayer from 'vue-vimeo-player'
import VueAwesomeSwiper from 'vue-awesome-swiper'
import 'swiper/dist/css/swiper.css'

Vue.use(vueVimeoPlayer);
Vue.use(Vuex);
Vue.use(uiv);
Vue.use(VueRouter);
Vue.use(BootstrapVue);
Vue.use(VueLazyload);
Vue.use(VueAwesomeSwiper);

const router = new VueRouter({
    routes:Routes,
    mode:'history'
});

new Vue({
    el: '#app',
    render: h => h(App),
    router:router,
    store
});

Vue.use(Vuex);Vue.use(VueRouter);
