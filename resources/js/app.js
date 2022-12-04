import './bootstrap';

import swal from 'sweetalert2';
window.Swal = swal;

import Vue from 'vue'

import HomeIndex from '../components/App.vue';
import NavVue from '../components/Layouts/Nav.vue'
import FooterVue from '../components/Layouts/Footer.vue'
import LoginUser from '../components/Login/Login.vue'
import RegisterUser from '../components/Login/Register.vue'
import IndexUser from '../components/Users/Index.vue'
import FormUser from '../components/Users/Form.vue'

// import los componentes

new Vue({
    el: '#app',
    components:{
        HomeIndex,
        NavVue,
        FooterVue,
        LoginUser,
        RegisterUser,
        IndexUser,
        FormUser
    }
})
