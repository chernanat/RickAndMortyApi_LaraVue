<template>
    <section>
        <NavVue></NavVue>
        <section class="container">
          <h2 class="mt-2 text-center">Login</h2>
          <form class="mt-5" method="post" v-on:submit.prevent="login()">
              <div>
                  <label class='form-label'>Email:</label>
                  <input v-model="user.email" class='form-control' type="email">
              </div>
              <div>
                  <label class='form-label'>Password:</label>
                  <input v-model="user.password" class='form-control' type="password">
              </div>
              <br>
              <div class="d-grid gap-2 text-center">
                  <input class="btn btn-success" type="submit" value="Login">
              </div>
          </form>
        </section>
          <br>
        <FooterVue></FooterVue>

    </section>

  </template>
  
  <script>
  import Auth from '../helpers/auth.js'
  import NavVue from '../Layouts/Nav.vue'
  import FooterVue from '../Layouts/Footer.vue'
  
export default {
    components:{
        NavVue,
        FooterVue
    },
    mounted(){
        Auth.initialize()
        this.auth.user_id = Auth.data.id
        this.validateLogin()
    },
    data(){
        return{
            user:{},
            auth: {
                user_id: null,
            }
        }
    },
    methods:{
        login(){
            axios.post('/sign/login',this.user).then(res => {
                Auth.set(this.user.email,this.user.name,res.data.user.id)
                window.location.href = "/home"
            }
            ).catch(err => {
                if(err.response.status == 422){
                    if(err.response.data.logged == false){
                        Swal.fire(err.response.data.errors,'','error')
                    }else{
                        Swal.fire(err.response.data.message,'','error')
                    }
                }
                else{
                    console.log(err);
                }
            });
        },
        validateLogin(){
            if(this.auth.user_id = Auth.data.id){
                window.location.href = "/home"
            }
        }
    }
  }
</script>