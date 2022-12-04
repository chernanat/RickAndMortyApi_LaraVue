export default {
    data:{
        email:null,
        id:null
    },
    initialize(){
        this.data.email = localStorage.getItem('email')
        this.data.id = localStorage.getItem('id')
    },
    set(email, username,id ){
        localStorage.setItem('email', email)
        localStorage.setItem('id', id)
        this.initialize()
    },
    remove(){
        localStorage.removeItem('email')
        localStorage.removeItem('id')
        this.initialize()
    }
}