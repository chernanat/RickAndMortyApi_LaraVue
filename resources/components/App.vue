<template>
    <section>
        <NavVue></NavVue>
        <div class="container mt-3">
            <div v-if="episodes" class="text-center">
                
                <h3 class="text-success">Episodes Of {{character_data.name}}</h3>
                <div v-for="(episode,index) in episodes_api" :key=index>
                    <div class="alert alert-dismissible alert-primary">
                        <h4 class="alert-heading text-secondary">Episode Name: {{episode.name}} </h4>
                        <p><b>Episode Code:</b> {{episode.episode}}</p>
                        <p><b>Launch Date:</b> {{episode.air_date}}</p>
                        <p class="mb-0 text-danger"><b>Link: </b> <a :href='episode.url' class="alert-link">{{episode.url}}</a></p>
                    </div>
                </div>
                <div>
                    <input @click="close()" type="button" value="Close" class="btn btn-success mt-2">
                </div>
                <br>
            </div>
            <div class="row" v-for="(character, index) in characters" :key=index>
                <div class="col-md card">
                    <div class="col-sm text-center">
                        <img v-if="character.image" :src="character.image" alt="Card image cap" style="width: 15rem;">
                        <h3 class="card-title">Character Name: <b>{{character.name}}</b></h3>
                        <h4 class="card-subtitle mb-2">Especie: <b>{{character.species}}</b></h4>
                        <h4 class="card-subtitle mb-2">Status: <b>{{character.status}}</b></h4>
                        <h4 class="card-subtitle mb-2">Gender: <b>{{character.gender}}</b></h4>
                        <h4 class="card-subtitle mb-2">Location: <b>{{character.location.name}}</b></h4>
                        <div>
                            <label for=""><b>Mark As Favorite!</b></label>
                            <input type="checkbox" v-model="data_user" :value="{ id: character.id, user_id: Number(user.user_id) }" @click="markasFavorite()">
                        </div>
                    </div>

                    <div class="text-center">   
                        <input @click="getEpisodes(character)" onclick="window.scrollTo(0,0)" type="button" value="See Episodes" class="btn btn-success mt-2">
                    </div>
                    <br>
                </div>

            </div>
            <div class="text-center">
                <ul class="pagination pagination-lg text-center">
                    <li v-if="pagination.previous" class="page-item"><a class="page-link" @click="previousPage()" href="#previuos">Previous</a></li>
                    <li v-if="pagination.next" class="page-item"><a class="page-link" @click="nextPage()" href="#next" >Next</a></li>
                </ul>
            </div>
        </div>
        <FooterVue></FooterVue>
    </section>
</template>
<script>
import axios from 'axios';
import NavVue from './Layouts/Nav.vue';
import FooterVue from './Layouts/Footer.vue';
import Auth from './helpers/auth'

export default {
    components:{
        NavVue,
        FooterVue
    },
    data(){
        return{
            url_characters: '',
            characters: {},
            episodes: null,
            episodes_api: [],
            character_data: {
                name: null,
            },
            episode_data: {
                episode_name: null
            },
            pagination:{
                next: null,
                previous: null
            },
            user:{
                user_id: null
            },
            favorites: [],
            data_user:[
                {
                    id: '',
                    user_id: ''
                }
            ]
        }
    },
    mounted(){
    },  
    created(){
        this.data_user = []
        this.getInfoRickAndMortyApi()    
        Auth.initialize() 
        this.user.user_id = Auth.data.id
        this.logged()
    },
    methods:{
        async getInfoRickAndMortyApi(){
            await axios.get('https://rickandmortyapi.com/api').then(res=>{
                this.url_characters = res.data.characters
                this.getCharacters(this.url_characters)
            }).catch(err=>{
                console.log(err);
            })
        },
        async getCharacters(url){
            await axios.get(url).then(res=>{
                this.characters = res.data.results
                this.pagination.next = res.data.info.next
                this.pagination.previous = res.data.info.prev
            }).catch(err=>{
                console.log(err);
            })
        },
        async getEpisodes(character){
            this.episodes = [];  
            this.episodes = character.episode;
            for (let i = 0; i < this.episodes.length; i++) {
                await axios.get(this.episodes[i]).then(res=>{
                    this.episodes_api[i] = res.data
                }).catch(err=>{
                    console.log(err);
                })
            }
            this.character_data.name = character.name
        },
        nextPage(){
            this.getCharacters(this.pagination.next)
        },
        previousPage(){
            this.getCharacters(this.pagination.previous)
        },
        close(){
            this.episodes = null;
            this.episodes_api = [];
        },
        logged(){
            if(this.user.user_id == null){
                window.location.href = "/"
            }
        },
        markasFavorite(){
            axios.get(`/favorite`, this.data_user).then(res=>{
                // Swal.fire('Added to Favorite!', '','success')
                console.log(res.data);
            }).catch(err=>{
                console.log(err);
            })
        }
    }
}
</script>