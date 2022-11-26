<template>
    <section>
        <NavVue></NavVue>
        <div class="container mt-3">
            <div v-if="episodes" class="text-center">
                
                <h3 class="text-success">Episodes Of {{character_data.name}}</h3>
                <div v-for="(episode,index) in episodes" :key=index>
                    <div class="alert alert-dismissible alert-primary">
                        <h4 class="alert-heading text-secondary">Episode Name: </h4>
                        <p class="mb-0 text-danger"><b>Link: </b> <a :href='episode' class="alert-link">{{episode}}</a></p>
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
                        <h3 class="card-title">Name: <b>{{character.name}}</b></h3>
                        <h4 class="card-subtitle mb-2">Especie: <b>{{character.species}}</b></h4>
                        <h4 class="card-subtitle mb-2">Status: <b>{{character.status}}</b></h4>
                        <h4 class="card-subtitle mb-2">Gender: <b>{{character.gender}}</b></h4>
                        <h4 class="card-subtitle mb-2">Location: <b>{{character.location.name}}</b></h4>
                    </div>
                    <div class="text-center">   
                        <input @click="getEpisodes(character)" type="button" value="See Episodes" class="btn btn-success mt-2">
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
            character_data: {
                name: null,
            },
            episode_data: {
                episode_name: null
            },
            pagination:{
                next: null,
                previous: null
            }
        }
    },
    created(){
        this.getInfoRickAndMortyApi()    
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
        getEpisodes(character){  
            this.episodes = character.episode;
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
        }
    }
}
</script>
