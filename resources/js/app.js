import './bootstrap';

import Vue from 'vue'

import HomeIndex from '../components/App.vue';
import NavVue from '../components/Layouts/Nav.vue'
import FooterVue from '../components/Layouts/Footer.vue'

// import los componentes

new Vue({
    el: '#app',
    components:{
        HomeIndex,
        NavVue,
        FooterVue
    }
})
