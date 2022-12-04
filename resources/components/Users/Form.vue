<template>
    <section class="container">
        <div class="mt-2" v-if="user.name">
            <h2>Edit User {{user.name}}</h2> 
        </div>
        <div class="mt-2" v-else>
            <h2>Edit User {{user.email}}</h2> 
        </div>
        <form class="form mt-2" method="post" v-on:submit.prevent="update(person.id)">
            <div>
                <label class="form-label" for="">Name:</label>
                <input class="form-control"  type="text" v-model="user.name">
            </div>
            <div>
                <label class="form-label" for="">Email:</label>
                <input class="form-control"  type="email" v-model="user.email">
            </div>
            <div>
                <label class="form-label" for="">Adress:</label>
                <input class="form-control" type="text" v-model="user.address">
            </div>
            <div>
                <label class="form-label" for="">BirthDate:</label>
                <input class="form-control" type="date" v-model="user.birthdate">
            </div>
            <div>
                <label class="form-label" for="">City:</label>
                <input class="form-control"  type="text" v-model="user.city">
            </div>
            <br>
            <div class="d-grid gap-2 text-center">
                <input class="btn btn-success" type="submit" value="Update Information!">
            </div>
        </form>
    </section>
</template>
<script>


export default {
    props:['person'],
    components:{
   },
   mounted(){
        this.user = (this.$parent.person);
    },
    data(){
        return{
            user:{}
        }
      },
    methods:{
        update(id){
            axios.post(`/user/${id}`,this.user).then(res=>{
                if(res.data.updated){
                    Swal.fire('User Updated!', '', 'success');
                }
            }).catch(err=>{
                if(err.response.status == 500){
                    Swal.fire('Error!', 'Email Cannot Be empty!', 'error');
                }
                console.log(err);
            })
        }
      }
}
</script>