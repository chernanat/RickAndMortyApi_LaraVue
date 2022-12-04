<template>
    <section>
        <NavVue></NavVue>
        <section>
            <FormUser :person="person"></FormUser>
        </section>
        <br>
        <footer><FooterVue></FooterVue></footer>
    </section>
</template>
<script>
import FooterVue from '../Layouts/Footer.vue';
import NavVue from '../Layouts/Nav.vue'
import FormUser from '../Users/Form.vue'

export default {
    props: ['person'],
    components:{
        NavVue,
        FooterVue,
        FormUser
   },
   mounted(){

    },
    data(){
        return{

          }
      },
    methods:{

      }
}
</script>
