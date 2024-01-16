import axios from 'axios';
import {mapGetters} from 'vuex';

export default{
    name: 'LoginPage',
    data() {
        return {
            userData:{
                email: null,
                password: null,
            },
            userStatus: false,
        }
    },
    computed:{
        ...mapGetters(['storedToken','storedUserData']),
    },
    methods: {
        home(){
            this.$router.push('/home')
        },
        login(){
            this.$router.push({
                name: 'login',
            })
        },
        logout(){
            this.$store.dispatch('setToken', null);
            this.login();
        },
        accountLogin(){
            
            axios.post('http://localhost:8000/api/user/login',this.userData).then((response)=>{
                
               if(response.data.token == null){
                    this.userStatus = true;
               }else{
                    this.userStatus = false;
                    this.clearFormData();
                    this.storeUserInfo(response);
                    this.home();
               }

            }).catch((error)=> console.log(error));
        },
        storeUserInfo(response){
            this.$store.dispatch("setToken",response.data.token);
            this.$store.dispatch('setUserData',response.data.user);
        },
        clearFormData(){
            this.userData.email = null;
            this.userData.password = null;
        }
    },
}