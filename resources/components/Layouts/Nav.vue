<template>
    <section>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <div v-if="auth.email">
                    <a class="navbar-brand" href="/home">RickAndMortyApi</a>
                </div>
                <div v-else>
                    <a class="navbar-brand" href="/">RickAndMortyApi</a>
                </div>

                <div id="navbarColor02">
                    <ul class="navbar-nav me-auto">
                        <li v-if="!auth.email" class="nav-item">
                            <a class="nav-link active" href="/register">Register
                                <span class="visually-hidden"></span>
                            </a>
                            </li>
                        <li v-if="!auth.email" class="nav-item">
                            <a class="nav-link active" href="/">Login
                                <span class="visually-hidden"></span>
                            </a>
                        </li>
                        <li v-if="auth.email" class="nav-item">
                            <a class="nav-link active btn" v-bind:href="'/user/'+ auth.id">Settings
                                <span class="visually-hidden"></span>
                            </a>
                        </li>
                        <li v-if="auth.email" class="nav-item">
                            <a @click="logout" class="nav-link active btn">Logout
                                <span class="visually-hidden"></span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </section>
</template>
<script>

import Auth from '../helpers/auth.js'

export default {
    data(){
        return{
            auth: {
            },
            user: ''
        }
    },
    mounted(){
        Auth.initialize()
        this.index()
    },
    methods:{
        index(){
            this.auth = Auth.data
        },
        logout(){
            axios.post('/sign/logout').then(res=>{
                if(res.data.logout){
                    Auth.remove()
                    window.location.href = "/"
                }
            }).catch(err=>{
                console.log(err);
            })
        }
    }
}
</script>